<?php

namespace App\Service\Helper;

class SearchTermTransformerHelper
{
    private string $searchTerm;

    private array $searchTermArray;

    public function get(): string
    {
        return $this
            ->removePunctuation()
            ->removeEmpty()
            ->removeSpecialCharacters()
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

    private function removePunctuation(): self
    {
        $this->searchTermArray = array_map(fn($value) => preg_replace('/[[:punct:]]/', '', $value), $this->searchTermArray);

        return $this;
    }

    private function removeEmpty(): self
    {
        $this->searchTermArray = array_filter($this->searchTermArray, fn($value) => $value !== '');

        return $this;
    }

    private function removeSpecialCharacters(): self
    {
        $this->searchTermArray = array_map(fn($value) => str_replace([':', '*', '&'], '', $value), $this->searchTermArray);

        return $this;
    }

    private function addWildcards(): self
    {
        $this->searchTermArray = array_map(fn($value) => addslashes($value), $this->searchTermArray);

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