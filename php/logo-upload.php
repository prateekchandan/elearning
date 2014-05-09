<?php


    include "dbconnect.php";
    session_start();
    if(isset($_SESSION['user-email']))
        $user=$_SESSION['user-email'];
    else
        die("Please login to continue");


    $q=mysqli_query($con,"select * from user where email = '".$user."'");
    if(mysqli_num_rows($q)==0)
        die("Please login to continue");

	$type=substr($_FILES['img']['type'],0,5);
	if($type!="image")
		die("File is possibly not an image");
	if($_FILES['img']['size']>3*1024*1024)
		die("Image exceeds maximum limit of 3 MB");
    $data=mysqli_fetch_assoc($q);
    if($data['fotopath']==''){
		$name= substr( "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" ,mt_rand( 0 ,50 ) ,1 ) .substr( md5( time() ), 1);
		$uploaddir = '../img/profilepics/';
		$uploadfile = $uploaddir.$name.".png";
		$dbfile = './img/profilepics/'.$name.".png";
    }
	else{
		$name=$data['fotopath'];
		$uploadfile = ".".$name;
		$dbfile = $name;
	}

   
	if (move_uploaded_file($_FILES['img']['tmp_name'], $uploadfile)) {
		mysqli_query($con,"update user set fotopath='".$dbfile."' where email='".$user."'");
	    echo "done";
	} else {
	    echo "Possible file upload attack!\n";
	}

?>