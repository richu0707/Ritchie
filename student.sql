CREATE DATABASE college_db;

USE college_db;

-- Creating the Students table
CREATE TABLE Students (
    student_id INT PRIMARY KEY AUTO_INCREMENT,
    first_name VARCHAR(50),
    last_name VARCHAR(50),
    email VARCHAR(100) UNIQUE,
    phone_number VARCHAR(15),
    date_of_birth DATE,
    major VARCHAR(100),
    enrollment_year YEAR,
    graduation_year YEAR
);

-- Creating the Courses table
CREATE TABLE Courses (
    course_id INT PRIMARY KEY AUTO_INCREMENT,
    course_name VARCHAR(100),
    course_code VARCHAR(10) UNIQUE,
    department VARCHAR(100),
    credits INT,
    semester VARCHAR(10)
);

-- Continue creating other tables (Faculty, Departments, Enrollments, etc.)