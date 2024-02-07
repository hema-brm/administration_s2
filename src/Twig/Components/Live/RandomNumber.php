<?php

// src/Components/RandomNumber.php
namespace App\Twig\Components\Live;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;

#[AsLiveComponent]
class RandomNumber
{
    use DefaultActionTrait;

    #[LiveProp]
    public int $max = 1000;
    public function getRandomNumber(): int
    {
        return rand(0, $this->max);
    }
}