<?php
$search = $searchErr = "";

if($_SERVER["REQUEST_METHOD"] == "POST") {

    if(empty($_POST["search"])) {

        $searchErr = "Required";
    }
    else {
        $search = $_POST["search"];
    }

    if($search) {

        echo "<script>window.location.href='search_result.php?search_keyword=$search';</script>";
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
    <form method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="text" placeholder="keyword" name="search" value="<?php echo $search; ?>">
        <span><?php echo $searchErr; ?></span>
        <input type="submit" value="search">
    </form>
</body>
</html>