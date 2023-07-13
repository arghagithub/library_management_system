<?php

    session_start();
    unset($_SESSION['adminloggedin']);

    header("Location: http://localhost/LMS/");

?>