# Planning

## 1. Creation of Environments and Docker Connection (2 hours)
- No framework is used due to restrictions related to permissions on the computer where the test is being developed.
- Initial setup of the environment using Docker to ensure consistency and portability.

## 2. Database Configuration (1.5 hours)
- The Docker container includes a PostgreSQL instance.
- An SQL script is created to define the `transactions` table with the required fields:
    - `accountNumberFrom`
    - `accountTypeFrom`
    - `accountNumberTo`
    - `accountTypeTo`
    - `amount`
    - `memo`
    - `creationDate`

## 3. Transactions Controller (2.5 hours)
- A controller is implemented with `GET` and `POST` methods:
    - **GET**: Allows listing transactions with support for filters and pagination.
    - **POST**: Allows creating new transactions with basic validations.

## 4. Swagger Integration (1 hour)
- A Swagger file is created to document the available endpoints.
- The `swagger.json` file is configured to display and test the endpoints.

## 5. PHPUnit Testing (1 hour)
- PHPUnit is installed within the Docker container.
- Unit tests are created to verify the behavior of the `GET` methods in the transactions controller.
- Tests are executed from the Docker environment to ensure reproducibility.

## 6. Validations and Pagination (1.5 hours)
- Validations are implemented for input data in the transactions controller.
- A method is created to handle pagination of results in the `GET` endpoint.

---

## Total Estimated Development Time: **9.5 hours**
