<?php

namespace App\Twig;

use Twig\Error\LoaderError;
use Twig\Error\RuntimeError;
use Twig\Error\SyntaxError;
use Twig\Extension\AbstractExtension;
use Twig\TwigFunction;

class FlashExtension extends AbstractExtension
{
    private $twig;

    public function __construct(\Twig\Environment $twig)
    {
        $this->twig = $twig;
    }

    public function getFunctions(): array
    {
        return [
            new TwigFunction('displayFlash', [$this, 'displayFlash'], ['is_safe' => ['html']]),
        ];
    }

    /**
     * @throws SyntaxError
     * @throws RuntimeError
     * @throws LoaderError
     */
    public function displayFlash(): string
    {
        return $this->twig->render('@components/flash/index.html.twig');
    }
}
