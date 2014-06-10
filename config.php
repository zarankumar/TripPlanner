<?php 
$host="localhost";
$username="root";
$password="";

$con=mysql_connect("$host", "$username", "$password")or die("cannot connect");
$db=mysql_select_db("trip2")or die("cannot select DB");




?>