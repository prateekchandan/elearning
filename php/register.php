<?php
	include "dbconnect.php";
	include "encrypt.php";
	
	foreach ($_POST as $key => $value) {
		$_POST[$key]=mysqli_real_escape_string($con,$_POST[$key]);
	}

	if($_POST['password']!=$_POST['repassword'])
	{
		die("passnotmatch");
	}
	if(strlen($_POST['password'])<8)
	{
		die("passworderr");
	}
	$q=mysqli_query($con,"select * from user where email = '".$_POST['email']."'");
	if(mysqli_num_rows($q)>0){
		die('emailerr');
	}
		echo 'done';

	mysqli_query($con,"insert into user (`name`,`email`,`password`) values ('".$_POST['name']."' , '".$_POST['email']."' , '".encrypt_decrypt('encrypt',$_POST['password'])."')");

?>
