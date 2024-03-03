<?php

namespace App\Controller\Quote\Live\QuoteCreator;

use App\Entity\Product;
use App\Entity\ProductQuote;
use App\Form\ProductQuoteType;
use App\Repository\ProductRepository;
use App\Service\Quote\QuoteCreatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveListener;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\Attribute\PreReRender;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\LiveResponder;
use Symfony\UX\LiveComponent\ValidatableComponentTrait;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PostMount;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsLiveComponent]
class Item extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;
    use ValidatableComponentTrait;

    #[LiveProp]
    public int $key;

    #[LiveProp(writable: true)]
    #[Assert\GreaterThanOrEqual(value: 0, message: 'Le prix ne doit pas être négatif.')]
    public ?float $price = null;

    #[LiveProp(writable: true)]
    #[Assert\Positive(message: 'La quantité doit être un nombre positif.')]
    public int $quantity = 1;

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
    public float $total = 0.0;

    #[LiveProp]
    public float $totalHT = 0.0;

    #[LiveProp]
    public float $totalTTC = 0.0;

    #[LiveProp]
    public float $totalTVA = 0.0;

    #[LiveProp]
    public float $totalDiscount = 0.0;

    #[LiveProp]
    public bool $isEditing = false;

    #[LiveProp]
    public string $mode = 'create';

    #[LiveProp]
    public bool $canEdit = true;

    #[LiveProp]
    public ?ProductQuote $initialFormData = null;

    #[LiveProp(writable: true)]
    #[Assert\NotNull(message: 'Vous devez choisir un produit.')]
    public ?Product $product = null;

    #[LiveProp(writable: true)]
    public bool $itemPriceHasBeenEdited = false;

    public function __construct(
        private readonly ProductRepository $productRepository,
    )
    {

    }

    public function mount(?int $productId): void
    {
        if ($productId) {
            $this->product = $this->productRepository->find($productId);
        }
    }

    protected function instantiateForm(): FormInterface
    {
        return $this->getForm();
    }

    private function getForm(): FormInterface
    {
        return $this->createForm(ProductQuoteType::class, $this->initialFormData);
    }

    #[LiveAction]
    public function save(LiveResponder $responder): void
    {
        $this->validate();

        $this->addFlash('info', 'Produit ajouté au devis.');


        $this->changeEditMode(false, $responder);

        $responder->emitUp('line_item:save', [
            'key' => $this->key,
            'product' => $this->product->getId(),
            'quantity' => $this->quantity,
            'tva' => $this->tva,
            'discount' => $this->discount,
            'price' => $this->price,
            'total' => $this->total,
        ]);
    }

    #[LiveAction]
    public function edit(LiveResponder $responder): void
    {
        $this->changeEditMode(true, $responder);
    }

    private function changeEditMode(bool $isEditing, LiveResponder $responder): void
    {
        $this->isEditing = $isEditing;

        $responder->emitUp('line_item:change_edit_mode', [
            'key' => $this->key,
            'isEditing' => $this->isEditing,
        ]);
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
        $total = $this->getTotalHT() + $this->getTotalTVA() - $this->getTotalDiscount();
        if ($total < 0) {
            $total = 0;
        }

        return $total;
    }

    #[ExposeInTemplate]
    public function lineItemsHasErrors()
    {
        $productError = $this->getErrors('product');
        $quantityError = $this->getErrors('quantity');

        return !empty($productError) || !empty($quantityError);
    }

    #[ExposeInTemplate('_canSaveItems')]
    public function canSaveItems(): bool
    {
        if (!$this->canEdit) {
            return false;
        }
        return $this->mode != 'show';
    }

    private function setDefaultProduct(): void
    {
        if (empty($this->product)) {
            $this->product = $this->productRepository->findOneBy([], [
                'id' => 'ASC'
            ]);
        }
    }

    #[PostMount]
    public function postMount(): void
    {
        $this->initTotals();
    }

    #[PreReRender]
    public function onEachUpdate(): void
    {
        $this->initTotals();
    }

    private function initTotals(): void
    {
        $this->totalHT = $this->getTotalHT();
        $this->totalTVA = $this->getTotalTVA();
        $this->totalDiscount = $this->getTotalDiscount();
        $this->total = $this->getTotalTTC();
    }

    #[LiveListener('product_selection_has_been_changed')]
    public function onProductChanged()
    {
        if (!$this->isEditing || $this->itemPriceHasBeenEdited) {
            return;
        }

        $this->price = $this->product->getPrice();
    }

    #[LiveListener('product_price_has_been_edited')]
    public function onPriceChanged(): void
    {
        if ($this->price == $this->product->getPrice()) {
            return;
        }
        $this->refreshTotal();
        $this->itemPriceHasBeenEdited = true;
    }

    #[LiveListener('product_selection_has_been_changed')]
    public function onProductSelectionChanged(): void
    {
        $this->refreshTotal();
    }

    #[LiveListener('product_tva_has_been_changed')]
    public function onProductTvaChange(): void
    {
        $this->refreshTotal();
    }

    #[LiveListener('product_quantity_has_been_edited')]
    public function onQuantityChanged(): void
    {
        $this->refreshTotal();
    }

    private function refreshTotal(): void
    {
        $this->total = ProductQuote::_getTotal($this->price, $this->quantity, $this->tva, $this->discount);
    }
}
