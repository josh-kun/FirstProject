<?php
include("connections.php");

// get all the data from specified user id
@$user_id = $_REQUEST['current_id'];


$sql = "SELECT * FROM mytbl WHERE id='$user_id'";
$delete_query = mysqli_query($connection, $sql);

while($row_delete = mysqli_fetch_assoc($delete_query)) {

    $db_id = $row_delete["id"];
    $db_name = $row_delete["name"];
    $db_email = $row_delete["email"];
    $db_address = $row_delete["address"];

}

if($_SERVER["REQUEST_METHOD"] == "POST") {

    $users_id = $_POST["users_id"];

    $delete_sql = "DELETE FROM mytbl WHERE id = '$users_id'";
    mysqli_query($connection, $delete_sql);

    echo "<script type='text/javascript'>alert('Record has been deleted!');</script>";
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
    <style>

    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
    }

    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
    }

    div {
        border: solid thin;
        text-align: center;
        padding: 2em;
        position: relative;
    }

    a {
        position: absolute;
        right: 0;
        top: 0;
    }
    </style>
</head>
<body>
    <div>
    <a href="index.php"><button>X</button></a>
<?php
    echo "Are you sure to delete info of $db_name ?";
?>
        <hr>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">
            <input type="hidden" name="users_id" value="<?php echo $db_id; ?>">
            <input type="submit" value="Yes">
        </form>
    </div>
</body>
</html>