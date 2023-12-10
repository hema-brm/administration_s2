<?php

namespace App\Service\Request;

class PageFromRequestService
{
    private RequestQueryService $requestQueryService;

    public function __construct(RequestQueryService $requestQueryService)
    {
        $this->requestQueryService = $requestQueryService;
    }

    public function get(string $key = 'page'): int
    {
        $page = (int) $this->requestQueryService->get($key);

        if ($page < 1) {
            $page = 1;
        }

        return $page;
    }
}