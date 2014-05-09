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

    $q=mysqli_query($con,"select * from topics where topic_id='".mysqli_real_escape_string($con,$_POST['id'])."'");
        if(mysqli_num_rows($q)>0)
            die('iderr');
	 mysqli_query($con,'insert into topics (topic_id ,subject_id, name, info) values ("'.mysqli_real_escape_string($con,$_POST['id']).'","'.mysqli_real_escape_string($con,$_POST['subject']).'","'.mysqli_real_escape_string($con,$_POST['name']).'","'.mysqli_real_escape_string($con,$_POST['description']).'")');

       echo "done";
?>