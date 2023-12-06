<?php

namespace App\Twig;

use App\Twig\Helper\Paginator\PaginatorButton;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('uniqid', [$this, 'uniqid']),
            new TwigFunction('generatePaginatorButton', [$this, 'generatePaginatorButton']),
        ];
    }

    public function uniqid(string $prefix = '', bool $more_entropy = false): string
    {
        return uniqid($prefix, $more_entropy);
    }

    public function generatePaginatorButton(int $current = 1, int $total = 1, int $visiblePage = 5): array
    {
        return (new PaginatorButton($current, $total, $visiblePage))->generate();
    }
        
}
