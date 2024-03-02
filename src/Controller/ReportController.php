<?php

namespace App\Controller;

use App\Repository\PaymentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
use App\Service\SalesReportService;

class ReportController extends AbstractController
{
    /**
     * @Route("/report", name="report")
     */
    public function report(Request $request, ChartBuilderInterface $chartBuilder, PaymentRepository $paymentRepository, SalesReportService $salesReportService): Response
    {
        $timePeriod = $request->query->get('period', 'month');
        switch ($timePeriod) {
            case 'year':
                $paymentsData = $paymentRepository->getTotalPriceSumByYear();
                $labels = [];
                $data = [];

                // Iterate over the payment data and populate the labels and data arrays
                foreach ($paymentsData as $payment) {
                    $year = (int) $payment['year'];
                    $labels[] = $year; // Add the year to the labels array
                    $data[] = $payment['totalPrice']; // Add the total price to the data array
                }

                // Create the bar chart
                $chart = $this->createBarChart($chartBuilder, 'Revenus par année', 'Year', array_reverse($labels), array_reverse($data));
                break;
            default:
                // Default to month
                $paymentsData = $paymentRepository->getTotalPriceSumByMonth();
                $labels = [];
                $data = [];

                // Group payments data by year and month
                $groupedData = [];
                foreach ($paymentsData as $payment) {
                    $year = $payment['year'];
                    $month = $payment['month'];
                    if (!isset($groupedData[$year])) {
                        $groupedData[$year] = array_fill(1, 12, 0);
                    }
                    $groupedData[$year][$month] = $payment['totalPrice'];
                }

                // Populate labels and data arrays for the current year and the previous year
                $currentYear = date('Y');
                $previousYear = $currentYear - 1;
                foreach ([$currentYear, $previousYear] as $year) {
                    // Reverse the order of months within each year
                    krsort($groupedData[$year]);
                    foreach ($groupedData[$year] as $month => $totalPrice) {
                        $labels[] = sprintf('%s-%02d', $year, $month); // Format: YYYY-MM
                        $data[] = $totalPrice;
                    }
                }

                // Create the bar chart
                $chart = $this->createBarChart($chartBuilder, 'Revenus par mois (sur les deux dernières années)', 'Mois', array_reverse($labels), array_reverse($data));
                break;
        }

        // Data for the doughnut chart
        $doughnutData = $paymentRepository->getTotalPriceSumByCategory();
        $doughnutLabels = array_keys($doughnutData);
        $doughnutValues = array_values($doughnutData);
        $doughnutBackgroundColors = ['rgb(255, 99, 132)', 'rgb(144, 213, 79)', 'rgb(255, 205, 86)'];

        // Create the doughnut chart
        $doughnutChart = $chartBuilder->createChart(Chart::TYPE_DOUGHNUT);
        $doughnutChart->setData([
            'labels' => $doughnutLabels,
            'datasets' => [
                [
                    'data' => $doughnutValues,
                    'backgroundColor' => $doughnutBackgroundColors,
                ],
            ],
        ]);
        $doughnutChart->setOptions([
            'plugins' => [
                'legend' => [
                    'position' => 'top',
                ],
                'title' => [
                    'display' => true,
                    'text' => 'Etat total des paiements',
                ],
            ],
            'maintainAspectRatio' => false,
        ]);

        // Get product sales data
        $productSales = $salesReportService->getProductSalesByMonth();

        return $this->render('accountant/report.html.twig', [
            'chart' => $chart,
            'doughnutChart' => $doughnutChart,
            'productSales' => $productSales,
        ]);
    }

    private function createBarChart(ChartBuilderInterface $chartBuilder, string $title, string $xAxisTitle, array $labels, array $data): Chart
    {
        $chart = $chartBuilder->createChart(Chart::TYPE_BAR);
        $chart->setData([
            'labels' => $labels,
            'datasets' => [
                [
                    'label' => 'Total Price',
                    'backgroundColor' => 'rgb(144, 213, 79)',
                    'borderColor' => 'rgb(255, 255, 255)',
                    'data' => $data,
                ],
            ],
        ]);
        $chart->setOptions([
            'scales' => [
                'y' => [
                    'beginAtZero' => true,
                    'ticks' => [
                        'stepSize' => 500,
                    ],
                    'title' => [
                        'display' => true,
                        'text' => 'Total (€)',
                    ],
                ],
                'x' => [
                    'title' => [
                        'display' => true,
                        'text' => $xAxisTitle,
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'position' => 'top',
                ],
                'title' => [
                    'display' => true,
                    'text' => $title,
                ],
            ],
            'maintainAspectRatio' => false,
        ]);

        return $chart;
    }
}
