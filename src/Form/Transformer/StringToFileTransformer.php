<?php

namespace App\Form\Transformer;

use Symfony\Component\Form\DataTransformerInterface;
use Symfony\Component\HttpFoundation\File\File;

class StringToFileTransformer implements DataTransformerInterface
{
    public function __construct(private readonly string $directory)
    {
    }

    public function transform($value): ?File
    {
        $res = !empty($value) ? new File($this->directory . $value) : null;
        return $res;
    }

    public function reverseTransform($value): ?File
    {
        return $value ? new File($value) : null;
    }
}