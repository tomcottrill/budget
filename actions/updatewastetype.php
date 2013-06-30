<?php

require '../php/classes/class.main.php';
$wt = new serviceAreaMapping();

$wastetypes = $wt -> con -> performQuery("Update wastetypes SET Name = '" . $_POST['Name'] . "' WHERE ID = " . $_POST['ID']);

header("Location: ../wastetypes.php");
?>