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
    <title>Return book</title>
</head>

<body>
    <?php
        require '../partials/_navbar.php';

        if(isset($_GET['returnbook'])){
            if($_GET['returnbook']=='true'){
                echo '<div class="container my-3"><div class="alert text-center alert-success alert-dismissible fade show" role="alert">
                      <strong>Success : </strong> Book is returned successfully and total fine is <strong> '.$_GET['fine'].'₹</strong>
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

    <div class="container d-flex justify-content-center align-items-center my-5">
        <div class="card" style="width: 23rem;">
            <div class="card-body">
                <form action="/LMS/books/handlereturn.php" method="POST">
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
                    <button type="submit" class="btn btn-success">Return</button>
                </form>
            </div>
        </div>
    </div>
</body>

</html>