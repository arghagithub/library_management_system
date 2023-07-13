<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        .card-body,.card-img-top {
            border: 2px solid black;
        }
    </style>
    <title>LMS</title>
</head>

<body>
    <?php

    require "partials/_navbar.php";
    require "partials/_dbconnect.php";

    $sql="SELECT * FROM `books`";
    $result=mysqli_query($conn,$sql);
    $numbook=mysqli_num_rows($result);

    $sql="SELECT * FROM `authors`";
    $result=mysqli_query($conn,$sql);
    $numauthor=mysqli_num_rows($result);

    $sql="SELECT * FROM `categories`";
    $result=mysqli_query($conn,$sql);
    $numcategory=mysqli_num_rows($result);

    $sql="SELECT * FROM `users`";
    $result=mysqli_query($conn,$sql);
    $numuser=mysqli_num_rows($result);


    $sql="SELECT * FROM `issued_books`";
    $result=mysqli_query($conn,$sql);
    $numissue=mysqli_num_rows($result);

    $sql="SELECT * FROM `issued_books` WHERE `is_returned`=0;";
    $result=mysqli_query($conn,$sql);
    $numnotreturn=mysqli_num_rows($result);


    echo '<h3 class="text-center my-4">Library Management System</h3>';
    if(isset($_SESSION['adminloggedin']) && $_SESSION['adminloggedin']==true){
        echo '
        <div class="container d-flex flex-wrap justify-content-center my-6">
            <div class="card my-3" style="width: 17rem;border:1px solid black;
">
                
                <div class="card-body">
                    <h5 class="card-title">Registered users</h5>
                    <p class="card-text">Total no of users : '.$numuser.'</p>
                    <a href="/LMS/cards/showalluser.php" class="btn btn-success">View all registered user</a>
                </div>
            </div>
            <div class="card my-3 mx-4" style="width: 17rem;border:1px solid black;
">
                <div class="card-body">
                    <h5 class="card-title">Total books</h5>
                    <p class="card-text">Number of books available : '.$numbook.'</p>
                    <a href="/LMS/cards/showallbooks.php" class="btn btn-warning">View all books</a>
                </div>
            </div>
            <div class="card my-3" style="width: 17rem;border:1px solid black;
">

                <div class="card-body">
                    <h5 class="card-title">Books categories</h5>
                    <p class="card-text">Number of books categories : '.$numcategory.'</p>
                    <a href="/LMS/cards/showallcategories.php" class="btn btn-info">View all categories</a>
                </div>
            </div>
            <div class="card my-3 mx-4" style="width: 17rem;border:1px solid black;
">

                <div class="card-body">
                    <h5 class="card-title">No. of authors</h5>
                    <p class="card-text">Total no of authors : '.$numauthor.'</p>
                    <a href="/LMS/cards/showallauthors.php" class="btn btn-primary">View all authors</a>
                </div>
            </div>
            <div class="card my-3" style="width: 17rem;border:1px solid black;
">

                <div class="card-body">
                    <h5 class="card-title">Books issued</h5>
                    <p class="card-text">No of books issued : '.$numissue.'</p>
                    <a href="/LMS/cards/showallissuedbooks.php" class="btn btn-dark">View issued books</a>
                </div>
            </div>
            <div class="card my-3 mx-4" style="width: 17rem;border:1px solid black;
">

                <div class="card-body">
                    <h5 class="card-title">Books not returned</h5>
                    <p class="card-text">No of books not returned '.$numnotreturn.'</p>
                    <a href="/LMS/cards/showallnotreturnedbooks.php" class="btn btn-danger">View not returned books</a>
                </div>
            </div>
        </div>';
    }
    elseif(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){

        $user_id=$_SESSION['user_id'];
        $sql="SELECT * FROM `issued_books` WHERE `user_id`='$user_id'";
        $result=mysqli_query($conn,$sql);
        $numissue=mysqli_num_rows($result);


        $sql="SELECT * FROM `issued_books` WHERE `is_returned`=0 AND `user_id`='$user_id'";
        $result=mysqli_query($conn,$sql);
        $numnotret=mysqli_num_rows($result);

        $sql="SELECT * FROM `issued_books` WHERE `is_returned`=0 AND `user_id`='$user_id'";
        $result=mysqli_query($conn,$sql);
        $numfine=mysqli_num_rows($result);

        
        if($numfine>0){
            $totalfine=0;
            while($row=mysqli_fetch_assoc($result)){
                $due = date_create( $row[ 'due_date' ] );
                $today = date_create( date( 'Y-m-d' ) );

                if(($today>$due)==1){
                    $interval = $today->diff( $due );
                    $diff = $interval->format( '%a' );
                    $fine = $diff * 5;
                }
                else{
                     $fine=0;
                }
                $totalfine+=$fine;
            }
        }


        echo '
        <div class="container d-flex flex-wrap justify-content-evenly my-3">
            <div class="card my-3" style="width: 18rem;">
                <img src="images/timing.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Library timing</h5>
                    <li>Opening at : 8:00 am</li>
                    <li>Closing at : 8:00 pm</li>
                    <li>Sunday off</li>
                </div>
            </div>
            <div class="card my-3" style="width: 18rem;">
                <img src="images/provide.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">What we provide</h5>
                    <li>Free wifi</li>
                    <li>News Papers</li>
                    <li>Discussion rooms</li>
                    <li>RO water</li>
                    <li>Peaceful environment</li>
                    <li>Online public access catalog</li>
                </div>
            </div>
            <div class="card my-3" style="width: 28rem;">
                <img src="images/rules.jpg" class="card-img-top" alt="...">
                <div class="card-body">
                    <h5 class="card-title">Rules and regulations</h5>
                    <li>No smoking, eating, sleeping and talking loudly</li>
                    <li>Use of cell phones is not allowed.</li>
                    <li>No library material can be taken out of the library without permission.</li>
                    <li>Readers should not mark, underline, write, tear pages of library documents</li>
                    <li>A fine of 5 rupees per day per book will be charged from the defaulting members.</li>
                </div>
            </div>
        </div>

        <div class="container d-flex flex-wrap justify-content-around my-3">
            <div class="card my-3" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">All issued books</h5>
                    <p class="card-text">Total number of issued books : '.$numissue.' </p>
                    <a href="/LMS/user/showissuedbooks.php" class="btn btn-success">View all issued books</a>
                </div>
            </div>
            <div class="card my-3" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Not returned books</h5>
                    <p class="card-text">Number of books not returned : '.$numnotret.'</p>
                    <a href="/LMS/user/notreturnedbooks.php" class="btn btn-warning">View all not returned books</a>
                </div>
            </div>
            <div class="card my-3" style="width: 18rem;">
                <div class="card-body">
                    <h5 class="card-title">Total fine due</h5>
                    <p class="card-text">Total due fine till today : '.$totalfine.'</p>
                    <a href="/LMS/user/showfinedistribution.php" class="btn btn-danger">View fine distribution</a>
                </div>
            </div>
        </div>';
    }
    else{
        echo '<div id="none" class="container d-flex flex-wrap justify-content-evenly my-5">
        <div class="card my-5" style="width: 25rem; border:2px solid black;">
            <div class="card-body">
                <h5 class="card-title text-center">Login Yourself</h5>
                <form action="/LMS/partials/handlelogin.php" method="POST">
                    <div class="mb-3">
                        <label for="email" class="form-label">Email address</label>
                        <input type="email" class="form-control" id="email" name="email" aria-describedby="emailHelp">
                        <div id="emailHelp" class="form-text">We will never share your email with anyone else.</div>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password">
                    </div>
                    <button type="submit" class="btn btn-success">login</button>
                </form>
            </div>
        </div>
    </div>';
    }
    ?>




</body>

</html>