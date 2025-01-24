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
    public function create($data): mixed
    {
        $sql = "INSERT INTO transactions (accountNumberFrom, accountTypeFrom, accountNumberTo, accountTypeTo, amount, memo)
                VALUES (:accountNumberFrom, :accountTypeFrom, :accountNumberTo, :accountTypeTo, :amount, :memo)";
        $stmt = $this->db->prepare($sql);
        $stmt->execute($data);
        return $this->db->lastInsertId();
    }


    /**
     *
     * @param $filters
     * @param $limit
     * @param $offset
     * @return mixed
     */
    public function getAll($filters, $limit, $offset): mixed
    {
        $sql = "SELECT * FROM transactions WHERE 1=1";

        if (!empty($filters['type'])) {
            $sql .= " AND accountTypeFrom = :type";
        }
        if (!empty($filters['startDate'])) {
            $sql .= " AND creationDate >= :startDate";
        }
        if (!empty($filters['endDate'])) {
            $sql .= " AND creationDate <= :endDate";
        }

        $sql .= " ORDER BY creationDate DESC LIMIT :limit OFFSET :offset";

        $stmt = $this->db->prepare($sql);

        if (!empty($filters['type'])) {
            $stmt->bindParam(':type', $filters['type']);
        }
        if (!empty($filters['startDate'])) {
            $stmt->bindParam(':startDate', $filters['startDate']);
        }
        if (!empty($filters['endDate'])) {
            $stmt->bindParam(':endDate', $filters['endDate']);
        }
        $stmt->bindParam(':limit', $limit, PDO::PARAM_INT);
        $stmt->bindParam(':offset', $offset, PDO::PARAM_INT);

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /**
     * @param $filters
     * @return mixed
     */
    public function count($filters): mixed
    {
        $sql = "SELECT COUNT(*) as total FROM transactions WHERE 1=1";

        if (!empty($filters['type'])) {
            $sql .= " AND accountTypeFrom = :type";
        }
        if (!empty($filters['startDate'])) {
            $sql .= " AND creationDate >= :startDate";
        }
        if (!empty($filters['endDate'])) {
            $sql .= " AND creationDate <= :endDate";
        }

        $stmt = $this->db->prepare($sql);

        if (!empty($filters['type'])) {
            $stmt->bindParam(':type', $filters['type']);
        }
        if (!empty($filters['startDate'])) {
            $stmt->bindParam(':startDate', $filters['startDate']);
        }
        if (!empty($filters['endDate'])) {
            $stmt->bindParam(':endDate', $filters['endDate']);
        }

        $stmt->execute();
        return $stmt->fetchColumn();
    }
}