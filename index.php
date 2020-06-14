<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="./assets/css/style.css">
    <title>Labb2</title>
</head>
<body class="Body-Login">
    <div class="Background__Login">
        <div class="Login__Main">
            <h1 class="Login__Heading">Logga in</h1>
            <form class="form" action="login.php" method="post">
                <p><input class="Login__Input" type="text" name="email" placeholder="Email"></p>
                <p><input class="Login__Input" type="password" name="password" placeholder="Lösenord"></p>
                <p><input class="button" type="submit" value="Logga in"></p>
            </form>
            <a class="Login__Link" href="registration.php">Registrera en användare</a>
        </div>
    </div>
</body>
</html>