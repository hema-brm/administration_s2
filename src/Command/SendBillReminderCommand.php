<?php

namespace App\Command;

use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputArgument;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use App\Repository\PaymentRepository;
use App\Service\Mailer;
use App\Entity\Payment;

#[AsCommand(
    name: 'send:bill-reminder',
    description: 'Envoi des rappels de facture automatiques',
)]
class SendBillReminderCommand extends Command
{
    private $emailService;
    private $paymentRepository;

    public function __construct(Mailer $mailer, PaymentRepository $paymentRepository)
    {
        parent::__construct();
        $this->emailService = $mailer;
        $this->paymentRepository = $paymentRepository;
    }

    protected function configure(): void
    {
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $io = new SymfonyStyle($input, $output);
       
        $LateBills = $this->paymentRepository->findLateBills();
        $deadlineBills = $this->paymentRepository->findDeadlineBills();
        $LateInThreeDaysBills= $this->paymentRepository->findLateInThreeDaysBills();

        foreach ($LateBills as $bill) {
            $customer = $bill->getCustomer(); 
            $sendMail = $this->emailService->sendMail(3, $customer); //a mettre l'id du template
            if($sendMail){
                $io->success("Relance envoyée pour la facture n° " . $bill->getBillNumber());
            }
        }

        foreach ($deadlineBills as $bill) {
            $customer = $bill->getCustomer(); 
            $sendMail = $this->emailService->sendMail(3, $customer);
            if($sendMail){
                $io->success("Relance envoyée pour la facture n° " . $bill->getBillNumber());
            }
        }

        foreach ($LateInThreeDaysBills as $bill) {
            $customer = $bill->getCustomer(); 
            $sendMail = $this->emailService->sendMail(3, $customer);
            if($sendMail){
                $io->success("Relance envoyée pour la facture n° " . $bill->getBillNumber());
            }
        }

        return Command::SUCCESS;
    }
}
