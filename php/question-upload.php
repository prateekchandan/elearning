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

    $images=array();
    $imfiles=['pic','pica','picb','picc','picd'];
    foreach ($imfiles as $key) {
        if($_FILES[$key]['error']==0){
            $type=substr($_FILES[$key]['type'],0,5);
            if($type!="image")
            die("File is possibly not an image");

            if($_FILES[$key]['size']>3*1024*1024)
            die("Image exceeds maximum limit of 3 MB");

            $name= substr( "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ" ,mt_rand( 0 ,50 ) ,1 ) .substr( md5( time() ), 1);
            $uploaddir = '../img/questionpic/';
            $uploadfile = $uploaddir.$name.".png";
            $images[$key] = './img/questionpic/'.$name.".png";

            if (move_uploaded_file($_FILES[$key]['tmp_name'], $uploadfile)) {
            } 
            else {
                die( "Error ! Some image cant be uploaded");
            }
        }
        else
        {
            $images[$key]=0;
        }
    }
    foreach ($_GET as $key => $value) {
        $_GET[$key]=$str = iconv("UTF-8", "ASCII//TRANSLIT", $value);
    }
    if($stmt = $mysqli->prepare("insert into questions (`id`,`subject_id`,`topic_id`,`description`,`pic`,`cha`,`pica`,`chb`,`picb`,`chc`,`picc`,`chd`,`picd`,`answer`,`level`) values (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)"))
    {

    $stmt->bind_param('ssssssssssssssi', $id, $subject_id, $course_id,$_GET['description'],$images['pic'],$_GET['cha'],$images['pica'],$_GET['chb'],$images['picb'],$_GET['chc'],$images['picc'],$_GET['chd'],$images['picd'],$answer,$level);

    $n=mysqli_fetch_assoc(mysqli_query($con,"select * from envar where `key`='qno'"))['value'];
    $subject_id=$_GET['subject'];
    $course_id=$_GET['course'];
    $id=$subject_id.$course_id.$n;
    $answer=$_GET['answer'];
    $level=1;
    
    $stmt->execute();
    echo "done";
    mysqli_query($con,"update envar set value='".($n+1)."' where `key`='qno'");
    }
    else{
        echo "failed";
    }

?>