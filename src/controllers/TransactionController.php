<?php

namespace controllers;

use Models\Transaction;


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

    public function getAll() {

    }
}