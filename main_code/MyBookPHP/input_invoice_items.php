<?php
include("global.php");
include("header.php");

$my_customer_id = mysqli_real_escape_string($connection, $_POST["my_customer_id"]);
$due_date = mysqli_real_escape_string($connection, $_POST["due_date"]);
$invoice_num = mysqli_real_escape_string($connection, $_POST['invoice_num']);

$sql = "SELECT invoice_id FROM invoices WHERE invoice_num='$invoice_num';";
$query=mysqli_query($connection, $sql);
if(mysqli_num_rows($query)==0){
    $sql="INSERT INTO Invoices (Company_ID, Customer_ID, Charge_Date, Due_Date, Invoice_Num) VALUES
    ('$user_id', '$my_customer_id', NOW(), '$due_date', '$invoice_num');";
    if(mysqli_query($connection, $sql)){
        echo "";
    }
    else{
        echo "Could not connect to database";
        header("input_invoice.php");
        exit();
    }
}

?>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Invoice #<?php echo $invoice_num ?></h3>
                                    <div class="card-body">
                                        <form action="process_invoice.php" method="POST">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <input type="hidden" name="my_customer_id" value="<?php echo $my_customer_id; ?>">
                                                        <input class="form-control" id="item_title" type="text" name="item_title" value="<?php echo $edit_title; ?>"/>
                                                        <label for="item_title">Item Title</label>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-floating">
                                                        <input type="hidden" name="due_date" value="<?php echo $due_date; ?>">
                                                        <input class="form-control" id="rate" type="text" name="rate" value="<?php echo $edit_rate; ?>"/>
                                                        <label for="rate">Rate</label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-floating mb-3">
                                                <input type="hidden" name="invoice_num" value="<?php echo $invoice_num;?>">
                                                <input class="form-control" id="quantity" type="text" name="quantity" value="<?php echo $edit_quantity; ?>" />
                                                <label for="quantity">Quantity</label>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <input class="form-control" id="description" type="text" name="description" value="<?php echo $edit_description; ?>"/>
                                                    <label for="description">Item Description</label>
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid">
                                                    <input type="submit" class="btn btn-primary btn-block" name="add" value="Add">
                                                </div>
                                            </div>
                                            <div class="mt-4 mb-0">
                                                <div class="d-grid">
                                                    <input type="submit" class="btn btn-primary btn-block" name="add_and_preview" value="Add and Preview">
                                                </div>
                                            </div>

                                        </form>
                                    </div>
                                    <div class="card-footer text-center py-3">
                                        
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
<?php

include('footer.php');
?>