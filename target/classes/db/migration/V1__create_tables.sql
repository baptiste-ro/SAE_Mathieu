CREATE TABLE users (
    id SERIAL PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    address VARCHAR(50),
    password VARCHAR(50),
    email VARCHAR(50),
    role VARCHAR(50),
    admin BOOLEAN,
    pfp_id VARCHAR(50)
);