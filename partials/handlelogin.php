<?php
    session_start();
    require "_dbconnect.php";
    require "../secret.php";

    if($_SERVER['REQUEST_METHOD']=='POST'){
        if($_POST['email']==$personal_email){
            $admin_email=$_POST['email'];
            $admin_password=$_POST['password'];
            $sql="SELECT * FROM `admin` WHERE `admin_email`='$admin_email'";
            $result=mysqli_query($conn,$sql);
            $numofrow=mysqli_num_rows($result);
            $row=mysqli_fetch_assoc($result);
            if($numofrow>0){
                if(password_verify($admin_password,$row['admin_password'])){
                    $_SESSION['admin_id']=$row['admin_id'];
                    $_SESSION['admin_name']=$row['admin_name'];
                    $_SESSION['adminloggedin']=true;
                    header("Location: http://localhost/LMS/?adminlogin=true");
                }
                else{
                    header("Location: http://localhost/LMS/?adminlogin=false&error=wrong admin(password) credentials");
                }
            }
            else{
                header("Location: http://localhost/LMS/?adminlogin=false&error=wrong admin(no admin) credentials");
            }
        }
        else{
            $email=$_POST['email'];
            $password=$_POST['password'];
            $sql="SELECT * FROM `users` WHERE `user_email`='$email'";
            $result=mysqli_query($conn,$sql);
            $numofrow=mysqli_num_rows($result);
            $row=mysqli_fetch_assoc($result);
            if($numofrow>0){
                if(password_verify($password,$row['user_password'])){
                    $_SESSION['user_id']=$row['user_id'];
                    $_SESSION['user_name']=$row['user_name'];
                    $_SESSION['loggedin']=true;
                    header("Location: http://localhost/LMS/?login=true");
                }
                else{
                    header("Location: http://localhost/LMS/?login=false&error=wrong user credentials");
                }
            }
            else{
                header("Location: http://localhost/LMS/?login=false&error=wrong user credentials");
            }
        }
    }

?>