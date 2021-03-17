<?php
// 305/pizza/update.php

//Turn on error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

if (!isset($_GET['id'])) {
    header("location: index.php");
}
//var_dump($_GET);
$id = $_GET['id'];
//echo "Order ID: $id";

// Connect to DB
require ($_SERVER['HOME'].'/connect.php');
$cnxn = connect();

// Prevent SQL injection
$id = mysqli_real_escape_string($cnxn, $id);

// Query the database
$sql = "UPDATE pizza SET order_filled = 'y' WHERE order_id = $id";
$success = mysqli_query($cnxn, $sql);

if (!$success) {
    die ("Database error. Please contact...");
}
//var_dump($row);
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Order</title>
</head>
<body>
    <h1>Order Updated!</h1>
</body>
</html>