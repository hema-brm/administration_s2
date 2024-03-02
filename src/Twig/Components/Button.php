<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Button
{
    public string $id = '';
    public string $text = '';

    public string $type = 'primary';
    public string $color = 'primary';


    public string $icon = '';

    public string $variant = 'default';
    public string $route = '#';
    public string $onClick = '';
    public string $target = '';
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