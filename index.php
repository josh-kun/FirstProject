<?php
include("connections.php"); // isama lahat ng code ng ibang page sa current page

$name = $email = $address = $password = $check_password = ""; // mga variables na hahawak sa mga na-input sa textbox 
$nameErr = $emailErr = $addressErr =   $passwordErr = $check_passwordErr = ""; // mga variables na hahawak ng mga error sa textbox

if($_SERVER["REQUEST_METHOD"] == "POST") {

    // cleans the data
    function testInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    if(empty($_POST["name"])) {
        $nameErr = " * Name is required!";
    } else {
        $name = testInput($_POST["name"]);
    }

    if(empty($_POST["email"])) {
        $emailErr = " * Email is required!";
    } else {
        $email = testInput($_POST["email"]);
    }

    if(empty($_POST["address"])) {
        $addressErr = " * Address is required!";
    } else {
        $address = testInput($_POST["address"]);
    }

    if(empty($_POST["password"])) {
        $passwordErr = " * Password is required!";
    } else {
        $password = testInput($_POST["password"]);
    }

    if(empty($_POST["check_password"])) {
        $check_passwordErr = " * Type your password again!";
    } else {
        $check_password = testInput($_POST["check_password"]);
    }

    // if all values are not empty
    if($name && $email && $address && $password && $check_password) {


        // i che check nya kung may nag eexist na katulad na email sa database
        $check_email_query = mysqli_query($connection, "SELECT * FROM mytbl WHERE email='$email'");
        $count_email_rows = mysqli_num_rows($check_email_query);

        if($count_email_rows > 0) {
            $emailErr = " * Email is already registered!";
        }
        else {
            // handles the query to be sent to the database
            $insert_query = mysqli_query($connection, "INSERT INTO mytbl(id, name, address, email, password, account_type) VALUES('', '$name', '$address', '$email', '$check_password', '2')");

            if($insert_query) {
                echo "<script type='text/javascript'>alert('New Record has been inserted');</script>";
                echo "<script type='text/javascript'>window.location.href='index.php'</script>";
            }
            else {
                echo "something went wrong";
            }

        }
       
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>FirstProject</title>
    <style>
    .error-msg {
        font-style: italic;
        color: red;
    }
    </style>
</head>
<body>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div><label for="">Name: </label><input type="text" name="name" placeholder="name" value="<?php echo $name; ?>"><span class="error-msg"><?php echo $nameErr; ?></span></div>
        <div><label for="">Address: </label><input type="text" name="address" placeholder="address" value="<?php echo $address; ?>"><span class="error-msg"><?php echo $addressErr; ?></span></div>
        <div><label for="">Email: </label><input type="text" name="email" placeholder="email" value="<?php echo $email; ?>"><span class="error-msg"><?php echo $emailErr; ?></span></div>
        <div><label for="">Password: </label><input type="password" name="password" placeholder="password" value="<?php echo $password; ?>"><span class="error-msg"><?php echo $passwordErr; ?></span></div>
        <div><label for="">Confirm Password: </label><input type="password" name="check_password" placeholder="confirm password" value="<?php echo $check_password; ?>"><span class="error-msg"><?php echo $check_passwordErr; ?></span></div>
        <input type="submit" value="submit">
    </form>
    <hr>
<?php
include("nav.php");
?>
    <hr>
<?php
// to view data from the database
$view_query = mysqli_query($connection, "SELECT * FROM mytbl");

    echo "<table border='1'>
        <tr>
        <th>Name</th>
        <th>Email</th>
        <th>Address</th>
        <th>Options</th>
        </tr>";

    while($row = mysqli_fetch_assoc($view_query)){

        $db_id = $row['id'];

        $db_name = $row['name'];
        $db_email = $row['email'];
        $db_address = $row['address'];

        echo "<tr>
        <td>$db_name</td>
        <td>$db_email</td>
        <td>$db_address</td>
        <td>
        <a href='edit.php?current_id=$db_id'><button>Edit</button></a>
        <a href='delete.php?current_id=$db_id'><button>Delete</button></a>
        </td>
        </tr>";
    }

    echo "</table>";
?>

<hr>
<?php

// foreach example
$name1 = "Joshua Mercado";
$name2 = "Richard Dayrit";
$name3 = "Aljon Valen";
$name4 = "Ronnel Garino";
$name5 = "Aeroll Tiosen";

$name_list = array($name1, $name2, $name3, $name4, $name5); // create an array

echo "<ul style='padding: 0; margin: 0;'>";

foreach($name_list as $display_names) {

    echo "<li style='border-bottom: solid thin; list-style: none;'>$display_names</li>";

}

echo "</ul>";
?>
</body>
</html>