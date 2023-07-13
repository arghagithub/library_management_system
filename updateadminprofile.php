<?php
require "partials/_dbconnect.php";
if($_SERVER['REQUEST_METHOD']=='POST'){
    if(isset($_POST['eadminid'])){
        $eid=$_POST['eadminid'];
        $eadminname=$_POST['ename'];
        $eemail=$_POST['eemail'];
        $epassword=$_POST['epassword'];
        $ecpassword=$_POST['ecpassword'];
    
        $sql="SELECT * FROM `admin` WHERE `admin_id`='$eid'";
        $result=mysqli_query($conn,$sql);
        $numofrow=mysqli_num_rows($result);
        if($numofrow>0){
            if($epassword == $ecpassword){
                $hashedpassword=password_hash($epassword,PASSWORD_BCRYPT);
                $sql="UPDATE `admin` SET `admin_name`='$eadminname', `admin_password`='$hashedpassword' WHERE `admin_id`='$eid' AND `admin_email`='$eemail';";
                $result=mysqli_query($conn,$sql);
                $affrow=mysqli_affected_rows($conn);
                if($affrow>0){
                    header('Location: http://localhost/LMS/adminprofile.php?admin_id='.$eid.'&adminupdate=true');
                }
            }
            else{
                header('Location: http://localhost/LMS/adminprofile.php?admin_id='.$eid.'&adminupdate=false&error=passwords do not match with each other');
                exit;
            }
        }
    }
}


?>