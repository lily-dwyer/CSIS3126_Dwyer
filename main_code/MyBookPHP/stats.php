<?php
include('global.php');
include('header.php');

$year = 0;

if (!empty($_GET['new_year'])) {
    $year = intval($_GET['new_year']);
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
    $("#new_year").change(function(){
        let new_year = $(this).val();
        window.location.href = 'stats.php?new_year=' + new_year;
    });
});
</script>
        
            <div id="layoutSidenav_content">
                <main>
                    <div class="container-fluid px-4">
                        <h1 class="mt-4">Stats</h1>
                        <ol class="breadcrumb mb-4">
                            <li class="breadcrumb-item"><a href="comp_dash.php">Dashboard</a></li>
                            <li class="breadcrumb-item active">Stats</li>
                        </ol>
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Unpaid Stats
                            </div>
                            <div class="card-body">
                            <?php
                            $sql = "SELECT 
                                customers.last_name, 
                                customers.first_name, 
                                ROUND(COALESCE(SUM(invoice_totals.invoice_total), 0),2) AS gross_balance,
                                ROUND(COALESCE(SUM(invoice_totals.invoice_total), 0) - COALESCE(SUM(payment_totals.total_paid), 0),2) AS total_owed,
                                COUNT(CASE 
                                    WHEN payments.date_paid > invoices.due_date THEN 1 
                                    ELSE NULL 
                                END) AS late_payments
                            FROM customers
                            INNER JOIN invoices ON invoices.customer_id = customers.customer_id
                            INNER JOIN companies ON companies.company_id = invoices.company_id
                            LEFT JOIN (
                                SELECT invoice_id, SUM(rate * quantity) AS invoice_total
                                FROM invoice_items
                                GROUP BY invoice_id
                            ) AS invoice_totals ON invoice_totals.invoice_id = invoices.invoice_id
                            LEFT JOIN (
                                SELECT invoice_id, SUM(amount) AS total_paid
                                FROM payments
                                GROUP BY invoice_id
                            ) AS payment_totals ON payment_totals.invoice_id = invoices.invoice_id
                            LEFT JOIN payments ON payments.invoice_id = invoices.invoice_id
                            WHERE companies.company_id = '$user_id'";
                            if($year != 0){
                                $sql .= " AND invoices.charge_date BETWEEN '$year-01-01' AND '$year-12-31'";
                            }                            
                            $sql .= "GROUP BY customers.customer_id, customers.first_name, customers.last_name;";
                                $query = mysqli_query($connection, $sql);
                                echo "<table border='1' width='80%' align='center' cellpadding='10'
                                cellspacing='0'>";
                                echo "<thead bgcolor='#007BFF' style='color: white; font weight: bold;'>";
                                    echo"<tr>";
                                        echo"<th>First Name</th>";
                                        echo"<th>Last Name</th>";
                                        echo"<th>Total Charged</th>";
                                        echo"<th>Total Owed</th>";
                                        echo"<th>Percent Unpaid</th>";
                                        echo"<th>Number of Late Payments</th>";
                                    echo"</tr>";
                                    echo"</thead>";
                                    echo"<tbody>";
                                if(mysqli_num_rows($query) > 0){
                                    while($row = mysqli_fetch_assoc($query)){
                                        echo"<tr bgcolor='#f2f2f2'>";
                                        echo "<td>" . $row['first_name'] . "</td>";
                                        echo "<td>" . $row['last_name'] . "</td>";
                                        $gross_balance = $row['gross_balance'];
                                        $total_owed = $row['total_owed'];
                                        echo "<td>" . $gross_balance . "</td>";
                                        echo "<td>" . $total_owed . "</td>";
                                        $percent_unpaid = ROUND(($total_owed/$gross_balance) * 100,2);
                                        echo "<td>" . $percent_unpaid . "</td>";
                                        echo "<td>" . $row['late_payments'] . "</td>";
                                        echo"</tr>";
                                    }

                                }
                                else{
                                    echo "<tr><td colspan='4'>No Stats Available</td></tr>";
                                }
                                echo"</table>";
                                ?>
                            </div>
                        </div>
                    <div class="card mb-4">
                        <div class="card-header">
                            <i class="fas fa-table me-1"></i>
                            Paid Stats
                            </div>
                        <div class="card-body">
                            <?php
                            $sql = "SELECT COALESCE(SUM(invoice_items.rate * invoice_items.quantity), 0) as company_total FROM invoice_items 
                            INNER JOIN invoices on invoices.invoice_id=invoice_items.invoice_id 
                            WHERE invoices.company_id='$user_id'";
                            if($year != 0){
                                $sql .= "AND invoices.charge_date BETWEEN '$year-01-01' AND '$year-12-31' ";
                            }
                            
                            $sql .= "GROUP BY invoices.company_id;";
                            $query = mysqli_query($connection, $sql);
                            $row = mysqli_fetch_assoc($query);
                            $company_total = $row ? $row['company_total'] : 0;

                            $sql = "SELECT 
                                customers.first_name, 
                                customers.last_name,
                                COALESCE(SUM(payment_totals.total_paid), 0) AS amount_paid,
                                COALESCE(SUM(invoice_totals.invoice_total), 0) AS customer_total
                            FROM customers
                            INNER JOIN invoices ON invoices.customer_id = customers.customer_id
                            INNER JOIN companies ON companies.company_id = invoices.company_id
                            LEFT JOIN (
                                SELECT invoice_id, SUM(amount) AS total_paid
                                FROM payments
                                GROUP BY invoice_id
                            ) AS payment_totals ON payment_totals.invoice_id = invoices.invoice_id
                            LEFT JOIN (
                                SELECT invoice_id, SUM(rate * quantity) AS invoice_total
                                FROM invoice_items
                                GROUP BY invoice_id
                            ) AS invoice_totals ON invoice_totals.invoice_id = invoices.invoice_id
                            WHERE companies.company_id = '$user_id'";
                            if($year != 0){
                                $sql .= "AND invoices.charge_date BETWEEN '$year-01-01' AND '$year-12-31' ";
                            }
                    
                            $sql .= "GROUP BY customers.customer_id, customers.first_name, customers.last_name;";
                                $query = mysqli_query($connection, $sql);
                            echo "<table border='1' width='80%' align='center' cellpadding='10'
                            cellspacing='0'>";
                            echo "<thead bgcolor='#007BFF' style='color: white; font weight: bold;'>";
                                echo"<tr>";
                                    echo"<th>First Name</th>";
                                    echo"<th>Last Name</th>";
                                    echo"<th>Total Paid</th>";
                                    echo"<th>Percent Towards Total Profits</th>";
                                echo"</tr>";
                                echo"</thead>";
                                echo"<tbody>";
                                if(mysqli_num_rows($query) > 0){
                                    while($row = mysqli_fetch_assoc($query)){
                                        echo"<tr bgcolor='#f2f2f2'>";
                                        echo "<td>" . $row['first_name'] . "</td>";
                                        echo "<td>" . $row['last_name'] . "</td>";
                                        echo "<td>" . $row['amount_paid'] . "</td>";
                                        $customer_total = $row['customer_total'];
                                        $percent = ROUND(($customer_total/$company_total) * 100,2);
                                        echo "<td>" . $percent . "</td>";
                                        echo"</tr>";
                                    }

                                }
                                else{
                                    echo "<tr><td colspan='4'>No Stats Available</td></tr>";
                                }
                                echo"</table>";
                                ?>
                        </div>
                
                               
                        <div class="card mb-4">
                            <div class="card-header">
                                <i class="fas fa-table me-1"></i>
                                Filter by Year
                            </div>
                            <div>
                                <!-- Can I make the selection that is running show up first? -->
                                <select name="new_year" id="new_year">
                                    <?php
                                        $sql = "SELECT DISTINCT YEAR(charge_date) AS new_year FROM invoices;";
                                        $query = mysqli_query($connection, $sql);
                                        if (!$query) {
                                            die("Query failed: " . mysqli_error($connection));
                                        }
                                        if ($year==0){
                                            echo "<option value=0>All Time</option>";
                                        }
                                        while ($row = mysqli_fetch_assoc($query)) {
                                            $new_year = $row['new_year'];
                                            echo "<option value='$new_year'>$new_year</option>";
                                        }
                                        if($year!=0){
                                            echo "<option value=0>All Time</option>";
                                        }
                                    ?>
                                </select>
                            </div>
                        </div>
            
                </main>
<?php
include("footer.php");
?>
