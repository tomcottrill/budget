<?php
require 'classes/class.main.php';

$m = new serviceAreaMapping();

$response = $m->getProviderDetails($_POST["id"]);

echo $response;

?>