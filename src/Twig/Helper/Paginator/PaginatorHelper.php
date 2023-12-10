<?php

namespace App\Twig\Helper\Paginator;

class PaginatorHelper {

    public int $current;

    public int $itemCount;

    public int $total;

    public int $limit;
    
    public function __construct(int $current, int $itemCount, int $limit)
    {
        $this->setItemCount($itemCount);
        $this->setLimit($limit);
        $this->setTotal();
        $this->setCurrent($current);
    }

    private function setCurrent(int $current): void {
        if ($current > $this->total) {
            $current = $this->total;
        }

        if ($current < 1) {
            $current = 1;
        }

        $this->current = $current;
    }

    private function setItemCount(int $itemCount): void {
        if ($itemCount < 0) {
            $itemCount = 0;
        }

        $this->itemCount = $itemCount;
    }

    private function setLimit(int $limit): void {
        if ($limit < 1) {
            $limit = 1;
        }

        $this->limit = $limit;
    }


    private function setTotal() {
        $this->total = ceil($this->itemCount / $this->limit);
    }

}