<?php
include("connections.php"); // isama lahat ng code ng ibang page sa current page

$name = $email = $address = ""; // mga variables na hahawak sa mga na-input sa textbox 
$nameErr = $emailErr = $addressErr = ""; // mga variables na hahawak ng mga error sa textbox

if($_SERVER["REQUEST_METHOD"] == "POST") {

    // cleans the data
    function testInput($data) {
        $data = trim($data);
        $data = stripslashes($data);
        $data = htmlspecialchars($data);

        return $data;
    }

    if(empty($_POST["name"])) {
        $nameErr = "Name is required!";
    } else {
        $name = testInput($_POST["name"]);
    }

    if(empty($_POST["email"])) {
        $emailErr = "Email is required!";
    } else {
        $email = testInput($_POST["email"]);
    }

    if(empty($_POST["address"])) {
        $addressErr = "Address is required!";
    } else {
        $address = testInput($_POST["address"]);
    }

    // if all values are not empty
    if($name && $email && $address) {

        // handles the query to be sent to the database
        $insert_query = mysqli_query($connection, "INSERT INTO mytbl(id, name, address, email) VALUES('', '$name', '$address', '$email')");

        if($insert_query) {
            echo "<script type='text/javascript'>alert('New Record has been inserted');</script>";
            echo "<script type='text/javascript'>window.location.href='index.php'</script>";
        }else {
            echo "something went wrong";
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
</head>
<body>
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
        <div><input type="text" name="name" placeholder="name" value="<?php echo $name; ?>"><span><?php echo $nameErr; ?></span></div>
        <div><input type="text" name="address" placeholder="address" value="<?php echo $address; ?>"><span><?php echo $addressErr; ?></span></div>
        <div><input type="text" name="email" placeholder="email" value="<?php echo $email; ?>"><span><?php echo $emailErr; ?></span></div>
        <input type="submit" value="submit">
    </form>
    <hr>
    <a href="index.php"><button>Home</button></a>
    <a href="search.php"><button>Search</button></a>
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