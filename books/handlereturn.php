<?php

require '../partials/_dbconnect.php';

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
    $user_id = $_POST[ 'userid' ];
    $bookname = $_POST[ 'bookname' ];

    $sql1 = "SELECT * FROM `books` WHERE `book_name`='$bookname'";
    $result1 = mysqli_query( $conn, $sql1 );
    $numrow1 = mysqli_num_rows( $result1 );
    if ( $numrow1>0 ) {
        $row1 = mysqli_fetch_assoc( $result1 );
        $book_id = $row1[ 'book_id' ];

        //now add check sql

        $sql2 = "SELECT * FROM `issued_books` WHERE `user_id`='$user_id' AND `book_id`='$book_id'";
        $result2 = mysqli_query( $conn, $sql2 );
        $numrow2 = mysqli_num_rows( $result2 );
        if ( $numrow2>0 ) {
            $row2 = mysqli_fetch_assoc( $result2 );
            if ( $row2[ 'is_returned' ] == 0 ) {

                $submit_date = date( 'Y-m-d' );
                $due_date = $row2[ 'due_date' ];

                $due = new DateTime( $row2[ 'due_date' ] );
                $submit = new DateTime( date( 'Y-m-d' ) );

                if(($submit>$due)==1){
                    $interval = $submit->diff( $due );
                    $diff = $interval->format( '%a' );
                    $fine = $diff*5;
                }
                else{
                    $fine=0;
                }

                $sql3 = "UPDATE `issued_books` SET `is_returned`=1, `submit_date`='$submit_date',`fine`='$fine' WHERE `user_id`='$user_id' AND `book_id`='$book_id';";
                $result3 = mysqli_query( $conn, $sql3 );
                $affrow3 = mysqli_affected_rows( $conn );

                $sql5 = "UPDATE `books` SET `num_of_books`=`num_of_books`+1 WHERE `book_id`='$book_id'";
                $result5 = mysqli_query( $conn, $sql5 );
                $affrow5 = mysqli_affected_rows( $conn );

                if ( $affrow3>0 && $affrow5>0 ) {
                    header( 'Location:/LMS/books/returnbook.php?returnbook=true&fine='.$fine.'' );
                } else {
                    header( 'Location:/LMS/books/returnbook.php?returnbook=false&error=Internal server error' );
                }

            } else {
                header( 'Location:/LMS/books/returnbook.php?returnbook=false&error=You already submit these book' );
            }

        } else {
            header( 'Location:/LMS/books/returnbook.php?returnbook=false&error=You are not authenticate user' );
        }
    } else {
        header( 'Location:/LMS/books/returnbook.php?returnbook=false&error=This book is not belonged to you' );
    }

}

?>