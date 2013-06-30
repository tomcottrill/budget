<?php

require '../php/classes/class.main.php';
$wt = new serviceAreaMapping();

$id = $_GET['id'];

$wastetypes = $wt -> con -> performQuery("Delete From wastetypes where ID = " . $id);

header("Location: ../wastetypes.php");
?>