-- Database of Travel Management System ProjectI BCA

CREATE TABLE tour_packages (
    id INT AUTO_INCREMENT PRIMARY KEY,
    name VARCHAR(255) NOT NULL,
    type VARCHAR(100) NOT NULL,
    location VARCHAR(255) NOT NULL,
    features TEXT NOT NULL,
    price DECIMAL(10, 2) NOT NULL,
    image_path VARCHAR(500) NOT NULL
);

CREATE TABLE admin (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL 
);

INSERT INTO admin (username, password) VALUES ('admin', 'password123');

CREATE TABLE tblusers (
    id INT AUTO_INCREMENT PRIMARY KEY,
    FullName VARCHAR(100) DEFAULT NULL,
    MobileNumber VARCHAR(15) DEFAULT NULL, 
    EmailId VARCHAR(70) UNIQUE NOT NULL,
    Password VARCHAR(255) NOT NULL, -- Use secure hashing
    RegDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    UpdationDate TIMESTAMP NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP
);

INSERT INTO tblusers (FullName, MobileNumber, EmailId, Password, RegDate) VALUES
('Anuj kumar', '1111111111', 'anuj@gmail.com', 'examplehashedpassword', '2017-05-10 10:38:17');

CREATE TABLE tblenquiry (
    id INT AUTO_INCREMENT PRIMARY KEY,
    FullName VARCHAR(100) DEFAULT NULL,
    EmailId VARCHAR(100) DEFAULT NULL,
    MobileNumber VARCHAR(15) DEFAULT NULL,
    Subject VARCHAR(100) DEFAULT NULL,
    Description MEDIUMTEXT DEFAULT NULL,
    PostingDate TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
    Status TINYINT(1) DEFAULT 0 -- Use enum or documentation to indicate meaning of statuses
);

-- Dumping data for table tblenquiry
INSERT INTO tblenquiry (FullName, EmailId, MobileNumber, Subject, Description, PostingDate) VALUES
('Test', 'test@gm.com', '4747474747', 'Test', 'Sample description text here.', '2017-05-14 07:54:07');

CREATE TABLE tblbooking (
  BookingId int(11) NOT NULL AUTO_INCREMENT,
  PackageId int(11) NOT NULL, 
  UserEmail varchar(100) NOT NULL,
  FromDate DATE NOT NULL,
  ToDate DATE NOT NULL, 
  Comment mediumtext DEFAULT NULL,
  RegDate timestamp NULL DEFAULT current_timestamp(),
  status varchar(50) DEFAULT NULL,
  CancelledBy ENUM('user', 'admin') DEFAULT NULL,
  UpdationDate timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  PRIMARY KEY (`BookingId`),
  FOREIGN KEY (`PackageId`) REFERENCES `tour_packages`(`id`), 
  FOREIGN KEY (`UserEmail`) REFERENCES `tblusers`(`EmailId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

