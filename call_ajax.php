<?php
//create mysql connection
    $mysqli = new mysqli("localhost", "root", "","project");
    if ($mysqli->connect_error) {
    die("Connection failed: " . $mysqli->connect_error);}

session_start();
$s1=$_REQUEST["n"];

$select_query="select DISTINCT location from listing where location like '%".$s1."%'";
$sql=mysqli_query($mysqli,$select_query) or die (mysqli_error());
$s="";
                if (mysqli_num_rows($sql) > 0) {
                // output data of each row
                while($row=mysqli_fetch_array($sql))
{
    $s=$s."
    <a class='link-p-colr' href='index.php?location=".$row['location']."'>
        <div class='live-outer'>
                <div class='live-im'>
                    <img src='area.jpg'/>
                </div>
                <div class='live-product-det'>
                    <div class='live-product-name'>
                        <p>".$row['location']."</p>
                    </div>
                    <div class='live-product-price'>
                        <div class='live-product-price-text'><p></p></div>
                    </div>
                </div>
            </div>
    </a>
    "   ;
}
echo $s;
}
$select_query="select * from listing where title like '%".$s1."%'";
//check if mysql query is successful

$sql=mysqli_query($mysqli,$select_query) or die (mysqli_error());
$s="";
while($row=mysqli_fetch_array($sql))
{
	$s=$s."
	<a class='link-p-colr' href='view.php?id=".$row['id']."'>
		<div class='live-outer'>
            	<div class='live-im'>
                	<img src='".$row['pimage']."'/>
                </div>
                <div class='live-product-det'>
                	<div class='live-product-name'>
                    	<p>".$row['title']."</p>
                    </div>
                    <div class='live-product-price'>
						<div class='live-product-price-text'><p>Rent: ".number_format($row['rent'])."</p></div>
                    </div>
                </div>
            </div>
	</a>
	"	;
}
echo $s;
?>