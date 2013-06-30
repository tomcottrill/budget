<?php
require '../php/classes/class.main.php';
$query = "Update pricingstructures SET " . $_POST['name'] . " = '" . $_POST['value'] . "' WHERE ID =" . $_POST['pk'];

$client = new serviceAreaMapping();
$client -> con -> performQuery($query);
header("HTTP/1.0 200 OK");
?>