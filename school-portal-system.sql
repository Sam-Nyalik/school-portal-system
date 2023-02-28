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
    roleID INTEGER NOT NULL
);

CREATE TABLE roles (
    roleID INTEGER AUTO_INCREMENT PRIMARY KEY,
    role_name VARCHAR(10) NOT NULL
);

CREATE TABLE students (
    studentID INTEGER AUTO_INCREMENT PRIMARY KEY,
    enrol_date DATE NOT NULL,
    date_of_birth DATE NOT NULL,
    year INTEGER,
    userID INTEGER NOT NULL,
    courseID INTEGER NOT NULL
);

CREATE TABLE units (
    unitID VARCHAR(10) PRIMARY KEY,
    title VARCHAR(50) NOT NULL,
    lecturerID INTEGER NOT NULL,
    year INTEGER,
    courseID INTEGER NOT NULL
);

CREATE TABLE course (
    courseID INTEGER AUTO_INCREMENT PRIMARY KEY,
    departmentID INTEGER NOT NULL,
    course_length INTEGER,
    course_name VARCHAR(50) NOT NULL
);

CREATE TABLE lecturers (
    lecturerID INTEGER PRIMARY KEY AUTO_INCREMENT,
    userID INTEGER NOT NULL,
    departmentID INTEGER NOT NULL
);

CREATE TABLE department (
    departmentID INTEGER PRIMARY KEY AUTO_INCREMENT,
    department_name VARCHAR(50) NOT NULL
);

CREATE TABLE unit_registration (
    registrationID INTEGER PRIMARY KEY AUTO_INCREMENT,
    studentID INTEGER NOT NULL,
    unitID VARCHAR(10) NOT NULL
);

CREATE TABLE classroom (
    classroomID INTEGER PRIMARY KEY AUTO_INCREMENT,
    room_name VARCHAR(10) NOT NULL
);

CREATE TABLE lecture (
    lectureID INTEGER PRIMARY KEY AUTO_INCREMENT,
    lecturerID INTEGER NOT NULL,
    datetime DATETIME NOT NULL,
    classroomID INTEGER NOT NULL,
    unitID VARCHAR(10) NOT NULL
);

CREATE TABLE attended_lecture (
    attendanceID INTEGER PRIMARY KEY AUTO_INCREMENT,
    studentID INTEGER NOT NULL,
    attended BOOLEAN NOT NULL,
    lectureID INTEGER NOT NULL
);

alter table students add foreign key (userID) references users(userID);
alter table students add foreign key (courseID) references course(courseID);

alter table units add foreign key (lecturerID) references lecturers(lecturerID);
alter table units add foreign key (courseID) references course(courseID);

alter table course add foreign key (departmentID) references department(departmentID);

alter table lecturers add foreign key (departmentID) references department(departmentID);
alter table lecturers add foreign key (userID) references users(userID);

alter table unit_registration add foreign key (studentID) references students(studentID);
alter table unit_registration add foreign key (unitID) references units(unitID);

alter table lecture add foreign key (lecturerID) references lecturers(lecturerID);
alter table lecture add foreign key (classroomID) references classroom(classroomID);
alter table lecture add foreign key (unitID) references units(unitID);

alter table attended_lecture add foreign key (studentID) references students(studentID);
alter table attended_lecture add foreign key (lectureID) references lecture(lectureID);

alter table users add foreign key (roleID) references roles(roleID);