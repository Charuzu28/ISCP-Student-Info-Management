CREATE TABLE courses (
    courseID INT AUTO_INCREMENT PRIMARY KEY,
    course VARCHAR(50) NOT NULL
);

CREATE TABLE register (
    registerID INT AUTO_INCREMENT PRIMARY KEY,  
    facultyID VARCHAR(6) UNIQUE,
    fname VARCHAR(50) NOT NULL,
    mname VARCHAR(50) NULL,
    lname VARCHAR(50) NOT NULL,
    email VARCHAR(100) UNIQUE NOT NULL,   
    birthday DATE NOT NULL,
    age INT NOT NULL
);

CREATE TABLE login (
    loginID INT AUTO_INCREMENT PRIMARY KEY,
    registerID INT,
    username VARCHAR(50) NOT NULL,
    password VARCHAR(255) NOT NULL, 
    FOREIGN KEY (registerID) REFERENCES register(registerID)
);

CREATE TABLE student (
    studentID INT AUTO_INCREMENT PRIMARY KEY,
    loginID INT,
    registerID INT,
    courseID INT,
    studentName VARCHAR(50) NOT NULL,
    year VARCHAR(50) NULL,
    FOREIGN KEY (registerID) REFERENCES register(registerID),
    FOREIGN KEY (loginID) REFERENCES login(loginID),
    FOREIGN KEY (courseID) REFERENCES courses(courseID)
);
