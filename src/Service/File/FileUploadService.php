<?php

namespace App\Service\File;

use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\File;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;

class FileUploadService
{
    public function __construct(
        private readonly SluggerInterface $slugger,
    )
    {
    }

    public function upload(?File $file, string $directory): ?string
    {
        if (!$file) {
            return null;
        }

        $originalFilename = $file->getFilename();
        $safeFilename = $this->slugger->slug($originalFilename);
        $newFilename = $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();

        try {
            $file->move($directory, $newFilename);
        } catch (FileException $e) {
            return null;
        }
        return $newFilename;
    }
}