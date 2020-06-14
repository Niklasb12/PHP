<?php 

  function check($connection, $checkUser) {

      $query = "SELECT * FROM users
                  WHERE userEmail = '$checkUser'";

      $result = mysqli_query($connection,$query) or die("Query failed: $query");

      $row = mysqli_fetch_assoc($result);

      $count = mysqli_num_rows($result);

      return $count;
  }
  
  function regUser($connection) {
    
      $date = date("Y-m-d H:i:s");
      $email = escapeInsert($connection,$_POST['regEmail']);
      $username = escapeInsert($connection,$_POST['regUsername']);
      $password = escapeInsert($connection,$_POST['regPassword']);
      $passwordAgain = escapeInsert($connection,$_POST['regAgainPassword']);
      $passwordHash = password_hash($password, PASSWORD_DEFAULT);

      $sqlUsername = "SELECT * FROM users WHERE userName='$username'";
      $sqlEmail = "SELECT * FROM users WHERE userEmail='$email'";
      $resUsername = mysqli_query($connection, $sqlUsername);
      $resEmail = mysqli_query($connection, $sqlEmail);
      if($password == $passwordAgain) {
        if(mysqli_num_rows($resEmail) > 0){
            $email_error = "Sorry... email already taken"; 
            return $email_error;
          } else if (mysqli_num_rows($resUsername) > 0) {
            $name_error = "Sorry... username already taken";
            return $name_error;
          }else{
    
            $query = "INSERT INTO users
                    (userEmail,userName,userPassword,userDate)
                    VALUES('$email','$username','$passwordHash','$date')";
        
            $result = mysqli_query($connection,$query) or die("Query failed: $query");
        
            $insId = mysqli_insert_id($connection);
        
            return $insId;
          }
        } else {
          $errorPass = 'wrong pass';
          return $errorPass;
        }
      
  }

  function escapeInsert($conn,$insert) {
      $insert = htmlspecialchars($insert);
  
      $insert = mysqli_real_escape_string($conn,$insert);
  
      return $insert;
  }

?>