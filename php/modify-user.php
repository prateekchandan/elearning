<?php
    include "dbconnect.php";
    session_start();
    if(isset($_SESSION['user-email']))
        $user=$_SESSION['user-email'];
    else
        die("Error in authentication");

    $q=mysqli_query($con,"select * from user where email = '".$user."'");

    if(mysqli_num_rows($q)==0)
        die("Error in authentication");

    $data=mysqli_fetch_assoc($q);

    if($data['admin']!=1)
        die("Error in authentication");

    if(!isset($_POST['action'])) {
        die("Error in authentication");
    }

    $id=mysqli_real_escape_string($con,$_POST['id']);
    switch($_POST['action']){
        case 'delete':
            mysqli_query($con,'delete from user where uid='.$id);
            break;
        case 'role':
            mysqli_query($con,'update user set admin='.mysqli_real_escape_string($con,$_POST['role']).' where uid='.$id);
            echo 'done';
            break;
        default:
        die("Error in modifying");

    }

?>