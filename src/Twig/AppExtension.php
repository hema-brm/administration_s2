<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class AppExtension extends AbstractExtension
{
    public function getFunctions()
    {
        return [
            new TwigFunction('uniqid', [$this, 'uniqid']),
        ];
    }

    public function uniqid(string $prefix = '', bool $more_entropy = false)
    {
        return uniqid($prefix, $more_entropy);
    }
}
