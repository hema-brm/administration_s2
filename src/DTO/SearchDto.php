<?php

namespace App\DTO;

class SearchDto{

    public ?string $search = null;

    public function getSearch() : ?string 
    {
        return $this->search;
    }

}