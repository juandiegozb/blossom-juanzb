<?php

namespace controllers;

use Models\Transaction;
use Utils\Paginator;


class TransactionController {
    private $model;

    public function __construct($db) {
        $this->model = new Transaction($db);
    }

    public function create($request) {
        $data = $request;
        $id = $this->model->create($data);
        return ['status' => 201, 'data' => ['transactionID' => $id]];
    }

    public function getAll($queryParams) {
        $filters = [
            'type' => $queryParams['type'] ?? null,
            'startDate' => $queryParams['startDate'] ?? null,
            'endDate' => $queryParams['endDate'] ?? null,
        ];

        $paginator = new Paginator($queryParams, $this->model->count($filters));
        $data = $this->model->getAll($filters, $paginator->getLimit(), $paginator->getOffset());

        return [
            'status' => 200,
            'data' => $data,
            'pagination' => $paginator->getPaginationLinks(),
        ];
    }
}