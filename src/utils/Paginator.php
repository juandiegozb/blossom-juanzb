<?php

namespace Utils;

class Paginator {
    private mixed $currentPage;
    private mixed $limit;
    private int $totalTransactions;
    private string $baseUrl;

    public function __construct($queryParams, $totalTransactions) {
        $this->currentPage = isset($queryParams['page']) ? max(1, (int)$queryParams['page']) : 1;
        $this->limit = isset($queryParams['limit']) ? max(1, (int)$queryParams['limit']) : 10;
        $this->totalTransactions = $totalTransactions;
        $this->baseUrl = $_SERVER['REQUEST_SCHEME'] . '://' . $_SERVER['HTTP_HOST'] . $_SERVER['REQUEST_URI'];
    }

    public function getOffset(): float|int
    {
        return ($this->currentPage - 1) * $this->limit;
    }

    public function getLimit()
    {
        return $this->limit;
    }

    public function getPaginationLinks(): array
    {
        $totalPages = ceil($this->totalTransactions / $this->limit);

        $links = [
            'current' => $this->baseUrl,
        ];

        if ($this->currentPage > 1) {
            $links['prev'] = $this->addQueryParam($this->baseUrl, 'page', $this->currentPage - 1);
        }

        if ($this->currentPage < $totalPages) {
            $links['next'] = $this->addQueryParam($this->baseUrl, 'page', $this->currentPage + 1);
        }

        return $links;
    }

    private function addQueryParam($url, $key, $value): string
    {
        $parsedUrl = parse_url($url);
        parse_str($parsedUrl['query'] ?? '', $queryParams);
        $queryParams[$key] = $value;
        $queryString = http_build_query($queryParams);

        return $parsedUrl['scheme'] . '://' . $parsedUrl['host'] . $parsedUrl['path'] . '?' . $queryString;
    }
}