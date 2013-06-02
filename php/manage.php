<?php
require 'classes/class.main.php';

$p = new dumpsterManager();

header('Content-type: text/json');

switch($_REQUEST['mode']){
	case "details":
		echo json_encode($p->getDetails($_REQUEST['pid']));
	break;
	case "list":
		echo json_encode($p->getFullList());
	break;
	case "deleteall":
		echo json_encode($p->deleteAllAreas($_REQUEST['pid']));
	break;
	case "deletesingle":
		echo json_encode($p->deleteArea($_REQUEST['pid'], $_REQUEST['aid']));
	break;
	case "savezip":
		echo $p->saveArea("savezip", $_REQUEST['attributes']);
	break;
	case "savecounty":
		echo $p->saveArea("savecounty", $_REQUEST['attributes']);
	break;
	case "saveradius":
		echo $p->saveArea("saveradius", $_REQUEST['attributes']);
		//var_dump(json_decode($_REQUEST['attributes']));
	break;
	case "savecustom":
		echo $p->saveArea("savecustom", $_REQUEST['attributes']);
	break;
	case "deletehauler":
		echo $p->deleteHauler($_REQUEST['pid']);
	break;
	case "changeinfo":
		echo json_encode($p->saveHaulerInfo($_REQUEST['pid'], $_REQUEST['attributes']));
	break;
}


?>