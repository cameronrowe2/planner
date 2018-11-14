CREAT DATABASE IF NOT EXISTS planner;

CREATE TABLE Login (
    username VARCHAR(100) NOT NULL,
    password VARCHAR(100) NOT NULL
);

CREATE TABLE Contacts (
    ID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(100) NOT NULL,
    email VARCHAR(100),
    mobile VARCHAR(100),
    phone VARCHAR(100),
    reason VARCHAR(255),
    website VARCHAR(100),
    address VARCHAR(255),
    comments VARCHAR(500),
    creation_time DATETIME DEFAULT CURRENT_TIMESTAMP,
    modification_time DATETIME ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE Notes (
    ID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    creation_time DATETIME DEFAULT CURRENT_TIMESTAMP,
    modification_time DATETIME ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE Dairy (
    ID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    creation_time DATETIME DEFAULT CURRENT_TIMESTAMP,
    modification_time DATETIME ON UPDATE CURRENT_TIMESTAMP
);

CREATE TABLE Calendar (
    ID INT UNSIGNED AUTO_INCREMENT PRIMARY KEY,
    date DATE NOT NULL,
    title VARCHAR(100) NOT NULL,
    description TEXT,
    time TIME,
    creation_time DATETIME DEFAULT CURRENT_TIMESTAMP,
    modification_time DATETIME ON UPDATE CURRENT_TIMESTAMP
);