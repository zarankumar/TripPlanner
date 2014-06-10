<?php

// All functions are goes here.

// Function for finding the distance between two places
function distance($start,$end)
 	{
 
		
		$res=mysql_query("select * from places where pname='$start'");
		$row=mysql_fetch_array($res);
		$lat1=$row[3];
		$lon1=$row[4];
	$res=mysql_query("select * from places where pname='$end'");
		$row=mysql_fetch_array($res);
		$lat2=$row[3];
		$lon2=$row[4];
	
	
					$pi80 = M_PI / 180; 
					$lat1 *= $pi80;
					$lon1 *= $pi80;
					$lat2 *= $pi80;
					$lon2 *= $pi80;
					$r = 6372; // mean radius of Earth in km
					$dlat = $lat2 - $lat1;
					$dlon = $lon2 - $lon1;
					$a = sin($dlat / 2) * sin($dlat / 2) + cos($lat1) *
					cos($lat2) * sin($dlon / 2) * sin($dlon / 2);
					$c = 2 * atan2(sqrt($a), sqrt(1 - $a));
					$km = $r * $c;
					return $km;
					
	}
//#...............................
//function returs nos nearest place around 20km


 function nearest($place)
		{
	$res=mysql_query("select * from places where pname='$place'");
		$row=mysql_fetch_array($res);
		
		$origLat=$row[3];
		$origLon=$row[4];
		
		$dis=distance($_SESSION['start'],$_SESSION['end']);
		if($dis=0)
		$dist=20;// 50 km
		else if($dis<45)
		$dist=30;
		else
		$dist=50;
		//echo $dist;
		$query = "SELECT pname, plati, plong, 6372 * 2 *  ASIN(SQRT( POWER(SIN(($origLat - abs(plati))*pi()/180/2),2)+COS($origLat*pi()/180 )*COS(abs(plati)*pi()/180)
          *POWER(SIN(($origLon-plong)*pi()/180/2),2))) 
          as distance FROM places WHERE 
          plong between ($origLon-$dist/abs(cos(radians($origLat))*69)) 
          and ($origLon+$dist/abs(cos(radians($origLat))*69)) 
          and plati between ($origLat-($dist/69)) 
          and ($origLat+($dist/69))
          having distance < $dist ORDER BY distance limit 20"; 
		$result = mysql_query($query) or die(mysql_error());
		
		while($row = mysql_fetch_assoc($result)) {
			//echo $row['pname']." > ".$row['distance']."<BR>";
			$n[]=$row['pname'];
			}
			
			return $n;
				
				}
//#...............................
// function for find the rate of the place from db

function  placeRate($place)
	{
	$res=mysql_query("select rating from places where pname='$place'");
	$row=mysql_fetch_array($res);
	return $row[0];
		
	}
	
//# function for find f value;
		function findF($sPlace)
		{
		foreach($openList as $place=>$svalue)
		 {
		 if(strcmp($sPlace,$place)==0)
		 	{
		//$start="cochin";
		//$end="thekkady";
		$f=svalue+distance($sPlace,$end);
		return $f;
			}
		}
		}	
	
	
//#.....Function for find best next move
function bestMove($openList)
{
	//Check whether any high rated tourist place around.
	$max_rated_place;
	$max_rate=0;
		foreach($openList as $place=>$svalue)
		{
		if($max_rate<placeRate($place))
			{
			$max_rate=placeRate($place);
			$max_rated_place=$place;
			}
		
		}
	if($max_rate>6)
	{
	return $max_rated_place;	//Return Best rated Place
	}
	if($max_rate<6 and $max_rate>4)//If the rating of places b/w 4-6 then find nearest places and its childrens.
			{
				$max_nos_child=0;
				$max_child_place;
			 foreach($openList as $place=>$svalue)
				 {
				 if($max_nos_child<sizeof(nearest($place)))
					{
					$max_nos_child=sizeof(nearest($place));
					$max_child_place=$place;
					}
				 }
			 
			 return $max_child_place;
			}
	if($max_rate<4)
		{
		$min_f=1000;
		$min_f_place;
			 foreach($openList as $place=>$svalue)
				 {
				 if($min_f>findF($place))
					{
					$min_f=findF($place);
					$min_f_place=findF($place);
					}
				 }
			 
			 return $min_f_place;
		
		}	
			
	
}

