 <?php

    session_start();
    include('database_connection.php');
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.6.3/css/font-awesome.min.css">
<link href="https://fonts.googleapis.com/css?family=Roboto+Condensed|Rubik" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="css/style.css" rel="stylesheet">
</head>
<body>
	<header>
       <div class="container">
         <div id="branding">
          <h1><span class="highlight">ToLet</span> - Find Your Home</h1>
         </div>

         <div class="srbox">
            <form action="#" method="get">
              <div class="bk">
                <input type="text" onKeyUp="fx(this.value)" autocomplete="off" name="qu" id="qu" class="textbox" placeholder="Search Location or Listing" tabindex="1">
                <button type="button" class="textbox-clr" id="textbox-clr" onClick="lightbg_clr()"></button>
                <button type="submit" class="query-submit" tabindex="2"><i class="fa fa-search" style="color:#727272; font-size:20px"></i></button>
                <div id="livesearch"></div>
              </div>
            </form>
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
        <div class="row">
    		<div class="col-md-3">

				<div class="list-group">
					<h3>Rent per Month</h3>
					<input type="hidden" id="hidden_minimum_price" value="0" />
                    <input type="hidden" id="hidden_maximum_price" value="500000" />
                    <p id="price_show">500 - 100000+</p>
                    <div id="price_range"></div>
                </div>
                <div class="list-group">
                    
                </div>



                <div class="list-group">
					<h3>Property Type</h3>
                    <div style="height: 150px; overflow-y: auto; overflow-x: hidden;">
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector pt" value="Flat">Flat</label>
                    </div>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector pt" value="House">House</label>
                    </div>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector pt" value="Room">Room</label>
                    </div>
                    </div>
                </div>

                    <div class="list-group">
                    <h3>Bedroom (s)</h3>
                     <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector bed" value="1">1</label>
                    </div>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector bed" value="2">2</label>
                    </div>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector bed" value="3">3</label>
                    </div>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector bed" value="4">4</label>
                    </div>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector bed" value="5">5</label>
                    </div>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector bed" value="6+">6+</label>
                    </div>
                    </div> 

                </div>

                <div class="list-group">
                    <h3>Bathroom (s)</h3>
                     <div style="height: 180px; overflow-y: auto; overflow-x: hidden;">
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector bath" value="1">1</label>
                    </div>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector bath" value="2">2</label>
                    </div>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector bath" value="3">3</label>
                    </div>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector bath" value="4">4</label>
                    </div>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector bath" value="5">5</label>
                    </div>
                    <div class="list-group-item checkbox">
                        <label><input type="checkbox" class="common_selector bath" value="6+">6+</label>
                    </div>
                    </div> 

                </div>
				
            </div>
            

            <div class="col-md-9">

            	<br />
                <div class="row filter_data">
                	<p> Lorem Ipsum </p>
                </div>
            </div>
        </div>

    </div>

  
<style>
#loading
{
	text-align:center; 
	background: url('loader.gif') no-repeat center; 
	height: 150px;
}
</style>

<script>
$(document).ready(function(){

    filter_data();

    function filter_data()
    {
        $('.filter_data').html('<div id="loading" style="" ></div>');
        var action = 'fetch_data';
        var minimum_price = $('#hidden_minimum_price').val();
        var maximum_price = $('#hidden_maximum_price').val();
        var bed = get_filter('bed');
        var bath = get_filter('bath');

        var location =  " <?php if(isset($_GET['location'])){ echo $_GET['location'];}?> ";
        var pt = get_filter('pt');
        $.ajax({
            url:"fetch_data.php",
            method:"POST",
            data:{action:action, minimum_price:minimum_price, maximum_price:maximum_price, location:location, pt:pt, bed:bed , bath:bath},
            success:function(data){
                $('.filter_data').html(data);
            }
        });
    }

    function get_filter(class_name)
    {
        var filter = [];
        $('.'+class_name+':checked').each(function(){
            filter.push($(this).val());
        });
        return filter;
    }

    $('.common_selector').click(function(){
        filter_data();
    });

    $('#price_range').slider({
        range:true,
        min:500,
        max:100000,
        values:[500, 100000],
        step:500,
        stop:function(event, ui)
        {	
            $('#price_show').html(ui.values[0] + ' - ' + ui.values[1]);
            $('#hidden_minimum_price').val(ui.values[0]);
            $('#hidden_maximum_price').val(ui.values[1]);
            filter_data();
        }
    });

});



</script>
<script>
function myFunction() {
  // Declare variables
  var input, filter, ul, li, a, i, txtValue;
  input = document.getElementById('myInput');
  filter = input.value.toUpperCase();
  ul = document.getElementById("myUL");
  li = ul.getElementsByTagName('li');

  // Loop through all list items, and hide those who don't match the search query
  for (i = 0; i < li.length; i++) {
    a = li[i].getElementsByTagName("a")[0];
    txtValue = a.textContent || a.innerText;
    if (txtValue.toUpperCase().indexOf(filter) > -1) {
      li[i].style.display = "";
    } else {
      li[i].style.display = "none";
    }
  }
}
</script>

<script>
    //script for search
function lightbg_clr() {
    $('#qu').val("");
    $('#textbox-clr').text("");
    $('#search-layer').css({"width":"auto","height":"auto"});
    $('#livesearch').css({"display":"none"});   
    $("#qu").focus();
 };
 
function fx(str)
{
var s1=document.getElementById("qu").value;
var xmlhttp;
if (str.length==0) {
    document.getElementById("livesearch").innerHTML="";
    document.getElementById("livesearch").style.border="0px";
    document.getElementById("search-layer").style.width="auto";
    document.getElementById("search-layer").style.height="auto";
    document.getElementById("livesearch").style.display="block";
    $('#textbox-clr').text("X");
    return;
  }
if (window.XMLHttpRequest)
  {// code for IE7+, Firefox, Chrome, Opera, Safari
  xmlhttp=new XMLHttpRequest();
  }
else
  {// code for IE6, IE5
  xmlhttp=new ActiveXObject("Microsoft.XMLHTTP");
  }
xmlhttp.onreadystatechange=function()
  {
  if (xmlhttp.readyState==4 && xmlhttp.status==200)
    {
    document.getElementById("livesearch").innerHTML=xmlhttp.responseText;
    document.getElementById("search-layer").style.width="100%";
    document.getElementById("search-layer").style.height="100%";
    document.getElementById("livesearch").style.display="block";
    $('#textbox-clr').text("X");
    }
  }
xmlhttp.open("GET","call_ajax.php?n="+s1,true);
xmlhttp.send(); 
}
</script> 



</body>
</html>