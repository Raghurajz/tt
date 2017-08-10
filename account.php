<?php 
session_start();
$menu= 1;
include("dbconnection.php");

include("functions/login1.php");

//CHECKS login button is submitted or not
if(isset($_POST["btnlogin"]))
{
	//patient Login funtion..
$_SESSION[loginvalidation] =  loginfuntion($_POST["loginid"],$_POST["password"]);
}
?>
<!-- ####################################################################################################### -->



      
<!-- Patient Login Form####################################################################################################### -->
<div id="container">
  <div class="wrapper">
    <div id="content">
     <?php 
 if(isset($_SESSION["loginid"]))
{
	$enable ="true";
	
	
}
else
{
header("Location: login.php");
}
 ?>
 
     
