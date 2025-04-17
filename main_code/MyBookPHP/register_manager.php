<?php
class register_manager{
    public $role;
    public $email;
    public $phone;
    public $pass;
    public $address;
    public $city;
    public $state;
    public $zip;

    public function __construct($role, $email, $phone, $pass, $address, $city, $state, $zip){
        $this->role = $role;
        $this->email = $email;
        $this->phone = $phone;
        $this->pass = password_hash($pass, PASSWORD_DEFAULT);
        $this->address = $address;
        $this->city = $city;
        $this->state = $state;
        $this->zip = $zip;
    }

    function is_new($connection){
        $sql = "SELECT customer_id FROM customers WHERE email='$this->email';";
        $query=(mysqli_query($connection, $sql));
        if(mysqli_num_rows($query)!=0){
            return false;
        }
        else{
            $sql = "SELECT company_id FROM companies WHERE email='$this->email';";
            $query=(mysqli_query($connection, $sql));
            if(mysqli_num_rows($query)!=0){
                return false;
            }
            else{
                return true;
            }
        }
    }

    function generate($connection){
        do{
        $company_code= rand(1000000, 9999999);
        $sql="SELECT company_id FROM companies WHERE company_code='$company_code';";
        $query=(mysqli_query($connection, $sql));
        }while(mysqli_num_rows($query)>0);
        
        return $company_code;
    }


    function insertion($connection, $name1, $name2){
        if(($this->is_new($connection))==false){
            return false;
        }
        if($this->role=="company"){
            $company_code = $this->generate($connection);
            $sql = "INSERT INTO Companies (Company_Name, Company_Code, Street_Address, City, State, Zip, Email, Phone_Num, Password)
            VALUES ('$name1', '$company_code', '$this->address', '$this->city', '$this->state', '$this->zip', '$this->email', '$this->phone', '$this->pass');";
        }
        else{
            $sql = "INSERT INTO Customers (First_Name, Last_Name, Street_Address, City, State, Zip, Email, Phone_Num, Password) 
            VALUES ('$name1', '$name2', '$this->address', '$this->city', '$this->state', '$this->zip', '$this->email', '$this->phone', '$this->pass');";
        }
        
        if(mysqli_query($connection,$sql)){
            return true;
        }
        else{
            return false;
        }
    }
}
?>