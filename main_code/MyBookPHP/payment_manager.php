<?php
class payment_manager{
    public $invoice_id;
    public $amount;

    public function __construct($invoice_id,$amount){
        $this->invoice_id = $invoice_id;
        $this->amount = $amount;
    }  

    function pay($connection, $invoice_id, $amount){
        $sql="INSERT INTO Payments (Invoice_ID, Amount, Date_Paid) VALUES ('$invoice_id', '$amount', NOW());";
        if(mysqli_query($connection, $sql)){
            header("Location: comp_dash.php");
            exit();
        }
        else{
            echo "Could not connect to database";
            include("payment.php");
            die();
        }
    }
}
?>