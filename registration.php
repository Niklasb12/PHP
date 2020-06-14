<?php 
    
    require("include/connectMysql.php");
    require("include/loginRegFunctions.php");

    $connection = connectdb();

    if(isset($_POST['issubmit']) && $_POST['issubmit'] == 1){

        $regUser = regUser($connection);

        if($regUser > 0) {
            header("Location: index.php");
        }else if($regUser == "Sorry... username already taken"){
            $errorUsername = 'Användarnamnet existerar redan';
        }elseif($regUser == "wrong pass") {
            $errorPass = 'Lösenorden matchar inte';
        }else {
            $errorEmail = "Mejlen existerar redan";
        }

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
<body class="Body-Registration">
    <div class="Background__Registration">
        <div class="Registration__Main">
            <h1 class="Registration__Heading">Registrera</h1>
            <form class="form" action="registration.php" method="post">
                <input type="hidden" name="issubmit" value="1">
                <?php if(isset($errorUsername)) { ?>
                   <h3 class="Error"> <?php echo $errorUsername; ?></h3>
                <?php }?>
                  <?php if(isset($errorEmail)) { ?>
                  <h3 class="Error"> <?php  echo $errorEmail;  ?></h3>
                <?php }?>
                <?php if(isset($errorPass)) { ?>
                  <h3 class="Error"> <?php  echo $errorPass;  ?></h3>
                <?php }?>
                <p><input class="Registration__Input" type="email" name="regEmail" placeholder="Email"></p>
                <p><input class="Registration__Input" type="text" name="regUsername" placeholder="Username"></p>
                <p><input class="Registration__Input" type="password" name="regPassword" placeholder="Lösenord"></p>
                <p><input class="Registration__Input" type="password" name="regAgainPassword" placeholder="Repetera Lösenord"></p>
                <p><input class="button" type="submit" value="Registrera"></p>
            </form>
            <a class="Registration__Link" href="index.php">Gå till startsidan</a>
        </div>
    </div>
</body>
</html>