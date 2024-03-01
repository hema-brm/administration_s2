<?php

namespace App\Controller\Bill\Live\BillCreator;

use App\Entity\Product;
use App\Entity\ProductBill;
use App\Form\ProductBillType;
use App\Service\Bill\ProductBillCreatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveListener;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\Attribute\PreReRender;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\LiveResponder;
use Symfony\UX\LiveComponent\ValidatableComponentTrait;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PostMount;

#[AsLiveComponent]
class Item extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;
    use ValidatableComponentTrait;

    #[LiveProp]
    public int $key;

    #[LiveProp]
    public bool $isEditing = true;

    #[LiveProp(writable: true)]
    public ?ProductBill $productBill = null;

    #[LiveProp(writable: true)]
    public Product $product;

    #[LiveProp(writable: true)]
    public int $productId;

    #[LiveProp(writable: true)]
    #[Assert\Positive(message: 'La quantité doit être un nombre positif.')]
    public int $quantity;

    #[LiveProp(writable: true)]
    #[Assert\GreaterThanOrEqual(value: 0, message: 'Le prix ne doit pas être négatif.')]
    public float $price;

    #[LiveProp(writable: true)]
    #[Assert\Range(
        notInRangeMessage: 'La TVA doit être comprise entre {{ min }} et {{ max }}.',
        min: 0,
        max: 100,
    )]
    public float $tva;

    #[LiveProp(writable: true)]
    #[Assert\Range(
        notInRangeMessage: 'La remise doit être comprise entre {{ min }} et {{ max }}.',
        min: 0,
        max: 100,
    )]
    public float $discount;

    #[LiveProp]
    #[Assert\Positive(message: 'Veuillez vérifier la quantité et le prix.')]
    public float $total;

    #[LiveProp]
    public float $totalHT = 0.0;

    #[LiveProp]
    public float $totalTTC = 0.0;

    #[LiveProp]
    public float $totalTVA = 0.0;

    #[LiveProp]
    public float $totalDiscount = 0.0;

    #[LiveProp]
    public string $mode = 'create';

    public function __construct(
        private readonly ProductBillCreatorService $productBillCreatorService,
    )
    {
    }

    public function mount(int $productId): void
    {
        $this->productId = $productId;
        $this->setDefaultData();
    }

    #[PostMount]
    public function postMount(): void
    {
        $this->refreshTotal();
    }

    public function getTotalHT(): float
    {
        return $this->quantity * $this->price;
    }

    public function getTotalTTC(): float
    {
        return $this->getTotalHT() * (1 + $this->tva / 100);
    }

    public function getTotalTVA(): float
    {
        return $this->getTotalHT() * ($this->tva / 100);
    }

    public function getTotalDiscount(): float
    {
        return $this->getTotalHT() * ($this->discount / 100);
    }

    public function getTotal(): float
    {
        return $this->getTotalTTC() - $this->getTotalDiscount();
    }

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(ProductBillType::class, $this->productBill);
    }

    private function setDefaultData(): void
    {
        $this->product = $this->productBillCreatorService->getDefaultProduct($this->productId);
        $this->quantity = $this->productBillCreatorService->getDefaultQuantity();
        $this->tva = $this->productBillCreatorService->getDefaultTva();
        $this->discount = $this->productBillCreatorService->getDefaultDiscount();
        $this->price = $this->productBillCreatorService->getDefaultPrice();

        $this->refreshTotal();
    }

    private function changeEditMode(bool $isEditing,  LiveResponder $responder): void
    {
        $this->isEditing = $isEditing;

        $responder->emitUp('product_bill_item:change_edit_mode', [
            'key' => $this->key,
            'isEditing' => $this->isEditing,
        ]);
    }

    #[PreReRender]
    public function preReRender(): void
    {
        $this->refreshTotal();
    }

    #[LiveAction]
    public function save(LiveResponder $responder): void
    {
        $this->validate();

        $responder->emitUp('product_bill_item:save', [
            'key' => $this->key,
            'productId' => $this->product->getId(),
            'quantity' => $this->quantity,
            'tva' => $this->tva,
            'discount' => $this->discount,
            'price' => $this->price,
        ]);

        $this->changeEditMode(false, $responder);
        $this->addFlash('info', 'Produit ajouté au facture.');
    }

    #[LiveAction]
    public function edit(LiveResponder $responder): void
    {
        $this->changeEditMode(true, $responder);
    }

    #[LiveListener('product_bill:product_selection_change')]
    public function onProductSelectionChange(): void
    {
        $this->price = $this->product->getPrice();
    }

    #[ExposeInTemplate('_canSave')]
    public function canSaveItems(): bool
    {
        return $this->mode != 'show';
    }

    private function refreshTotal()
    {
        $this->total = $this->getTotal();
        $this->totalHT = $this->getTotalHT();
        $this->totalTTC = $this->getTotalTTC();
        $this->totalTVA = $this->getTotalTVA();
        $this->totalDiscount = $this->getTotalDiscount();
    }

}
