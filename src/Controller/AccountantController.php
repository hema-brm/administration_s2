<?php

namespace App\Controller;

use App\Repository\PaymentRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\UX\Chartjs\Builder\ChartBuilderInterface;
use Symfony\UX\Chartjs\Model\Chart;



class AccountantController extends AbstractController
{
    /**
     * @Route("/accountant", name="accountant")
     */
    public function accountant(ChartBuilderInterface $chartBuilder, PaymentRepository $paymentRepository): Response
    {

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
                    'text' => 'Revenus',
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
                    'text' => 'Etat des paiements',
                ],
            ],
            'maintainAspectRatio' => false,
        ]);

        return $this->render('accountant/accountant.html.twig', [
            'chart' => $chart,
            'doughnutChart' => $doughnutChart,
        ]);
    }
}
