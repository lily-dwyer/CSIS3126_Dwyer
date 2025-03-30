<?php
include("global.php");

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
            <td><input type='text' name='item_title[]'></td>
            <td><input type='number' step='0.01' name='rate[]'></td>
            <td><input type='number' name='quantity[]'></td>
            <td><input type='text' name='description[]'></td>
            <td><button type='button' class='removeLine'>Remove Line</button></td>
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
    <body class="bg-primary">
        <div id="layoutAuthentication">
            <div id="layoutAuthentication_content">
                <main>
                    <div class="container">
                        <div class="row justify-content-center">
                            <div class="col-lg-7">
                                <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            <h3 align="center">Input items on your invoice</h3>
                            </div>
                        <div class="card-body">
                        <form action="process_invoice.php" method="POST">
                            <input type="hidden" name="due_date" value="<?php echo $due_date; ?>">
                            <input type="hidden" name="my_customer_id" value="<?php echo $my_customer_id; ?>">
                            <table id="itemTable" border='1' width='80%' align='center' cellpadding='10' cellspacing='0'>
                                <thead>
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
                                     <td><input type="text" name="item_title[]"></td>
                                     <td><input type="number" step= "0.01" name="rate[]"></td>
                                     <td><input type="number" name="quantity[]"></td>
                                     <td><input type="text" name="description[]"></td>
                                     <td><button type="button" class="removeLine"> Remove Line</button></td>
                                </tr>
                            </table>
                            <button type="button" id="addLine">Add Line</button>
                            <button type="submit" id="submit">Submit Invoice</button>
                        </form>
                        </div>
                    </div>
                </main>
            </div>
<?php

include('footer.php');
?>