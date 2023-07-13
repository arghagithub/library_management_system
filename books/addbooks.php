<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    .card-body {
        border: 2px solid black;
        border-radius: 5px;
    }
    </style>
    <title>Add books</title>
</head>

<body>
    <?php
        require '../partials/_navbar.php';
        require '../partials/_dbconnect.php';    


        if($_SERVER['REQUEST_METHOD']=='POST'){
            $bookname=$_POST['bookname'];
            $authorname=$_POST['authorname'];
            $category=$_POST['categoryname'];
            $price=$_POST['price'];
            $numbooks=$_POST['numbooks'];

            $sql1="SELECT * FROM `categories` WHERE `category_name`='$category'";
            $result1=mysqli_query($conn,$sql1);
            $numrow1=mysqli_num_rows($result1);
            if($numrow1>0){
                $row1=mysqli_fetch_assoc($result1);
                $category_id=$row1['category_id'];



                $sql2="SELECT * FROM `authors` WHERE `author_name`='$authorname'";
                $result2=mysqli_query($conn,$sql2);
                $numrow2=mysqli_num_rows($result2);
                if($numrow2>0){
                    $row2=mysqli_fetch_assoc($result2);
                    $author_id=$row2['author_id'];


                    $sql3="SELECT * FROM `books` WHERE `book_name`='$bookname'";
                    $result3=mysqli_query($conn,$sql3);
                    $numrow3=mysqli_num_rows($result3);

                    if($numrow3>0){
                       echo '<div class="container my-3"><div class="alert text-center alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error : </strong> Book is already added
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                            </div></div>';
                    }
                    else{
                        $sql="INSERT INTO `books` (`book_name`,`book_author_id`,`book_category_id`,`book_price`,`num_of_books`) VALUES ('$bookname','$author_id','$category_id','$price','$numbooks')";
                        $result=mysqli_query($conn,$sql);
                        if($result){
                            echo '<div class="container my-3"><div class="alert text-center alert-success alert-dismissible fade show" role="alert">
                                <strong>Success : </strong> Book is added successfully
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div></div>';
                        }
                        else{
                            echo '<div class="container my-3"><div class="alert text-center alert-danger alert-dismissible fade show" role="alert">
                                <strong>Error : </strong> No books are added
                                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                                </div></div>';
                        }
                    }                    
                }
                else{
                    echo '<div class="container my-3"><div class="alert text-center alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning : </strong> Please register the new author before
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div></div>';
                }
            }
            else{
                echo '<div class="container my-3"><div class="alert text-center alert-warning alert-dismissible fade show" role="alert">
                    <strong>Warning : </strong> Please register the new category before
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div></div>';
            }
        }
    ?>



    <h3 class="text-center my-3">Library Mnagement System</h3>

    <div class="container d-flex justify-content-center align-items-center my-3">
        <div class="card" style="width: 28rem;">
            <div class="card-body">
                <h4 class="card-title text-center my-2">Add book's details</h4>
                <form action="/LMS/books/addbooks.php" method="POST">
                    <div class="mb-3">
                        <label for="bookname" class="form-label">Book's name</label>
                        <input type="text" class="form-control" required id="bookname" name="bookname"
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="authorname" class="form-label">Author's name</label>
                        <input type="text" class="form-control" required id="authorname" name="authorname">
                    </div>
                    <div class="mb-3">
                        <label for="categoryname" class="form-label">Category</label>
                        <input type="text" class="form-control" required id="categoryname" name="categoryname">
                    </div>
                    <div class="mb-3">
                        <label for="price" class="form-label">Book's price</label>
                        <input type="number" class="form-control" required id="price" name="price">
                    </div>
                    <div class="mb-3">
                        <label for="numbooks" class="form-label">Number of books added</label>
                        <input type="number" class="form-control" required id="numbooks" name="numbooks">
                    </div>
                    <button type="submit" class="btn btn-primary">Add book</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>