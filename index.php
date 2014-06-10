<?php
session_start();
// include  files
include'aPathFinder.php';

$mtime = microtime(); 
   $mtime = explode(" ",$mtime); 
   $mtime = $mtime[1] + $mtime[0]; 
   $starttime = $mtime; 
 
if(isset($_GET['logout'])==true)
	logout();
if(isset($_POST["routeIt"]))
{
$start=$_POST["start"];
$end=$_POST["end"];
}
if(isset($_POST['luser']))
	{
	$msg=loginCheck($_POST['luser'],$_POST['lpass']);
	echo $msg;
	}
 if(isset($_POST['email']))// Registration form 
  	{
	$msg=register($_POST['email'],$_POST['user'],$_POST['pass']);
	echo $msg;
	}
if(isset($_GET["tripid-delete"]))
{
$msg=deleteTrip($_GET['tripid-delete']);
echo $msg;
}
if(isset($_GET["path"]))
{
//save route to database
$mes=saveTrip($_GET["path"]);
echo $mes;
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
    <script src="custom-validate.js"></script>
    <script src="js/jquery.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false"></script>
    <script>
         $(document).ready(function(){
function  displayProxy()
{
	$('#loads').css({'display':'block'});
	//$('#loads').fadeIn();
	setTimeout(function(){$('#loads').css({'display':'none'})},1000);
}
});
    
    </script>
  </head>
  <body>
  <div id="loads">

<img id="loader" src="img/loader.gif"/>
<h3>loading....</h3>
</div>
<style>
#loader{
margin:250px 500px}

 #loads{
 color:#000000;
  background-color:#ffffff;
  position:fixed;
  width:100%;
  height:100%;
  display:none;
  z-index:1000;
 
  
  }
</style>
  <div id="loads"></div>
    <div class="row">
    	<div class="large-9 columns"> &nbsp;</div>
        <div class="large-1 columns"><?php if(isset($_SESSION["user"])){?><a href="#" data-reveal-id="mydash" data-reveal>Dashboard</a>|<?php }?></div>
		<div class="large-1 columns"><a href="#" data-reveal-id="myRegModal" data-reveal>Register</a>|</div>
        <div class="large-1 columns"><a href="#" data-reveal-id="myLoginModal" data-reveal>
		<?php if(!isset($_SESSION['user']))
		echo "login";
		else 
		echo '<a href="'.$_SERVER['PHP_SELF'].'?logout=true">Logout</a>';?></a></div>
	</div>
    
    <div class="row">
      <div class="large-12 columns">
        <h1>Intelligent Trip Route Planner </h1>
      </div><hr/>
    </div>
    
    <div class="row">
      <div class="large-12 columns">
      	<div class="panel">
	        <h3>We&rsquo;re stoked you want to try Trip Route Planner! </h3>
	       <p>
           <div class="row">
           <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post" class="inline" name="mainForm"  onSubmit=" return formchecker();">
          <div class="large-4 columns"><label class="label">Starting Point</label><input type="text" name="start"  id="start" value="<?php if(isset($_POST['routeIt']))echo $_POST["start"];  ?>" ></div>
           <div class="large-4 columns"><label class="label">Ending Point</label><input type="text" name="end" id="end" value="<?php if(isset($_POST['routeIt'])) echo $_POST["end"];  ?>"></div>
           <div class="large-4 columns"><button class="button" type="submit" name="routeIt" id="load">Route it</button></div>
           </form>
           </div>
         <?php //if(isset($_POST['end'])){ $msg= checkStartEnd($_POST['start'],$_POST['end']);
		// echo $msg; }?>
         </p>  
	       
      	</div>
      </div>
    </div>

    <div class="row">
    <hr/>
      <div class="large-12 medium-12 columns">
        <h5>Your Travel Route !</h5>
        <!-- Grid Example -->

        <div class="row">
          <div class="large-8 columns">
                          <p><div id="map-canvas" style="float:left;width:100%;min-height:500px;"></div></p>
                       <P>&nbsp;   </P>
            <button name="button" onClick="Route();">What Google Map says?</button>
              <button name="button" onClick="calcRoute();">Our Best Travel Route</button>
                      <div class="row">
                      <div class="panel"><!--Route Details-->
                <h4>Your best Travel Route</h4>
                  
        	<p><?php 
			
			//echo "display algorithm progress";
			if(isset($_POST["routeIt"]))
			{
			$route=bestTravelRoute($start,$end);
			//echo "Our Route distance";
			$a=explode('|', $route, 2);
			 $p=KmFinder($a[0],$a[1]);
			// print_r($p);
			echo 'Route='.$route;
			echo '<h4>Need Edit? </h4>';
			echo "<form action='$_SERVER[PHP_SELF]' method='get'><input name='path' type='text' value='$route'><button  class='button success' type='submit'>Save Route</button></form>";
					
			$p=explode("|" ,$route);
			//print_r($p);
			//$m=saveTrip($p);
		
			echo"<select multiple id='waypoints' name='ways' style='visibility:hidden'>"; 
			foreach($p as $place)
			echo '<option value="'.$place.'" selected>'.$place.'</input>';
			
			}
			?>
          </select>
        	   
            </p>
              
                <hr/>
                </div><!--Route Details-->
                 <div class="callout panel">
              <p><strong><h5>Why our Route is Better?</h5></strong> </p>
              <p></p>
              <ul>
              	
                <?php 
			googleDist();
			echo "</br>Our Algorithmic Path:";
			echo $route;
				$a=explode('|', $route, 2);
			 $p=KmFinder($a[0],$a[1]);
			 echo "</br>".$p['km']."KM";
				
			?>
              </ul>
            </div>
                
           <div class="callout panel"> 
           <h4><b>Execution Time</b></h4>
      <?php
	  $mtime = microtime(); 
   $mtime = explode(" ",$mtime); 
   $mtime = $mtime[1] + $mtime[0]; 
   $endtime = $mtime; 
   $totaltime = ($endtime - $starttime); 
   echo "This page was created in ".$totaltime." seconds"; 
	  ?></div>
                  
                     </div>
                     
          </div>
             <div class="large-4 medium-4 columns">
			           
				<div class="panel">
        	<h5>Our Result?</h5>
            <form name="tripPath" action="<?php echo $_SERVER['PHP_SELF'];?>" method="get">
        	<p>
             <?php 
		googleDist();
			?>
    
            </p>
             
        	   </form>      
        </div>
        <div class="panel">
        <h5>Links </h5>
        <a href="http://qiao.github.io/PathFinding.js/visual/">A Star Visual</a>
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
    <script>
         $(document).ready(function(){
		 
		 $('#load').click(function()
{
	$('#loads').css({'display':'block'});
	//$('#loads').fadeIn();
	var i;
	setTimeout(function(){$('#loads').css({'display':'none'})},9000);
	for(i=1;i<10;i++)
	{
	
	console.log("con ok");
	
	console.log("con not ok");
	}
});	

});
    
    </script>
      </body>
</html>
