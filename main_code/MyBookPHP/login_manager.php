<?php
class login_manager{
    public $email;
    public $pass;

    public function __construct($email,$pass){
        $this->email = $email;
        $this->pass = $pass;
    }  

    function login($connection, $email, $pass, &$errormsg){
        $sql="SELECT customer_id, first_name, last_name, email, password FROM customers WHERE email='$email'";   
        $query = mysqli_query($connection, $sql);
        if(mysqli_num_rows($query)>0){
            $row = mysqli_fetch_assoc($query);
            if(password_verify($pass, $row['password'])){
                $_SESSION['customer_id'] = $row['customer_id'];
                $_SESSION['first_name'] = $row['first_name'];
                $_SESSION['last_name'] = $row['last_name'];  
                header("Location: cust_dash.php");
                exit();   
            }
        }

        $sql2="SELECT company_id, email, company_name, company_code, password FROM companies WHERE email='$email'";   
        $query2 = mysqli_query($connection, $sql2);
        if(mysqli_num_rows($query2)>0){
            $row2 = mysqli_fetch_assoc($query2);
            if(password_verify($pass, $row2['password'])){
                $_SESSION['company_id'] = $row2['company_id']; 
                $_SESSION['company_name'] = $row2['company_name'];
                $_SESSION['company_code'] = $row2['company_code'];
                header("Location: comp_dash.php");
                exit();   
            }
        }

        $errormsg = $errormsg . 'Username or password incorrect';
        include("login.php");
        die();
    }
}
?>