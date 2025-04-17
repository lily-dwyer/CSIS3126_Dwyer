<?php
class payment_manager{
    public $invoice_id;
    public $amount;

    public function __construct($invoice_id,$amount){
        $this->invoice_id = $invoice_id;
        $this->amount = $amount;
    }  

    function pay($connection){
        $sql="INSERT INTO Payments (Invoice_ID, Amount, Date_Paid) VALUES ('$this->invoice_id', '$this->amount', NOW());";
        if(mysqli_query($connection, $sql)){
            return true;
        }
        else{
            return false;
        }
    }
}
?>