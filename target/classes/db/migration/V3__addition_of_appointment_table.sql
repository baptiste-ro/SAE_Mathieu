DROP TABLE IF EXISTS appointment;

CREATE TABLE appointment(
    appointment_date DATE,
    appointment_time TIME,
    cid int,
    PRIMARY KEY (appointment_date, appointment_time),
    FOREIGN KEY (cid) REFERENCES users(id)
);