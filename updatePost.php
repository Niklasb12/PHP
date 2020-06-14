<?php

    session_start();

    require("include/connectMysql.php");
    require("include/post-functions.php");

    $connection = connectdb();

    if(!isset($_SESSION['status']) && !$_SESSION['status'] == "ok"){
        header("Location: index.php");
        exit;
    }


    if(isset($_GET['editid']) && $_GET['editid'] > 0 ){
        $getPostData = getPostData($connection, $_GET['editid']);
    }


    if(isset($_POST['updateid']) && $_POST['updateid'] > 0){
        
        $updatePost = updatePost($connection);

        header("Location: myPosts.php");
    }

?>



<!DOCTYPE HTML>
<html lang="sv">
<head>
    <meta charset="utf-8" />
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Labb2</title>
</head>

<body class="Body-Createpost">
    <div class="createButtons">
        <div class="formButtons">
            <a href="allPosts.php" class="noneWhite">Alla inlägg</a>
            <a href="myFavorite.php" class="noneWhite">Mina Favoriter</a>
            <a href="myPosts.php" class="noneWhite">Mina inlägg</a>
        </div>
        <form class="formButtons" action="logout.php" method="post">
            <input class="noneWhite" type="submit" value="Logga ut">
        </form>
    </div>
    <div class="mainCreate">
        <h1 class="createHeading">Lägg till en ny post</h1>
        <form class="form" action="updatePost.php" method="post">
            <input type="hidden" name="updateid" value="<?php echo $getPostData['postId']; ?>">
            <p><input class="inputTitle" type="text" name="txtTitle" placeholder="Title" value="<?php echo $getPostData['postTitle'];?>"></p>
            <p><textarea class="inputContent" type="text" name="txtContent"><?php echo $getPostData['postContent'];?></textarea></p>
            <p><input class="button" type="submit" value="Uppdatera"></p>
        </form>
    </div>
<?php
    disconnectdb($connection)
?>
</body>
</html>