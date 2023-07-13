<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    .container {
        height: 100vh;
    }
    </style>
    <title>My Profile</title>
</head>

<body>
    <?php
        require "partials/_navbar.php";
        ?>
    <div class="modal fade" id="updateuserModal" tabindex="-1" aria-labelledby="updateuserModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="updateuserModalLabel">Update Your profile</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="/LMS/updateuserprofile.php" method="POST">
                        <input type="hidden" id="euserid" name="euserid">
                        <div class="mb-3">
                            <label for="ename" class="form-label">Name</label>
                            <input type="text" class="form-control" required id="ename" name="ename"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="econtact" class="form-label">Contact no</label>
                            <input type="text" class="form-control" required id="econtact" name="econtact"
                                aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">User must be a Indian(+91)</div>
                        </div>
                        <div class="mb-3">
                            <label for="eplace" class="form-label">Place</label>
                            <input type="text" class="form-control" required id="eplace" name="eplace"
                                aria-describedby="emailHelp">
                        </div>
                        <div class="mb-3">
                            <label for="eemail" class="form-label">Email address</label>
                            <input type="email" class="form-control" required id="eemail" name="eemail"
                                aria-describedby="emailHelp">
                            <div id="emailHelp" class="form-text">We'll never share your email with anyone else.</div>
                        </div>
                        <div class="mb-3">
                            <label for="epassword" class="form-label">Password</label>
                            <input type="password" class="form-control" required id="epassword" name="epassword">
                            <div id="emailHelp" class="form-text">If you don't want to change password then use your old password</div>
                        </div>
                        <div class="mb-3">
                            <label for="ecpassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" required id="ecpassword" name="ecpassword">
                        </div>
                        <button type="submit" class="btn btn-success">Signup</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div class="container d-flex justify-content-center align-items-center">
        <?php
                require "partials/_dbconnect.php";
                $id=$_GET['id'];
                $sql="SELECT * FROM `users` WHERE `user_id`='$id'";
                $result=mysqli_query($conn,$sql);   
                $numofrow=mysqli_num_rows($result);
                if($numofrow>0){
                    $row=mysqli_fetch_assoc($result);
                    echo '<table class="table text-center">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Contact no</th>
                        <th scope="col">Place</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">'.$row['user_name'].'</th>
                        <td>'.$row['user_email'].'</td>
                        <td>'.$row['user_contact'].'</td>
                        <td>'.$row['user_place'].'</td>
                        <td><button type="button" class="btn btn-primary update" id='.$id.'>Update Profile</button></td>
                      </tr>
                    </tbody>
                  </table>';
                }
        ?>
    </div>
</body>


<script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
    crossorigin="anonymous">
</script>


<script>
const update = document.getElementsByClassName('update');
Array.from(update).forEach((element) => {
    element.addEventListener('click', (e) => {
        document.getElementById('euserid').value = e.target.id;
        document.getElementById('ename').value = e.target.parentNode.parentNode.getElementsByTagName('th')[0]
            .innerText;
        document.getElementById('eemail').value = e.target.parentNode.parentNode.getElementsByTagName('td')[0]
            .innerText;
        document.getElementById('econtact').value = e.target.parentNode.parentNode.getElementsByTagName('td')[1]
            .innerText;
        document.getElementById('eplace').value = e.target.parentNode.parentNode.getElementsByTagName('td')[2]
            .innerText;
        $('#updateuserModal').modal('toggle');
    })
})
</script>

</html>