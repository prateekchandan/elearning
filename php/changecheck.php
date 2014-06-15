<?php

    include "dbconnect.php";
    session_start();
    if(isset($_SESSION['user-email']))
        $user=$_SESSION['user-email'];
    else
        die("error");

    $q=mysqli_query($con,"select * from user where email = '".$user."'");
    if(mysqli_num_rows($q)==0)
        die("error");

    $data=mysqli_fetch_assoc($q);

    if($data['admin']!=1)
        die("error"); 
    
    $id=mysqli_real_escape_string($con,$_POST['id']);

    mysqli_query($con,'UPDATE questions SET checked = IF(checked=1, 0, 1) where id="'.$id.'"');

?>