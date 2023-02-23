create database school_portal_system;
use school_portal_system;

create table students(
studentID integer auto_increment primary key,
first_name varchar(10) not null,
last_name varchar(10) not null,
email varchar(50) not null,
phone_number varchar(50) not null,
password varchar(50) not null,
enrol_date date not null,
date_of_birth date not null,
gender varchar(6) not null,
current_year integer
);

create table units (
unitID varchar(10) primary key,
unit_title varchar(50) not null,
lecturerID integer not null
);

