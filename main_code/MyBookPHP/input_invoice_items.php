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
$due_date = mysqli_real_escape_string($connection, $_POST["due_date"]);
if(empty($due_date)){
    $errormsg = "Please enter valid due date";
    include("input_invoice.php");
}

?>
<!DOCTYPE html>
<html>
<head>
<title>JavaScript CDN Example</title>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
</head>
<body>
<script>
$(document).ready(function(){
    let count = 1;
    $("#addLine").click(function(){
        count++;
        let row = `
        <tr>
            <td>${count}</td>
            <td><input type="text" name="item_title[]" class="form-control"></td>
            <td><input type="number" step="0.01" name="rate[]" class="form-control"></td>
            <td><input type="number" name="quantity[]" class="form-control"></td>
            <td><input type="text" name="description[]" class="form-control"></td>
            <td><button type="button" class="btn btn-danger removeLine">Remove</button></td>
        </tr>`;
        $("#itemTable tbody").append(row);
        update();
    });


    $(document).on("click", ".removeLine", function(){
        $(this).closest("tr").remove();
        update();
    });

    function update(){
        let lines=0;
        $('#itemTable tbody tr').each(function(){
            lines++;
            $(this).find("td:first").text(lines);
        });
    }   
});
</script>
            <main>
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-10"> 
                            <div class="card mb-4 w-100"> 
                                <div class="card-header">
                                    <i class="fas fa-table me-1"></i>
                                    <h3 class="text-center">Input items on your invoice</h3>
                                </div>
                                <div class="card-body">
                                    <form action="process_invoice.php" method="POST">
                                        <input type="hidden" name="due_date" value="<?php echo $due_date; ?>">
                                        <input type="hidden" name="my_customer_id" value="<?php echo $my_customer_id; ?>">
                                        
                                        <div class="table-responsive">
                                            <table id="itemTable" class="table table-bordered w-100">
                                                <thead class="table-dark">
                                                    <tr>
                                                        <th>#</th>
                                                        <th>Item Title</th>
                                                        <th>Rate</th>
                                                        <th>Quantity</th>
                                                        <th>Description</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr bgcolor='#f2f2f2'>
                                                        <td>1</td>
                                                        <td><input type="text" name="item_title[]" class="form-control"></td>
                                                        <td><input type="number" step="0.01" name="rate[]" class="form-control"></td>
                                                        <td><input type="number" name="quantity[]" class="form-control"></td>
                                                        <td><input type="text" name="description[]" class="form-control"></td>
                                                        <td><button type="button" class="btn btn-danger removeLine">Remove</button></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>

                                        <div class="d-flex justify-content-between mt-3">
                                            <button type="button" id="addLine" class="btn btn-success">Add Line</button>
                                            <button type="submit" id="submit" class="btn btn-primary">Submit Invoice</button>
                                        </div>
                                    </form>
                                </div>
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
            </main>

<?php

include('footer.php');
?>