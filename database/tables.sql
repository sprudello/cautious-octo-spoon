-- Database -- 
CREATE DATABASE PasswordManager CHARACTER SET utf8 COLLATE utf8_general_ci;

-- Tables --
USE PasswordManager;
CREATE TABLE passwords(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    website VARCHAR(255) NOT NULL,
    username VARCHAR(255),
    password VARCHAR(255) NOT NULL,
    user_id INT DEFAULT 1
);

USE PasswordManager;
CREATE TABLE users(
	id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL
);