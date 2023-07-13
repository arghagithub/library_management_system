<?php

    $servername="localhost";
    $user="root";
    $password="";
    $dbname="LMS";

    $conn=mysqli_connect($servername,$user,$password,$dbname);

    if(!$conn){
        die("Internal server error");
    }

?>