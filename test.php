<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
<title>Untitled Document</title>
<script src="js/jquery.js">
</script>

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
</head>

<body>
<div id="loads">
loading......
<img id="loader" src="img/loader.gif"/>
</div>
<a href="#" id="load">click</a>

testin..

<style>
#loader{
margin:250px 500px}

 #loads{
 color:#FFFFFF;
  background-color:rgba(0,0,0,1);
  position:fixed;
  width:100%;
  height:100%;
  display:none;
  z-index:1000;
 
  
  }
</style>

</body>
</html>
