<?php
    include "dbconnect.php";
    session_start();
    if(isset($_SESSION['user-email']))
        $user=$_SESSION['user-email'];
    else
        die("Error in authentication");

    $q=mysqli_query($con,"select * from user where email = '".$user."'");

    if(mysqli_num_rows($q)==0)
        die("Error in authentication");

    $data=mysqli_fetch_assoc($q);

    if($data['admin']!=1)
        die("Error in authentication");

    if(!isset($_POST['subject']) || !isset($_POST['course']) )
    	die("Chose subject and courses properly");

    foreach ($_POST as $key => $value) {
    	$_POST[$key]=mysqli_real_escape_string($con,$value);
    }

    $all=mysqli_query($con,'select * from questions where subject_id="'.$_POST['subject'].'" && topic_id="'.$_POST['course'].'" ');
    
    while($row=mysqli_fetch_assoc($all)){
    	echo '<div class="well row">';
    	echo '<div class="col-md-12"><h4 style="text-transform: none;font-weight: normal;">'.$row['description'].'</h4></div>';
    	if($row['pic']!="0"){
    		echo '<img src="'.$row['pic'].'">';
    	}
    	echo '<div class="row"><div class="col-md-6"><b>A</b>. '.$row['cha'].'</div>';
    	if($row['pica']!="0"){
    		echo '<img src="'.$row['pica'].'">';
    	}
    	echo '<div class="col-md-6"><b>B</b>. '.$row['chb'].'</div></div>';
    	if($row['picb']!="0"){
    		echo '<img src="'.$row['picb'].'">';
    	}
    	echo '<div class="row"><div class="col-md-6"><b>C</b>. '.$row['chc'].'</div>';
    	if($row['picc']!="0"){
    		echo '<img src="'.$row['picc'].'">';
    	}
    	echo '<div class="col-md-6"><b>D</b>. '.$row['chd'].'</div></div>';
    	if($row['picd']!="0"){
    		echo '<img src="'.$row['picd'].'">';
    	}
    	echo '<div class="row"><a href="./edit-q.php?id='.$row['id'].'"  target=_blank class="btn btn-default btn-sm">Edit this</a></div>';
    	echo '</div>';

    }



?>
