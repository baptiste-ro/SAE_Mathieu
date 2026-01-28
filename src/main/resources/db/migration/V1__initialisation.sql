-- Flyway effectue les migrations AVANT que Hibernate puisse créer les tables !
-- De ce fait, je suis obligé de créer ici les tables.
-- Cependant, Hibernate ne vas pas agir comme le créateur des tables, mais comme un outil de vérification.
-- Il doit vérifier si les tables fournis par Flyway correspondent aux siennes.

-- USERS TABLE
CREATE TABLE users (
    cid INT AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    address VARCHAR(50),
    password VARCHAR(200),
    email VARCHAR(50),
    role VARCHAR(50),
    admin BOOLEAN,
    pfp_id VARCHAR(255)
);

-- APPOINTMENT TABLE
CREATE TABLE appointment (
    appointment_date DATE NOT NULL,
    appointment_time TIME NOT NULL,
    cid INT NOT NULL,

    PRIMARY KEY (appointment_date, appointment_time),

    CONSTRAINT fk_appointment_client
        FOREIGN KEY (cid) REFERENCES users(cid)
);

INSERT INTO users(cid, address, admin, email, first_name, last_name, password, pfp_id, role) VALUES (0, '48 rue Clarisse, Haubourdin', TRUE, 'baptiste-royer@outlook.com', 'Baptiste', 'Royer', '$2a$10$oy9yJ9Ayi4628w1rBgGNWewWBfQBgRhhbRwYLKIpbxGgpeEjI8J.O', 'default.png', 'client');

INSERT INTO users(cid, address, admin, email, first_name, last_name, password, pfp_id, role) VALUES (1, '48 rue Clarisse, Haubourdin', FALSE, 'baptiste-royer@outlook.com', 'Jai', 'Je', '$2a$10$oy9yJ9Ayi4628w1rBgGNWewWBfQBgRhhbRwYLKIpbxGgpeEjI8J.O', 'default.png', 'client');
INSERT INTO users(cid, address, admin, email, first_name, last_name, password, pfp_id, role) VALUES (2, '48 rue Clarisse, Haubourdin', FALSE, 'baptiste-royer@outlook.com', 'Pas', 'Suis', '$2a$10$oy9yJ9Ayi4628w1rBgGNWewWBfQBgRhhbRwYLKIpbxGgpeEjI8J.O', 'default.png', 'client');
INSERT INTO users(cid, address, admin, email, first_name, last_name, password, pfp_id, role) VALUES (3, '48 rue Clarisse, Haubourdin', FALSE, 'baptiste-royer@outlook.com', 'Didee', 'A', '$2a$10$oy9yJ9Ayi4628w1rBgGNWewWBfQBgRhhbRwYLKIpbxGgpeEjI8J.O', 'default.png', 'client');
INSERT INTO users(cid, address, admin, email, first_name, last_name, password, pfp_id, role) VALUES (4, '48 rue Clarisse, Haubourdin', FALSE, 'baptiste-royer@outlook.com', 'Desole', 'Sec', '$2a$10$oy9yJ9Ayi4628w1rBgGNWewWBfQBgRhhbRwYLKIpbxGgpeEjI8J.O', 'default.png', 'client');

INSERT INTO appointment(appointment_date, appointment_time, cid) VALUES ('2026-10-21', '08:30:00', 2)