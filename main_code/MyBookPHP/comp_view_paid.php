<?php
include('global.php');
include('header.php');

if (empty($_SESSION['company_id'])) {
    session_unset(); 
    session_destroy(); 
    header("Location: login.php"); 
    exit();
}  

$my_customer_id = intval($_POST["my_customer_id"]);

$sql = "SELECT first_name, last_name FROM Customers WHERE customer_id='$my_customer_id';";
$query = mysqli_query($connection, $sql);
$row = mysqli_fetch_assoc($query);
$first_name = $row['first_name'];
$last_name = $row['last_name'];
?>
<main>
<div class="container-fluid px-4">
<h1 class="mt-4">Paid Invoices</h1>
    <ol class="breadcrumb mb-4">
        <li class="breadcrumb-item active"><a href="comp_dash.php">Dashboard</a></li>
        <li class="breadcrumb-item active">
            <a href="view_cust.php?my_customer_id=<?php echo urlencode($my_customer_id); ?>">
                <?php echo htmlspecialchars($first_name . ' ' . $last_name); ?>
            </a>
        </li>
        <li class="breadcrumb-item active">Paid Invoices</li>
    </ol>
    <div class="card mb-4">
        <div class="card-body">
                        <?php
                        $sql = "SELECT i.invoice_num, i.invoice_id, i.charge_date, 
                            ROUND(SUM(ii.rate * ii.quantity), 2) AS total_cost,
                            COALESCE(p.total_paid, 0) AS total_paid, p.latest_date_paid
                            FROM invoices i
                            INNER JOIN invoice_items ii ON i.invoice_id = ii.invoice_id
                            LEFT JOIN (
                                SELECT 
                                    invoice_id, 
                                    SUM(amount) AS total_paid, 
                                    MAX(date_paid) AS latest_date_paid
                                FROM payments
                            GROUP BY invoice_id) 
                            p ON i.invoice_id = p.invoice_id
                            WHERE i.customer_id = $my_customer_id AND i.company_id = $user_id
                            GROUP BY i.invoice_id, total_paid, p.latest_date_paid
                            HAVING total_cost = total_paid;";
            
                                $query = mysqli_query($connection, $sql);
                                echo "<table border='1' width='80%' align='center' cellpadding='10'
                                cellspacing='0'>";
                                echo "<thead bgcolor='#007BFF' style='color: white; font weight: bold;'>";
                                    echo"<tr>";
                                        echo"<th>Invoice Number</th>";
                                        echo"<th>Date Charged</th>";
                                        echo"<th>Total Cost</th>";
                                        echo"<th>Latest Date Paid</th>";
                                    echo"</tr>";
                                    echo"</thead>";
                                    echo"<tbody>";
                                if(mysqli_num_rows($query) > 0){
                                    while($row = mysqli_fetch_assoc($query)){
                                        echo"<tr bgcolor='#f2f2f2'>";
                                        echo "<td>" . $row['invoice_num'] . "</td>";
                                        echo "<td>" . $row['charge_date'] . "</td>";
                                        echo "<td>" . $row['total_cost'] . "</td>";
                                        echo "<td>" . $row['latest_date_paid'] . "</td>";
                                        echo "<td><a href='comp_view_invoice_items.php?invoice_id=" . urlencode($row['invoice_id']) . "'>View Items</a></td>";
                                        echo"</tr>";
                                    }
                                }
                                else{
                                    echo "<tr><td colspan='4'>No Paid Invoices</td></tr>";
                                }
                                echo"</table>";
                            ?>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>

<?php
include("footer.php");
?>

                           