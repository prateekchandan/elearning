<?php
  include 'dbconnect.php';
  include "encrypt.php";
  //USING SESSION TO CHECK LOGIN
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
  // FINDING LEVEL OF USER IN CURRENT TOPIC
  $all_topic_level=json_decode($user['topic_level'],true);
  $topic_level=$all_topic_level[$data['topic']];

  // CALCULATING TIME TAKEN 
  $currtime=time();
  $diff=($currtime-$data['time']);

  // CREATING THE ANSWER ARRAY
  $response=json_decode($_POST['response'],true);
  $qid=mysqli_real_escape_string($con,$_POST['id']);

  $correct=1;
  // PREVENTING SQL INJECTION
  foreach ($data as $key => $value) {
    $data[$key]=mysqli_real_escape_string($con,$value);
  }

  $query=mysqli_query($con,'select answer from questions where id="'.$qid.'"');
  
  if(mysqli_num_rows($query)==0){
  	$data['response']="No Question found";
  }
  else
  {
  	$accuracy=json_decode($user['accuracy'],true);
    // Setting up the accuracy
  	if(isset($accuracy[$data['topic']]))
    {
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
    // SHIFTED THE ACCURACY

    // NOW CHECKING THE ANSWER
    $answer=json_decode(mysqli_fetch_assoc($query)['answer'],true);
    foreach ($answer as $key) {
      if(!in_array($key, $response)){
        $correct=0;
      }
    }
    foreach ($response as $key) {
      if(!in_array($key, $answer)){
        $correct=0;
      }
    }
  	if($correct){
  		$data['response']="Correct Answer !❀";
  		if($diff<=(120+(60*$topic_level)))
  			$last20['1']=1;
  		else
  			$last20['1']=0;
  	}
  	else{
  		$data['response']="Oops Wrong Answer!";
  		$last20['1']=0;
  	}

  	$accuracy[$data['topic']]=$last20;
  	mysqli_query($con,'update user set accuracy="'.mysqli_real_escape_string($con,json_encode($accuracy)).'" where uid="'.$user['uid'].'"');
    mysqli_query($con,'update questions set attempt=attempt+1 where id="'.$qid.'"');

    $filename="../users/".$user['uid'].".txt";

    if(!file_exists($filename))
    {
     $file= fopen($filename, "w");
     fwrite($file,'[]');
     fclose($file);
    }
    $qtext=json_decode(file_get_contents($filename),true);
    if($correct)
    {
      array_push($qtext, $qid);

       $file= fopen($filename, "w");
     fwrite($file,json_encode($qtext));
     fclose($file);
    }
    if($correct)
    {
      mysqli_query($con,'update questions set correct=correct+1 where id="'.$qid.'"');

      $correctnes=0;
      for ($i=1; $i <=(10+ $topic_level); $i++) { 
        if($last20[$i]==1){
          $correctnes++;
        }
      }
      
      $correctnes=($correctnes/(10+ $topic_level))*100;
      /************* TO CHECK IF ALL QUESTION FINISHED INCREASE LEVEL  **/
      $q=mysqli_query($con , 'SELECT * FROM questions where topic_id="'.$data['topic'].'" && subject_id="'.$data['subject'].'" && level="'.$topic_level.'"');
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
      /******************************/
      if($correctnes>=80||sizeof($all)==0){
        $data['response'].="<br> Congrats Your level for this topic is increased you are now at level ".($topic_level+1);
        $all_topic_level[$data['topic']]=$topic_level+1;

        mysqli_query($con,'update user set topic_level="'.mysqli_real_escape_string($con,json_encode($all_topic_level)).'" , accuracy="{}" where uid="'.$user['uid'].'"');

        $data['error']=2;
      }

    }
  }
    

   echo json_encode($data);
?>