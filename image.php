<?php

    session_start();

    require("include/connectMysql.php");
    require("include/post-functions.php");

    $connection = connectdb();


    $status = $statusMsg = ''; 
    if(isset($_POST["submit"])){ 
        $status = 'error'; 
        if(!empty($_FILES["image"]["name"])) {
            $fileName = basename($_FILES["image"]["name"]); 
            $fileType = pathinfo($fileName, PATHINFO_EXTENSION); 
            $allowTypes = array('jpg','png','jpeg','gif'); 
            if(in_array($fileType, $allowTypes)){ 
                $image = $_FILES['image']['tmp_name']; 
                $imgContent = addslashes(file_get_contents($image));
                $userId = $_SESSION['userId'];

                $query = "INSERT INTO images
                            (image,uploaded,imageUid)
                            VALUES('$imgContent', NOW(),'$userId')";

                $result = mysqli_query($connection,$query) or die("Query failed: $query");

                $insert = mysqli_insert_id($connection);
            
                if($insert){ 
                    $status = 'success'; 
                    $statusMsg = "File uploaded successfully."; 
                }else{ 
                    $statusMsg = "File upload failed, please try again."; 
                }  
            }else{ 
                $statusMsg = 'Sorry, only JPG, JPEG, PNG, & GIF files are allowed to upload.'; 
            } 
        }else{ 
            $statusMsg = 'Please select an image file to upload.'; 
        } 
        echo $statusMsg; 
    } 

    $result = getImage($connection, $_SESSION['userId']);


?>

<?php if($result->num_rows > 0){ ?>
    <div class="gallery">
        <?php while($row = $result->fetch_assoc()){ ?>
            <img src="data:image/jpg;charset=utf8;base64,<?php echo base64_encode($row['image']); ?>" /> 
        <?php } ?> 
    </div> 
<?php }else{ ?> 
    <p class="status error">Image(s) not found...</p>
<?php } ?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Labb2</title>
</head>
<body>
    <a href="allPosts.php">Tillbaka</a>
<form action="image.php" method="post" enctype="multipart/form-data">
    <label>Select Image File:</label>
    <input type="file" name="image">
    <input type="submit" name="submit" value="Upload">
</form>
</body>
</html>