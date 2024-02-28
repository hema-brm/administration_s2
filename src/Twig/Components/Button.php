<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Button
{
    public string $id = '';
    public string $text = '';

    public string $color = 'primary';
    public string $textColor = 'white';

    public string $icon = '';

    public string $variant = 'normal';
    public string $route = '#';
    public string $onClick = '';
    public array $customClasses = [];
    public bool $disabled = false;
    public array $attr = [];

    public function __construct()
    {
        if (empty($this->id)) {
            $this->id = uniqid();
        }
    }
}