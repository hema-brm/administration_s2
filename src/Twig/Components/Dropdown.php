<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Dropdown
{
    public string $id;
    public string $triggerId;
    public string $contentId;
    public string $showClass = 'scale-100';
    public string $hideClass = 'scale-0';

    public function __construct()
    {
        $this->id = 'dropdown-' . uniqid();
        $this->triggerId = $this->id . '-trigger';
        $this->contentId = $this->id . '-content';
    }
}