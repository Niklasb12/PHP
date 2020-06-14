<?php

    session_start();

    require("include/connectMysql.php");
    require("include/post-functions.php");

    $connection = connectdb();

    if(!isset($_SESSION['status']) && !$_SESSION['status'] == "ok"){
        header("Location: index.php");
        exit;
    }
    $userDate = $_SESSION['userDate'];
    $user = $_SESSION['userName'];

    $getFavorite = getFavorite($connection,$_SESSION['userId']);

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
    <div class="Background__Allposts">
        <div class="allPosts__Main">
            <div class="Buttons__Upper">
                <div class="formButtons">
                    <a href="allPosts.php" class="none">Alla inlägg</a>
                    <a href="createPost.php" class="none">Skapa ett inlägg</a>
                    <a href="myPosts.php" class="none">Mina inlägg</a>
                </div>
                <form class="formButtons" action="logout.php" method="post">
                    <input class="none" type="submit" value="Logga ut">
                </form>
            </div>
                <h1 class="white">Mina favoriter</h1>
                <?php if($getFavorite->num_rows > 0) {?>
                <?php while($row = mysqli_fetch_array($getFavorite)) { ?>
                <div class="Allposts__Container">
                    <div class="Container__Left">
                        <p class="Allposts__Info">Medlem sedan : <?php echo $userDate; ?></p>
                        <p class="Allposts__Info">Skriven av : <?php echo $row['authorName']; ?></p>
                        <p class="Allposts__Info">Inlägget skrivet : <?php echo $row['postDate']; ?></p>
                        <div class="buttons">
                            <a class="link" href="deleteFavoritePost.php?deleteid=<?php echo $row['postId'];?>">Ta bort</a>
                        </div>
                    </div>
                    <div class="Container__Right">
                        <h1 class="Allposts__Title"><?php echo $row['postTitle']; ?></h1>
                        <p class="Allposts__Content"><?php echo $row['postContent']; ?></p>
                    </div>
                </div>
                <?php } 
                } else { ?>
                <h1 class="noFavorite">Inga Favoriter</h1>
           <?php } ?>
        </div>
    </div>
<?php
    disconnectdb($connection)
?>
</body>
</html>