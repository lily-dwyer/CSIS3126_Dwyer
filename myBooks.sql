/* CREATE SCHEMA MyBooks;
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
  `Charge_Date` TIMESTAMP NOT NULL DEFAULT current_timestamp,
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
  `Quanity` DECIMAL(5,1) NOT NULL,
  `Description` VARCHAR(500) NOT NULL,
  FOREIGN KEY (`Invoice_ID`) REFERENCES `Invoices`(`Invoice_ID`)
  ON DELETE CASCADE 
  ON UPDATE CASCADE
);

CREATE TABLE `Payments` (
  `Payment_ID` INT auto_increment PRIMARY KEY,
  `Invoice_ID` INT,
  `Amount` DECIMAL(10,2) NOT NULL,
  `Date_Paid` TIMESTAMP NOT NULL DEFAULT current_timestamp,
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
INSERT INTO Companies (Company_Name, Street_Address, City, State, Zip, Email, Phone_Num, Password)
VALUES
('Tech Innovations', '100 Tech Park', 'Chicago', 'IL', '60611', 'contact@techinnovations.com', '555-1122', 'companypassword1'),
('Book World', '200 Book Rd', 'Springfield', 'IL', '62702', 'info@bookworld.com', '555-3344', 'companypassword2'),
('Auto Dynamics', '300 Auto Ln', 'Peoria', 'IL', '61615', 'support@autodynamics.com', '555-5566', 'companypassword3'),
('Future Vision', '600 Bright Ave', 'Evanston', 'IL', '60201', 'vision@futurevision.com', '555-1212', 'companypassword4');

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
INSERT INTO Invoice_Items (Invoice_ID, Title, Rate, Quanity, Description)
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
INSERT INTO Companies (Company_Name, Street_Address, City, State, Zip, Email, Phone_Num, Password)
VALUES
('GreenTech Solutions', '400 Greenway Blvd', 'Oak Park', 'IL', '60301', 'contact@greentech.com', '555-7777', 'companypassword5');

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
INSERT INTO Invoice_Items (Invoice_ID, Title, Rate, Quanity, Description)
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
*/






