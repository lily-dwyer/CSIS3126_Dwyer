<?php
include("global.php");
include("header.php");

if (empty($_SESSION['company_id'])) {
    session_unset(); 
    session_destroy(); 
    header("Location: login.php"); 
    exit();
}  

$my_customer_id = intval($_POST["my_customer_id"]);
if(isset($errormsg)){
    $display = true;
}
else{
    $display = false;
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
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Input New Invoice</h3>
                                    <p style="color:Tomato;" class="text-center">
                                        <?php
                                            if($display==true){
                                                echo $errormsg;
                                            }
                                        ?>
                                    </p>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-md-6">
                                                <div class="form-floating mb-3 mb-md-0">
                                                    <form action="input_invoice_items.php" method="POST">
                                                            <label for="due_date">Due Date</label>
                                                            <input type="hidden" name="my_customer_id" value="<?php echo $my_customer_id; ?>">
                                                            <input type="hidden" name="invoice_num" value="<?php echo $invoice_num; ?>">
                                                            <input class="form-control" name="due_date" id="due_date" type="date">
                                                            <div class="mt-4 mb-0">
                                                                <div class="d-grid"><input type="submit" class="btn btn-primary btn-block" value="Continue"></div>
                                                            </div>
                                                    </form>
                                                    <div class="card-footer text-center py-3">
                                                        <form action = "view_cust.php" method="POST">
                                                        <div class="card-footer text-center py-3">
                                                            <div class="small">
                                                            <a href="view_cust.php?my_customer_id=<?php echo urlencode($my_customer_id); ?>">
                                                                Back
                                                            </a>
                                                            </div>
                                                        </div>
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
<?php
include("footer.php");
?>
