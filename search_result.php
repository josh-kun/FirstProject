<?php
include("connections.php");

if(empty($_GET["search_keyword"])) {

    echo "walang laman";
}
else {
    $check = $_GET["search_keyword"];

    $terms = explode(" ", $check);

    $query = "SELECT * FROM mytbl WHERE ";
    $counter = 0;

    foreach($terms as $each) {
        $counter++;

        if($counter == 1) {
            $query .= "name LIKE '%$each%'";
        }
        else {
            $query .= "OR name LIKE '%$each%'";
        }
    }

    $select_query = mysqli_query($connection, $query);
    $count_query = mysqli_num_rows($select_query);

    if($count_query > 0 && $check != "") {

        while($row = mysqli_fetch_assoc($select_query)) {

            echo $name = $row["name"] . "<br>";
        }

    }
    else {

        echo "No results found";
    }
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
    <hr>
    <?php include("nav.php"); ?>
</body>
</html>