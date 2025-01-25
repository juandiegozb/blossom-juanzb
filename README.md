## Instructions to Clone and Start the Project

### 1. Clone the Repository

```bash
    git clone https://github.com/juandiegozb/blossom-juanzb.git
    cd blossom-juanzb
```

### 2. Build Docker Images

```bash
  docker compose build --no-cache
```

### 3. Start Services

```bash
  docker compose up -d
```

## Unit Tests

### Access PHP Container

```bash
  docker exec -it php-app bash
```

### Install Composer Dependencies

```bash
  composer install
```

### Run Tests

```bash
  ./vendor/bin/phpunit --testdox
```

## Endpoints

### 1. Get Transactions (GET)

**URL**: `GET http://localhost:8080/v1/transactions`

**Optional Filter Parameters**:

| Parameter | Type | Description |
|-----------|------|-------------|
| limit | integer | Maximum number of transactions to return per page |
| page | integer | Page number for pagination |
| startDate | string | Starting date in YYYY-MM-DD format |
| endDate | string | Ending date in YYYY-MM-DD format |

**Request Example**:
```
GET http://localhost:8080/v1/transactions?limit=10&page=1&startDate=2023-01-01&endDate=2023-12-31
```

**Successful Response (200)**:
```json
{
    "data": [
        {
            "transactionID": 1,
            "accountNumberFrom": "123456",
            "accountTypeFrom": "debit",
            "accountNumberTo": "654321",
            "accountTypeTo": "credit",
            "amount": 1000.50,
            "memo": "Payment for services",
            "traceNumber": "3fa85f64-5717-4562-b3fc-2c963f66afa6",
            "creationDate": "2023-12-01 12:00:00"
        }
    ],
    "pagination": {
        "current": "http://localhost:8080/v1/transactions?page=1&limit=10",
        "next": "http://localhost:8080/v1/transactions?page=2&limit=10",
        "prev": null
    }
}
```

**Errors**:

| Status Code | Message |
|------------|---------|
| 404 | No transactions available for the specified filters |

### 2. Create a Transaction (POST)

**URL**: `POST http://localhost:8080/v1/transactions`

**Request Body (JSON)**:

| Field | Type | Description                            |
|-------|------|----------------------------------------|
| accountNumberFrom | string | Source account number                  |
| accountTypeFrom | string | Source account type (e.g., credit)     |
| accountNumberTo | string | Destination account number             |
| accountTypeTo | string | Destination account type (e.g., debit) |
| amount | number | Amount to transfer                     |
| memo | string | Note or description of the transaction |

**Request Example**:
```json
{
    "accountNumberFrom": "123456",
    "accountTypeFrom": "debit",
    "accountNumberTo": "654321",
    "accountTypeTo": "credit",
    "amount": 500.00,
    "memo": "Transfer to savings account"
}
```

**Successful Response (201)**:
```json
{
    "status": 201,
    "data": {
        "transactionID": 2
    }
}
```

**Errors**:

| Status Code | Message |
|------------|---------|
| 400 | Invalid JSON format |
| 400 | Validation errors (with details of invalid or missing fields) |

## Configuration

### Important Files

- `docker-compose.yml`: Configures services (PHP, PostgreSQL, Nginx, Swagger UI)
- `nginx/default.conf`: Nginx server configuration
- `src/swagger/swagger.json`: Swagger API specification

## Project Structure

- `src/`: Source code
    - `controllers/`: Business logic and request handling
    - `models/`: Database interaction
    - `routes/`: Route definitions
    - `utils/`: Helper functions
    - `swagger/`: API documentation

## Swagger Documentation

Access API documentation at: `http://localhost:8081`