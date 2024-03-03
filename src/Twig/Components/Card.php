<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Card
{
    public string $id;
    public string $background = 'white';
    public array $widths = [
        'xs' => 'full',
        'sm' => 'full',
        'md' => 'full',
        'lg' => '3/4',
        'xl' => '3/4',
    ];
    public array $textSizes = [
        'xs' => 'sm',
        'sm' => 'sm',
        'md' => 'sm',
        'lg' => 'lg',
        'xl' => 'xl',
    ];

    public bool $shadow = true;
    public array $shadowSizes = [
        'xs' => 'sm',
        'sm' => 'md',
        'md' => 'md',
        'lg' => 'lg',
        'xl' => 'lg',
    ];

    public bool $border = true;
    public bool $rounded = true;
    public array $roundedSizes = [
        'xs' => 'xs',
        'sm' => 'sm',
        'md' => 'sm',
        'lg' => 'sm',
        'xl' => 'md',
    ];

    public string $title = '';
    public string $padding = '4';

    public function __construct()
    {
        $this->id = 'dropdown-' . uniqid();
    }

    public function getWidthClasses(): string
    {
        $classes = [];
        foreach ($this->widths as $breakpoint => $size) {
            $classes[] = "{$breakpoint}:w-{$size}";
        }

        return implode(' ', $classes);
    }

    public function getTextSizeClasses(): string
    {
        $classes = [];
        foreach ($this->textSizes as $breakpoint => $size) {
            $classes[] = "{$breakpoint}:text-{$size}";
        }

        return implode(' ', $classes);
    }

    public function getShadowClasses(): string
    {
        if (!$this->shadow) {
            return '';
        }

        $classes = [];
        foreach ($this->shadowSizes as $breakpoint => $size) {
            $classes[] = "{$breakpoint}:shadow-{$size}";
        }

        return implode(' ', $classes);
    }

    public function getRoundedClasses(): string
    {
        if (!$this->rounded) {
            return '';
        }

        $classes = [];
        foreach ($this->roundedSizes as $breakpoint => $size) {
            $classes[] = "{$breakpoint}:rounded-{$size}";
        }

        return implode(' ', $classes);
    }
}