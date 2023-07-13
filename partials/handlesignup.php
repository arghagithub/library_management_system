<?php

    require "_dbconnect.php";
    require "../secret.php";
    if($_SERVER['REQUEST_METHOD']=='POST'){
            if($_POST['email']==$personal_email){
                $admin_name=$_POST['name'];
                $admin_email=$_POST['email'];
                $admin_password=$_POST['password'];
                $admin_cpassword=$_POST['cpassword'];
                $sql="SELECT * FROM `admin` WHERE `admin_email`='$admin_email'";
                $result=mysqli_query($conn,$sql);
                $numofrow=mysqli_num_rows($result);
                if($numofrow>0){
                    header("Location: http://localhost/LMS/?adminsignup=false&error=admin already exists");
                    exit;
                }
                else{
                    if($admin_password == $admin_cpassword){
                        $hashedpassword=password_hash($admin_password,PASSWORD_BCRYPT);
                        $sql="INSERT INTO `admin` (`admin_name`,`admin_email`, `admin_password`) VALUES ('$admin_name','$admin_email','$hashedpassword');";
                        $result=mysqli_query($conn,$sql);
                        if($result){
                            header("Location: http://localhost/LMS/?adminsignup=true");
                        }
                    }
                    else{
                        header("Location: http://localhost/LMS/?adminsignup=false&error=passwords do not match with each other");
                        exit;
                    }
        
                }

            }
            else{
                $username=$_POST['name'];
                $email=$_POST['email'];
                $password=$_POST['password'];
                $cpassword=$_POST['cpassword'];
                $contact=$_POST['contact'];
                $place=$_POST['place'];
                $sql="SELECT * FROM `users` WHERE `user_email`='$email'";
                $result=mysqli_query($conn,$sql);
                $numofrow=mysqli_num_rows($result);
                if($numofrow>0){
                    header("Location: http://localhost/LMS/?signup=false&error=user already exists");
                    exit;
                }
                else{
                    if($password == $cpassword){
                        $hashedpassword=password_hash($password,PASSWORD_BCRYPT);
                        $sql="INSERT INTO `users` (`user_name`,`user_email`, `user_password`, `user_contact`,`user_place`) VALUES ('$username','$email','$hashedpassword','$contact','$place');";
                        $result=mysqli_query($conn,$sql);
                        if($result){
                            header("Location: http://localhost/LMS/?signup=true");
                        }
                    }
                    else{
                        header("Location: http://localhost/LMS/?signup=false&error=passwords do not match with each other");
                        exit;
                    }
        
                }
            }
    }

?>