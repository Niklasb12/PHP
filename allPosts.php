<?php

    session_start();

    require("include/connectMysql.php");
    require("include/post-functions.php");

    $connection = connectdb();

    if(!isset($_SESSION['status']) && !$_SESSION['status'] == "ok"){
        header("Location: index.php");
        exit;
    }


    $orderBy = "postDate";
    $order = "desc";


    if(!empty($_GET["orderby"])) {
        $orderBy = $_GET["orderby"];
    }
    if(!empty($_GET["order"])) {
        $order = $_GET["order"];
    }

    $allPosts = allPosts($connection, $orderBy ,$order, $_SESSION['userId']);


    $postDate = "desc";
    $postTitle = "desc";
    $userName = "asc";
    $userDate = "desc";

    if($orderBy == "postDate" and $order == "desc") {
        $postDate = "asc";
    }
    if($orderBy == "postTitle" and $order == "desc") {
        $postTitle = "asc";
    }
    if($orderBy == "userName" and $order == "asc") {
        $userName = "desc";
    }
    if($orderBy == "userDate" and $order == "desc") {
        $userDate = "asc";
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <script src="https://kit.fontawesome.com/bd7880edd1.js"></script>
    <title>Labb2</title>
</head>
<body>

    <div class="Background__Allposts">
        <div class="allPosts__Main">
            <div class="Buttons__Upper">
                <div class="formButtons">
                    <a href="topFive.php" class="none">Spel top 5</a>
                    <a href="myFavorite.php" class="none">Mina Favoriter</a>
                    <a href="createPost.php" class="none">Skapa ett inlägg</a>
                    <a href="myPosts.php" class="none">Mina inlägg</a>
                </div>
                <form class="formButtons" action="logout.php" method="post">
                    <input class="none" type="submit" value="Logga ut">
                </form>
            </div>
            <h1 class="white">Alla inlägg</h1>
            <div class="sort">
                <a class="sortBy" href="?orderby=postDate&order=<?php echo $postDate; ?>">sortera efter inläggs datum <i class="fas fa-sort"></i></a>
                <a class="sortBy" href="?orderby=postTitle&order=<?php echo $postTitle; ?>">sortera efter titel <i class="fas fa-sort"></i></a>
                <a class="sortBy" href="?orderby=userName&order=<?php echo $userName; ?>">sortera efter användarnamn <i class="fas fa-sort"></i></a>
                <a class="sortBy" href="?orderby=userDate&order=<?php echo $userDate; ?>">sortera efter medlems datum <i class="fas fa-sort"></i></a>
            </div>
            <?php while($row = mysqli_fetch_array($allPosts)) { 
                ?>
            <div class="Allposts__Container">
                <div class="Container__Left">
                    <p class="Allposts__Info">Medlem sedan : <?php echo $row['userDate']; ?></p>
                    <p class="Allposts__Info">Skriven av : <?php echo $row['userName']; ?></p>
                    <p class="Allposts__Info">Inlägget skrivet : <?php echo $row['postDate']; ?></p>
                    <a class="Allposts__Info" class href="favorite.php?favoriteid=<?php echo $row['postId'];?>">Lägg till som favorit <i class="fas fa-heart"></i></a>
                </div>
                <div class="Container__Right">
                    <h1 class="Allposts__Title"><?php echo $row['postTitle']; ?></h1>
                    <p class="Allposts__Content"><?php echo $row['postContent']; ?></p>
                </div>
            </div>
            <?php } ?>
        </div>
    </div>
<?php
    disconnectdb($connection)
?>
</body>
</html>