<?php

    session_start();
    $_SESSION['message'] = '';
    $_SESSION['loginmsg']= '';
    //include('database_connection.php');
    //connection variables
    

    //create mysql connection
    $mysqli = new mysqli("localhost", "root", "","project");
    if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);}

    if(!empty($_POST['login'])){


    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $username = $mysqli->real_escape_string($_POST['username']);
        //md5 hash password for security
        $password = md5($_POST['password']);

            $sql="select * from user where (username='$username' AND password='$password');";
                $res=mysqli_query($mysqli,$sql);
                if (mysqli_num_rows($res) > 0) {
                // output data of each row
                $row = mysqli_fetch_assoc($res);
                $avatar_path=$row['image'];
                $_SESSION['loginmsg'] ="Login Successful";
                $_SESSION['username'] = $username;
                $_SESSION['avatar'] = $avatar_path;
                }
        
                else{
                    $_SESSION['loginmsg'] = 'Invalid Username or Password!';
                }
                $mysqli->close();
} 
  }
    else if(!empty($_POST['register'])){

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    //two passwords are equal to each other
    if ($_POST['password'] == $_POST['confirmpassword']) {
        
        //define other variables with submitted values from $_POST
        $name = $mysqli->real_escape_string($_POST['name']);
        $username = $mysqli->real_escape_string($_POST['username']);
        $email = $mysqli->real_escape_string($_POST['email']);
        $phone = $mysqli->real_escape_string($_POST['phone']);
        //md5 hash password for security
        $password = md5($_POST['password']);

        //path were our avatar image will be stored
        $avatar_path = $mysqli->real_escape_string('image/'.time().$_FILES['avatar']['name']);
        
        //make sure the file type is image
        if (preg_match("!image!",$_FILES['avatar']['type'])) {

            $sql="select * from user where (username='$username' or email='$email');";
                $res=mysqli_query($mysqli,$sql);
                if (mysqli_num_rows($res) > 0) {
                // output data of each row
                $row = mysqli_fetch_assoc($res);
                if ($username==$row['username'])
                {
                $_SESSION['message'] ="Username already exists";
                }
                elseif($email==$row['email'])
                {
                $_SESSION['message'] ="Email already exists";
                }}
                else{
            
            //copy image to image/ folder 
            if (copy($_FILES['avatar']['tmp_name'], $avatar_path)){
                //set session variables to display on welcome page
                $_SESSION['username'] = $username;
                $_SESSION['avatar'] = $avatar_path;

                //insert user data into database
                $sql = 
                "INSERT INTO user (name, username, email, password, phonenumber, image) "
                . "VALUES ('$name', '$username', '$email', '$password', '$phone', '$avatar_path')";
                
                //check if mysql query is successful
                if ($mysqli->query($sql) === true){
                    $_SESSION['message'] = "Registration successful!"
                    . "Added $username to the database!";
                    //redirect the user to welcome.php
                    header("location: welcome.php");
                }
                else {
                    $_SESSION['message'] = 'User could not be added to the database!';
                }
                $mysqli->close(); 
              }
            else {
                $_SESSION['message'] = 'File upload failed!';
            }
          }
        }
        else {
            $_SESSION['message'] = 'Please only upload GIF, JPG or PNG images!';
        }
    }
    else {
        $_SESSION['message'] = 'Two passwords do not match!';
    }
} //if ($_SERVER["REQUEST_METHOD"] == "POST")
}
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
            <li class="current"><a href="login.html">Login</a></li>
            <li class="button1"><a href="createad.php"> List Your Property</a></li>
          </ul>
        </nav>
      </div>
    </header> 
    <div class="row">
      
      <div class="col-md-6">
      <div class="body-content">
      <div class="module">
      <h1>Create an account</h1>
      <form class="form" action="register.php" method="post" enctype="multipart/form-data" autocomplete="off">
      <div class="alert alert-error"><?= $_SESSION['message'] ?></div>
      <input name="name" placeholder="First and last name" required="" type="text"> 
      <input type="text" placeholder="User Name" name="username" required />
      <input type="email" placeholder="Email" name="email" required />
      <input type="password" placeholder="Password" name="password" autocomplete="new-password" required />
      <input type="password" placeholder="Confirm Password" name="confirmpassword" autocomplete="new-password" required />
      <input name="phone" placeholder="Phone Number" required="" type="text"> <br>
      <div class="avatar"><label>Upload Profile Picture: </label><input type="file" name="avatar" accept="image/*" required /></div>
      <input type="submit" value="Register" name="register" class="btn btn-block btn-primary" />
      </form>
      </div>
      </div>
    </div>
    <div class="col-md-6">
        <div class="body-content">
      <div class="module">
      <h1>Login To Your Account</h1>
      <form class="form" action="register.php" method="post" enctype="multipart/form-data" autocomplete="off">
      <div class="alert alert-error"><?= $_SESSION['loginmsg'] ?></div>
      <input type="text" placeholder="User Name" name="username" required />
      <input type="password" placeholder="Password" name="password" autocomplete="new-password" required />
      <br>
      <input type="submit" value="Login" name="login" class="btn btn-block btn-primary" />
      </form>
      </div>
      </div>
    </div>
  </div>






</body>
</html>