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
    $type=substr($_FILES['img']['type'],0,5);

    if($type!="image")
        die( "imgerror");

    if($_FILES['img']['size']>3*1024*1024)
        die( "imgerror");

    $name= $_GET['name'];

    $uploaddir = '../img/subjectimg/';
    $uploadfile = $uploaddir.$name.".png";

    if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile)) {
        $q=mysqli_query($con,"select * from subjects where subject_id='".mysqli_real_escape_string($con,$_GET['id'])."'");
        if(mysqli_num_rows($q)>0)
            die('iderr');

        mysqli_query($con,'insert into subjects (subject_id , name , info) values ("'.mysqli_real_escape_string($con,$_GET['id']).'","'.mysqli_real_escape_string($con,$_GET['name']).'","'.mysqli_real_escape_string($con,$_GET['description']).'")');

        echo "done";
    } 
    else {
        die( "imgerror");
    }
        

?>