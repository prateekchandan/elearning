<?php
    include "dbconnect.php";
    session_start();
    if(isset($_SESSION['user-email']))
        $user=$_SESSION['user-email'];
    else
        die('error');

    $q=mysqli_query($con,"select * from user where email = '".$user."'");
    if(mysqli_num_rows($q)==0)
        die('error');

    $data=mysqli_fetch_assoc($q);

    if($data['admin']!=1)
        hdie('error');

    if(!isset($_POST['id']))
        die('error');

    $qid=mysqli_real_escape_string($con,$_POST['id']);

    $q=mysqli_query($con,"select * from questions where id = '".$qid."'");

    if(mysqli_num_rows($q)==0)
        die('error');

     $question=mysqli_fetch_assoc($q);

     if($question['pic']!='0')
        unlink(".".$question['pic']);
    if($question['pica']!='0')
        unlink(".".$question['pica']);
    if($question['picb']!='0')
        unlink(".".$question['picb']);
    if($question['picc']!='0')
        unlink(".".$question['picc']);
    if($question['picd']!='0')
        unlink(".".$question['picd']);
    
    $q=mysqli_query($con,"delete from questions where id = '".$qid."'");
    echo 'done';

?>