<?php

require 'php/classes/class.main.php';
$post = array_filter($_POST);

if ($post['action'] == "update") {
	if (!isset($post['id'])) {echo "You need to select a provider.";
		die ;
	}
	if (!isset($post['alert'])) {echo "No Alert Entered";
		die ;
	}
	$test = new serviceAreaMapping();

	$sample = $test -> getProviderDetails($post['id']);

	$sample = json_decode($sample);

	$alerts = $test -> getAlert($sample -> provider_id);

	if (($alerts == "")) {

		$sql = "Insert Into alerts(provider_id, Alert) VALUES (" . $sample -> provider_id . ", '" . addslashes($post['alert']) . "')";
		$msg = "Alert has been added.";
	} else {$sql = "Update alerts set Alert = '" . addslashes($post['alert']) . "' where provider_id = " . $sample -> provider_id;
		$msg = "Alert has been updated";
	}

	$test -> con -> performQuery($sql);

}
if ($post['action'] == "delete") {
	if (!isset($post['id'])) {echo "You need to select a provider.";
		die ;
	}
	$sql = "DELETE from alerts where provider_id = '" . $post['id'] . "'";
	$test = new serviceAreaMapping();
	$test -> con -> performQuery($sql);
	$msg = "Alert has been deleted";

}

echo $msg;
?>