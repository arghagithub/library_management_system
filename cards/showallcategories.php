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
    <h2 class="text-center my-3">All our categories of books</h2>
    <div class="container my-3">
    <table id="mytable" class="table table-light">
            <thead>
                <tr>
                    <th scope="col">Sno</th>
                    <th scope="col">category_id</th>
                    <th scope="col">Name</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        require "../partials/_dbconnect.php";
                        $sql="SELECT * from `categories`";
                        $result=mysqli_query($conn,$sql);
                        $numrows=mysqli_num_rows($result);
                        if($numrows>0){
                            $num=1;
                            while($row=mysqli_fetch_assoc($result)){
                                echo '<tr>
                                <th scope="row">'.$num.'</th>
                                <td>'.$row['category_id'].'</td>
                                <td>'.$row['category_name'].'</td>
                            </tr>';
                            $num+=1;
                            }
                        }
                        else{
                            echo '<div class="container my-3"><div class="alert text-center alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error : </strong> No categories, please add some categories
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

</html>