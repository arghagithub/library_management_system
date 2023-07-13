<?php

require 'partials/_dbconnect.php';
session_start();
$id = $_GET[ 'id' ];
$sql = "DELETE FROM `users` WHERE `user_id`='$id'";
$result = mysqli_query( $conn, $sql );

$affrow = mysqli_affected_rows( $conn );
if ( $affrow>0 ) {
    $sql = "DELETE FROM `issued_books` WHERE `user_id`='$id'";
    $result = mysqli_query( $conn, $sql );
    $affrow = mysqli_affected_rows( $conn );
    if ( $affrow>0 ) {
        unset( $_SESSION[ 'loggedin' ] );
        header( 'Location: http://localhost/LMS/?deleteuser=true' );
    }
}

?>