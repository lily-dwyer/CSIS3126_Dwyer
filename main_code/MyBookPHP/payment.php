<?php
include("global.php");
include("header.php");

if (empty($_SESSION['company_id'])) {
    session_unset(); 
    session_destroy(); 
    header("Location: login.php"); 
    exit();
}  

$invoice_id = intval($_GET["invoice_id"]);

$sql="SELECT SUM(invoice_items.quantity*invoice_items.rate) - COALESCE(SUM(payments.amount),0) as balance FROM invoice_items
    LEFT JOIN payments on payments.invoice_id=invoice_items.invoice_id WHERE invoice_items.invoice_id=$invoice_id
    GROUP BY invoice_items.invoice_id;";
$query=mysqli_query($connection, $sql);
$row=mysqli_fetch_assoc($query);
$balance=$row['balance'];

?>
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card shadow-lg border-0 rounded-lg mt-5">
                                    <div class="card-header"><h3 class="text-center font-weight-light my-4">Input Payment for Invoice# <?php echo $invoice_id; ?></h3>
                                    <div class="card-body">
                                            <div class="row mb-3">
                                                <div class="col-md-6">
                                                    <div class="form-floating mb-3 mb-md-0">
                                                        <form action="process_payment.php" method="POST">
                                                            <input type="hidden" value=<?php echo $invoice_id; ?> name="invoice_id">
                                                            <label for="amount">Amount</label>
                                                            <input class="form-control" name="amount" id="amount" type="number" min=1 max=<?php echo $balance; ?>>
                                                            <div class="mt-4 mb-0">
                                                                <div class="d-grid"><input type="submit" class="btn btn-primary btn-block" value="Process Payment"></div>
                                                            </div>
                                                        </form>
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
