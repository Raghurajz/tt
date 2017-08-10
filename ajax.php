<?php

include_once("init.php");
include("db.php");
//require_once 'config.php';
if(!empty($_POST['type'])){
	$type = $_POST['type'];
	$name = $_POST['name_startsWith'];
	//$query = "SELECT * FROM products where  UPPER($type) LIKE '".strtoupper($name)."%'";
	//$result = mysqli_query($con, $query);
	$data = array();
	$cat= $db->query("SELECT * FROM products where  UPPER($type) LIKE '".strtoupper($name)."%'");
			while ($lin = $db->fetchNextObject($cat)) {
				$productid= $lin->productid;
				$description= $lin->description;
				$retailprice= $lin->retailprice;
				$s_gst= $lin->s_gst;
				$c_gst= $lin->c_gst;
				$name = $productid.'|'.$description.'|'.$retailprice.'|'.$s_gst.'|'.$c_gst;
 array_push($data, $name);
	//while ($row = mysqli_fetch_assoc($result)) {
	///	$name = $row['productid'].'|'.$row['description'].'|'.$row['retailprice'].'|'.$row['s_gst'].'|'.$row['c_gst'];
	//	array_push($data, $name);
	}	
	echo json_encode($data);exit;
}


