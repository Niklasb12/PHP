<?php 

    function createPost($connection, $userId) {
        $title = mysqli_real_escape_string($connection,$_POST['txtTitle']);
        $content = mysqli_real_escape_string($connection,$_POST['txtContent']);
        $date = date("Y-m-d");
    
        $query = "INSERT INTO post
                (postTitle,postContent,postDate,userPostUid)
                VALUES('$title','$content','$date', '$userId')";
    
        $result = mysqli_query($connection,$query) or die("Query failed: $query");
    
        $insId = mysqli_insert_id($connection);

        return $insId;
    }

    function allPosts($connection, $orderBy ,$order) {

        $query = "SELECT userName, userDate, postDate, postTitle, postContent, postId
            from post
            inner join users
            on userId = userPostUid
            ORDER BY " . $orderBy . ' ' . $order;
            // ORDER BY postDate ASC
            
            
        $result = mysqli_query($connection,$query);
         
        return $result;

    }


    function myPosts($connection, $userId) {
        $query = "SELECT * FROM post WHERE userPostUid='$userId' ORDER BY postDate ASC";

        $result = mysqli_query($connection,$query);

        return $result;
    }

    function deletePost($connection) {

        $query = "DELETE FROM post WHERE postId=". $_POST['postdeleteid'];

        $result = mysqli_query($connection,$query) or die("Query failed: $query");

    }

    function deleteFavoritePost($connection) {

        $query = "DELETE FROM userPost WHERE userPostPid=". $_POST['postdeleteid'];

        $result = mysqli_query($connection,$query) or die("Query failed: $query");
    }

    function updatePost($connection) {
        $title = mysqli_real_escape_string($connection,$_POST['txtTitle']);
        $content = mysqli_real_escape_string($connection,$_POST['txtContent']);
        $editid = $_POST['updateid'];
    
        $query = "UPDATE post
                SET postTitle='$title', postContent='$content'
                WHERE postId=". $editid;
    
        $result = mysqli_query($connection,$query) or die("Query failed: $query");
    }

    function getPostData($connection, $editId) {
        $query = "SELECT * FROM post WHERE postId=". $editId;

	    $result = mysqli_query($connection,$query);

        $post = mysqli_fetch_assoc($result);
        
        return $post;
    }

    function setFavorite($connection, $postId, $userId) {

       $query = "INSERT INTO userPost (userPostUid, userPostPid) VALUES ('$userId','$postId')";
       
       $result = mysqli_query($connection,$query) or die("Query failed: $query");
    
       $insId = mysqli_insert_id($connection);

       return $insId;

    }

    function getFavorite($connection, $userId) {
        
        $query = "SELECT users.userId AS userId, users.userDate AS userDate, post.userName AS authorName, post.postTitle AS postTitle, post.postContent AS postContent, post.postDate AS postDate, post.postId AS postId
                    from (select * from post inner join users on post.userPostUid = users.userId) as post
                    inner join userPost
                    on post.postId = userPost.userPostPid
                    inner join users
                    on userPost.userPostUid = users.userId
                    where users.userId = $userId";

        $result = mysqli_query($connection,$query);

        return $result;

     }


?>
