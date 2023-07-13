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
    <title>Add categories</title>
</head>

<body>
    <?php
        require '../partials/_navbar.php';
        require '../partials/_dbconnect.php';
        if($_SERVER['REQUEST_METHOD']=="POST"){
            $category =$_POST['category'];
            $existsql="SELECT * FROM `categories` WHERE `category_name`='$category'";
            $existresult=mysqli_query($conn,$existsql);
            $numrow=mysqli_num_rows($existresult);
            if($numrow>0){
                echo '<div class="container my-3"><div class="alert text-center alert-danger alert-dismissible fade show" role="alert">
                    <strong>Error : </strong> Category already exists
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                  </div></div>';
                  exit;
            }
            else{
                $sql="INSERT INTO `categories` ( `category_name`) VALUES ('$category');";
                $result=mysqli_query($conn,$sql);
                if($result){
                    echo '<div class="container my-3"><div class="alert text-center alert-success alert-dismissible fade show" role="alert">
                    <strong>Success : </strong> category is added successfully
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
    ?>
    <h3 class="text-center my-3">Library Mnagement System</h3>

    <div class="d-flex align-items-center box justify-content-center my-5">
        <div class="card" style="width: 22rem;">
            <div class="card-body">
                <form action="/LMS/categories/addcategory.php" method="POST">
                    <h4>Add new category</h4>
                    <div class="mb-3">
                        <label for="category" class="form-label">Category name</label>
                        <input type="text" class="form-control" id="category" required name="category"
                            aria-describedby="emailHelp">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Category</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>