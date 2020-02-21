 <?php

    session_start();
    $_SESSION['pmessage'] = '';
    //include('database_connection.php');
    //connection variables


if(!isset($_SESSION['username'])) {
      $_SESSION['loginmsg'] = "Please Login First";
      header("location: login.php");
      exit();
                }
    

    //create mysql connection
    $mysqli = new mysqli("localhost", "root", "","project");
    if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);}



 if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
            
        
        //define other variables with submitted values from $_POST
        $title = $mysqli->real_escape_string($_POST['title']);
        $type = $mysqli->real_escape_string($_POST['type']);
        $rent = $mysqli->real_escape_string($_POST['rent']);
        $area = $mysqli->real_escape_string($_POST['area']);
        $bed = $mysqli->real_escape_string($_POST['bed']);
        $bath = $mysqli->real_escape_string($_POST['bath']);
        $location = $mysqli->real_escape_string($_POST['location']);
        $detloc = $mysqli->real_escape_string($_POST['detloc']);
        $det = $mysqli->real_escape_string($_POST['det']);

        //path were our avatar image will be stored
        $pavatar_path = $mysqli->real_escape_string('image/'.time().rand(100,20000).$_FILES['pavatar']['name']);
        $savatar1_path="";
        $savatar2_path="";
        $savatar1_path = $mysqli->real_escape_string('image/'.time().rand(100,20000).$_FILES['savatar1']['name']);
        $savatar2_path = $mysqli->real_escape_string('image/'.time().rand(100,20000).$_FILES['savatar2']['name']); 

        if(!is_numeric($rent))
              $_SESSION['pmessage']="Rent can only be number";
            else if(!is_numeric($area))
              $_SESSION['pmessage']="Please only enter area in number of square feet";
            else{
        
        //make sure the file type is image
        if (preg_match("!image!",$_FILES['pavatar']['type']) && preg_match("!image!",$_FILES['savatar1']['type']) && preg_match("!image!",$_FILES['savatar2']['type']))
        {
            
            //copy image to image/ folder 
            if (copy($_FILES['pavatar']['tmp_name'], $pavatar_path) && copy($_FILES['savatar1']['tmp_name'], $savatar1_path) && copy($_FILES['savatar2']['tmp_name'], $savatar2_path)){
                //set session variables to display on welcome page
                $phone= $_SESSION['phone'];
                $owner= $_SESSION['username'];
                //insert user data into database
                $sql = 
                "INSERT INTO listing (title, type, rent, area, bed, bath, location, detloc,det, pimage, simage1,simage2, status, phone, owner) "
                . "VALUES ('$title', '$type', '$rent', '$area', '$bed', '$bath',"
                 ."'$location','$detloc','$det','$pavatar_path', '$savatar1_path','$savatar2_path', '1', '$phone', '$owner')";
                
                //check if mysql query is successful
                if ($mysqli->query($sql) === true){
                    $_SESSION['pmessage'] = "Property Added Successfully!";
                    //redirect the user to welcome.php
                    //header("location: welcome.php");
                }
                else {
                    $_SESSION['pmessage'] = 'Property could not be added to the database!';
                    echo $sql;
                }
                $mysqli->close(); 
              }
            else {
                $_SESSION['pmessage'] = 'File upload failed!';
            }
        }
        else {
            $_SESSION['pmessage'] = 'Please only upload GIF, JPG or PNG images!';
        }
      }
} //if ($_SERVER["REQUEST_METHOD"] == "POST")


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
    <link href="//db.onlinewebfonts.com/c/a4e256ed67403c6ad5d43937ed48a77b?family=Core+Sans+N+W01+35+Light" rel="stylesheet" type="text/css"/>
    <link rel="stylesheet" href="css/form.css" type="text/css">
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
            <li><?php
                if(isset($_SESSION['username'])) {
                    print("<a href=\"profile.php\">Hi, ".$_SESSION['username']."</a>");
                }
                else{
                 print("<a href=\"login.php\">Login</a>");
                }
            ?></li>
            <li class="current"><a href="createad.php"> List Your Property</a></li>
          </ul>
        </nav>
      </div>
    </header> 

      <div class="body-content">
      <div class="module">
      <h1>List Your Property</h1>
      <form class="form" action="createad.php" method="post" enctype="multipart/form-data" autocomplete="off">
      <div class="alert alert-error"><?= $_SESSION['pmessage'] ?></div>
      <input name="title" placeholder="Property Title" required="" type="text"> 
      <select class="select-style" name="type" placeholder="type">
              <option value="select"> Select Type</option>
              <option value="Flat">Flat</option>
              <option value="Room">Room</option>
              <option value="House">House</option>
      <input type="text" placeholder="Rent Per Month (BDT)" name="rent" required />
      
      <select class="select-style" name="bed" placeholder="Bedroom(s)">
              <option value="select">Bedroom (s)</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6+">6+</option>
      <input type="text" placeholder="Area (Sqft)" name="area" required />
      <select class="select-style" name="bath" placeholder="Bathroom(s)">
              <option value="select">Bathroom(s)</option>
              <option value="1">1</option>
              <option value="2">2</option>
              <option value="3">3</option>
              <option value="4">4</option>
              <option value="5">5</option>
              <option value="6+">6+</option>
      <input list="location" placeholder="Location" type="text" name="location">
      <datalist id="location">
      <option value="Uttara">
      <option value="Mirpur">
      <option value="Bashundhara">
      <option value="Khilkhet">
      <option value="Gulshan">
      </datalist> 
      <textarea name="detloc" placeholder="Full Detailed Location"></textarea>
      <textarea name="det" placeholder="Description: Policy, Amenities and Others"></textarea> 
      <div class="avatar"><label>Upload Primary Image: </label><input type="file" name="pavatar" accept="image/*" required /></div>
      <div class="avatar"><label>Upload 2nd Image: </label><input type="file" name="savatar1" accept="image/*" required/></div>
      <div class="avatar"><label>Upload 3rd Image: </label><input type="file" name="savatar2" accept="image/*"  required /> </div>   
      
      <input type="submit" value="List Your Property" name="postad" class="btn btn-block btn-primary" />
      </form>
<br>
<br>
<br>



</body>
</html>