<?php
ob_start();
include("config.php");
	error_reporting (E_ALL ^ E_NOTICE);
	include("db.class.php");
        if(!include_once "config.php"){
           header("location:install.php");
 }
	
	// Open the base (construct the object):
	$db = new DB($config['database'], $config['host'], $config['username'], $config['password']);
	
	# Note that filters and validators are separate rule sets and method calls. There is a good reason for this. 

	require "gump.class.php";
	
	$gump = new GUMP(); 
	
	
	// Messages Settings
	$POSNIC = array();
	$POSNIC['username'] = $_SESSION['username'];
	$POSNIC['usertype'] = $_SESSION['usertype'];
	$POSNIC['msg'] 		= '';
	if(isset($_REQUEST['msg']) && isset($_REQUEST['type']) ) {
					
					if($_REQUEST['type'] == "error")
						$POSNIC['msg'] = "<div class='error-box round'>".$_REQUEST['msg']."</div>";
					else if($_REQUEST['type'] == "warning")
						$POSNIC['msg'] = "<div class='warning-box round'>".$_REQUEST['msg']."</div>"; 
					else if($_REQUEST['type'] == "confirmation")
						$POSNIC['msg'] = "<div class='confirmation-box round'>".$_REQUEST['msg']."</div>"; 
					else if($_REQUEST['type'] == "infomation")
						$POSNIC['msg'] = "<div class='information-box round'>".$_REQUEST['msg']."</div>"; 
	}
?>