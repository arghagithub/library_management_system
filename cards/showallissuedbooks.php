<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <title>All issued books</title>
</head>

<body>
    <?php
        require "../partials/_navbar.php";
    ?>
    <h2 class="text-center my-3">All issued books</h2>
    <div class="container my-3">
        <table id="mytable" class="table table-light">
            <thead>
                <tr>
                    <th scope="col">Sno</th>
                    <th scope="col">book id</th>
                    <th scope="col">book name</th>
                    <th scope="col">category</th>
                    <th scope="col">author</th>
                    <th scope="col">user name</th>
                    <th scope="col">issued date</th>
                    <th scope="col">due date</th>
                    <th scope="col">returned ?</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    require "../partials/_dbconnect.php";
                    $sql="SELECT * FROM `issued_books`";
                    $result=mysqli_query($conn,$sql);
                    $numrow=mysqli_num_rows($result);
                    if($numrow>0){
                        $num=1;
                        while($row=mysqli_fetch_assoc($result)){
                            $category_id=$row['category_id'];
                            $author_id=$row['author_id'];
                            $user_id=$row['user_id'];

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

                            $usersql="SELECT * FROM `users` WHERE `user_id`='$user_id'";
                            $userresult=mysqli_query($conn,$usersql);
                            if(mysqli_num_rows($userresult)>0){
                                $userrow=mysqli_fetch_assoc($userresult);
                            }

                            if($row['is_returned']==1){$isreturn="Yes";}else{$isreturn="No";}

                            echo '<tr>
                            <th scope="row">'.$num.'</th>
                            <th scope="row">'.$row['book_id'].'</th>
                            <td>'.$row['book_name'].'</td>
                            <td>'.$catrow['category_name'].'</td>
                            <td>'.$authrow['author_name'].'</td>
                            <td>'.$userrow['user_name'].'</td>
                            <td>'.$row['issued_date'].'</td>
                            <td>'.$row['due_date'].'</td>
                            <td>'.$isreturn.'</td>
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