<?php

namespace App\Twig\Components\Live\Quote\Item;

use App\Entity\Product;
use App\Entity\ProductQuote;
use App\Form\ProductQuoteType;
use App\Repository\ProductRepository;
use App\Service\Quote\QuoteCreatorService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveListener;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\UX\LiveComponent\LiveResponder;
use Symfony\UX\LiveComponent\ValidatableComponentTrait;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\UX\TwigComponent\Attribute\PostMount;
use Symfony\UX\TwigComponent\Attribute\PreMount;
use Symfony\UX\TwigComponent\Event\PreRenderEvent;

#[AsLiveComponent]
class Creator extends AbstractController
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

    #[LiveProp]
    public float $total = 0.0;

    #[LiveProp]
    public bool $isEditing = false;

    #[LiveProp]
    public string $mode = 'create';

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

        $responder->emitUp('line_item:save', [
            'key' => $this->key,
            'product' => $this->product->getId(),
            'quantity' => $this->quantity,
            'price' => $this->price,
            'total' => $this->total,
        ]);

        $this->changeEditMode(false, $responder);
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
        return $this->mode != QuoteCreatorService::READONLY_MODE;
    }

    private function setDefaultProduct(): void
    {
        if (empty($this->product)) {
            $this->product = $this->productRepository->findOneBy([], [
                'id' => 'ASC'
            ]);
        }
    }

    #[PreMount]
    public function preMount(array $data): array
    {
        $this->setDefaultProduct();

        $data['productId'] = $this->product->getId();
        $data['price'] = $this->product->getPrice();
        $data['total'] = $this->product->getPrice();

        return $data;
    }

    #[PostMount]
    public function postMount(): void
    {
        // No operation
    }

    #[LiveListener('product_selection_has_been_changed')]
    public function onProductChanged()
    {
        // Do not reset the price default value if the user is editing the line item
        if (!$this->isEditing || $this->itemPriceHasBeenEdited) {
            return;
        }

        // Only reset the price if the line item is not being edited, and the default price is not already set
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

    #[LiveListener('product_quantity_has_been_edited')]
    public function onQuantityChanged(): void
    {
        $this->refreshTotal();
    }

    private function refreshTotal(): void
    {
        $this->total = ProductQuote::_getTotal($this->price, $this->quantity);
    }
}
