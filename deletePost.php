<?php

    session_start();

    require("include/connectMysql.php");
    require("include/post-functions.php");

    $connection = connectdb();

    if(!isset($_SESSION['status']) && !$_SESSION['status'] == "ok"){
        header("Location: index.php");
        exit;
    }


    if(isset($_GET['deleteid']) && $_GET['deleteid'] > 0 ){
        $postDeleteid = $_GET['deleteid'];
    }



    if(isset($_POST['postdeleteid']) && $_POST['postdeleteid'] > 0){
        
        $deletePost = deletePost($connection);    
        
        header("Location: myPosts.php");
    }


?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Labb2</title>
</head>
<body class="Body-Deletepost">
    <div class="deletePostDiv">
        <h1 class="Delete-Post__Title">Ta bort post <?php echo $postDeleteid; ?></h1>
        <h3 class="white">Vill du verkligen ta bort denna post?</h3>
        <form class="Delete__Form" action="deletePost.php" method="post">
            <input type="hidden" name="postdeleteid" value="<?php echo $postDeleteid; ?>">
            <p><input class="Delete__Button" type="submit" value="JA"></p>
        </form>
        <form class="Delete__Form" action="myPosts.php" method="post">
            <input class="Delete__Button" type="submit" value="NEJ">
        </form>
    </div>
<?php
    disconnectdb($connection)
?>
</body>
</html>