CREATE DATABASE nasha_news;

USE nasha_news;

CREATE TABLE admins (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL
);

CREATE TABLE news (
    id INT AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image VARCHAR(255),
    date DATE,
    author VARCHAR(100)
);

INSERT INTO admins (username, password) VALUES ('admin', MD5('admin123'));
