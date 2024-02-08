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
                    'backgroundColor' => 'rgb(255, 99, 132)',
                    'borderColor' => 'rgb(255, 99, 132)',
                    'data' => $data,
                ],
            ],
        ]);
        $chart->setOptions([
            'scales' => [
                'y' => [
                    'suggestedMin' => 0,  
                    'suggestedMax' => 1000, 
                    'title' => [ 
                        'display' => true,
                        'text' => 'Total (€)',
                    ],
                ],
                'x' => [
                    'title' => [ // Add title for x-axis
                        'display' => true,
                        'text' => 'Mois',
                    ],
                ],
            ],
            
        ]);

        return $this->render('accountant/accountant.html.twig', [
            'chart' => $chart,
        ]);
    }
}
