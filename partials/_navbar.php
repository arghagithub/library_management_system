<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM" crossorigin="anonymous">
    <title> 📕 LMS 🧑‍🎓</title>
</head>

<body>
    <?php

    session_start();
    require '_signupmodal.php';
    require '_loginmodal.php';
    if(isset($_SESSION['adminloggedin']) && $_SESSION['adminloggedin']==true){
        echo '<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/LMS">Library Management System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/LMS">Dashboard</a>
                    </li>';
                        echo '<li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Admin Profile
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/LMS/adminprofile.php?admin_id='.$_SESSION['admin_id'].'">View & edit profile</a></li>
                        </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Books
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/LMS/books/addbooks.php">Add new books</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/LMS/books/managebooks.php">Manage books</a></li>
                        </ul>
                     </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Categories
                        </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/LMS/categories/addcategory.php">Add new categories</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/LMS/categories/managecategory.php">Manage categories</a></li>
                    </ul>
                    </li>
                    <li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                            Authors
                        </a>
                    <ul class="dropdown-menu">
                        <li><a class="dropdown-item" href="/LMS/authors/addauthor.php">Add new authors</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="/LMS/authors/manageauthor.php">Manage authors</a></li>
                    </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/LMS/books/issuebook.php">issue book</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" href="/LMS/books/returnbook.php">return book</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active">Welcome Admin, '.$_SESSION['admin_name'].'</a>
                    </li>';
                    
                    echo '
                </ul>';
                    echo '<form class="d-flex" role="search">
                    <a role="button" href="/LMS/partials/handleadminlogout.php" class="btn btn-danger">Logout</a>
                </form>';
                echo '
            </div>
        </div>
    </nav>';
    }
    else{
        echo '<nav class="navbar navbar-expand-lg bg-dark navbar-dark">
        <div class="container-fluid">
            <a class="navbar-brand" href="/LMS">Library Management System</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="/LMS">Home</a>
                    </li>';
    
                    if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
                        echo '<li class="nav-item dropdown">
                        <a class="nav-link active dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            My Profile
                        </a>
                        <ul class="dropdown-menu">
                            <li><a class="dropdown-item" href="/LMS/userprofile.php?id='.$_SESSION['user_id'].'">View & edit profile</a></li>
                            <li><hr class="dropdown-divider"></li>
                            <li><a class="dropdown-item" href="/LMS/deleteuserprofile.php?id='.$_SESSION['user_id'].'">Delete profile</a></li>
                        </ul>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active">Welcome, '.$_SESSION['user_name'].'</a>
                    </li>';
                    }
                    echo '
                </ul>';
    
                if(isset($_SESSION['loggedin']) && $_SESSION['loggedin']==true){
                    echo '<form class="d-flex" role="search">
                    <a role="button" href="/LMS/partials/handlelogout.php" class="btn btn-danger">Logout</a>
                </form>';
                }
                else{
                    echo '<form class="d-flex" role="search">
                    <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#signupModal">Signup</button>
                    <button type="button" class="btn btn-warning mx-3" data-bs-toggle="modal" data-bs-target="#loginModal">Login</button>
                </form>';
                }
                echo '
            </div>
        </div>
    </nav>';

    }

    if(isset($_GET['signup'])){
        if($_GET['signup']=='true'){
            echo '<div class="alert text-center alert-success alert-dismissible fade show" role="alert">
            <strong>Success : </strong> Thanks for registring
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        else{
            echo '<div class="alert text-center alert-error alert-dismissible fade show" role="alert">
            <strong>Error : </strong> '.$_GET['error'].'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }

    if(isset($_GET['adminsignup'])){
        if($_GET['adminsignup']=='true'){
            echo '<div class="alert text-center alert-success alert-dismissible fade show" role="alert">
            <strong>Success : </strong> Thanks for registring as Admin
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        else{
            echo '<div class="alert text-center alert-error alert-dismissible fade show" role="alert">
            <strong>Error : </strong> '.$_GET['error'].'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }

    if(isset($_GET['login'])){
        if($_GET['login']=='true'){
            echo '<div class="alert text-center alert-success alert-dismissible fade show" role="alert">
            <strong>Success : </strong> Successfully logged in
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        else{
            echo '<div class="alert text-center alert-danger alert-dismissible fade show" role="alert">
            <strong>Error : </strong> '.$_GET['error'].'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }

    if(isset($_GET['adminlogin'])){
        if($_GET['adminlogin']=='true'){
            echo '<div class="alert text-center alert-success alert-dismissible fade show" role="alert">
            <strong>Success : </strong> Successfully logged in as Admin
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        else{
            echo '<div class="alert text-center alert-danger alert-dismissible fade show" role="alert">
            <strong>Error : </strong> '.$_GET['error'].'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }

    if(isset($_GET['logout'])){
        if($_GET['logout']=='true'){
            echo '<div class="alert text-center alert-success alert-dismissible fade show" role="alert">
            <strong>Success : </strong> Successfully logged out
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }

    if(isset($_GET['deleteuser'])){
        if($_GET['deleteuser']=='true'){
            echo '<div class="alert text-center alert-success alert-dismissible fade show" role="alert">
            <strong>Success : </strong> Your account is successfully deleted
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }

    if(isset($_GET['update'])){
        if($_GET['update']=='true'){
            echo '<div class="alert text-center alert-success alert-dismissible fade show" role="alert">
            <strong>Success : </strong> Your profile is updated successfully
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
        else{
            echo '<div class="alert text-center alert-error alert-dismissible fade show" role="alert">
            <strong>Error : </strong> '.$_GET['error'].'
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div>';
        }
    }

?>

</body>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz" crossorigin="anonymous">
</script>


</html>