<?php
session_start();

$mysqli = new mysqli("localhost", "root", "","project");
    if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);}



 if ($_SERVER["REQUEST_METHOD"] == "POST") {
 $id = $mysqli->real_escape_string($_POST['id']);

 $sql = 
                "DELETE FROM listing WHERE id= '".$id."'";
                
                //check if mysql query is successful
                if ($mysqli->query($sql) === true){
                    //redirect the user to welcome.php
                    header("location: profile.php");
                }
                else {
                    echo $sql;
                }
                $mysqli->close(); 

}
?>