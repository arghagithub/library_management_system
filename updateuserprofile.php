<?php
    require "partials/_dbconnect.php";
    if($_SERVER['REQUEST_METHOD']=='POST'){
        


        if(isset($_POST['euserid'])){
            $eid=$_POST['euserid'];
            $eusername=$_POST['ename'];
            $eemail=$_POST['eemail'];
            $epassword=$_POST['epassword'];
            $ecpassword=$_POST['ecpassword'];
            $econtact=$_POST['econtact'];
            $eplace=$_POST['eplace'];
            $sql="SELECT * FROM `users` WHERE `user_email`='$eemail'";
            $result=mysqli_query($conn,$sql);
            $numofrow=mysqli_num_rows($result);
            if($numofrow>0){
                if($epassword == $ecpassword){
                    $hashedpassword=password_hash($epassword,PASSWORD_BCRYPT);
                    $sql="UPDATE `users` SET `user_name`='$eusername',`user_email`='$eemail', `user_password`='$hashedpassword', `user_contact`='$econtact',`user_place`='$eplace' WHERE `user_id`='$eid';";
                    $result=mysqli_query($conn,$sql);
                    $affrow=mysqli_affected_rows($conn);
                    if($affrow>0){
                        header("Location: http://localhost/LMS/?update=true");
                    }
                }
                else{
                    header("Location: http://localhost/LMS/?update=false&error=passwords do not match with each other");
                    exit;
                }
            }
        }
    }
?>