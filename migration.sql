CREATE TABLE transactions (
                              transactionID SERIAL PRIMARY KEY,
                              accountNumberFrom VARCHAR(20) NOT NULL,
                              accountTypeFrom VARCHAR(20) NOT NULL,
                              accountNumberTo VARCHAR(20) NOT NULL,
                              accountTypeTo VARCHAR(20) NOT NULL,
                              traceNumber UUID DEFAULT gen_random_uuid() NOT NULL,
                              amount NUMERIC(12, 2) NOT NULL,
                              creationDate TIMESTAMP DEFAULT NOW(),
                              memo TEXT
);
