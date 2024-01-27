<?php

namespace App\Service\Helper;

class SearchTermTransformerHelper
{
    private string $searchTerm;

    private array $searchTermArray;

    const UNSUPPORTED_CHARACTERS = [
        ':', '*', '&', '<', '>', '(', ')', '[', ']', '{', '}', 
        '^', '~', '?', ':', '/', '!', '@', '#', '$', 
        '%', '=', '|', '`', '"', ',',
    ];

    public function get(): string
    {
        return $this
            ->ensureCharacters()
            ->removeEmpty()
            ->addWildcards()
            ->implode()
            ->searchTerm;
    }

    public function withTerm(string $searchTerm): self
    {
        $this->searchTerm = $searchTerm;
        $this->searchTermArray = explode(' ', $searchTerm);

        return $this;
    }

    private function removeEmpty(): self
    {
        $this->searchTermArray = array_filter($this->TermArray, fn($value) => $value !== '');

        return $this;
    }

    private function ensureCharacters(): self
    {
        $this->searchTermArray = array_map(
            fn($value) => str_replace(
                self::UNSUPPORTED_CHARACTERS, 
                '', 
                $value
            ), $this->searchTermArray
        );

        return $this;
    }

    private function addWildcards(): self
    {
        $this->searchTermArray = array_map(
            fn($value) => addslashes($value), $this->searchTermArray
        );

        return $this;
    }

    private function implode(): self
    {
        $this->searchTerm = implode(":*& ", $this->searchTermArray) . ":*";
        
        if (empty($this->searchTermArray)) {
            $this->searchTerm = '';
        }
        
        return $this;
    }
}