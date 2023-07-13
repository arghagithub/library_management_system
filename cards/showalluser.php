<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <title>All users</title>
</head>

<body>
    <?php
        require "../partials/_navbar.php";
    ?>
    <h2 class="text-center my-3">Our all users</h2>
    <div class="container my-5">
        <table id="mytable" class="table table-light">
            <thead>
                <tr>
                    <th scope="col">sno</th>
                    <th scope="col">user_id</th>
                    <th scope="col">Name</th>
                    <th scope="col">Email</th>
                    <th scope="col">Phone no</th>
                    <th scope="col">Place</th>
                    <th scope="col">Joined on</th>
                </tr>
            </thead>
            <tbody>
                <?php
                        require "../partials/_dbconnect.php";
                        $sql="SELECT * from `users`";
                        $result=mysqli_query($conn,$sql);
                        $numrows=mysqli_num_rows($result);
                        if($numrows>0){
                            $num=1;
                            while($row=mysqli_fetch_assoc($result)){
                                echo '<tr>
                                <th scope="row">'.$num.'</th>
                                <td>'.$row['user_id'].'</td>
                                <td>'.$row['user_name'].'</td>
                                <td>'.$row['user_email'].'</td>
                                <td>'.$row['user_contact'].'</td>
                                <td>'.$row['user_place'].'</td>
                                <td>'.$row['joined_on'].'</td>
                            </tr>';
                            $num+=1;
                            }
                        }
                        else{
                            echo '<div class="container my-3"><div class="alert text-center alert-danger alert-dismissible fade show" role="alert">
                            <strong>Error : </strong> No users exists, please ad some users
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