<?php
require '../partials/_dbconnect.php';

if ( $_SERVER[ 'REQUEST_METHOD' ] == 'POST' ) {
    $user_id = $_POST[ 'userid' ];
    $bookname = $_POST[ 'bookname' ];
    $authorname = $_POST[ 'authorname' ];
    $category = $_POST[ 'categoryname' ];
    $issuedate = $_POST[ 'issuedate' ];
    $duedate = date( 'Y-m-d', strtotime( $issuedate . ' +7 day' ) );

    //Authenticate that this user belongs to our library
    $sql0 = "SELECT * FROM `users` WHERE `user_id`='$user_id'";
    $result0 = mysqli_query( $conn, $sql0 );
    $numrow0 = mysqli_num_rows( $result0 );

    if ( $numrow0>0 ) {

        $sql1 = "SELECT * FROM `categories` WHERE `category_name`='$category'";
        $result1 = mysqli_query( $conn, $sql1 );
        $numrow1 = mysqli_num_rows( $result1 );
        if ( $numrow1>0 ) {
            $row1 = mysqli_fetch_assoc( $result1 );
            $category_id = $row1[ 'category_id' ];

            $sql2 = "SELECT * FROM `authors` WHERE `author_name`='$authorname'";
            $result2 = mysqli_query( $conn, $sql2 );
            $numrow2 = mysqli_num_rows( $result2 );
            if ( $numrow2>0 ) {
                $row2 = mysqli_fetch_assoc( $result2 );
                $author_id = $row2[ 'author_id' ];

                $sql3 = "SELECT * FROM `books` WHERE `book_name`='$bookname'";
                $result3 = mysqli_query( $conn, $sql3 );
                $numrow3 = mysqli_num_rows( $result3 );
                if ( $numrow3>0 ) {
                    $row3 = mysqli_fetch_assoc( $result3 );
                    $book_id = $row3[ 'book_id' ];
                    $num_of_books = $row3[ 'num_of_books' ];

                    //books are avaliable or not

                    if ( $num_of_books>0 ) {

                        //users already issue that book or not

                        $sql = "SELECT * FROM `issued_books` WHERE `user_id`='$user_id' AND `book_id`='$book_id' AND `is_returned`=0";
                        $result = mysqli_query( $conn, $sql );
                        $numofrow = mysqli_num_rows( $result );

                        if ( $numofrow == 0 ) {

                            // jodi issue korar somoy karor kono issued boi due thake new boi issue korbo na
                            
                            $csql = "SELECT * FROM `issued_books` WHERE `user_id`='$user_id' AND `is_returned`=0";
                            $cresult = mysqli_query( $conn, $csql );
                            $cnumrow = mysqli_num_rows( $cresult );
                            $is_issue = true;
                            while( $crow = mysqli_fetch_assoc( $cresult ) ) {
                                $due = new DateTime( $crow[ 'due-date' ] );
                                $issue = new DateTime( $issuedate );
                                
                                if ( ( $due>$issue ) == 1 ) {
                                    $is_issue = false;
                                    break;
                                }
                            }
                            if ( $is_issue ) {
                                
                                //user maximum issue 3 three book

                                if ( $cnumrow<3 ) {
                                    $sql = "INSERT INTO `issued_books` (`book_id`,`book_name`,`author_id`,`category_id`,`user_id`,`issued_date`,`due_date`,`is_returned`) VALUES ('$book_id','$bookname','$author_id','$category_id','$user_id','$issuedate','$duedate','0')";
                                    $result = mysqli_query( $conn, $sql );
                                    if ( $result ) {
                                        $updatesql = "UPDATE `books` SET `num_of_books` = `num_of_books` - 1 WHERE `book_id`='$book_id'";
                                        $res = mysqli_query( $conn, $updatesql );
                                        $aff = mysqli_affected_rows( $conn );
                                        if ( $aff>0 ) {
                                            header( 'Location:/LMS/books/issuebook.php?addbook=true' );
                                        } else {
                                            header( 'Location:/LMS/books/issuebook.php?addbook=true&warning=updation unsuccessful' );
                                        }
                                    } else {
                                        header( 'Location:/LMS/books/issuebook.php?addbook=false&error=No book is issued' );
                                    }
                                } else {
                                    header( 'Location:/LMS/books/issuebook.php?addbook=false&error=You cannot issue more than three books' );
                                }
                            } else {
                                header( 'Location:/LMS/books/issuebook.php?addbook=false&error=Please return the due books before' );
                            }
                        } else {
                            header( 'Location:/LMS/books/issuebook.php?addbook=false&error=You have already issued this book' );
                        }

                    } else {
                        header( 'Location:/LMS/books/issuebook.php?addbook=false&error=No books are available' );
                    }

                } else {
                    header( 'Location:/LMS/books/issuebook.php?addbook=false&error=Please register the new book before' );
                }

            } else {
                header( 'Location:/LMS/books/issuebook.php?addbook=false&error=Please register the new author before' );
            }
        } else {
            header( 'Location:/LMS/books/issuebook.php?addbook=false&error=Please register the new category before' );
        }
    } else {
        header( 'Location:/LMS/books/issuebook.php?addbook=false&error=Please register the new user before' );
    }
}
?>