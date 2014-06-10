<?php
// include  files
include'aPathFinder.php';
if(isset($_POST["routeIt"]))
{
$start=$_POST["start"];
$end=$_POST["end"];
}
if(isset($_POST['luser']))
	{
	$lchek=loginCheck($_POST['luser'],$_POST['lpass']);
	if($lchek)
	echo "Logged True";
	}
?>
<!doctype html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>TripPlanner | Welcome</title>
    <link rel="stylesheet" href="css/foundation.css" />
    <script src="js/modernizr.js"></script>
    
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
  </head>
  <body>
    <div class="row">
    	<div class="large-9 columns"> &nbsp;</div>
        <div class="large-1 columns"><a href="#">Dashboard</a></div>
		<div class="large-1 columns"><a href="#" data-reveal-id="myRegModal" data-reveal >Register </a></div>
        <div class="large-1 columns">|<a href="#" data-reveal-id="myLoginModal" data-reveal>
		<?php if(isset($_SESSION['user']))
		echo "Logout";
		else 
		echo "login";?></a></div>
	</div>
    <div class="row">
      <div class="large-12 columns">
        <h1>Intelligent Trip Route Planner </h1>
      </div>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
      	<div class="panel">
	        <h3>Your Planned Trip Routes..</h3>
	       <p>
           <div class="row">
          	<table>
            	<tr>
                <td>Sl no</td>
                <td>Name</td>
                <td>Route</td>
                
                </tr>
                <tr>Trip</tr>
            
            </table>
          
     
          
          
           </div>
         </p>  
	       
      	</div>
      </div>
    </div>

    
        
        
        <hr/>
                
       
      </div>     

   
      </div>
      </div>

<div class="row">
        <div class="panel">
        Copy Right @ Trip Planner.!
        </div>
    </div>
 <?php include'popups.php';?>
    <script src="js/jquery.js"></script>
    <script src="js/foundation.min.js"></script>
    <script src="js/foundation/foundation.reveal.js"></script>
    <script>
      $(document).foundation();
    </script>
    
   <?php 
   include'mapping.php';
   
   
   ?>
      </body>
</html>
