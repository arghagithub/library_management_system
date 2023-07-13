<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>

    .card-body {
        border: 2px solid black;
        border-radius: 10px;
    }
    </style>
    <title>Add authors</title>
</head>

<body>
    <?php
        require '../partials/_navbar.php';
        require '../partials/_dbconnect.php';
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $author=$_POST['author'];
            $category=$_POST['category'];


            $sql1="SELECT * FROM `categories` WHERE `category_name`='$category'";
            $result1=mysqli_query($conn,$sql1);
            $numrow1=mysqli_num_rows($result1);
            if($numrow1>0){
                $row1=mysqli_fetch_assoc($result1);
                $category_id=$row1['category_id'];
                $existsql="SELECT * FROM `authors` WHERE `author_name`='$author'";
                $existresult=mysqli_query($conn,$existsql);
                $numrow=mysqli_num_rows($existresult);
                if($numrow>0){
                    echo '<div class="container my-3"><div class="alert text-center alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error : </strong> Author already exists
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div></div>';
                    exit;
                }
                else{
                    $sql="INSERT INTO `authors` ( `author_name`,`author_category_id`) VALUES ('$author','$category_id');";
                    $result=mysqli_query($conn,$sql);
                    if($result){
                        echo '<div class="container my-3"><div class="alert text-center alert-success alert-dismissible fade show" role="alert">
                        <strong>Success : </strong> Author is added successfully
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div></div>';
                    }
                    else{
                        echo '<div class="container my-3"><div class="alert text-center alert-danger alert-dismissible fade show" role="alert">
                        <strong>Error : </strong> Something went wrong
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div></div>'; 
                    }
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

    <div class="d-flex align-items-center box justify-content-center my-5">
        <div class="card" style="width: 22rem;">
            <div class="card-body">
                <form action="/LMS/authors/addauthor.php" method="POST">
                    <h4>Add new author</h4>
                    <div class="mb-3">
                        <label for="author" class="form-label">Author name</label>
                        <input type="text" class="form-control" id="author" name="author" required
                            aria-describedby="emailHelp">
                    </div>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category name</label>
                        <input type="text" class="form-control" id="category" name="category" required
                            aria-describedby="emailHelp">
                    </div>
                    <button type="submit" class="btn btn-primary">Add author</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>