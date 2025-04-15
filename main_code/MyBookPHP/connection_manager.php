<?php
class connection_manager{
    public $new_company_id;

    public function __construct($new_company_id){
        $this->new_company_id = $new_company_id;
    }  

    function connect($connection, $new_company_id, $user_id){
        $sql="SELECT relation_id from relationships WHERE company_id='$new_company_id' AND customer_id='$user_id';";
        $query=mysqli_query($connection, $sql);
        if(mysqli_num_rows($query)>0){
            $errormsg = "Connection already established.";
            include("connect.php");
            die();
        }
        else{
            $sql = "INSERT INTO relationships (company_id, customer_id) VALUES ('$new_company_id', '$user_id')";
            if(mysqli_query($connection, $sql)){
                header("Location: cust_dash.php");
                exit();
            }
            else{
                $errormsg = "Could not connect. Please try again Later.";
                include("connect.php");
                die;
            }
        }
    }
}
?>