<?php
session_start();
include("connections.php");

$email = $password = "";
$emailErr = $passwordErr = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(empty($_POST["email"])) {
        $emailErr = " * Email is required!";
    }
    else {
        $email = $_POST["email"];
    }

    if(empty($_POST["password"])) {
        $passwordErr = " * Password is required!";
    }
    else {
        $password = $_POST["password"];
    }

    if($password && $email) {

         // i che check nya kung may nag eexist na katulad na email sa database
         $check_email_query = mysqli_query($connection, "SELECT * FROM mytbl WHERE email='$email'");
         $count_email_rows = mysqli_num_rows($check_email_query);
 
         if($count_email_rows > 0) {

            while($row = mysqli_fetch_assoc($check_email_query)) {

                $db_id = $row["id"];
                $db_password = $row["password"];
                $db_account_type = $row["account_type"];
                
                // pag ang password ay kaparehas ng sa database
                if($password == $db_password) {

                    $_SESSION["id"] = $db_id; // variable para sa ibang page na gagamitan ng session

                    if($db_account_type == "1") {

                        echo "<script>window.location.href='admin/'</script>";
                    }
                    else {
                        echo "<script>window.location.href='user/'</script>";
                    }

                }
                else {
                    $passwordErr = " * Password is incorrect!";
                }
            }

         }
         else {
            $emailErr =  " * Email is not registered!";
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
            <div><label for="">Email: </label><input type="text" name="email" placeholder="email" value="<?php echo $email; ?>"><span class="error-msg"><?php echo $emailErr; ?></span></div>
            <div><label for="">Password: </label><input type="password" name="password" placeholder="password" value="<?php echo $password; ?>"><span class="error-msg"><?php echo $passwordErr; ?></span></div>
            <input type="submit" value="Log in">
        </form>
    </body>
</html>