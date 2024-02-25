<?php

namespace App\Twig\Components\Live\Quote;

use App\Entity\Product;
use App\Entity\Quote;
use App\Form\QuoteType;
use App\Service\Quote\QuoteCreatorService;
use App\Validator\Constraint as EasyVowsAssert;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\Attribute\LiveArg;
use Symfony\UX\LiveComponent\Attribute\LiveListener;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\ValidatableComponentTrait;
use Symfony\UX\TwigComponent\Attribute\ExposeInTemplate;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\UX\TwigComponent\Attribute\PreMount;

#[AsLiveComponent]
class Creator extends AbstractController
{
    use DefaultActionTrait;
    use ComponentWithFormTrait;
    use ValidatableComponentTrait;

    #[LiveProp(writable: true)]
    #[Assert\Valid]
    public ?Quote $quoteData = null;

    #[LiveProp(writable: true)]
    #[Assert\NotNull(message: 'Vous devez choisir un client.')]
    #[Assert\Positive(message: 'Le client choisi est invalide.')]
    public ?int $customerId = null;

    #[LiveProp(writable: true)]
    #[Assert\NotNull(message: 'Vous devez choisir un numéro de devis.')]
    #[Assert\Length(min: 3, max: 255, minMessage: 'Le numéro de devis doit contenir au moins {{ limit }} caractères.', maxMessage: 'Le numéro de devis doit contenir au maximum {{ limit }} caractères.')]
    #[EasyVowsAssert\QuoteNumberConstraint(message: 'Le numéro de devis "{{ value }}" est déjà utilisé.')]
    public ?string $quote_number = null;

    #[LiveProp(writable: true)]
    #[Assert\PositiveOrZero(message: 'La remise doit être supérieur ou égale à 0.')]
    #[Assert\LessThanOrEqual(value: 100, message: 'La remise doit être inférieur ou égale à 100.')]
    public ?float $discount = 0.0;

    #[LiveProp(writable: true)]
    #[Assert\PositiveOrZero(message: 'La TVA doit être supérieur ou égale à 0.')]
    #[Assert\LessThanOrEqual(value: 100, message: 'La TVA doit être inférieur ou égale à 100.')]
    public ?float $tva = 0.0;

    #[LiveProp(writable: true)]
    #[Assert\Choice(choices: [0, 1, 2, 3], message: 'Le statut choisi est invalide.')]
    public ?int $status = null;

    #[LiveProp(writable: true, format: 'Y-m-d')]
    #[Assert\NotNull(message: 'Vous devez choisir une date d\'émission.')]
    #[Assert\LessThan(propertyPath: 'expiry_date', message: 'La date d\'émission doit être inférieur à la date d\'expiration.')]
    public ?\DateTime $quote_issuance_date = null;

    #[LiveProp(writable: true, format: 'Y-m-d')]
    #[Assert\NotNull(message: 'Vous devez choisir une date d\'expiration.')]
    #[Assert\GreaterThan(propertyPath: 'quote_issuance_date', message: 'La date d\'expiration doit être supérieur à la date d\'émission.')]
    public ?\DateTime $expiry_date = null;

    #[LiveProp]
    public array $lineItems = [];

    public bool $savedSuccessfully = false;

    public function __construct(
        private readonly QuoteCreatorService $quoteCreatorService,
    )
    {
    }

    public function mount(Quote $quoteData): void
    {
        $this->quoteData = $quoteData;
    }

    protected function instantiateForm(): FormInterface
    {
        return $this->createForm(QuoteType::class, $this->quoteData);
    }

    private function ensureErrorMessageBeforeSaving(): void
    {
        $this->addFlash('error', 'Veuillez corriger les erreurs avant de sauvegarder.');
    }

    private function clearFlashBag(Session $session): void
    {
        $session->getFlashBag()->clear();
    }

    private function postQuoteSaving(): RedirectResponse
    {
        $this->addFlash('success', 'Votre devis a été créée avec succès.');
        $this->savedSuccessfully = true;
        return $this->redirectToRoute('app_quote_show', [
            'id' => $this->quoteData->getId(),
        ]);
    }

    private function ensureDefaultCustomer(): void
    {
        $this->customerId = $this->quoteCreatorService->getDefaultCustomer()->getId();
    }

    private function setDefaultData(): void
    {
        $this->setDefaultQuoteNumber();
        $this->setDefaultDates();
    }

    private function setDefaultDates(): void
    {
        $this->quoteCreatorService->setDefaultDates(
            $this->quote_issuance_date,
            $this->expiry_date
        );
    }

    private function setDefaultQuoteNumber(): void
    {
        $this->quote_number = $this->quoteCreatorService->getDefaultQuoteNumber();
    }

    #[PreMount]
    public function preMount(array $data): array
    {
        $this->ensureDefaultCustomer();
        $this->setDefaultData();
        return $data;
    }

    #[LiveAction]
    public function addLineItem(): void
    {
        $this->quoteCreatorService->addLineItem($this->lineItems);
    }

    #[LiveAction]
    public function saveQuote(Request $request, EntityManagerInterface $entityManager, Session $session)
    {
        if (!$this->canSaveQuote()) {
            $this->addFlash('warning', 'Veuillez remplir tous les champs obligatoires et ajouter des produits pour enregistrer le devis.');
            return;
        }
        $this->ensureErrorMessageBeforeSaving();
        $this->validate();
        $this->clearFlashBag($session);

        $this->quoteCreatorService->saveQuote(
            $entityManager,
            $this->quoteData,
            $this->customerId,
            $this->quote_number,
            $this->quote_issuance_date,
            $this->expiry_date,
            $this->discount,
            $this->tva,
            $this->status,
            $this->lineItems,
        );

        return $this->postQuoteSaving();
    }

    #[LiveListener('removeLineItem')]
    public function removeLineItem(#[LiveArg] int $key): void
    {
        $this->quoteCreatorService->removeLineItem($this->lineItems, $key);
    }

    #[LiveListener('line_item:change_edit_mode')]
    public function onLineItemEditModeChange(#[LiveArg] int $key, #[LiveArg] $isEditing): void
    {
        $this->quoteCreatorService->onLineItemEditModeChange($this->lineItems, $key, $isEditing);
    }

    #[LiveListener('line_item:save')]
    public function saveLineItem(
        #[LiveArg] int $key,
        #[LiveArg] Product $product,
        #[LiveArg] float $price,
        #[LiveArg] int $quantity,
        #[LiveArg] float $total,
    ): void
    {
        $this->quoteCreatorService->saveLineItem($this->lineItems, $key, $product, $quantity, $price, $total);
    }

    #[ExposeInTemplate]
    public function canSaveQuote(): bool
    {
        return $this->quoteCreatorService->canSaveQuote($this->lineItems);
    }

    #[ExposeInTemplate]
    public function productItemsIsEmpty(): bool
    {
        return $this->quoteCreatorService->productItemsIsEmpty($this->lineItems);
    }

    #[ExposeInTemplate]
    public function getTotals(): array
    {
        return $this->quoteCreatorService->getTotals(
            $this->lineItems,
            $this->discount,
            $this->tva,
        );
    }
}
