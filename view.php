<?php

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
$sql = "SELECT * FROM pizza WHERE order_id = $id";
$result = mysqli_query($cnxn, $sql);
$row = mysqli_fetch_array($result);
//var_dump($row);

foreach ($result as $row) {
    $id = $row['id'];
    echo "<a href='http://tostrander.greenriver.edu/305/pizza/update.php?id=$id'>View</a>";
}
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>View Order</title>
    <style>
        a.btn {
            text-decoration: none;
            color: black;
            background-color: gainsboro;
            font-family: sans-serif;
            font-size: 13px;
            border: 1px solid darkgray;
            border-radius: .25rem;
            padding: 0.3em 0.4em;
        }
        a.btn:hover {
            background-color: lightgray;
        }
    </style>
</head>
<body>
    <h1>View Order</h1>
    <p id="output"></p>
    <?php
        echo "<p>Order ID: ".$row['order_id']."</p>";
        echo "<p>Name: {$row['fname']} {$row['lname']}</p>";
        $size = $row['size'];
        echo "<p>Size: $size</p>";
        echo "<a class='btn' href='update.php?id=$id'>Mark order complete</a><br>";
        echo "<button id='mark' value='$id'>Mark order complete (Ajax)</button>";
    ?>
    <script src="//code.jquery.com/jquery-3.6.0.js"></script>
    <script>
        $("#mark").on("click", function(){
            let orderid = $("#mark").val();

            $.get('update-ajax.php', {id:orderid}, function(result){
                if (result === 'y') {
                    alert(orderid + " UPDATED");
                }
                //$("#output").html(result);
            });
        });

    </script>
</body>
</html>