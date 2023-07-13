<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <title>Manage all books</title>
</head>

<body>
    <?php
        require '../partials/_navbar.php';
        require '../partials/_dbconnect.php'; 
        if(isset($_GET['id'])){
            $id=$_GET['id'];
            $sql="DELETE FROM `books` WHERE `book_id`='$id'";
            $result=mysqli_query($conn,$sql);
            $affrow=mysqli_affected_rows($conn);
            if($affrow>0){
                echo '<div class="container my-3"><div class="alert text-center alert-success alert-dismissible fade show" role="alert">
                <strong>Success : </strong> Book is deleted successfully
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
            $bookname=$_POST['ebookname'];
            $categoryname=$_POST['ecategoryname'];
            $authorname=$_POST['eauthorname'];
            $price=$_POST['eprice'];
            $numbooks=$_POST['enumbooks'];

            $sql="SELECT * FROM `categories` WHERE `category_name`='$categoryname'";
            $result=mysqli_query($conn,$sql);
            if($result){
                $row=mysqli_fetch_assoc($result);
                $category_id=$row['category_id'];
            }

            $sql="SELECT * FROM `authors` WHERE `author_name`='$authorname'";
            $result=mysqli_query($conn,$sql);
            if($result){
                $row=mysqli_fetch_assoc($result);
                $author_id=$row['author_id'];
            }


            $sql="UPDATE `books` SET `book_name`='$bookname',`book_author_id`='$author_id',`book_category_id`='$category_id',`book_price`='$price',`num_of_books`='$numbooks'  WHERE `book_id`='$eid'";
            $result=mysqli_query($conn,$sql);
            $affrow=mysqli_affected_rows($conn);
            if($affrow>0){
                echo '<div class="container my-3"><div class="alert text-center alert-success alert-dismissible fade show" role="alert">
                <strong>Success : </strong> Book is updated successfully
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
                    <h1 class="modal-title fs-5" id="editModalLabel">Update book's details</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/LMS/books/managebooks.php" method="POST">
                        <input type="hidden" name="eid" id="eid">
                        <div class="mb-3">
                            <label for="ebookname" class="form-label">Book's name</label>
                            <input type="text" class="form-control" required id="ebookname" name="ebookname"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="eauthorname" class="form-label">Author's name</label>
                            <input type="text" class="form-control" required id="eauthorname" name="eauthorname">
                            <div id="emailHelp" class="form-text">You must ensure that provided author is registered in aothors table</div>

                        </div>
                        <div class="mb-3">
                            <label for="ecategoryname" class="form-label">Category</label>
                            <input type="text" class="form-control" required id="ecategoryname" name="ecategoryname">
                            <div id="emailHelp" class="form-text">You must ensure that provided category is registered in categories table</div>

                        </div>
                        <div class="mb-3">
                            <label for="eprice" class="form-label">Book's price</label>
                            <input type="number" class="form-control" required id="eprice" name="eprice">
                        </div>
                        <div class="mb-3">
                            <label for="enumbooks" class="form-label">Number of books added</label>
                            <input type="number" class="form-control" required id="enumbooks" name="enumbooks">
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div class="container my-3">
        <h3 class="text-center">All our book's details</h3>
        <table id="mytable" class="table table-light">
            <thead>
                <tr>
                    <th scope="col">Sno</th>
                    <th scope="col">Book_id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Author</th>
                    <th scope="col">Price</th>
                    <th scope="col">No of books available</th>
                    <th scope="col">Added on</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $sql="SELECT * FROM `books`";
                    $result=mysqli_query($conn,$sql);
                    $numrow=mysqli_num_rows($result);
                    if($numrow>0){
                        $num=1;
                        while($row=mysqli_fetch_assoc($result)){
                            $category_id=$row['book_category_id'];
                            $author_id=$row['book_author_id'];

                            $catsql="SELECT * FROM `categories` WHERE `category_id`='$category_id'";
                            $catresult=mysqli_query($conn,$catsql);
                            if(mysqli_num_rows($catresult)>0){
                                $catrow=mysqli_fetch_assoc($catresult);
                            }
                            
                            $authsql="SELECT * FROM `authors` WHERE `author_id`='$author_id'";
                            $authresult=mysqli_query($conn,$authsql);
                            if(mysqli_num_rows($authresult)>0){
                                $authrow=mysqli_fetch_assoc($authresult);
                            }

                            echo '<tr>
                            <th scope="row">'.$num.'</th>
                            <td>'.$row['book_id'].'</td>
                            <td>'.$row['book_name'].'</td>
                            <td>'.$catrow['category_name'].'</td>
                            <td>'.$authrow['author_name'].'</td>
                            <td>'.$row['book_price'].'</td>
                            <td>'.$row['num_of_books'].'</td>
                            <td>'.$row['added_on'].'</td>
                            <td>
                                <button type="button" class="btn btn-dark delete" id="'.$row['book_id'].'">Delete</button>
                                <button type="button" class="btn btn-dark edit" id="e'.$row['book_id'].'" >Edit</button>
                            </td>
                        </tr>';
                                $num+=1;
                        }
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
            window.location = `/LMS/books/managebooks.php?id=${$id}`;
        } else {
            window.location = `/LMS/books/managebooks.php`;
        }
    })
})


const edit = document.getElementsByClassName('edit');
Array.from(edit).forEach((element) => {
    element.addEventListener('click', (e) => {
        $id = e.target.id.substr(1);
        document.getElementById('eid').value = $id;
        document.getElementById('ebookname').value = e.target.parentNode.parentNode
            .getElementsByTagName('td')[0].innerText;
        document.getElementById('ecategoryname').value = e.target.parentNode.parentNode
            .getElementsByTagName('td')[1].innerText;
        document.getElementById('eauthorname').value = e.target.parentNode.parentNode
            .getElementsByTagName('td')[2].innerText;
        document.getElementById('eprice').value = e.target.parentNode.parentNode.getElementsByTagName(
            'td')[3].innerText;
        document.getElementById('enumbooks').value = e.target.parentNode.parentNode
            .getElementsByTagName('td')[4].innerText;
        $('#editModal').modal('toggle');
    })
})
</script>

</html>