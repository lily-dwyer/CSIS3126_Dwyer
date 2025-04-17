<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Register - SB Admin</title>
        <link href="css/styles.css" rel="stylesheet" />
        <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
        <head>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    </head>

<?php 
if ($G_NO_LOGIN==true || !empty($_SESSION['customer_id'])) {
    echo "<body>";
    if($G_NO_LOGIN==true){
        echo "";
    }
    else{
        echo "<nav class='sb-topnav navbar navbar-expand navbar-dark bg-dark'>";
            echo "<!-- Navbar Brand-->";
            echo "<a class='navbar-brand ps-3'>" . $first_name . " " . $last_name . "</a>";
            echo "<!-- Navbar-->";
            echo "<ul class='navbar-nav ms-auto me-5'>"; 
                echo"<li class='nav-item dropdown'>";
                    echo "<a class='small' id='logout' href='logout.php' role='button'>Logout<i class='fas fa-user fa-fw'></i></a>";
                echo"</li>";
            echo "</ul>";
                echo"</li>";
            echo"</ul>";
        echo"</nav>";
    }
}

if ($G_NO_LOGIN==true || !empty($_SESSION['company_id'])) {
    echo "<body>";
    if($G_NO_LOGIN==true){
        echo "";
    }
    else{
        echo "<nav class='sb-topnav navbar navbar-expand navbar-dark bg-dark'>";
            echo "<!-- Navbar Brand-->";
            echo "<a class='navbar-brand ps-3'>" . $company_name . "</a>";
            echo "<!-- Navbar-->";
            echo "<ul class='navbar-nav ms-auto me-5'>"; 
                echo"<li class='nav-item dropdown'>";
                    echo "<a class='small' id='logout' href='logout.php' role='button'>Logout<i class='fas fa-user fa-fw'></i></a>";
                echo"</li>";
            echo "</ul>";
                echo"</li>";
            echo"</ul>";
        echo"</nav>";
    }
}
?>