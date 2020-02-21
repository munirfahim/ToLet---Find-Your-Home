 <?php

    session_start();
    //include('database_connection.php');
    //connection variables

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
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
    <link href="css/form.css" rel="stylesheet">
</head>
<body>
	<header>
       <div class="container">
         <div id="branding">
          <h1><span class="highlight">ToLet</span> - Find Your Home</h1>
         </div>
        <nav>
          <ul>
            <li><a href="index.php">Home</a></li>
            <li class="current">
                <?php
                if(isset($_SESSION['username'])) {
                    print("<a href=\"profile.php\">Hi, ".$_SESSION['username']."</a>");
                }
                else{
                 print("<a href=\"login.php\">Login</a>");
                }
            ?></li>
            <li class="button1"><a href="createad.php"> List Your Property</a></li>
          </ul>
         </nav>
       </div>
    </header> 

    <div class="body content">
<div class="welcome">
	<div style="float:right">
        <a href="logout.php" class="btn btn-info btn-lg">
          <span class="glyphicon glyphicon-log-out"></span> Log out
        </a>
</div>
<div class="alert alert-success"><?= $_SESSION['message'] ?></div>
    <img src="<?= $_SESSION['avatar'] ?>"><br />
    Welcome <span class="user"><?= $_SESSION['username'] ?></span>
    <?php
    $mysqli = new mysqli("localhost", "root", "", "project");
    $sql = "SELECT * FROM listing where owner= '".$_SESSION['username']."'";
    //echo $sql;
    //$result = mysqli_result object
    $result = $mysqli->query( $sql ); 
    ?>
    <div id='registered'>
    <h1>Your Listings:</h1>
    <br>
    <?php
    //returns associative array of fetched row
    while( $row = $result->fetch_assoc() ){ 
        echo '
			<div class="col-sm-4 col-lg-3 col-md-3">
				<div style="border:1px solid #ccc; border-radius:5px; padding:16px; margin-bottom:16px; height:450px;">
					<img src="'. $row['pimage'] .'" alt="" class="img-responsive" >
					<p align="center"><strong><a href="view.php?id='.$row['id'].'">'. $row['title'] .'</a></strong></p>
					<h4 style="text-align:center;" class="text-danger" >'. $row['rent'] .'</h4>
					<p>Bedrooms : '. $row['bed'].'<br />
					Location : '. $row['location'] .' <br />
					Property Type : '. $row['type'] .' <br />
					Contact Number : '. $row['phone'] .' </p>
					<div style="float:center">
<form align="center" name="form1" method="post" action="delete.php">
  <label class="logoutLblPos">
  <input type="hidden" name="id" value="'.$row['id'].'"/>
  <input name="submit2" type="submit" id="submit2" value="Delete" class="btn btn-danger">
  </label>
</form>
</div>

				</div>

			</div>
			';
    }
?>  
</div>
</div>
</div>