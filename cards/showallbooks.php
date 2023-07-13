<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <title>All books</title>
</head>

<body>
    <?php
        require "../partials/_navbar.php";
    ?>
    <h2 class="text-center my-3">All our books</h2>
    <div class="container my-3">
        <table id="mytable" class="table table-light">
            <thead>
                <tr>
                    <th scope="col">Sno</th>
                    <th scope="col">book_id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Category</th>
                    <th scope="col">Author</th>
                    <th scope="col">Price</th>
                    <th scope="col">No of books available</th>
                    <th scope="col">Added on</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require "../partials/_dbconnect.php";
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

</html>