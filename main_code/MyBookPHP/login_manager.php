<?php
class login_manager{
    public $email;
    public $pass;

    public function __construct($email,$pass){
        $this->email = $email;
        $this->pass = $pass;
    }  

    function login($connection){
        $sql="SELECT customer_id, first_name, last_name, email, password FROM customers WHERE email='$this->email'";   
        $query = mysqli_query($connection, $sql);
        if(mysqli_num_rows($query)>0){
            $row = mysqli_fetch_assoc($query);
            if(password_verify($this->pass, $row['password'])){
                return ['Customer', $row['customer_id'], $row['first_name'], $row['last_name']]; 
            }
        }
        $sql2="SELECT company_id, email, company_name, company_code, password FROM companies WHERE email='$this->email'";   
        $query2 = mysqli_query($connection, $sql2);
        if(mysqli_num_rows($query2)>0){
            $row2 = mysqli_fetch_assoc($query2);
            if(password_verify($this->pass, $row2['password'])){
                return ["Company",$row2['company_id'], $row2['company_name'], $row2['company_code']]; 
            }
        } 
        return false;
        
    }

}
?>