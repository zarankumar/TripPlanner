  <!--Login forms-->
   <div id="myLoginModal" class="reveal-modal" data-reveal>
  <h2>Login Now.</h2>
   <form name="login" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
  
 <label class="label">Username</label><input type="text"  name="luser" />

 <label class="label">Password</label><input type="password"  name="lpass" />
 <button class="button">Login</button>
 </form>
  <a class="close-reveal-modal">&#215;</a>
</div>
<!--Registration forms-->
   <div id="myRegModal" class="reveal-modal" data-reveal>
  <h2>Register Now.</h2>
  <p class="lead"> Spend 1 minute.. </p>
 <form name="reg" action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
  <label class="label">Email</label><input type="email"  name="email" />
  
 <label class="label">Username</label><input type="text"  name="user"/>

 <label class="label">Password</label><input type="password"  name="pass"/>
 <button class="button">Register</button>
 </form>
 
  <a class="close-reveal-modal">&#215;</a>
</div>
<!--dashboards-->
   <div id="mydash" class="reveal-modal" data-reveal>
  <h2>Dashboard</h2>

 <table>
 	<tr>
    <td>Serial No</td>
     <td>Trip Route ID</td>
     <td>Places</td>
     <td>Action </td>
    </tr>
    <?php
	$res=tripDash();
	$i=1;
	while($row=mysql_fetch_array($res))
	{
	echo "<tr>";
	echo '<td>'.$i.'</td>';
	echo '<td>'.$row[0].'</td>';
	echo '<td>'.$row[1].'</td>';
	?>
    <td><a href="<?php echo $_SERVER['PHP_SELF']."?tripid-delete=".$row[0]; ?>">Delete </a> </td></tr>
	<?php $i++;} ?>
    
 </table>
  <a class="close-reveal-modal">&#215;</a>
</div>