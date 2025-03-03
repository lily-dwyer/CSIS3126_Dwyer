/*
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
  `Password` CHAR(60) NOT NULL
);

CREATE TABLE `Companies` (
  `Company_ID` INT auto_increment PRIMARY KEY,
  `Company_Name` VARCHAR(75) NOT NULL,
  `Company_Code` VARCHAR(6) NOT NULL,
  `Street_Address`VARCHAR(150) NOT NULL,
  `City` VARCHAR(50) NOT NULL,
  `State` VARCHAR(50) NOT NULL,
  `Zip` VARCHAR(6) NOT NULL,
  `Email` VARCHAR(150),
  `Phone_Num` VARCHAR(50) NOT NULL,
  `Password` CHAR(50) NOT NULL
);

CREATE TABLE `Invoices` (
  `Invoice_ID` INT auto_increment PRIMARY KEY,
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
  `Item_ID` INT auto_increment PRIMARY KEY,
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
  `Payment_ID` INT auto_increment PRIMARY KEY,
  `Invoice_ID` INT,
  `Amount` DECIMAL(10,2) NOT NULL,
  `Date_Paid` DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
  FOREIGN KEY (`Invoice_ID`) REFERENCES `Invoices`(`Invoice_ID`)
  ON DELETE CASCADE 
  ON UPDATE CASCADE
);

CREATE TABLE `Relationships` (
  `Relation_ID` INT auto_increment PRIMARY KEY,
  `Company_ID` INT,
  `Customer_ID` INT,
  FOREIGN KEY (`Company_ID`) REFERENCES `Companies`(`Company_ID`) 
  ON DELETE CASCADE 
  ON UPDATE CASCADE,
  FOREIGN KEY (`Customer_ID`) REFERENCES `Customers`(`Customer_ID`) 
  ON DELETE CASCADE 
  ON UPDATE CASCADE
); 

-- Insert Test Data for Customers
INSERT INTO Customers (First_Name, Last_Name, Street_Address, City, State, Zip, Email, Phone_Num, Password)
VALUES
('John', 'Doe', '123 Main St', 'Springfield', 'IL', '62701', 'john.doe@email.com', '555-1234', 'hashedpassword1'),
('Jane', 'Smith', '456 Elm St', 'Chicago', 'IL', '60610', 'jane.smith@email.com', '555-5678', 'hashedpassword2'),
('Tom', 'Brown', '789 Oak St', 'Peoria', 'IL', '61614', 'tom.brown@email.com', '555-8765', 'hashedpassword3'),
('Eve', 'Walker', '201 Birch Ln', 'Evanston', 'IL', '60201', 'eve.walker@email.com', '555-1111', 'hashedpassword4'),
('Charlie', 'Davis', '602 Cedar Ct', 'Oak Park', 'IL', '60302', 'charlie.d@email.com', '555-2222', 'hashedpassword5');

-- Insert Test Data for Companies
INSERT INTO Companies (Company_Name, Company_Code, Street_Address, City, State, Zip, Email, Phone_Num, Password)
VALUES
('Tech Innovations', 'x6saj4', '100 Tech Park', 'Chicago', 'IL', '60611', 'contact@techinnovations.com', '555-1122', 'companypassword1'),
('Book World', 'dgsq8h','200 Book Rd', 'Springfield', 'IL', '62702', 'info@bookworld.com', '555-3344', 'companypassword2'),
('Auto Dynamics', 'hw27vq', '300 Auto Ln', 'Peoria', 'IL', '61615', 'support@autodynamics.com', '555-5566', 'companypassword3'),
('Future Vision', 'xva82m','600 Bright Ave', 'Evanston', 'IL', '60201', 'vision@futurevision.com', '555-1212', 'companypassword4');

-- Insert Test Data for Invoices
INSERT INTO Invoices (Company_ID, Customer_ID, Charge_Date, Due_Date, Invoice_Num)
SELECT 
    (SELECT Company_ID FROM Companies WHERE Company_Name = 'Tech Innovations'),
    (SELECT Customer_ID FROM Customers WHERE First_Name = 'John' AND Last_Name = 'Doe'),
    NOW(), '2025-02-28',
    (SELECT COALESCE(MAX(Invoice_Num), 0) + 1 
     FROM Invoices 
     WHERE Company_ID = (SELECT Company_ID FROM Companies WHERE Company_Name = 'Tech Innovations') 
     AND Customer_ID = (SELECT Customer_ID FROM Customers WHERE First_Name = 'John' AND Last_Name = 'Doe'))
UNION ALL
SELECT 
    (SELECT Company_ID FROM Companies WHERE Company_Name = 'Book World'),
    (SELECT Customer_ID FROM Customers WHERE First_Name = 'Jane' AND Last_Name = 'Smith'),
    NOW(), '2025-03-15',
    (SELECT COALESCE(MAX(Invoice_Num), 0) + 1 
     FROM Invoices 
     WHERE Company_ID = (SELECT Company_ID FROM Companies WHERE Company_Name = 'Book World') 
     AND Customer_ID = (SELECT Customer_ID FROM Customers WHERE First_Name = 'Jane' AND Last_Name = 'Smith'))
UNION ALL
SELECT 
    (SELECT Company_ID FROM Companies WHERE Company_Name = 'Auto Dynamics'),
    (SELECT Customer_ID FROM Customers WHERE First_Name = 'Tom' AND Last_Name = 'Brown'),
    NOW(), '2025-04-10',
    (SELECT COALESCE(MAX(Invoice_Num), 0) + 1 
     FROM Invoices 
     WHERE Company_ID = (SELECT Company_ID FROM Companies WHERE Company_Name = 'Auto Dynamics') 
     AND Customer_ID = (SELECT Customer_ID FROM Customers WHERE First_Name = 'Tom' AND Last_Name = 'Brown'));

-- Insert Test Data for Invoice Items
INSERT INTO Invoice_Items (Invoice_ID, Title, Rate, Quantity, Description)
SELECT 
    (SELECT Invoice_ID FROM Invoices WHERE Company_ID = (SELECT Company_ID FROM Companies WHERE Company_Name = 'Tech Innovations') 
    AND Customer_ID = (SELECT Customer_ID FROM Customers WHERE First_Name = 'John' AND Last_Name = 'Doe') AND Invoice_Num = 1),
    'Software Subscription', 199.99, 1.0, 'Annual software subscription for business use'
UNION ALL
SELECT 
    (SELECT Invoice_ID FROM Invoices WHERE Company_ID = (SELECT Company_ID FROM Companies WHERE Company_Name = 'Book World') 
    AND Customer_ID = (SELECT Customer_ID FROM Customers WHERE First_Name = 'Jane' AND Last_Name = 'Smith') AND Invoice_Num = 1),
    'Books', 29.99, 3.0, 'Collection of business books for the office';

-- Insert Test Data for Payments
INSERT INTO Payments (Invoice_ID, Amount, Date_Paid)
SELECT 
    (SELECT Invoice_ID FROM Invoices WHERE Company_ID = (SELECT Company_ID FROM Companies WHERE Company_Name = 'Tech Innovations') 
    AND Customer_ID = (SELECT Customer_ID FROM Customers WHERE First_Name = 'John' AND Last_Name = 'Doe') AND Invoice_Num = 1),
    199.99, NOW()
UNION ALL
SELECT 
    (SELECT Invoice_ID FROM Invoices WHERE Company_ID = (SELECT Company_ID FROM Companies WHERE Company_Name = 'Book World') AND Customer_ID = (SELECT Customer_ID FROM Customers WHERE First_Name = 'Jane' AND Last_Name = 'Smith') AND Invoice_Num = 1),
    89.97, NOW();

-- Insert Test Data for Relationships
INSERT INTO Relationships (Company_ID, Customer_ID)
SELECT 
    (SELECT Company_ID FROM Companies WHERE Company_Name = 'Tech Innovations'),
    (SELECT Customer_ID FROM Customers WHERE First_Name = 'John' AND Last_Name = 'Doe')
UNION ALL
SELECT 
    (SELECT Company_ID FROM Companies WHERE Company_Name = 'Book World'),
    (SELECT Customer_ID FROM Customers WHERE First_Name = 'Jane' AND Last_Name = 'Smith')
UNION ALL
SELECT 
    (SELECT Company_ID FROM Companies WHERE Company_Name = 'Auto Dynamics'),
    (SELECT Customer_ID FROM Customers WHERE First_Name = 'Tom' AND Last_Name = 'Brown');


-- more test data 
-- Insert Additional Test Data for Customers
INSERT INTO Customers (First_Name, Last_Name, Street_Address, City, State, Zip, Email, Phone_Num, Password)
VALUES
('Alice', 'Johnson', '101 Maple Dr', 'Decatur', 'IL', '62523', 'alice.j@email.com', '555-3333', 'hashedpassword6'),
('Bob', 'Martinez', '707 Pine St', 'Rockford', 'IL', '61101', 'bob.m@email.com', '555-4444', 'hashedpassword7');

-- Insert Additional Test Data for Companies
INSERT INTO Companies (Company_Name, Company_Code, Street_Address, City, State, Zip, Email, Phone_Num, Password)
VALUES
('GreenTech Solutions', 'dgs68n', '400 Greenway Blvd', 'Oak Park', 'IL', '60301', 'contact@greentech.com', '555-7777', 'companypassword5');

-- Insert Additional Test Data for Invoices (Paid and Unpaid)
INSERT INTO Invoices (Company_ID, Customer_ID, Charge_Date, Due_Date, Invoice_Num)
SELECT 
    (SELECT Company_ID FROM Companies WHERE Company_Name = 'Future Vision'),
    (SELECT Customer_ID FROM Customers WHERE First_Name = 'Eve' AND Last_Name = 'Walker'),
    NOW(), '2025-05-01',
    (SELECT COALESCE(MAX(Invoice_Num), 0) + 1 
     FROM Invoices 
     WHERE Company_ID = (SELECT Company_ID FROM Companies WHERE Company_Name = 'Future Vision') 
     AND Customer_ID = (SELECT Customer_ID FROM Customers WHERE First_Name = 'Eve' AND Last_Name = 'Walker'))
UNION ALL
SELECT 
    (SELECT Company_ID FROM Companies WHERE Company_Name = 'Tech Innovations'),
    (SELECT Customer_ID FROM Customers WHERE First_Name = 'John' AND Last_Name = 'Doe'),
    NOW(), '2025-06-15',
    (SELECT COALESCE(MAX(Invoice_Num), 0) + 1 
     FROM Invoices 
     WHERE Company_ID = (SELECT Company_ID FROM Companies WHERE Company_Name = 'Tech Innovations') 
     AND Customer_ID = (SELECT Customer_ID FROM Customers WHERE First_Name = 'John' AND Last_Name = 'Doe'));

-- Insert Additional Test Data for Invoice Items
INSERT INTO Invoice_Items (Invoice_ID, Title, Rate, Quantity, Description)
SELECT 
    (SELECT Invoice_ID FROM Invoices WHERE Company_ID = (SELECT Company_ID FROM Companies WHERE Company_Name = 'Future Vision') 
    AND Customer_ID = (SELECT Customer_ID FROM Customers WHERE First_Name = 'Eve' AND Last_Name = 'Walker') AND Invoice_Num = 1),
    'Consultation Service', 299.99, 1.0, 'Monthly business strategy consultation'
UNION ALL
SELECT 
    (SELECT Invoice_ID FROM Invoices WHERE Company_ID = (SELECT Company_ID FROM Companies WHERE Company_Name = 'Tech Innovations') 
    AND Customer_ID = (SELECT Customer_ID FROM Customers WHERE First_Name = 'John' AND Last_Name = 'Doe') AND Invoice_Num = 2),
    'IT Support', 99.99, 2.0, 'On-site technical support sessions';

-- Insert Payments for Partial and Full Settlements
INSERT INTO Payments (Invoice_ID, Amount, Date_Paid)
SELECT 
    (SELECT Invoice_ID FROM Invoices WHERE Company_ID = (SELECT Company_ID FROM Companies WHERE Company_Name = 'Future Vision') 
    AND Customer_ID = (SELECT Customer_ID FROM Customers WHERE First_Name = 'Eve' AND Last_Name = 'Walker') AND Invoice_Num = 1),
    150.00, NOW()
UNION ALL
SELECT 
    (SELECT Invoice_ID FROM Invoices WHERE Company_ID = (SELECT Company_ID FROM Companies WHERE Company_Name = 'Tech Innovations') 
    AND Customer_ID = (SELECT Customer_ID FROM Customers WHERE First_Name = 'John' AND Last_Name = 'Doe') AND Invoice_Num = 2),
    199.98, NOW();

-- Insert Test Data for Relationships (Many-to-Many)
INSERT INTO Relationships (Company_ID, Customer_ID)
SELECT 
    (SELECT Company_ID FROM Companies WHERE Company_Name = 'GreenTech Solutions'),
    (SELECT Customer_ID FROM Customers WHERE First_Name = 'Alice' AND Last_Name = 'Johnson')
UNION ALL
SELECT 
    (SELECT Company_ID FROM Companies WHERE Company_Name = 'Auto Dynamics'),
    (SELECT Customer_ID FROM Customers WHERE First_Name = 'Eve' AND Last_Name = 'Walker')
UNION ALL
SELECT 
    (SELECT Company_ID FROM Companies WHERE Company_Name = 'GreenTech Solutions'),
    (SELECT Customer_ID FROM Customers WHERE First_Name = 'Bob' AND Last_Name = 'Martinez');




/*


-- Queries!

-- Query to input new Company user into database
INSERT INTO `Companies` (`Company_Name`, `Company_Name`, `Street_Address`, `City`, `State`, `Zip`, `Email`, `Phone_Num`, `Password`)
VALUES
('[Company Name]', '[Company Code]','[Address]', '[City]', '[State]', '[Zip Code', '[Email]', '[Phone Number]', '[Hashed Password]');

-- Query to input new Customers user into database
INSERT INTO `Customers` (`First_Name`, , 'Last_Name', `Street_Address`, `City`, `State`, `Zip`, `Email`, `Phone_Num`, `Password`)
VALUES
('[First Name]', '[Last Name]', '[Address]', '[City]', '[State]', '[Zip Code', '[Email]', '[Phone Number]', '[Hashed Password]');

-- Query to verify company login
SELECT email FROM companies WHERE password=[hashed password]

-- Query to verify customer login
SELECT email FROM customers WHERE password=[hashed password]

-- Query to provide customer names for companies
SELECT first_name, last_name 
FROM customers
INNER JOIN relationships ON relationships.customer_id=customers.customer_id 
WHERE relationships.company_id = [company_id];

-- Query to provide company names for customers
SELECT company_name 
FROM companies
INNER JOIN relationships ON relationships.company_id=companies.company_id 
WHERE relationships.customer_id = [customer_id];

-- Query to display company code for users to input
SELECT company_code FROM companies WHERE company_id=[company id];

-- Query to display company name so users can verify that is the company they intend to connect with
SELECT company_name FROM companies WHERE company_id = [id];

-- Query for customers to add new companies
INSERT INTO `Relationships` (`Company_ID`, `Customer_ID`)
SELECT 
    (SELECT Company_ID FROM companies WHERE company_code = '[company code]'),
    [customer_id];

-- Query to view all paid invoices between a particular company and customer(Display: Invoice Number, Date Charged, Total Charged, Date Paid) 
SELECT invoices.invoice_num, invoices.charge_date, SUM(invoice_items.rate * invoice_items.quantity) AS total_cost,
      payments.date_paid
FROM invoices
INNER JOIN invoice_items ON invoices.invoice_id = invoice_items.invoice_id
LEFT JOIN payments ON invoices.invoice_id = payments.invoice_id
WHERE invoices.customer_id = [customer_id] AND invoices.company_id = [company_id]
GROUP BY invoices.invoice_id, payments.payment_id, invoice_items.item_id
HAVING (total_cost-sum((payments.amount))=0);

-- Query to view all unpaid invoices between a particular company and customer(Display: Invoice Number, Date Charged, Total Charged, Total Unpaid Balance, Date Due) 
SELECT invoices.invoice_num, invoices.charge_date, SUM(invoice_items.rate * invoice_items.quantity) AS total_cost, 
      ((SUM(invoice_items.rate * invoice_items.quantity))-(coalesce((payments.amount)))) AS balance_due, invoices.due_date
FROM invoices
INNER JOIN invoice_items ON invoices.invoice_id = invoice_items.invoice_id
LEFT JOIN payments ON invoices.invoice_id = payments.invoice_id
WHERE invoices.customer_id = 4 AND invoices.company_id = 4
GROUP BY invoices.invoice_id, payments.payment_id, invoice_items.item_id
HAVING (total_cost-sum((payments.amount))>0);

-- Query to view unpaid invoices items from a particular invoice(Display: Invoice Number, Charge Title, Rate, Quantity, Total, Charge Description) 
SELECT invoices.invoice_num, invoice_items.title, invoice_items.rate, invoice_items.quantity, 
(invoice_items.rate * invoice_items.quantity) AS total,invoice_items.description
FROM invoice_items
INNER JOIN invoices ON invoices.invoice_id = invoice_items.invoice_id
LEFT JOIN payments ON invoices.invoice_id = payments.invoice_id
WHERE invoices.customer_id = [id] AND invoices.company_id = [id]
GROUP BY invoices.invoice_id, invoice_items.item_id
HAVING ((total-(sum(payments.amount)))>0);

-- Query to view paid invoices items from a particular invoice(Display: Invoice Number, Charge Title, Rate, Quantity, Total, Charge Description) 
SELECT invoices.invoice_num, invoice_items.title, invoice_items.rate, invoice_items.quantity, 
(invoice_items.rate * invoice_items.quantity) AS total,invoice_items.description
FROM invoice_items
INNER JOIN invoices ON invoices.invoice_id = invoice_items.invoice_id
LEFT JOIN payments ON invoices.invoice_id = payments.invoice_id
WHERE invoices.customer_id = [id] AND invoices.company_id = [id]
GROUP BY invoices.invoice_id, invoice_items.item_id
HAVING ((total-(sum(payments.amount)))=0);

-- Query for company to delete an invoice item while editing(also used for update: delete original and add corrected)
DELETE invoice_items
FROM invoice_items
WHERE invoice_items.item_id=[id];

-- Query to make payments
INSERT INTO `Payments` (`Invoice_ID`, `Amount`, `Date_Paid`)
SELECT (SELECT Invoice_ID FROM invoices 
		INNER JOIN customers ON customers.customer_id=invoices.customer_id
        WHERE invoices.Invoice_Num = [invoice num] AND customers.customer_id=[id], 
		5.00, NOW();

-- Query to display company email and phone number for customers in case there is an issue
SELECT email, phone_num FROM companies WHERE company_id = [id];

-- Query to display company unpaid stats(Displays: customer first name, customer last name, total unpaid, percent unpaid, number of late payments)
SELECT customers.last_name, customers.first_name, 
SUM(invoice_items.rate * invoice_items.quantity) AS gross_balance,
((SUM(invoice_items.rate * invoice_items.quantity)) - SUM(payments.amount)) AS total_owed,
round((((SUM(invoice_items.rate * invoice_items.quantity) - SUM(payments.amount))  / (SUM(invoice_items.rate * invoice_items.quantity))) * 100), 2) AS percent_unpaid,
COUNT(CASE WHEN payments.date_paid > invoices.due_date THEN 1 ELSE NULL END) AS late_payments
FROM customers 
INNER JOIN invoices ON invoices.customer_id = customers.customer_id
INNER JOIN invoice_items ON invoice_items.invoice_id = invoices.invoice_id
INNER JOIN companies ON companies.company_id=invoices.company_id
LEFT JOIN payments ON payments.invoice_id = invoices.invoice_id
WHERE companies.company_id=1
GROUP BY customers.customer_id, customers.first_name, customers.last_name;

-- Query to display company paid stats(Displays: First name, last name, total paid, and percent contribution to profits)
SELECT customers.first_name, customers.last_name, 
SUM(payments.amount) AS amount_paid, ROUND( (SUM(payments.amount) / 
(SELECT COALESCE(SUM(payments.amount), 0) FROM payments 
INNER JOIN invoices ON payments.invoice_id = invoices.invoice_id
WHERE invoices.company_id = [id])) * 100, 2) AS percent_of_profit
FROM customers
INNER JOIN invoices ON invoices.customer_id = customers.customer_id
INNER JOIN companies ON companies.company_id = invoices.company_id
LEFT JOIN payments ON payments.invoice_id = invoices.invoice_id
WHERE companies.company_id = [id] 
GROUP BY customers.customer_id, customers.first_name, customers.last_name;

-- Query to display company unpaid stats by year(displays: first name, last name, total unpaid, total charged, percent unpaid, number of late payments)
SELECT customers.last_name, customers.first_name, 
SUM(invoice_items.rate * invoice_items.quantity) AS gross_balance,
((SUM(invoice_items.rate * invoice_items.quantity)) - SUM(payments.amount)) AS total_owed,
round((((SUM(invoice_items.rate * invoice_items.quantity) - SUM(payments.amount))  / (SUM(invoice_items.rate * invoice_items.quantity))) * 100), 2) AS percent_unpaid,
COUNT(CASE WHEN payments.date_paid > invoices.due_date THEN 1 ELSE NULL END) AS late_payments
FROM customers 
INNER JOIN invoices ON invoices.customer_id = customers.customer_id
INNER JOIN invoice_items ON invoice_items.invoice_id = invoices.invoice_id
INNER JOIN companies ON companies.company_id=invoices.company_id
LEFT JOIN payments ON payments.invoice_id = invoices.invoice_id
WHERE companies.company_id=[id] AND YEAR(invoices.charge_date) = [year]
GROUP BY customers.customer_id, customers.first_name, customers.last_name;

-- Query to display company paid stats by year (Displays: First name, last name, total paid, and percent contribution to profits)
SELECT customers.first_name, customers.last_name, 
SUM(payments.amount) AS amount_paid, ROUND( (SUM(payments.amount) / 
(SELECT COALESCE(SUM(payments.amount), 0) FROM payments 
INNER JOIN invoices ON payments.invoice_id = invoices.invoice_id
WHERE invoices.company_id = [id])) * 100, 2) AS percent_of_profit
FROM customers
INNER JOIN invoices ON invoices.customer_id = customers.customer_id
INNER JOIN companies ON companies.company_id = invoices.company_id
LEFT JOIN payments ON payments.invoice_id = invoices.invoice_id
WHERE companies.company_id = [id] AND YEAR(invoices.charge_date) = 2025 
GROUP BY customers.customer_id, customers.first_name, customers.last_name;

*/