<?php

class invoice_manager{
    public $my_customer_id;

    public function __construct($my_customer_id){
        $this->my_customer_id = $my_customer_id;
    }  

    function get_invoice_num($connection, $my_customer_id, $user_id){
        $sql = "SELECT MAX(invoice_num) AS max FROM invoices WHERE customer_id=$my_customer_id AND company_id=$user_id;";
        $query = mysqli_query($connection, $sql);
        $row = mysqli_fetch_assoc($query);
        if(is_null($row["max"])){
            $invoice_num=1;
        }
        else{
            $invoice_num = intval($row["max"]) + 1;
        }
        return $invoice_num;
    }

    function create_invoice($connection, $user_id, $my_customer_id, $due_date, $invoice_num){
        $sql="INSERT INTO Invoices (Company_ID, Customer_ID, Charge_Date, Due_Date, Invoice_Num) VALUES
        ('$user_id', '$my_customer_id', NOW(), '$due_date', '$invoice_num');";
            if(!mysqli_query($connection, $sql)){
                return false;
            }

        $sql = "SELECT invoice_id FROM Invoices WHERE invoice_num=$invoice_num AND customer_id=$my_customer_id AND company_id=$user_id;";
        $query = mysqli_query($connection, $sql);
        $result=mysqli_fetch_assoc($query);
        $invoice_id = $result["invoice_id"];
        return $invoice_id;
    }
    function add_items($connection, $invoice_id, $item_title, $rates, $quantities, $descs){
        foreach ($item_title as $index => $title) {
            $rate = $rates[$index];
            echo $rate;
            if ($rate == null){
                return false;
            }
            $quantity = $quantities[$index];
            echo $quantity;
            if($quantity == null){
                return false;
            }
            $description = $descs[$index];
            echo $description;
            if($description==null){
                return false;
            }
            $title = $title;
            echo $title;
            if($title==null){
                return false;
            }
            $sql = "INSERT INTO Invoice_Items (Invoice_ID, Title, Rate, Quantity, Description) VALUES
                ('$invoice_id', '$title', '$rate', '$quantity', '$description');";
    
            if (!mysqli_query($connection, $sql)) {
                return false;
            }
        }
        return true;
    }
    
}
?>