/*

-- Queries!

-- Query to input new Company user into database
INSERT INTO `Companies` (`Company_Name`, `Street_Address`, `City`, `State`, `Zip`, `Email`, `Phone_Num`, `Password`)
VALUES
('[Company Name]', '[Address]', '[City]', '[State]', '[Zip Code', '[Email]', '[Phone Number]', '[Hashed Password]');

-- Query to input new Customers user into database
INSERT INTO `Customers` (`First_Name`, , 'Last_Name', `Street_Address`, `City`, `State`, `Zip`, `Email`, `Phone_Num`, `Password`)
VALUES
('[First Name]', '[Last Name]', '[Address]', '[City]', '[State]', '[Zip Code', '[Email]', '[Phone Number]', '[Hashed Password]');

-- Query to verify company login
SELECT password FROM companies WHERE password=[hashed password]

-- Query to verify customer login
SELECT password FROM customers WHERE password=[hashed password]

-- Query to provide customer names for companies
SELECT first_name, last_name 
FROM customers
INNER JOIN relationships ON relationships.customer_id=customers.customer_id 
WHERE relationships.company_id = 
(SELECT Company_ID FROM companies WHERE company_name = '[company name]');

-- Query to provide company names for customers
SELECT company_name
FROM companies
INNER JOIN relationships ON relationships.company_id=companies.company_id 
WHERE relationships.customer_id = 
(SELECT customer_ID FROM customers WHERE first_name = '[first name]' AND last_name = '[last name]');

-- Query to display company code for users to input
SELECT company_id FROM companies WHERE company_name = '[company name]';

-- Query to display company name so users can verify that is the company they intend to connect with
SELECT company_name FROM companies WHERE company_id = [id];

-- Query for customers to add new companies
INSERT INTO `Relationships` (`Company_ID`, `Customer_ID`)
SELECT 
    (SELECT Company_ID FROM companies WHERE company_name = '[company name]'),
    (SELECT Customer_ID FROM customers WHERE first_name = '[first name]' AND last_name = '[last name]');

-- Query to view paid invoices 
SELECT invoices.invoice_num, invoices.charge_date, invoices.due_date, 
       invoice_items.title, invoice_items.rate, invoice_items.quanity, 
       invoice_items.description,
       SUM(invoice_items.rate * invoice_items.quanity) AS total_cost
FROM invoices
INNER JOIN invoice_items ON invoices.invoice_id = invoice_items.invoice_id
LEFT JOIN payments ON invoices.invoice_id = payments.invoice_id
WHERE invoices.invoice_num = (SELECT invoice_num 
FROM invoices 
WHERE invoices.customer_id = (SELECT customer_id 
FROM customers 
WHERE first_name = '[First name]' AND last_name = '[Last Name]')
LIMIT 1)
GROUP BY invoices.invoice_num, invoices.charge_date, invoices.due_date, 
invoice_items.title, invoice_items.rate, invoice_items.quanity, invoice_items.description;

-- Part 1: Query to view items on unpaid invoices
SELECT 
    invoices.invoice_num, 
    invoices.charge_date, 
    invoices.due_date, 
    SUM(invoice_items.rate * invoice_items.quanity) AS total_owed,
    COALESCE(SUM(payments.amount), 0) AS total_paid,
    SUM(invoice_items.rate * invoice_items.quanity) - COALESCE(SUM(payments.amount), 0) AS balance_due
FROM invoices
INNER JOIN invoice_items ON invoices.invoice_id = invoice_items.invoice_id
LEFT JOIN payments ON invoices.invoice_id = payments.invoice_id
WHERE invoices.customer_id = (
    SELECT customer_id 
    FROM customers 
    WHERE first_name = 'Tom' AND last_name = 'Brown'
)
GROUP BY invoices.invoice_num, invoices.charge_date, invoices.due_date
HAVING SUM(invoice_items.rate * invoice_items.quanity) > COALESCE(SUM(payments.amount), 0);

-- Part 2: View total left to pay on each invoice
SELECT invoices.invoice_num,
       SUM(invoice_items.rate * invoice_items.quanity) AS total_owed,
       COALESCE(SUM(payments.amount), 0) AS total_paid,
       SUM(invoice_items.rate * invoice_items.quanity) - COALESCE(SUM(payments.amount), 0) AS balance_due
FROM invoices
INNER JOIN invoice_items ON invoices.invoice_id = invoice_items.invoice_id
LEFT JOIN payments ON invoices.invoice_id = payments.invoice_id
WHERE invoices.customer_id = 
    (SELECT customer_id 
     FROM customers 
     WHERE first_name = '[First Name]' AND last_name = '[Last Name]')
GROUP BY invoices.invoice_num
HAVING SUM(invoice_items.rate * invoice_items.quanity) > COALESCE(SUM(payments.amount), 0);

-- Query for customer to delete an invoice
DELETE invoice_items
FROM invoice_items
INNER JOIN invoices ON invoice_items.invoice_id = invoices.invoice_id
WHERE invoice_items.title = 'Computer Screen Repair'
AND invoice_items.item_id IS NOT NULL
AND invoice_items.item_id > 0;

-- Query to make payments
INSERT INTO `Payments` (`Invoice_ID`, `Amount`, `Date_Paid`)
SELECT (SELECT Invoice_ID FROM invoices 
		INNER JOIN customers ON customers.customer_id=invoices.customer_id
        WHERE invoices.Invoice_Num = 1 AND customers.first_name="Eve" AND customers.last_name="Walker"), 
5.00, NOW();

-- Query to display company email and phone number for customers in case there is an issue
SELECT email, phone_num FROM companies WHERE company_name = '[company name]';

-- Query to display company unpaid stats 
SELECT customers.last_name, customers.first_name, 
SUM(invoice_items.rate * invoice_items.quanity) AS gross_balance,
(SUM(invoice_items.rate * invoice_items.quanity) - SUM(payments.amount)) AS total_owed,
round((((SUM(invoice_items.rate * invoice_items.quanity) - SUM(payments.amount))  / (SUM(invoice_items.rate * invoice_items.quanity))) * 100), 2) AS percent_unpaid,
COUNT(CASE WHEN payments.date_paid > invoices.due_date THEN 1 ELSE NULL END) AS late_payments
FROM customers 
INNER JOIN invoices ON invoices.customer_id = customers.customer_id
INNER JOIN invoice_items ON invoice_items.invoice_id = invoices.invoice_id
LEFT JOIN payments ON payments.invoice_id = invoices.invoice_id
WHERE customers.first_name = "[First name]" AND customers.last_name = "[Last name]"
GROUP BY customers.last_name, customers.first_name;

-- Query to display company paid stats
SELECT customers.last_name, customers.first_name, 
SUM(payments.amount) AS amount_paid,
round(( (SUM(payments.amount)  / (SELECT sum(payments.amount) from payments)) * 100), 2) AS percent_of_profit
FROM customers 
INNER JOIN invoices ON invoices.customer_id = customers.customer_id
INNER JOIN invoice_items ON invoice_items.invoice_id = invoices.invoice_id
LEFT JOIN payments ON payments.invoice_id = invoices.invoice_id
WHERE customers.first_name = "[First Name]" AND customers.last_name = "[Last name]" 
AND YEAR(invoices.charge_date) = 2025 
GROUP BY customers.last_name, customers.first_name;

-- Query to display company unpaid stats by year
SELECT customers.last_name, customers.first_name, 
SUM(invoice_items.rate * invoice_items.quanity) AS gross_balance,
(SUM(invoice_items.rate * invoice_items.quanity) - SUM(payments.amount)) AS total_owed,
round((((SUM(invoice_items.rate * invoice_items.quanity) - SUM(payments.amount))  / (SUM(invoice_items.rate * invoice_items.quanity))) * 100), 2) AS percent_unpaid,
COUNT(CASE WHEN payments.date_paid > invoices.due_date THEN 1 ELSE NULL END) AS late_payments
FROM customers 
INNER JOIN invoices ON invoices.customer_id = customers.customer_id
INNER JOIN invoice_items ON invoice_items.invoice_id = invoices.invoice_id
LEFT JOIN payments ON payments.invoice_id = invoices.invoice_id
WHERE customers.first_name = "[First name]" AND customers.last_name = "[Last Name]" 
AND YEAR(invoices.charge_date) = [year] 
GROUP BY customers.last_name, customers.first_name;

-- Query to display company paid stats by year
SELECT customers.last_name, customers.first_name, 
SUM(payments.amount) AS amount_paid,
round(( (SUM(payments.amount)  / (SELECT sum(payments.amount) from payments)) * 100), 2) AS percent_of_profit
FROM customers 
INNER JOIN invoices ON invoices.customer_id = customers.customer_id
INNER JOIN invoice_items ON invoice_items.invoice_id = invoices.invoice_id
LEFT JOIN payments ON payments.invoice_id = invoices.invoice_id
WHERE customers.first_name = "[first name]" AND customers.last_name = "[last name]" 
AND YEAR(invoices.charge_date) = [year]
GROUP BY customers.last_name, customers.first_name;

*/