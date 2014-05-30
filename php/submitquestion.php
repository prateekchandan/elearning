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
   $user=mysqli_fetch_assoc($q);
    $data=$_POST;

    $all_topic_level=json_decode($user['topic_level'],true);
    $topic_level=$all_topic_level[$data['topic']];

  $currtime=time();
  $diff=($currtime-$data['time']);

  $response=$_POST['response'];
  $qid=mysqli_real_escape_string($con,$_POST['id']);

  $correct=0;

  $query=mysqli_query($con,'select answer from questions where id="'.$qid.'"');
  if(mysqli_num_rows($query)==0){
  	$data['response']="No Question found";
  }
  else{
  	$accuracy=json_decode($user['accuracy'],true);
  	if(isset($accuracy[$data['topic']])){
  		$last20=$accuracy[$data['topic']];
  	}
  	else
  		$last20=array();

  	
  	if(sizeof($last20)==0){
  		for ($i=1; $i <= 20; $i++) { 
  			$last20[$i]=0;
  		}

  	}
  	else{
  		for ($i=20; $i > 1; $i--) { 
  			$j=$i-1;
  			$last20[$i]=$last20[$j];
  		}
  	}
  	if(strtolower($response)==mysqli_fetch_assoc($query)['answer']){
  		$correct=1;
  		$data['response']="Correct Answer !❀";
  		$last20['1']=1;
  	}
  	else{
  		$data['response']="Oops Wrong Answer!";
  		$last20['1']=0;
  	}

  	$accuracy[$data['topic']]=$last20;
  	mysqli_query($con,'update user set accuracy="'.mysqli_real_escape_string($con,json_encode($accuracy)).'" where uid="'.$user['uid'].'"');
  	if($correct){
	  	$correctnes=0;
	  	for ($i=1; $i <=(10+ $topic_level); $i++) { 
	  		if($last20[$i]==1){
	  			$correctnes++;
	  		}
	  	}
	  	$correctnes=($correctnes/(10+ $topic_level))*100;
	  	if($correctnes>=80){
	  		$data['response'].="<br> Congrats Your level for this topic is increased you are now at level ".($topic_level+1);
	  		$all_topic_level[$data['topic']]=$topic_level+1;

	  		mysqli_query($con,'update user set topic_level="'.mysqli_real_escape_string($con,json_encode($all_topic_level)).'" , accuracy="{}" where uid="'.$user['uid'].'"');
	  	}

  	}
  }
  $filename="../users/".$user['uid'].".txt";
  if(!file_exists($filename)){
	 $file= fopen($filename, "w");
	 fwrite($file,'[]');
	 fclose($file);
  }
  $qtext=json_decode(file_get_contents($filename),true);
  if($correct){
  	array_push($qtext, $qid);

  	 $file= fopen($filename, "w");
	 fwrite($file,json_encode($qtext));
	 fclose($file);

  }

   echo json_encode($data);
?>