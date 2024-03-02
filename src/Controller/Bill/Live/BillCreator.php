<?php

namespace App\Controller\Bill\Live;

use App\Entity\Bill;
use App\Form\BillType;
use App\Entity\Product;
use App\Entity\Customer;
use App\Entity\ProductBill;
use App\Service\PdfService;
use App\Controller\MailerController;
use App\Repository\ProductRepository;
use App\Repository\CustomerRepository;
use App\Service\Bill\BillCreatorService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormInterface;
use App\Service\Quote\QuoteCreatorService;
use App\Service\Bill\ProductBillCreatorService;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\TwigComponent\Attribute\PostMount;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\PreReRender;
use Symfony\UX\LiveComponent\Attribute\LiveListener;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\ValidatableComponentTrait;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

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
    #[Assert\Choice(choices: [0, 1], message: 'Le statut choisi est invalide.')]
    public int $status;

    #[LiveProp]
    public array $productBillData = [];

    #[LiveProp]
    public float $total = 0.0;

    #[LiveProp]
    public $totalDiscount = 0.0;

    #[LiveProp]
    public float $totalWithDiscount = 0.0;

    private const FIELD_TO_VALIDATE = [
        'customer',
        'billNumber',
        'billIssuanceDate',
        'discount',
        'status',
    ];


    public function __construct(
        private readonly BillCreatorService $billCreatorService,
        private readonly ProductBillCreatorService $productBillCreatorService,
        private readonly CustomerRepository $customerRepository,
        private readonly PdfService $pdfService,
        //private readonly BillPdfController $billPdfController,
        private readonly MailerController $mailer
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
        $this->productBillData = $this->billCreatorService->getDefaultProductBills($this->billData);
    }

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(BillType::class, $this->billData);
    }

    #[LiveAction]
    public function saveBill(EntityManagerInterface $entityManager, Session $session)
    {
        $this->validate();
        $this->refreshBillData($entityManager);

        try {
            $entityManager->persist($this->billData);
            $entityManager->flush();
        } catch (\Exception $e) {
            $this->addFlash('error', $e->getMessage());
            return $this->redirectToRoute('app_bill_index');
        }
        
        // if($this->billData->getStatus() == Bill::STATUS_SENT){
        //     $this->mailer->newBillCreateEmail($this->billData->getCustomer(), $this->billData, $this->pdfService, $this->billPdfController);
        // }

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
        #[LiveArg] float $tva,
        #[LiveArg] float $discount,
        #[LiveArg] float $price,
    ): void
    {
        $data = [
            'productId' => $productId,
            'quantity' => $quantity,
            'price' => $price,
            'tva' => $tva,
            'discount' => $discount,
            'total' => $quantity * $price,
            'isEditing' => false,
        ];

        $this->setProductBillItem($key, $data);
    }

    private function refreshBillData(EntityManagerInterface $entityManager): void
    {
        $this->billData->setCustomer($this->customer);
        $this->billData->setBillNumber($this->billNumber);
        $this->billData->setBillIssuanceDate($this->billIssuanceDate);
        $this->billData->setStatus($this->status);
        $this->billData->setDiscount($this->discount);

        $existingProductBills = $this->billData->getProductBills();
        foreach ($existingProductBills as $productBill) {
            $this->billData->removeProductBill($productBill);
            $entityManager->remove($productBill);
        }

        foreach ($this->productBillData as $data) {
            $this->billData->addProductBill($this->productBillCreatorService->createProductBill($data));
        }
    }

    #[PostMount]
    public function postMount()
    {
        $this->refreshTotal();
    }

    #[PreReRender]
    public function preRender(): void
    {
        $this->refreshTotal();
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

    #[LiveListener('product_bill_item:change_edit_mode')]
    public function onLineItemEditModeChange(#[LiveArg] int $key, #[LiveArg] $isEditing): void
    {
        $this->productBillData[$key]['isEditing'] = $isEditing;
    }

    #[LiveListener('product_bill_item:remove')]
    public function removeProductBillItem(#[LiveArg] int $index): void
    {
        unset($this->productBillData[$index]);
    }

    #[ExposeInTemplate('_isReadOnlyMode')]
    public function isReadOnlyMode(): bool
    {
        return ('show' == $this->mode);
    }

    #[ExposeInTemplate('_productItemsIsEmpty')]
    public function productBillsIsEmpty(): bool
    {
        return empty($this->productBillData);
    }

    #[ExposeInTemplate('_hasPendingProductBill')]
    public function hasPendingProductBill(): bool
    {
        foreach ($this->productBillData as $productBill) {
            if ($productBill['isEditing']) {
                return true;
            }
        }
        return false;
    }

    #[ExposeInTemplate('_canSaveBill')]
    public function canSaveBill(): bool
    {
        return !$this->productBillsIsEmpty() && !$this->hasPendingProductBill();
    }

    #[ExposeInTemplate('_hasErrors')]
    public function hasErrors(): bool
    {
        foreach (self::FIELD_TO_VALIDATE as $field) {
            if ($this->getErrors($field)) {
                return true;
            }
        }
        return false;
    }

    #[ExposeInTemplate('_allValid')]
    public function isValid(): bool
    {
        return !$this->hasErrors() && $this->canSaveBill();
    }

    #[ExposeInTemplate('_hasDiscountValue')]
    public function hasDiscountValue(): bool
    {
        return $this->discount > 0;
    }

    public function _getTotal(): float
    {
        $total = 0.0;
        foreach ($this->productBillData as $lineItem) {
            if ($lineItem['isEditing']) {
                continue;
            }
            $price = $lineItem['price'];
            $quantity = $lineItem['quantity'];
            $tva = $lineItem['tva'];
            $discount = $lineItem['discount'];

            $totalHT = $price * $quantity;
            $totalTva = $totalHT * ($tva / 100);
            $totalDiscount = $totalHT * ($discount / 100);

            $total += $totalHT + $totalTva - $totalDiscount;
        }
        return $total;
    }

    private function refreshTotal(): void
    {
        $this->total = $this->_getTotal();
        $this->totalDiscount = $this->total * ($this->discount / 100);
        $this->totalWithDiscount = $this->total - $this->totalDiscount;
    }

}
