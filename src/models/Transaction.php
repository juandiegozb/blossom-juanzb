<?php

namespace Models;

use PDO;

class Transaction {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    /**
     * Method that allow insert new data to the transactions table
     * @param data
     * @return mixed
     * @author Juan Zambrano
     */
    public function create($data) {
        $sql = "INSERT INTO transactions (accountNumberFrom, accountTypeFrom, accountNumberTo, accountTypeTo, amount, memo)
                VALUES (:accountNumberFrom, :accountTypeFrom, :accountNumberTo, :accountTypeTo, :amount, :memo)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
        return $this->db->lastInsertId();
    }
}