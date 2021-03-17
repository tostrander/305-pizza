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

if ($success) {
    echo "y";
}