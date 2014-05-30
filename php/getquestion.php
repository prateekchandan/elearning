<?php
include 'dbconnect.php';
include "encrypt.php";
    session_start();
    if(isset($_SESSION['user-email']))
        $user=$_SESSION['user-email'];
    else
        die('{error:1}');


    $q=mysqli_query($con,"select * from user where email = '".$user."'");
    if(mysqli_num_rows($q)==0)
        die('{error:1}');

    $data=$_POST;

    $user=mysqli_fetch_assoc($q);
    if(!isset($data['error'])){
    	die('{error:1}');
    }

    $data['error']=0;
    $q=mysqli_query($con , 'SELECT * FROM questions where topic_id="'.$data['topic'].'" && subject_id="'.$data['subject'].'"');
    
    if(mysqli_num_rows($q)==0){
    	$data['error']=2;
    	die(json_encode($data));
    }
    
    $filename="../users/".$user['uid'].".txt";
    
    if(!file_exists($filename)){
     $file= fopen($filename, "w");
     fwrite($file,'[]');
     fclose($file);
    }
  
  $qtext=json_decode(file_get_contents($filename),true);
    
    $all=[];
    
    while($row=mysqli_fetch_assoc($q)){
        if(!in_array($row['id'],$qtext))
        {
            array_push($all, $row);
        }


    }
    
    if(sizeof($all)==0){
        $data['error']=3;
        die(json_encode($data));    
    }
    
    $q=$all[array_rand($all)];

    $data=array_merge($data,$q);
    unset($data['answer']);
    unset($data['score']);
    unset($data['subject_id']);
    unset($data['topic_id']);
    $data['servedtime']=time();
    echo json_encode($data);

?>