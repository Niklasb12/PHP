<?php

    session_start();

    require("include/connectMysql.php");
    require("include/post-functions.php");

    $connection = connectdb();

    if(!isset($_SESSION['status']) && !$_SESSION['status'] == "ok"){
        header("Location: index.php");
        exit;
    }


    $favorite = setFavorite($connection, $_GET['favoriteid'], $_SESSION['userId']);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Labb2</title>
</head>
<body>
    <div class="favorite">
        <h1>Favorit är tillagd!</h1>
        <p>Klicka <a href="myFavorite.php">här</a> för att komma till dina favoriter</p>
    </div>
</body>
</html>