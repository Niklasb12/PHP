<?php

    session_start();

    require("include/connectMysql.php");

    $connection = connectdb();

    $checkUser = mysqli_real_escape_string($connection,$_POST['email']);
    $checkPass = mysqli_real_escape_string($connection,$_POST['password']);

    $query = "SELECT * FROM users
    WHERE userEmail = '$checkUser'";

    $result = mysqli_query($connection,$query) or die("Query failed: $query");

    $row = mysqli_fetch_assoc($result);

    $count = mysqli_num_rows($result);

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Labb2</title>
</head>
<body>

<?php

    if($count == 1) {
        if (password_verify($checkPass, $row["userPassword"])) {
            $_SESSION['status'] = "ok";
            $_SESSION['userId'] = $row["userId"];
            $_SESSION['userDate'] = $row["userDate"];
            $_SESSION['userName'] = $row["userName"];
            header("Location: allPosts.php");
        } else {
            header("Location: index.php");
            echo "<p>Du har inte fyllt i rätt användare och lösenord</p>";
            echo '<p><a href="index.php">Försök igen</a></p>';
        }
    } else {
        header("Location: index.php");
        echo "<p>Finns ingen användare</p>";
    }

    disconnectdb($connection)

?>

</body>
</html>