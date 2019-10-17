<?php
session_start();
include("../connections.php");

if(@$_SESSION["id"]) {
    $user_id = $_SESSION["id"]; // session variable from the login script

    $get_record = mysqli_query($connection, "SELECT * FROM mytbl WHERE id='$user_id'");
    while($row = mysqli_fetch_assoc($get_record)) {

        $db_name = $row["name"];
    }

    echo "Welcome $db_name !<a href='../logout.php'>Logout</a>"; 
}
else {
    echo "You must login first <a href='../login.php'>Log in</a>";
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    
</body>
</html>