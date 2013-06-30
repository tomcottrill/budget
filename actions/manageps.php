<?php
require '../php/classes/class.main.php';

if ($_POST['action'] == "add") {
	if ($_POST['id'] == "") {echo "You must select a hauler.";
		die ;
	}
	if ($_POST['wastetype'] == "") {echo "You must select a wastetype.";
		die ;
	}

	$query = "Insert into pricingstructures (WasteType, Hauler) VALUES (";
	$query .= "'" . $_POST['wastetype'] . "', ";
	$query .= "'" . $_POST['id'] . "') ";

	$client = new serviceAreaMapping();
	$client -> con -> performQuery($query);

	$msg = "Price Structure Added.";
}
if ($_POST['action'] == "delete") {
	$query = "Delete From pricingstructures WHERE ID = " . $_POST['id'];
	$client = new serviceAreaMapping();
	$client -> con -> performQuery($query);

	$msg = "Deleted";
}

echo $msg;

//$client = new serviceAreaMapping();
//$client ->con->performQuery($query);
//header("HTTP/1.0 200 OK");
?>