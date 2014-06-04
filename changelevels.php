<?php
	include "php/dbconnect.php";
	function cmp($a, $b)
		{
		    return $a['ratio'] - $b['ratio'];
		}
	$topic_query=mysqli_query($con,'select * from topics');
	while ($row=mysqli_fetch_assoc($topic_query)) {
		$topic=$row['topic_id'];
		$q=mysqli_query($con,"select * from questions where topic_id='".$topic."' && attempt !=0"); // 
		$total=mysqli_num_rows($q);
		$rem= $total% 7;
		$eq=($total-$rem)/7;

		$allq=array();

		while($que=mysqli_fetch_assoc($q)){
			$que['ratio'] = $que['correct']/$que['attempt'];
			array_push($allq, $que);
		}

		usort($allq, "cmp");
		$lev=1;
		$count=0;
		
		foreach ($allq as $key) {
			
			if($count > (($lev * $eq)+$rem)){
				$lev++;
			}
			mysqli_query($con,"update questions set level = '".$lev."' where id='".$key['id']."'");
			$count++;
		}
	}
	header("Location:./");
?>