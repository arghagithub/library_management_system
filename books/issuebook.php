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
    <title>Issue books</title>
</head>

<body>
    <?php
        require '../partials/_navbar.php';

        if(isset($_GET['addbook'])){
            if($_GET['addbook']=='true'){
                echo '<div class="container my-3"><div class="alert text-center alert-success alert-dismissible fade show" role="alert">
                      <strong>Success : </strong> Book is issued successfully
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div></div>';
            }
            elseif($_GET['addbook']=='true' && isset($_GET['warning'])){
                    echo '<div class="container my-3"><div class="alert text-center alert-warning alert-dismissible fade show" role="alert">
                      <strong>Warning : </strong> '.$_GET['warning'].'
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div></div>';
                }
                else{
                    echo '<div class="container my-3"><div class="alert text-center alert-danger alert-dismissible fade show" role="alert">
                      <strong>Error : </strong> '.$_GET['error'].'
                      <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div></div>';
                }
        }
        
    ?>


    <h3 class="text-center my-3">Library Mnagement System</h3>

    <div class="container d-flex justify-content-center align-items-center">
        <div class="card" style="width: 28rem;">
            <div class="card-body">
                <form action="/LMS/books/handleissue.php" method="POST">
                    <h4 class="text-center">Add all details</h4>
                    <div class="mb-3">
                        <label for="userid" class="form-label">user's id</label>
                        <input type="number" class="form-control" required id="userid" name="userid"
                            aria-describedby="emailHelp">
                    </div>
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
                        <label for="issuedate" class="form-label">issue date</label>
                        <input type="date" class="form-control" required id="issuedate" name="issuedate">
                    </div>
                    <button type="submit" class="btn btn-success">issue book</button>
                </form>

            </div>
        </div>
    </div>
</body>

</html>