<?php

    function connectdb() {
        $connection = mysqli_connect("localhost", "root", "", "labb2php") or die("Could not connect");

        mysqli_select_db($connection,"labb2php") or die("Could not select database");

        return $connection;
    }


    function disconnectdb($connection) {
        $disconnect = mysqli_close($connection);

    }



?>