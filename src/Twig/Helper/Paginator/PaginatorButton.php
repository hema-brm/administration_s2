<?php

namespace App\Twig\Helper\Paginator;

class PaginatorButton {
    private int $current;
    private int $total;
    private int $visiblePage;

    public function __construct(int $current = 1, int $total = 1, int $visiblePage = 5) {
        $this->current = $current;
        $this->total = $total;
        $this->visiblePage = $visiblePage;
    }

    public function generate() {
        if ($this->total <= 1) {
            return [
                'label' => [],
                'current' => $this->current,
                'total' => $this->total,
            ];;
        }

        if ($this->current > $this->total) {
            $this->current = $this->total;
        }

        if ($this->current < 1) {
            $this->current = 1;
        }

        $min = $this->current;
        $max = $this->total;
    
        if (($this->total - $this->current) < ($this->visiblePage - 1)) {
            $min = $this->total - ($this->visiblePage - 1);
            if ($min < 1) {
                $min = 1;
            }
        }
    
        $showAllPages = ($max - $min) < $this->visiblePage;
    
        $buttons = [];
        $loop = 1;
        $center = (int) ceil($this->visiblePage/2);
        for ($i = $min; $i <= $max; $i++) {
            if ($loop == $center && !$showAllPages) {
                $buttons[] = null;
                $i = $max - $center + 1;
            } else {
                $buttons[] = $i;
            }
            $loop++;
        }
    
        return [
            'label' => $buttons,
            'current' => $this->current,
            'total' => $this->total,
        ];
    }
}