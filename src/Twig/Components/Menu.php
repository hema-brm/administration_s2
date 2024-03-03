<?php

namespace App\Twig\Components;

use Symfony\UX\TwigComponent\Attribute\AsTwigComponent;

#[AsTwigComponent]
class Menu
{
    public string $id;

    public string $color = 'primary';

    public int $width = 60;

    public int $colorValue = 200;

    public string $variant = 'desktop';
    public string $desktopBreakpoint = 'md';

    public function __construct()
    {
        $this->id = uniqid('menu_');
    }

    public function getDesktopClasses(): string
    {
        return 'hidden ' . $this->desktopBreakpoint . ':block';
    }

    public function getMobileClasses(): string
    {
        return 'block ' . $this->desktopBreakpoint . ':hidden';
    }
}