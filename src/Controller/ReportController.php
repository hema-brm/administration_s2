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
                $productSales = $salesReportService->getProductSalesByYear();
                echo "<pre>";
                print_r($productSales);
                echo "</pre>";
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
                                'text' => 'Year', // Change the x-axis title to "Year"
                            ],
                        ],
                    ],
                    'plugins' => [
                        'legend' => [
                            'position' => 'top',
                        ],
                        'title' => [
                            'display' => true,
                            'text' => 'Revenus par année', // Change the chart title to "Revenue Per Year"
                        ],
                    ],
                    'maintainAspectRatio' => false,
                ]);

                break;
            default:
                // Default to month
                $productSales = $salesReportService->getProductSalesByMonth();
                echo "<pre>";
                print_r($productSales);
                echo "</pre>";
                $paymentsData = $paymentRepository->getTotalPriceSumByMonth();
                $labels = [];
                $data = array_fill(1, 12, 0);

                foreach ($paymentsData as $payment) {
                    $month = (int) $payment['month'];
                    $data[$month] = $payment['totalPrice'];
                }


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
                            'text' => 'Revenus par mois',
                        ],
                    ],
                    'maintainAspectRatio' => false,
                ]);

                break;
        }



        // Data for the doughnut chart
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
                    'text' => 'Etat des paiements',
                ],
            ],
            'maintainAspectRatio' => false,
        ]);

        return $this->render('accountant/report.html.twig', [
            'chart' => $chart,
            'doughnutChart' => $doughnutChart,
            'productSales' => $productSales,
        ]);
    }
}
