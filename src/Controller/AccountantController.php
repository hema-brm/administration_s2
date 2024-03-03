<?php

namespace App\Controller;

use App\Repository\PaymentRepository;
use App\Repository\BillRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;
use Symfony\Component\Security\Http\Attribute\IsGranted;


class AccountantController extends AbstractController
{
    /**
     * @Route("/accountant", name="accountant")
     */
    #[IsGranted('view')]
    public function accountant(ChartBuilderInterface $chartBuilder, PaymentRepository $paymentRepository, BillRepository $billRepository): Response
    {
        // Fetch recent payments
        $recentPayments = $paymentRepository->findRecentPayments(5);

        // Fetch recent bills
        $recentBills = $billRepository->findRecentBills(5);

        // Get payment data for the bar chart
        $paymentsData = $paymentRepository->getTotalPriceSumByMonth();
        $labels = [];
        $data = [];

        // Group payments data by year and month
        $groupedData = [];
        if ($paymentsData !== null) { // Check if paymentsData is not null
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
                if (isset($groupedData[$year])) { // Check if $groupedData[$year] is set
                    // Reverse the order of months within each year
                    krsort($groupedData[$year]);
                    foreach ($groupedData[$year] as $month => $totalPrice) {
                        $labels[] = sprintf('%s-%02d', $year, $month); // Format: YYYY-MM
                        $data[] = $totalPrice;
                    }
                }
            }
        }

        // Reverse the order of labels and data to show oldest to newest
        $labels = array_reverse($labels);
        $data = array_reverse($data);

        // Create the bar chart
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
                        'text' => 'Mois',
                    ],
                ],
            ],
            'plugins' => [
                'legend' => [
                    'position' => 'top',
                ],
                'title' => [
                    'display' => true,
                    'text' => 'Revenus par mois (sur les deux dernières années)',
                ],
            ],
            'maintainAspectRatio' => false,
        ]);

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

        return $this->render('accountant/accountant.html.twig', [
            'chart' => $chart,
            'doughnutChart' => $doughnutChart,
            'recentPayments' => $recentPayments,
            'recentBills' => $recentBills,
        ]);
    }
}