// Login 
function loginCheck($user,$pass)
	{
	$qry="select * from login where user='$user' and pass='$pass'";
				$r=mysql_query($qry);
				if(mysql_num_rows($r)==1)
				{
						$_SESSION["user"]=$user;
						return  true;
				}		
	return false;
	}
	
// logout
function logout()
{
session_destroy();
header("location:./index.php");
}	

// Check both start place and end place in our DB for better performance
function checkStartEnd($start,$end)
	{
	$s=false;$e=false;
		$res=mysql_query("select * from places where pname='$start'");
		$row=mysql_fetch_array($res);
		 $res1=mysql_query("select * from places where pname='$end'");
		$row1=mysql_fetch_array($res);
		if(mysql_num_rows($row)==1)
		$s=true;
		if(mysql_num_rows($row1)==1)
		$e=true;
		if($s=true and $e=true)
		return $msg="Logged in False!!";
		else
		return $msg="Logged in true";
				
		
	}
// registration
function register($email,$user,$pass)
	{
	
	// enter into database.check whether user is already registred otherwise register.
	$qry="select * from login where email='$email'";
	
	$res=mysql_query($qry);
	$row=mysql_fetch_array($res);
	if($row)
			{
			$msg='<h5 style="color:#FF0000">Email is already registered with us.Try another one.</h5>';
			
			}
			else
			{
			$res=mysql_query("insert into login(user,pass,email) values('$user','$pass','$email')");
			
			$msg='<h5 style="color:#00CC00">Successfully Registered.Login now !</h5>';
			}
		return $msg;
	
	
	
	}
	
// functions for save  routes into database ,trip table
function saveTrip($route)
{
// route as array
// trip id
$p=explode("|" ,$route);
		
			$places = serialize($p);

						 $q="select max(tripid) from trip";
						$r=mysql_query($q);
						 $row=mysql_fetch_array($r);
						 $tripid=$row[0]+1;
if(isset($_SESSION["user"])){						 
$qry="insert into trip values('$tripid','$places','$_SESSION[user]')";
$res=mysql_query($qry);
if($res)
return $msg="<h3 style='color:green'>Added to trip!</h3>";
}
$msg="<h3 style='color:red' >Login to save</h3>";
return $msg;

}
///function for returning all trips created by user
function tripDash()
	{
	$q="select * from trip where username='$_SESSION[user]'";
	$res=mysql_query($q);
	//$row=mysql_fetch_array($res);
	return $res;
	
	}
/// function for delete one trip
function deleteTrip($tripid)
{
$query="delete from trip where tripid='$tripid'";
		
		if(mysql_query($query))
		return $msg="Deleted ";
		else
		return $msg="Something went wrong.Cant be deleted.";
}
// function for calculating the KM distance
function KmFinder($start,$path)
{
$from = $start;
$to = $path;

$from = urlencode($from);
$to = urlencode($to);

$data = file_get_contents("http://maps.googleapis.com/maps/api/distancematrix/json?origins=$from&destinations=$to&language=en-EN&sensor=false");
$data = json_decode($data);

$time = 0;
$distance = 0;

foreach($data->rows[0]->elements as $road) {
    $time += $road->duration->value;
    $distance += $road->distance->value;
}
$km=$distance/1000;
/*echo "To: ".$data->destination_addresses[0];
echo "<br/>";
echo "From: ".$data->origin_addresses[0];
echo "<br/>";
echo "Time: ".$time." seconds";
echo "<br/>";
echo "Distance: ".$distance." meters";
echo "<br/>";
echo "Km=".$km;
*/
$d=array('km'=>$km,'time'=>$time);
return $d;
}
function googleDist()
{
	echo "Google Distance:";
	echo "</br>Path".$_POST["start"]." - ".$_POST["end"];
		$k=KmFinder($_POST["start"],$_POST["end"]);
				echo "</br>".$k['km'].'KM';
				//print_r($k);
				$a=explode('|', $route, 2);
			 $p=KmFinder($a[0],$a[1]);
			// print_r($p);
				
}

?>
