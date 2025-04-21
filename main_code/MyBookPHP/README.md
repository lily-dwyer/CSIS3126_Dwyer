# **MyBooks**

## **Description**

This project is a PHP-based full-stack web application designed to simulate a two-sided invoice management platform that connects companies and their customers. The system allows users to register as either a company or a customer and perform tasks appropriate to their role. Customers can log in, connect with companies using unique codes, and view past and present invoices assigned to them. Companies can create invoices, track payments, view past and present invoices, and view financial statistics through a dedicated dashboard. The application includes essential features like user authentication, form validation, relationship management between customers and companies, itemized invoice creation, and a stats page offering analytical insights into invoice trends. The goal of this project is to streamline communication and transaction tracking between businesses and clients while maintaining a secure and user-friendly interface.

## **Getting Started**

### **Dependencies**

* A server that can host PHP/SQL (e.g., MAMP)  
* Browser

### **Installing**

* The repository is available on GitHub under CSIS3126\_Dwyer. You can download the zip and extract the files or   
  * git clone [https://github.com/lily-dwyer/CSIS3126\_Dwyer.git](https://github.com/lily-dwyer/CSIS3126_Dwyer.git)  
* Navigate to CSIS3126\_Dwyer/main\_code and open/run UpdatedMyBooks.sql

### **Executing program**

* If using MAMP, put MyBookPHP in htdocs in your MAMP file  
  * Access in browser “localhost:XXXX/MyBookPHP”  
    * XXXX \= Your apache port found in MAMP application under preferences-\>ports  
* The login page should appear. 

### **Usage**

* There are no users when the program first starts.   
* Select “Need an account? Sign up\!” to register  
* Fill out form  
* Select whether you are making an account for a company or a customer  
  * If you are a company, you will be prompted to enter your company name  
* If registration is completed successfully, you will be redirected to the login page  
* Login with existing credentials  
* Companies will redirect to company dashboard  
  * If no connections exist, the dashboard will display the company name and company code and allow you to log out   
    * Share this code with a customer to connect  
  * Otherwise, you can select a customer   
    * Once you select a customer you can view paid  
      * View-only, displays invoice number, date charged, date of most recent payment, and total cost  
      * From here you can also view invoice items  
        * Displays invoices number, item title, rate, quantity, item total, description  
    * View Unpaid  
      * Displays invoice number, date charged, total cost, balance due, due date (in red if overdue)  
      * From here you can also view invoice items  
        * Displays invoices number, item title, rate, quantity, item total, description  
      * You can make payments towards an invoice. You may not pay more than is due on a single invoice.   
    * Input new invoice  
      * First select a due date from the calendar  
      * Next, input the title, rate, quantity, and description for each item. You can add and remove lines as needed  
      * Submit  
  * Or (if you have any existing invoices) view stats  
    * Unpaid Stats includes the customer's first and last name, total charged, total owed, percent of their invoices unpaid, and their number of late payments  
    * Paid Stats includes the customer’s first and last name, total paid, and how much their charged play into your total profit as a percentage  
* Customers will redirect to customer dashboard  
  * If no connections exist, customer dash will include customer name, logout button, and button to connect with new companies  
    * To connect, select this option and type in a connection code from a company  
      * The program will confirm they have retrieved the correct company and the connection will be processed  
      * This company will now appear in your companies drop down  
  * You can select a company from your companies dropdown if you have any  
    * Here you can view paid invoices  
      * View-only, displays invoice number, date charged, date of most recent payment, and total cost  
      * From here you can also view invoice items  
        * Displays invoices number, item title, rate, quantity, item total, description  
    * And unpaid invoices  
      * Displays invoice number, date charged, total cost, balance due, due date (in red if overdue)  
      * From here you can also view invoice items  
        * Displays invoices number, item title, rate, quantity, item total, description

## **Help**

* Connection issues:  
  * Global.php assumes some factors about your sql server  
    * If your server is not called localhost and your username and password for your server is not root, you will need to alter the connection statement in line 4 accordingly.  
      * $connection \= mysqli\_connect("localhost", "root", "root", "mybooks") or die("Unable to connect to database");  
* This site can’t be reached:   
  * Ensure your server is running

## **Authors**

Lillian Dwyer

## **Version History**

* 0.1  
  * Initial Release

## **License**

MIT License Copyright © 2025 Lillian Dwyer

 Permission is hereby granted, free of charge, to any person obtaining a copy of this software and associated documentation files (the "Software"), to deal in the Software without restriction, including without limitation the rights to use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of the Software, and to permit persons to whom the Software is furnished to do so, subject to the following conditions: The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software. 

THE SOFTWARE IS PROVIDED "AS IS," WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.

## **Acknowledgments**

* README Template: \<script src="[https://gist.github.com/DomPizzie/7a5ff55ffa9081f2de27c315f5018afc.js](https://gist.github.com/DomPizzie/7a5ff55ffa9081f2de27c315f5018afc.js)"\>\</script\>  
* HTML/CSS Template: [SB Admin 2 \- Free Bootstrap Admin Theme \- Start Bootstrap](https://startbootstrap.com/theme/sb-admin-2)  
* Project overseen by Jeffrey Tagen

