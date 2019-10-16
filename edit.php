<?php
include("connections.php");


// get all the data from specified user id
@$user_id = $_REQUEST['current_id'];

$get_record_query = mysqli_query($connection, "SELECT * FROM mytbl WHERE id = '$user_id'");

while($row_edit = mysqli_fetch_assoc($get_record_query)){

    $db_name = $row_edit["name"];
    $db_email = $row_edit["email"];
    $db_address = $row_edit["address"];

}

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $specified_user_id = $_POST["user_id"];

    $new_name = $_POST["new_name"];
    $new_email = $_POST["new_email"];
    $new_address = $_POST["new_address"];

    $sql = "UPDATE mytbl SET name='$new_name',
    address='$new_address',
    email='$new_email' 
    WHERE id='$specified_user_id'";

    mysqli_query($connection, $sql);

    echo "<script type='text/javascript'>alert('Record has been updated!');</script>";
    echo "<script type='text/javascript'>window.location.href='index.php';</script>";
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
    <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
    <div><input type="hidden" name="user_id" value="<?php echo $user_id; ?>"></div>
    <div><input type="text" placeholder="new name" name="new_name" value="<?php echo $db_name; ?>"></div>
    <div><input type="text" placeholder="new email" name="new_email" value="<?php echo $db_email; ?>"></div>
    <div><input type="text" placeholder="new address" name="new_address" value="<?php echo $db_address; ?>"></div>
    <div><input type="submit" value="Update"></div>
    </form>
</body>
</html>