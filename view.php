<?php

    session_start();
    include('database_connection.php');
    //connection variables
    $mysqli = new mysqli("localhost", "root", "","project");
    if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);}

	$s1=$_GET["id"];

	$select_query="select * from listing where id='".$s1."'";
	$sql=mysqli_query($mysqli,$select_query) or die (mysqli_error());
	$s="";
                if (mysqli_num_rows($sql) > 0) {
                // output data of each row
                $row = mysqli_fetch_assoc($sql);
            }
	else
echo "No Data Found";

    ?>



<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Cheap flats rooms accommodation inside Dhaka">
	 <meta name="keywords" content="Flat, Rent, Dhaka">
  	<meta name="author" content="Sirajum Munir Fahim">
	<title>ToLet - Find Your Home</title>
	<script src="js/jquery-1.10.2.min.js"></script>
    <script src="js/jquery-ui.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="css/bootstrap.min.css">
    <link href = "css/jquery-ui.css" rel = "stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed|Rubik" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700" rel="stylesheet">
    <link href="css/style.css" rel="stylesheet">
    <link href="css/view.css" rel="stylesheet">
</head>
<body>
	<header>
       <div class="container">
         <div id="branding">
          <h1><span class="highlight">ToLet</span> - Find Your Home</h1>
         </div>

        <nav>
          <ul>
            <li class="current"><a href="index.php">Home</a></li>
            <li>
                <?php
                if(isset($_SESSION['username'])) {
                    print("<a href=\"profile.php\">Hi, ".$_SESSION['username']."</a></li>
            <li id=\"adbutton\"><a href=\"createad.php\"> List Your Property</a></li>");
                }
                else{
                 print("<a href=\"login.php\">Login</a>");
                }
            ?>
          </ul>
         </nav>
       </div>
    </header> 
    <div class="container">
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
					<div class="preview col-md-6">
						<h3 class="product-title"><?php echo $row['title']; ?></h3>
						<div class="rating">
							<span class="review-no"><?php echo $row['location']; ?></span>
						</div>
						<div class="preview-pic tab-content">
						  <div class="tab-pane active" id="pic-1"><img src= <?php echo "'".$row['pimage']."'"; ?>/></div>
						  <div class="tab-pane" id="pic-2"><img src=<?php echo "'".$row['simage1']."'"; ?>/></div>
						  <div class="tab-pane" id="pic-3"><img src=<?php echo "'".$row['simage2']."'"; ?>/></div>
						</div>
						<ul class="preview-thumbnail nav nav-tabs">
						  <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src=<?php echo "'".$row['pimage']."'"; ?> /></a></li>
						  <li><a data-target="#pic-2" data-toggle="tab"><img src=<?php echo "'".$row['simage1']."'"; ?>/></a></li>
						  <li><a data-target="#pic-3" data-toggle="tab"><img src=<?php echo "'".$row['simage2']."'"; ?>/></a></li>
						</ul>
						
					</div>
					<div class="details col-md-6">
						<br><br><br>
						<h4 class="price">Description </h4>
						<p class="product-description"><?php echo $row['det']; ?></p>
						<h4 class="price">Rent: <span><?php echo $row['rent']; ?> BDT</span></h4>
						<h5 class="sizes">Property Type:
							<span class="size" data-toggle="tooltip" title="small"><?php echo $row['type'];?></span></h5>
						<h5 class="sizes">Area:
							<span class="size" data-toggle="tooltip" title="small"><?php echo $row['area'];?> sqft</span></h5>
						<h5 class="sizes">Bedroom (s):
							<span class="size" data-toggle="tooltip" title="small"><?php echo $row['bed']; ?></span></h5>
						<h5 class="sizes">Bathroom (s):
							<span class="size" data-toggle="tooltip" title="small"><?php echo $row['bath']; ?></span>
						</h5>
						<h5 class="price">Detailed Location </h5>
						<p class="product-description"><?php echo $row['detloc']; ?></p>
						<h4 class="sizes">Contact Number:
							<span class="size" data-toggle="tooltip" title="small"><?php echo $row['phone'];?> </span></h4>
						
					</div>
				</div>
			</div>
		</div>
	</div>
  </body>
</html>
