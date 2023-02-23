create database school_portal_system;
use school_portal_system;

create table students(
studentID integer auto_increment primary key,
first_name varchar(10) not null,
last_name varchar(10) not null,
email varchar(50) not null,
phone_number varchar(50) not null,
password varchar(50) not null,
enrol_date date not null
);