create database school_portal_system;
use school_portal_system;

CREATE TABLE users (
    userID INTEGER AUTO_INCREMENT PRIMARY KEY,
    first_name VARCHAR(10) NOT NULL,
    last_name VARCHAR(10) NOT NULL,
    email VARCHAR(50) NOT NULL,
    phone_number VARCHAR(50) NOT NULL,
    password VARCHAR(50) NOT NULL,
    gender VARCHAR(6) NOT NULL,
    is_admin BOOLEAN NOT NULL
);

CREATE TABLE students (
    studentID INTEGER AUTO_INCREMENT PRIMARY KEY,
    enrol_date DATE NOT NULL,
    date_of_birth DATE NOT NULL,
    year INTEGER,
    userID INTEGER NOT NULL
);

CREATE TABLE units (
    unitID VARCHAR(10) PRIMARY KEY,
    title VARCHAR(50) NOT NULL,
    lecturerID INTEGER NOT NULL,
    year INTEGER
);

CREATE TABLE lecturers (
    lecturerID INTEGER PRIMARY KEY AUTO_INCREMENT,
    userID INTEGER NOT NULL
);