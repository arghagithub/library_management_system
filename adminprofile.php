<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
    </style>
    <title>Admin Profile</title>
</head>

<body>
    <?php
        require "partials/_navbar.php";
        if(isset($_GET['adminupdate'])){
            if($_GET['adminupdate']=='true'){
                echo '<div class="container my-2"><div class="alert text-center alert-success alert-dismissible fade show" role="alert">
            <strong>Success : </strong> Profile is updated successfully
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
          </div></div>';
            }
            else{
                echo '<div class="container my-2"><div class="alert text-center alert-danger alert-dismissible fade show" role="alert">
                <strong>Error : </strong> '.$_GET['error'].'
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
              </div></div>';

            }
        }
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
                    <p>Admin is not allowed to change email address because it is used in official confidentiality purposes</p>
                    <form action="/LMS/updateadminprofile.php" method="POST">
                        <input type="hidden" id="eadminid" name="eadminid">
                        <div class="mb-3">
                            <label for="ename" class="form-label">Name</label>
                            <input type="text" class="form-control" required id="ename" name="ename"
                                aria-describedby="emailHelp">
                        </div>

                        <input type="hidden" class="form-control" value="arghagolui2001@gmail.com" required id="eemail"
                            name="eemail" aria-describedby="emailHelp">

                        <div class="mb-3">
                            <label for="epassword" class="form-label">Password</label>
                            <input type="password" class="form-control" required id="epassword" name="epassword">
                            <div id="emailHelp" class="form-text">If you don't want to change password then use your old
                                password</div>
                        </div>
                        <div class="mb-3">
                            <label for="ecpassword" class="form-label">Confirm Password</label>
                            <input type="password" class="form-control" required id="ecpassword" name="ecpassword">
                        </div>
                        <button type="submit" class="btn btn-success">Update</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <h3 class="text-center my-3">Library Mnagement System</h3>

    <div class="container my-6 d-flex justify-content-center align-items-center">
        <?php
                require "partials/_dbconnect.php";
                $admin_id=$_GET['admin_id'];
                $sql="SELECT * FROM `admin` WHERE `admin_id`='$admin_id'";
                $result=mysqli_query($conn,$sql);   
                $numofrow=mysqli_num_rows($result);
                if($numofrow>0){
                    $row=mysqli_fetch_assoc($result);
                    echo '<table class="table text-center my-4">
                    <thead>
                      <tr>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Joined on</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr>
                        <th scope="row">'.$row['admin_name'].'</th>
                        <td>'.$row['admin_email'].'</td>
                        <td>'.$row['joined_on'].'</td>
                        <td><button type="button" class="btn btn-primary update" id='.$admin_id.'>Update Profile</button></td>
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
        document.getElementById('eadminid').value = e.target.id;
        document.getElementById('ename').value = e.target.parentNode.parentNode.getElementsByTagName(
                'th')[0]
            .innerText;
        $('#updateuserModal').modal('toggle');
    })
})
</script>

</html>