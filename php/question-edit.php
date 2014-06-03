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
        $value = iconv("UTF-8", "ASCII//TRANSLIT", $value);
        $_GET[$key] = mysqli_real_escape_string($con,$value);
    }

    $subject_id=$_GET['subject'];
    $course_id=$_GET['course'];
    $id=$_GET['qid'];
    $answer_array=array();
    if(isset($_GET['answera']))
        array_push($answer_array, 'a');
    if(isset($_GET['answerb']))
        array_push($answer_array, 'b');
    if(isset($_GET['answerc']))
        array_push($answer_array, 'c');
    if(isset($_GET['answerd']))
        array_push($answer_array, 'd');
    $answer=json_encode($answer_array);
    $level=$_GET['level'];

    $answer=mysqli_real_escape_string($con,$answer);

    $q="update questions set `subject_id`='".$subject_id."' 
            , `topic_id` ='".$course_id."' ,`description`='".$_GET['description']."'
            ,`pic`='".$images['pic']."',`cha`='".$_GET['cha']."',`pica`='".$images['pica']."'
            ,`chb`='".$_GET['chb']."',`picb`='".$images['picb']."',`chc`='".$_GET['chc']."'
            ,`picc`='".$images['picc']."',`chd`='".$_GET['chd']."',`picd`='".$images['picd']."'
            ,`answer`='".$answer."',`level`='".$level."' where id='".$_GET['qid']."' ";
    
    mysqli_query($con,$q);

    echo "done";



?>