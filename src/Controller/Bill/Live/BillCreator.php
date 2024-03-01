<?php

namespace App\Controller\Bill\Live;

use App\Entity\Bill;
use App\Entity\Customer;
use App\Entity\Product;
use App\Entity\ProductBill;
use App\Form\BillType;
use App\Repository\CustomerRepository;
use App\Repository\ProductRepository;
use App\Service\Bill\BillCreatorService;
use App\Service\Bill\ProductBillCreatorService;
use App\Service\Quote\QuoteCreatorService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveListener;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\Attribute\PreReRender;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\ValidatableComponentTrait;
use Symfony\Component\Validator\Constraints as Assert;

#[AsLiveComponent]
class BillCreator extends AbstractController
{
    use DefaultActionTrait;
    use ValidatableComponentTrait;
    use ComponentWithFormTrait;

    #[LiveProp]
    public string $mode = 'create';

    #[LiveProp(writable: true)]
    public ?Bill $billData = null;

    #[LiveProp(writable: true)]
    #[Assert\Valid]
    public ?Customer $customer = null;

    #[LiveProp(writable: true)]
    #[Assert\NotNull(message: 'Vous devez saisir un numéro de devis.')]
    #[Assert\Length(
        min: 3,
        max: 255,
        minMessage: 'Le numéro de facture doit contenir au moins {{ limit }} caractères.',
        maxMessage: 'Le numéro de facture doit contenir au maximum {{ limit }} caractères.',
    )]
    public string $billNumber = '';

    #[LiveProp(writable: true, format: 'Y-m-d')]
    #[Assert\NotNull(message: 'Vous devez choisir une date d\'émission.')]
    public \DateTimeInterface $billIssuanceDate;

    #[LiveProp(writable: true)]
    #[Assert\PositiveOrZero(message: 'La remise doit être supérieur ou égale à 0.')]
    #[Assert\LessThanOrEqual(value: 100, message: 'La remise doit être inférieur ou égale à 100.')]
    public float $discount;

    #[LiveProp(writable: true)]
    #[Assert\PositiveOrZero(message: 'La TVA doit être supérieur ou égale à 0.')]
    #[Assert\LessThanOrEqual(value: 100, message: 'La TVA doit être inférieur ou égale à 100.')]
    public float $tva;

    #[LiveProp(writable: true)]
    #[Assert\Choice(choices: [0, 1], message: 'Le statut choisi est invalide.')]
    public int $status;

    #[LiveProp]
    public array $productBillData = [];


    public function __construct(
        private readonly BillCreatorService $billCreatorService,
        private readonly ProductBillCreatorService $productBillCreatorService,
        private readonly CustomerRepository $customerRepository,
    )
    {
    }

    public function mount(Bill $bill)
    {
        $this->billData = $bill;
        $this->setDefaultData();
    }

    private function setDefaultData(): void
    {
        $this->customer = $this->billCreatorService->getDefaultCustomer($this->billData);
        $this->billNumber = $this->billCreatorService->getDefaultBillNumber($this->billData);
        $this->billIssuanceDate = $this->billCreatorService->getDefaultBillIssuanceDate($this->billData);
        $this->status = $this->billCreatorService->getDefaultBillStatus($this->billData);
        $this->discount = $this->billCreatorService->getDefaultDiscount($this->billData);
        $this->tva = $this->billCreatorService->getDefaultTVA($this->billData);
    }

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(BillType::class, $this->billData);
    }

    #[LiveAction]
    public function saveBill(EntityManagerInterface $entityManager, Session $session)
    {
        $this->validate();
        $this->refreshBillData();

        try {
            $entityManager->persist($this->billData);
            $entityManager->flush();
        } catch (\Exception $e) {
            $this->addFlash('danger', 'Erreur lors de l\'enregistrement de la facture.');
            return $this->redirectToRoute('app_bill_index');
        }

        $this->addFlash('success', 'Facture enregistrée avec succès.');
        return $this->redirectToRoute('app_bill_show', [
            'id' => $this->billData->getId(),
        ]);
    }

    #[LiveListener('product_bill_item:save')]
    public function saveProductItem(
        #[LiveArg] int $key,
        #[LiveArg] int $productId,
        #[LiveArg] int $quantity,
        #[LiveArg] float $price,
    ): void
    {
        $this->refreshBillData();

        $this->setProductBillItem($key, [
            'productId' => $productId,
            'quantity' => $quantity,
            'price' => $price,
            'total' => $quantity * $price,
            'isEditing' => false,
        ]);
    }

    private function refreshBillData(): void
    {
        $this->billData->setCustomer($this->customer);
        $this->billData->setBillNumber($this->billNumber);
        $this->billData->setBillIssuanceDate($this->billIssuanceDate);
        $this->billData->setStatus($this->status);
        $this->billData->setDiscount($this->discount);
        $this->billData->setTva($this->tva);

        foreach ($this->productBillData as $productBillDatum) {
            $productBill = $this->productBillCreatorService->createProductBill($productBillDatum);
            $this->billData->addProductBill($productBill);
        }
    }

    #[PreReRender]
    public function preRender(): void
    {
        //$this->refreshBillData();
    }

    #[LiveAction]
    public function addProductBillItem(): void
    {
        $this->productBillData[] =  $this->productBillCreatorService->generateDefaultProductBillData();
    }

    public function setProductBillItem(int $index, array $data): void
    {
        $this->productBillData[$index] = $data;
    }

    #[LiveListener('product_bill_item:remove')]
    public function removeProductBillItem(#[LiveArg] int $index): void
    {
        unset($this->productBillData[$index]);
    }

}
