<?php

//fetch_data.php

include('database_connection.php');

if(isset($_POST["action"]))
{
	$query = "
		SELECT * FROM listing WHERE status = '1'
	";
	if(isset($_POST["minimum_price"], $_POST["maximum_price"]) && !empty($_POST["minimum_price"]) && !empty($_POST["maximum_price"]))
	{
		$query .= "
		 AND rent BETWEEN '".$_POST["minimum_price"]."' AND '".$_POST["maximum_price"]."'
		";
	}
	if(!empty($_POST["location"]) && isset($_POST["location"]))
	{
		//$location_filter = implode("','", $_POST["location"]);
		$stripped = str_replace(' ', '',$_POST["location"]);
		if(!empty($stripped)){
		$query .= "
		 AND location IN('".$stripped."')
		";}
	}
	if(isset($_POST["pt"]))
	{
		$pt_filter = implode("','", $_POST["pt"]);
		$query .= "
		 AND type IN('".$pt_filter."')
		";
	}
	if(isset($_POST["bed"]))
	{
		$pt_filter = implode("','", $_POST["bed"]);
		$query .= "
		 AND bed IN('".$pt_filter."')
		";
	}
	if(isset($_POST["bath"]))
	{
		$pt_filter = implode("','", $_POST["bath"]);
		$query .= "
		 AND bath IN('".$pt_filter."')
		";
	}


	
	$statement = $connect->prepare($query);
	$statement->execute();
	$result = $statement->fetchAll();
	$total_row = $statement->rowCount();
	$output = '';
	if($total_row > 0)
	{
		foreach($result as $row)
		{
			$output .= '
			<div class="col-sm-4 col-lg-3 col-md-3">
				<div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:450px; ">
					<img src="'. $row['pimage'] .'" alt="" class="img-responsive" >
					<p align="center"><strong><a href="view.php?id='.$row['id'].'">'. $row['title'] .'</a></strong></p>
					<h4 style="text-align:center;" class="text-danger" >'. $row['rent'] .'</h4>
					<p>Location : '. $row['location'].'<br />
					Property Type : '. $row['type'] .' <br />
					Bedroom (s) : '. $row['bed'] .' <br />
					Bathroom (s) : '. $row['bath'] .' <br />
					Contact Number : '. $row['phone'] .' </p>
				</div>

			</div>
			';
		}
	}
	else
	{
		$output = '<h3>No Data Found</h3>';
	}
	echo $output;
}


?>