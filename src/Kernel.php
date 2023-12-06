<?php

namespace App;

use App\Doctrine\TsvectorType;
use Doctrine\DBAL\Types\Type;
use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public function boot(): void
    {
        parent::boot();

        if (!Type::hasType('tsvector')) {
            Type::addType('tsvector', TsvectorType::class);
        }
    }
}
