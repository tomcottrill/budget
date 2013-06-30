<?php

require_once 'php/classes/class.main.php';

$type = $_GET['type'];

$list = new serviceAreaMapping();

$query = "SELECT * From wastetypes order by Name";

$wastetypes = $list -> con -> performQuery($query);

if ($type == "html") {
	echo "<option value=\"\">Choose One...</option>";
	while ($row = mysql_fetch_assoc($wastetypes)) {
		echo "<option value = " . $row['ID'] . ">" . $row['Name'] . "</option>";
	}
}

if ($type == "json") {
	while ($row = mysql_fetch_assoc($wastetypes)) {
		$types[] = "{value: " . $row['ID'] . ", text: '" . $row['Name'] . "'}";
	}
	$types_output = implode(", ", $types);
	echo $types_output;

}
?>