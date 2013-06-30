<?php

require '../php/classes/class.main.php';
$wt = new serviceAreaMapping();

$wastetypes = $wt -> con -> performQuery("Insert Into wastetypes (Name) Values ('" . $_POST['Name'] . "')");

header("Location: ../wastetypes.php");
?>