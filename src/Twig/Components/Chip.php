<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Chip
{
    public string $text = '';

    public string $color = 'primary';

    public string $icon = '';

    public string $size = 'normal';
}