CREATE TABLE users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    nimi VARCHAR(255) NOT NULL,
    katuosoite VARCHAR(255) NOT NULL,
    postinumero VARCHAR(5) NOT NULL,
    postitoimipaikka VARCHAR(255) NOT NULL,
    puhelinnumero VARCHAR(20) NOT NULL,
    email VARCHAR(255) UNIQUE NOT NULL,
    salasana VARCHAR(255) NOT NULL,
    aktivointikoodi VARCHAR(255),
    aktiivinen TINYINT(1) DEFAULT 0,
);

