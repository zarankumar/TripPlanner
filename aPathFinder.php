<?php
include'config.php';
include'functions.php';

$openList=array();
$closeList=array();
$came_from=array();
error_reporting(0);

function bestTravelRoute($start,$end)
	{
	$openList[$start]='0';// insert into Start place to Open List
	$gScore=0;
	// save start and end places in session
	$_SESSION['start']=$start;
	$_SESSION['end']=$end;
	
	do{
		$current_place=bestMove($openList); // find best place move 
		if(!isset($current_place))
			{
			$current_place=$end;
			$came_from[$current_place]=$next_place;
			//echo"Now came array:";print_r($came_from);
					
			//$openList[$current_place]=20;
			
			}
	//	echo "</br>Current Best Move: ".$current_place;
		$current_g_val=(int)$openList[$current_place];
		//echo $current_g_val;
		$closeList[]=$current_place;// add to close list
		//echo "Current Close List:</br>";print_r($closeList);
		$openList = array_diff_key($openList, array($current_place=>'$current_g_val'));// remove current place from openlist
		//echo "</br>Open List ";print_r($openList);
			
			
			if(strcmp($current_place,$end)==0)
				{
			//	echo "destination reached";
			// return pathFinder($current_place);
			 return reconstruct_path($came_from,$current_place);
			     }
				 	
			$adjucent_places=nearest($current_place);// find nearest places
			
			foreach($adjucent_places as $next_place)
				{
			//	echo "</br>Next Place Now : ".$next_place;
					if(in_array($next_place,$closeList))// if place in close list
					{
				//	  echo " Its in Close List Continueing..</br>";
					  continue;
					}
					if(!(isset($openList['$next_place'])))// if place is not in open list
					{
				//	echo"</br>Not in OpenList";
					$openList[$next_place]=(int)$current_g_val+(int)distance($next_place,$end);
					//$parent[]=$next_place=>$current_place;
					$came_from[$next_place]=$current_place;
					//$came_from['$next_place']='$current_place';
				//	echo "</br>added to open list</br>Now Open List: </br>";
				//	print_r($openList);echo "</br>";	
								
					}
					
					//echo "parent :";
					//print_r($parent);
					
				
				}
			
	
	
	}while(!empty($openList));
	
	}
	
	
		function reconstruct_path($came_from, $current_node)
{
//echo "<br/>fn called ";
    if(isset($came_from[$current_node]))
	{
	//echo "<br/>in array";
        $p = reconstruct_path($came_from,$came_from[$current_node]);
		//echo "<br/>P=".$p;
        return ($p."|".$current_node);
    }
	else
     {
	// echo "<br/>else part";
	    return $current_node;
		}
}
	
	



?>
