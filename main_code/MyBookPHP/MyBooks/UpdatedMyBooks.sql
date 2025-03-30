CREATE SCHEMA MyBooks;
USE MyBooks;
CREATE TABLE `Customers` (
  `Customer_ID` INT auto_increment PRIMARY KEY,
  `First_Name` VARCHAR(50) NOT NULL,
  `Last_Name` VARCHAR(50) NOT NULL,
  `Street_Address` VARCHAR(150) NOT NULL,
  `City` VARCHAR(50) NOT NULL,
  `State` VARCHAR(50) NOT NULL,
  `Zip` VARCHAR(6) NOT NULL,
  `Email` VARCHAR(150),
  `Phone_Num` VARCHAR(50) NOT NULL,
  `Password` CHAR(255) NOT NULL
);

CREATE TABLE `Companies` (
  `Company_ID` INT auto_increment PRIMARY KEY,
  `Company_Name` VARCHAR(75) NOT NULL,
  `Company_Code` VARCHAR(8) NOT NULL,
  `Street_Address`VARCHAR(150) NOT NULL,
  `City` VARCHAR(50) NOT NULL,
  `State` VARCHAR(50) NOT NULL,
  `Zip` VARCHAR(6) NOT NULL,
  `Email` VARCHAR(150),
  `Phone_Num` VARCHAR(50) NOT NULL,
  `Password` CHAR(255) NOT NULL
);

CREATE TABLE `Invoices` (
  `Invoice_ID` INT auto_increment PRIMARY KEY NOT NULL,
  `Company_ID` INT,
  `Customer_ID` INT,
  `Charge_Date` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Due_Date` date NOT NULL,
  `Invoice_Num` INT NOT NULL,
  FOREIGN KEY (`Customer_ID`) REFERENCES `Customers`(`Customer_ID`)
  ON DELETE CASCADE 
  ON UPDATE CASCADE,
  FOREIGN KEY (`Company_ID`) REFERENCES `Companies`(`Company_ID`)
  ON DELETE CASCADE 
  ON UPDATE CASCADE
);

CREATE TABLE `Invoice_Items` (
  `Item_ID` INT auto_increment PRIMARY KEY NOT NULL,
  `Invoice_ID` INT,
  `Title` VARCHAR(100) NOT NULL,
  `Rate` DECIMAL(10, 2) NOT NULL,
  `Quantity` DECIMAL(5,1) NOT NULL,
  `Description` VARCHAR(500) NOT NULL,
  FOREIGN KEY (`Invoice_ID`) REFERENCES `Invoices`(`Invoice_ID`)
  ON DELETE CASCADE 
  ON UPDATE CASCADE
);

CREATE TABLE `Payments` (
  `Payment_ID` INT auto_increment PRIMARY KEY NOT NULL,
  `Invoice_ID` INT,
  `Amount` DECIMAL(10,2) NOT NULL,
  `Date_Paid` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`Invoice_ID`) REFERENCES `Invoices`(`Invoice_ID`)
  ON DELETE CASCADE 
  ON UPDATE CASCADE
);

CREATE TABLE `Relationships` (
  `Relation_ID` INT auto_increment PRIMARY KEY NOT NULL,
  `Company_ID` INT,
  `Customer_ID` INT,
  FOREIGN KEY (`Company_ID`) REFERENCES `Companies`(`Company_ID`) 
  ON DELETE CASCADE 
  ON UPDATE CASCADE,
  FOREIGN KEY (`Customer_ID`) REFERENCES `Customers`(`Customer_ID`) 
  ON DELETE CASCADE 
  ON UPDATE CASCADE
); 