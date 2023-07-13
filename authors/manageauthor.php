<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    .box {
        height: 75vh;
    }

    .table {
        border: 2px solid black;
    }
    </style>
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">

    <title>Manage authors</title>
</head>

<body>
    <?php
        require '../partials/_navbar.php';
        require '../partials/_dbconnect.php';
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $sql="DELETE FROM `authors` WHERE `author_id`='$id'";
            $result=mysqli_query($conn,$sql);
            $affrow=mysqli_affected_rows($conn);
            if($affrow>0){
                echo '<div class="container my-3"><div class="alert text-center alert-success alert-dismissible fade show" role="alert">
                <strong>Success : </strong> Author is deleted successfully
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div></div>';
            }
            else{
                echo '<div class="container my-3"><div class="alert text-center alert-danger alert-dismissible fade show" role="alert">
                <strong>Error : </strong> No, deletion is unsuccessfull
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div></div>';
            }
        }

        if(isset($_POST['eid'])){
            $eid=$_POST['eid'];
            $authorname=$_POST['eauthor'];
            $sql="UPDATE `authors` SET `author_name`='$authorname' WHERE `author_id`='$eid'";
            $result=mysqli_query($conn,$sql);
            $affrow=mysqli_affected_rows($conn);
            if($affrow>0){
                echo '<div class="container my-3"><div class="alert text-center alert-success alert-dismissible fade show" role="alert">
                <strong>Success : </strong> Author is updated successfully
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div></div>';
            }
            else{
                echo '<div class="container my-3"><div class="alert text-center alert-danger alert-dismissible fade show" role="alert">
                <strong>Error : </strong> No, updation is unsuccessfull
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div></div>';
            }
        }
    ?>
    <div class="modal fade" id="editModal" tabindex="-1" aria-labelledby="editModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="editModalLabel">Modal title</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/LMS/authors/manageauthor.php" method="POST">
                        <h4 class="text-center">Update author's details</h4>
                        <input type="hidden" name="eid" id="eid">
                        <div class="mb-3">
                            <label for="eauthor" class="form-label">Author name</label>
                            <input type="text" class="form-control" id="eauthor" name="eauthor"
                                aria-describedby="emailHelp">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container my-3">
        <h2 class="text-center">Our Authors</h2>
        <table id="mytable" class="table table-light">
            <thead>
                <tr>
                    <th scope="col">sno</th>
                    <th scope="col">author_id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Category Name</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        $sql="SELECT * from `authors`";
                        $result=mysqli_query($conn,$sql);
                        $numrows=mysqli_num_rows($result);
                        if($numrows>0){
                            $num=1;
                            while($row=mysqli_fetch_assoc($result)){
                                $category_id=$row['author_category_id'];
                                $catsql="SELECT * FROM `categories` WHERE `category_id`='$category_id'";
                                $catresult=mysqli_query($conn,$catsql);
                                $catnumrows=mysqli_num_rows($catresult);
                                if($catnumrows>0){
                                    $catrow=mysqli_fetch_assoc($catresult);
                                }
                                echo '<tr>
                                <th scope="row">'.$num.'</th>
                                <td>'.$row['author_id'].'</td>
                                <td>'.$row['author_name'].'</td>
                                <td>'.$catrow['category_name'].'</td>
                                <td>
                                <button type="button" class="btn btn-dark delete" id="'.$row['author_id'].'">Delete</button>
                                <button type="button" class="btn btn-dark edit" id="e'.$row['author_id'].'" >Edit</button>
                                </td>
                            </tr>';
                            $num+=1;
                            }
                        }
                        else{
                            echo '<div class="container my-3"><div class="alert text-center alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error : </strong> No authors, please ad some authors
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                          </div></div>';
                        }

                    ?>
            </tbody>
        </table>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous"></script>
<script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>

<script>
$(document).ready(function() {
    $('#mytable').DataTable();
})
</script>
<script>
const del = document.getElementsByClassName('delete');
Array.from(del).forEach((element) => {
    element.addEventListener('click', (e) => {
        $id = e.target.id;
        if (confirm("Do you want to delete the author")) {
            window.location = `/LMS/authors/manageauthor.php?id=${$id}`;
        } else {
            window.location = `/LMS/authors/manageauthor.php`;
        }
    })
})


const edit = document.getElementsByClassName('edit');
Array.from(edit).forEach((element) => {
    element.addEventListener('click', (e) => {
        const id = e.target.id.substr(1);
        document.getElementById('eid').value = id;
        document.getElementById('eauthor').value = e.target.parentNode.parentNode.getElementsByTagName(
            'td')[0].innerText;
        $('#editModal').modal('toggle');
    })
})
</script>

</html>