<?php

use PHPUnit\Framework\TestCase;
use Models\Transaction;

class TransactionTest extends TestCase
{
    private $dbMock;
    private $transactionModel;

    protected function setUp(): void
    {
        $this->dbMock = $this->createMock(PDO::class);
        $this->transactionModel = new Transaction($this->dbMock);
    }

    public function testGetAllReturnsExpectedData()
    {

        $mockData = [
            ['id' => 1, 'accountNumberFrom' => '123', 'accountTypeFrom' => 'savings', 'amount' => 1000],
            ['id' => 2, 'accountNumberFrom' => '456', 'accountTypeFrom' => 'checking', 'amount' => 2000],
        ];

        $stmtMock = $this->createMock(PDOStatement::class);
        $stmtMock->method('fetchAll')->willReturn($mockData);

        $this->dbMock
            ->method('prepare')
            ->willReturn($stmtMock);

        $filters = ['type' => null, 'startDate' => null, 'endDate' => null];
        $result = $this->transactionModel->getAll($filters, 10, 0);

        $this->assertEquals($mockData, $result);
    }
}
