<?php 

    session_start();

    if(!isset($_SESSION['status']) && !$_SESSION['status'] == "ok"){
        header("Location: index.php");
        exit;
    }

    require './oop/games.php';
    require './oop/valorant.php';

    $valorant = new Valorant('Valorant', 'FPS', 'The best game!');
    $CS = new Games('Counter-Strike', 'FPS');
    $ageOfEmpire = new Games('Age of empire', 'Strategy');
    $rdr2 = new Games('Red Dead Redemption 2', 'Adventure');
    $mineCraft = new Games('Minecraft', 'Sandbox');

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Labb2</title>
</head>
<body class="Body-topFive">
    <div class="topFive">
        <h3 class="whiteHeading">Top 5 spel</h3>
        <ol> 
            <li class="white"><?php echo $valorant->getTitle() . ', ' . $valorant->getGenre() . ', ' . $valorant->getBest(); ?></li>
            <li class="white"><?php echo $CS->getTitle() . ', ' . $CS->getGenre(); ?></li>
            <li class="white"><?php echo $ageOfEmpire->getTitle() . ', ' . $ageOfEmpire->getGenre(); ?></li>
            <li class="white"><?php echo $rdr2->getTitle() . ', ' . $rdr2->getGenre(); ?></li>
            <li class="white"><?php echo $mineCraft->getTitle() . ', ' . $mineCraft->getGenre(); ?></li>
        </ol>
        <a class="white" href="allPosts.php">Tillbaka</a>
    </div>
</body>
</html>