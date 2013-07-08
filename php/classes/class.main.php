<?php

require 'class.credentials.php';
require 'class.database.php';

class serviceAreaMapping {
	function __construct() {
		$this -> con = new mysqlDB(MYSQL_HOST, MYSQL_USER, MYSQL_PW);
		$this -> con -> selectDB(MYSQL_DB);
	}

	public function getProviderDetails($providerID) {
		if (!is_null($providerID)) {

			$result = $this -> con -> performQuery("SELECT * FROM " . TBL_PROVIDERS . " WHERE provider_id='" . $providerID . "' LIMIT 1");
			$row = mysql_fetch_assoc($result);

			$response = new stdClass();

			foreach ($row as $key => $value) {
				$response -> {$key} = $value;
			}

			//	header('Content-type: text/json');

			return json_encode($response);
		}
	}

	public function setNewProvider($data) {
		$insert = implode("','", array($data -> name, $data -> address, $data -> phone, $data -> email, $data -> website, $data -> addressLocation -> jb, $data -> addressLocation -> kb));
		$this -> con -> performQuery("REPLACE INTO " . TBL_PROVIDERS . " (provider_name, provider_address, provider_phone, provider_email, provider_website, provider_lat, provider_lng) VALUES ('" . $insert . "')");
		$id = mysql_insert_id();
		$this -> con -> performQuery("Insert into extended_info (ProviderID) VALUES ($id)");
		return $id;

	}

	/*
	 *	{ @param $serviceObj holds the POST array, including all data and commands}
	 */
	public function setServiceAreas($serviceObj) {

		switch($serviceObj->type) {
			case "zip" :

				/*Response to collect processing time and number of rows*/
				$response = new stdClass();
				$response -> total_time = 0;
				$response -> total_rows = 0;

				/*Process zip codes*/

				//$zipcodes_exploded =  explode(",", $serviceObj->zipcodes);
				$zipcodes = implode("','", $serviceObj -> zipcodes);

				$query = "SELECT zipcode, ST_AsText(the_geom) as geom FROM tl_2009_us_zcta5 WHERE zipcode IN ('" . $zipcodes . "')";

				$url = COMMON . "?q=" . urlencode($query) . "&api_key=" . CARTODB_API_KEY;

				$zip_result = $this -> executeUrl($url);

				$zipMsg = json_decode($zip_result);

				for ($i = 0; $i < count($zipMsg -> rows); $i++) {
					//echo $zipMsg->rows[0]->geom;

					$sql = "INSERT INTO service_areas (the_geom,name,area_type,provider_id, provider_name, provider_rank) VALUES " . "(ST_GeomFromText('" . $zipMsg -> rows[$i] -> geom . "',4326),'" . $zipMsg -> rows[$i] -> zipcode . "','" . $serviceObj -> type . "','" . $serviceObj -> provider_id . "', '" . $serviceObj -> provider_name . "', '" . $serviceObj -> rank . "')";

					$ch = curl_init(CARTO_BUDGET_DUMPSTER);
					$query = http_build_query(array('q' => $sql, 'api_key' => CARTODB_API_KEY_BD));

					// Configuring curl options
					curl_setopt($ch, CURLOPT_POST, TRUE);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
					$result_not_parsed = curl_exec($ch);

					$result_parsed = json_decode($result_not_parsed);
					$response -> total_time += floatval($result_parsed -> time);
					$response -> total_rows += intval($result_parsed -> total_rows);
				}

				header('Content-type: text/json');

				if ($response -> total_rows == 0) {
					$response -> status = "error";
					echo json_encode($response);
				} else {
					$response -> status = "success";
					echo json_encode($response);
				}

				break;
			case "county" :

				/*Response to collect processing time and number of rows*/
				$response = new stdClass();
				$response -> total_time = 0;
				$response -> total_rows = 0;

				//results in county_state
				//$counties_obj = json_decode($serviceObj->counties);

				$countyData = array();

				foreach ($serviceObj->counties as $county) {

					$query = "SELECT name, state, ST_AsText(the_geom) as geom FROM us_counties WHERE name='" . $county -> county . "' AND state='" . $county -> state . "'";
					$url = THGIS . "?q=" . urlencode($query) . "&api_key=" . CARTODB_API_KEY;
					$county_result = $this -> executeUrl($url);
					$countyMsg = json_decode($county_result);

					$countyAttributes = new stdClass();
					$countyAttributes -> county = $countyMsg -> rows[0] -> name;
					$countyAttributes -> state = $countyMsg -> rows[0] -> state;
					$countyAttributes -> geom = $countyMsg -> rows[0] -> geom;

					array_push($countyData, $countyAttributes);
				}

				foreach ($countyData as $item) {
					$sql = "INSERT INTO service_areas (the_geom,name,area_type,provider_id, provider_name, provider_rank) VALUES " . "(ST_GeomFromText('" . $item -> geom . "',4326),'" . $item -> county . ", " . $item -> state . "','" . $serviceObj -> type . "','" . $serviceObj -> provider_id . "', '" . $serviceObj -> provider_name . "', '" . $serviceObj -> rank . "')";

					$ch = curl_init(CARTO_BUDGET_DUMPSTER);
					$query = http_build_query(array('q' => $sql, 'api_key' => CARTODB_API_KEY_BD));

					// Configuring curl options
					curl_setopt($ch, CURLOPT_POST, TRUE);
					curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
					curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
					$result_not_parsed = curl_exec($ch);

					$result_parsed = json_decode($result_not_parsed);

					$response -> total_time += floatval($result_parsed -> time);
					$response -> total_rows += intval($result_parsed -> total_rows);
				}

				header('Content-type: text/json');

				if ($response -> total_rows == 0) {
					$response -> status = "error";
					echo json_encode($response);
				} else {
					$response -> status = "success";
					echo json_encode($response);
				}

				break;
			case "radius" :
				/*Response to collect processing time and number of rows*/
				$response = new stdClass();
				$response -> total_time = 0;
				$response -> total_rows = 0;

				//$center = explode(",", $serviceObj->latlng);
				//$sql = "INSERT INTO service_areas (the_geom,area_type,area_name,name,provider_id) SELECT (ST_Multi(ST_Transform(ST_Transform(ST_Buffer(ST_Transform(ST_GeomFromText('POINT(" . $center[0] . " " . $center[1] . ")',4326),_ST_BestSRID(ST_GeomFromText('POINT(" . $center[0] . " " . $center[1] . ")' ,4326)))," . $serviceObj->radius . "),3857),4326))),'" . $serviceObj->type. "','" . $serviceObj->name . "','" . $serviceObj->name. "','" . $serviceObj->provider_id . "'";

				//Bigger first, smaller afterwards
				foreach ($serviceObj->radii as $key => $value) {

					if ($key < (count($serviceObj -> radii) - 1)) {

						$milesA = $this -> milesToMeters($serviceObj -> radii[intval($key + 1)]);
						$milesB = $this -> milesToMeters($serviceObj -> radii[$key]);

						$sql = "INSERT INTO service_areas (the_geom,area_type,name,provider_id,provider_name, provider_rank) VALUES (" . "ST_GeomFromText(" . "(SELECT ST_Astext(ST_Difference((SELECT ST_Multi(ST_Transform(" . "ST_Transform(" . "ST_Buffer(" . "ST_Transform(" . "ST_GeomFromText('POINT(" . $serviceObj -> centerLng . " " . $serviceObj -> centerLat . ")',4326)," . "_ST_BestSRID(" . "ST_GeomFromText('POINT(" . $serviceObj -> centerLng . " " . $serviceObj -> centerLat . ")' ,4326)))," . $milesA . "),3857),4326))) ," . "(SELECT (ST_Multi(ST_Transform(" . "ST_Transform(" . "ST_Buffer(" . "ST_Transform(" . "ST_GeomFromText('POINT(" . $serviceObj -> centerLng . " " . $serviceObj -> centerLat . ")',4326)," . "_ST_BestSRID(" . "ST_GeomFromText('POINT(" . $serviceObj -> centerLng . " " . $serviceObj -> centerLat . ")' ,4326)))," . $milesB . "),3857),4326))))  ) ) " . "),4326), '" . $serviceObj -> type . "', 'radius area(" . $serviceObj -> radii[$key] . "-" . $serviceObj -> radii[intval($key + 1)] . " mi)', '" . $serviceObj -> provider_id . "','" . $serviceObj -> provider_name . "'" . ",'" . $serviceObj -> rank . "')";

						$ch = curl_init(CARTO_BUDGET_DUMPSTER);
						$query = http_build_query(array('q' => $sql, 'api_key' => CARTODB_API_KEY_BD));

						// Configuring curl options
						curl_setopt($ch, CURLOPT_POST, TRUE);
						curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
						curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
						$result_not_parsed = curl_exec($ch);

						$result_parsed = json_decode($result_not_parsed);
						$response -> total_time += floatval($result_parsed -> time);
						$response -> total_rows += intval($result_parsed -> total_rows);
					}
				}

				header('Content-type: text/json');

				if ($response -> total_rows == 0) {
					$response -> status = "error";
					echo json_encode($response);
				} else {
					$response -> status = "success";
					echo json_encode($response);
				}

				break;
			case "custom" :

				/*Response to collect processing time and number of rows*/
				$response = new stdClass();
				$response -> total_time = 0;
				$response -> total_rows = 0;

				$geometry = "POLYGON((" . $serviceObj -> wkt . "))";

				$sql = "INSERT INTO service_areas (the_geom,name,area_type,provider_id,provider_name, provider_rank) VALUES " . "(ST_GeomFromText('" . $geometry . "',4326),'Custom defined service area','" . $serviceObj -> type . "','" . $serviceObj -> provider_id . "','" . $serviceObj -> provider_name . "','" . $serviceObj -> rank . "')";

				$ch = curl_init(CARTO_BUDGET_DUMPSTER);
				$query = http_build_query(array('q' => $sql, 'api_key' => CARTODB_API_KEY_BD));

				// Configuring curl options
				curl_setopt($ch, CURLOPT_POST, TRUE);
				curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
				curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
				$result_not_parsed = curl_exec($ch);

				$result_parsed = json_decode($result_not_parsed);
				$response -> total_time += floatval($result_parsed -> time);
				$response -> total_rows += intval($result_parsed -> total_rows);

				header('Content-type: text/json');

				if ($response -> total_rows == 0) {
					$response -> status = "error";
					echo json_encode($response);
				} else {
					$response -> status = "success";
					echo json_encode($response);
				}
				break;
		}
	}

	/*
	 *	{getServiceAreas method return all intersecting areas with the input geometry}
	 *	@param $inputGeom holds the input geometry (can be either address point, zip or county area)
	 *	$inputGeom is type stdClass
	 */
	public function getServiceAreas($inputGeom) {

		switch($inputGeom->type) {
			case "address" :
				$sql = "SELECT name, st_asgeojson(the_geom) as geom, provider_id, provider_name, provider_rank FROM service_areas WHERE ST_Within(ST_GeomFromText('POINT(" . $inputGeom -> longitude . " " . $inputGeom -> latitude . ")',4326), the_geom) ORDER BY provider_rank ASC";
				$result = $this -> postCartoRequest(CARTO_BUDGET_DUMPSTER, $sql, CARTODB_API_KEY_BD);

				$parsedResult = json_decode($result, true);
				$count = 0;
				foreach ($parsedResult['rows'] as $res) {
					$query = "Select searchText from extended_info where ProviderID = " . $res['provider_id'];
					$searchText_res = $this -> con -> performQuery($query);
					$searchText = mysql_fetch_assoc($searchText_res);
					if ($searchText['searchText'] == NULL) { $st = "";
					} else {$st = $searchText['searchText'];
					}
					$parsedResult['rows'][$count]['searchText'] = $st;
					$count++;

				}

				$parsedResult = (object)$parsedResult;

				$parsedResult -> goi = '{"type": "Point","coordinates": [' . $inputGeom -> longitude . ',' . $inputGeom -> latitude . ']}';
				$parsedResult -> goi_type = "point";

				header('Content-type: text/json');

				echo json_encode($parsedResult);

				break;
			case "zip" :
				$fetchZipSql = "SELECT ST_AsText(the_geom) AS geom, ST_AsGeoJson(the_geom) geomjson FROM tl_2009_us_zcta5 WHERE zipcode='" . $inputGeom -> zip . "'";
				$zipGeometryResult = $this -> postCartoRequest(COMMON, $fetchZipSql, CARTODB_API_KEY_BD);
				$parsed = json_decode($zipGeometryResult);

				if (count($parsed -> rows) > 0) {
					$sql = "SELECT DISTINCT name, st_asgeojson(the_geom) as geom, provider_id, provider_name, provider_rank FROM service_areas WHERE ST_Intersects(ST_GeomFromText('" . $parsed -> rows[0] -> geom . "',4326), the_geom)  ORDER BY provider_rank ASC";
					$result = $this -> postCartoRequest(CARTO_BUDGET_DUMPSTER, $sql, CARTODB_API_KEY_BD);

					$parsedResult = json_decode($result, true);
					$count = 0;
					foreach ($parsedResult['rows'] as $res) {
						$query = "Select searchText from extended_info where ProviderID = " . $res['provider_id'];
						$searchText_res = $this -> con -> performQuery($query);
						$searchText = mysql_fetch_assoc($searchText_res);
						if ($searchText['searchText'] == NULL) { $st = "";
						} else {$st = $searchText['searchText'];
						}
						$parsedResult['rows'][$count]['searchText'] = $st;
						$count++;

					}

					$parsedResult = (object)$parsedResult;
					$parsedResult -> goi = $parsed -> rows[0] -> geomjson;
					$parsedResult -> goi_type = "area";

					header('Content-type: text/json');

					echo json_encode($parsedResult);
				}
				break;
			case "county" :
				$fetchCountySql = "SELECT name, state, ST_AsText(the_geom) as geom, ST_AsGeoJson(the_geom) geomjson FROM us_counties WHERE name='" . $inputGeom -> county . "' AND state='" . $inputGeom -> state . "'";
				$countyGeometryResult = $this -> postCartoRequest(THGIS, $fetchCountySql, CARTODB_API_KEY);

				$parsed = json_decode($countyGeometryResult);

				if (count($parsed -> rows) > 0) {
					$sql = "SELECT DISTINCT name, st_asgeojson(the_geom) as geom, provider_id, provider_name, provider_rank FROM service_areas WHERE ST_Intersects(ST_GeomFromText('" . $parsed -> rows[0] -> geom . "',4326), the_geom)  ORDER BY provider_rank ASC";
					$result = $this -> postCartoRequest(CARTO_BUDGET_DUMPSTER, $sql, CARTODB_API_KEY_BD);

					$parsedResult = json_decode($result, true);
					$count = 0;
					foreach ($parsedResult['rows'] as $res) {
						$searchText_res = $this -> con -> performQuery($query);
						$searchText = mysql_fetch_assoc($searchText_res);
						if ($searchText['searchText'] == NULL) { $st = "";
						} else {$st = $searchText['searchText'];
						}
						$parsedResult['rows'][$count]['searchText'] = $st;
						$count++;

					}

					$parsedResult = (object)$parsedResult;
					$parsedResult -> goi = $parsed -> rows[0] -> geomjson;
					$parsedResult -> goi_type = "area";

					header('Content-type: text/json');

					echo json_encode($parsedResult);
				}
				break;
		}
	}

	/*
	 *	{deleteAllServiceAreas method deletes all records from the cartoDB service_providers table having the same provider_id as the input parameter ID}
	 *	@param $companyID This is the provider_id of the company, its type is integer
	 *
	 */
	public function deleteAllServiceAreas($companyID) {

		/*Response to collect processing time and number of rows*/
		$r = new stdClass();
		$r -> total_time = 0;
		$r -> total_rows = 0;

		$sql = "DELETE FROM service_areas WHERE provider_id='" . $companyID . "'";
		$result = $this -> postCartoRequest(CARTO_BUDGET_DUMPSTER, $sql, CARTODB_API_KEY_BD);
		$result_parsed = json_decode($result);

		$r -> total_time = floatval($result_parsed -> time);
		$r -> total_rows = intval($result_parsed -> total_rows);

		if ($r -> total_rows == 0) {
			$r -> status = "error";
			return json_encode($r);
		} else {
			$r -> status = "success";
			return json_encode($r);
		}

	}

	/*
	 *	{deleteSingleServiceArea method deletes all records from the cartoDB service_providers table having the same provider_id as the input parameter ID}
	 *	@param $companyID This is the provider_id of the company, its type is integer
	 *
	 */
	public function deleteSingleServiceArea($companyID, $areaID) {
		$sql = "DELETE FROM service_areas WHERE provider_id='" . $companyID . "' AND cartodb_id='" . $areaID . "'";
		$result = $this -> postCartoRequest(CARTO_BUDGET_DUMPSTER, $sql, CARTODB_API_KEY_BD);
		$parsedResult = json_decode($result);
		return $parsedResult;
	}

	/*
	 *	{getAllServiceAreas method fetches all service areas from the cartoDB table, that belong to a single company ID. It is used to collect the areas to be shown in the management console.}
	 *	@param $companyID This is the provider_id of the company, its type is integer
	 *
	 */
	public function getAllServiceAreas($companyID) {

		$sql = "SELECT name as name, area_type as type, cartodb_id as cdbid, provider_id as pid, ST_AsGeoJson(the_geom) as geom FROM service_areas WHERE provider_id='" . $companyID . "'";
		$result = $this -> postCartoRequest(CARTO_BUDGET_DUMPSTER, $sql, CARTODB_API_KEY_BD);

		return $result;
	}

	/*
	 *	Public function updateServiceAreas
	 *	@param providerID - ID of the hauler
	 *	@param providerRank - Usage rank of the hauler
	 *	@param providerName - Name of the hauler
	 *	This method updates the rank of the areas that belong to the company specified by the providerID parameter
	 */
	public function updateServiceAreas($providerID, $providerRank, $providerName) {
		$sql = "UPDATE service_areas SET provider_rank='" . $providerRank . "', provider_name='" . $providerName . "' WHERE provider_id='" . $providerID . "'";
		$result = $this -> postCartoRequest(CARTO_BUDGET_DUMPSTER, $sql, CARTODB_API_KEY_BD);

		return $result;
	}

	/*
	 * {postCartoRequest method posts a request to CartoDB table}
	 *	@param $domain is the carto domain the request is going to be sent to
	 *	@param $sql is the SQL query that is going to be sent to cartoDB
	 */
	private function postCartoRequest($domain, $sql, $key) {
		$ch = curl_init($domain);
		$query = http_build_query(array('q' => $sql, 'api_key' => $key));

		// Configuring curl options
		curl_setopt($ch, CURLOPT_POST, TRUE);
		curl_setopt($ch, CURLOPT_POSTFIELDS, $query);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
		$unparsedResult = curl_exec($ch);

		return $unparsedResult;
	}

	/*
	 * {executeUrl method executes a parameter URL}
	 *	@param $url is the url thats going to be executed
	 *	@returns the cURL response for further processing
	 */
	private function executeUrl($url) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($curl);
		curl_close($curl);

		return $result;
	}

	private function milesToMeters($miles) {
		return intval(intval($miles) * 1609.34);
	}

	public function getAlert($providerID) {
		$sql = "Select Alert from alerts where provider_id = $providerID";
		$result = $this -> con -> performQuery($sql);
		$result = mysql_fetch_assoc($result);
		if (count($result) > 0) {
			return $result['Alert'];
		} else {
			return "";
		}
	}

}

class autoComplete {
	function __construct() {
		$this -> dbc = new mysqlDB(MYSQL_HOST, MYSQL_USER, MYSQL_PW);
		$this -> dbc -> selectDB(MYSQL_DB);
	}

	public function suggestCompanies($input) {
		$query = "SELECT * FROM " . TBL_PROVIDERS . " WHERE provider_name LIKE '%" . $input . "%' ORDER BY provider_name";
		$result = $this -> dbc -> performQuery($query);
		$response = array();
		while ($row = mysql_fetch_assoc($result)) {
			$item = new stdClass();
			$item -> lab = $row['provider_name'];
			$item -> val = $row['provider_id'];
			array_push($response, $item);
		}
		return $response;
	}

	public function suggestCountyAreas($input) {
		$query = "SELECT name, state FROM us_counties WHERE name ILIKE '" . $input . "%' ORDER BY name ASC LIMIT 15";
		$url = THGIS . "?q=" . urlencode($query) . "&api_key=" . CARTODB_API_KEY;
		$result = $this -> executeUrl($url);

		$returnedObj = json_decode($result);

		$jsonArray = array();

		foreach ($returnedObj->rows as $row) {
			$item = new stdClass();
			$item -> label = $row -> name . ", " . $row -> state;
			$item -> value = $row -> name . ", " . $row -> state;
			$item -> county = $row -> name;
			$item -> state = $row -> state;
			array_push($jsonArray, $item);
		}

		return $jsonArray;
	}

	public function suggestZipAreas($input) {
		$query = "SELECT zipcode FROM tl_2009_us_zcta5 WHERE zipcode LIKE '" . $input . "%' ORDER BY zipcode ASC LIMIT 15";
		$url = COMMON . "?q=" . urlencode($query) . "&api_key=" . CARTODB_API_KEY;
		$result = $this -> executeUrl($url);

		$returnedObj = json_decode($result);

		$jsonArray = array();

		foreach ($returnedObj->rows as $row) {
			$item = new stdClass();
			$item -> lab = $row -> zipcode;
			$item -> val = $row -> zipcode;
			array_push($jsonArray, $item);
		}

		return $jsonArray;
	}

	private function executeUrl($url) {
		$curl = curl_init();
		curl_setopt($curl, CURLOPT_URL, $url);
		curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
		$result = curl_exec($curl);
		curl_close($curl);

		return $result;
	}

}

class dumpsterManager {
	function __construct() {
		$this -> dbc = new mysqlDB(MYSQL_HOST, MYSQL_USER, MYSQL_PW);
		$this -> dbc -> selectDB(MYSQL_DB);
		$this -> m = new serviceAreaMapping();
	}

	public function saveHaulerInfo($providerID, $attributes) {
		$haulerAttribs = json_decode(stripslashes($attributes));

		//mySQL hauler change

		$sqlHauler = "UPDATE " . TBL_PROVIDERS . " SET provider_name='" . $haulerAttribs -> name . "', provider_rank='" . $haulerAttribs -> rank . "', provider_address='" . $haulerAttribs -> address . "', provider_phone='" . $haulerAttribs -> tel . "', provider_email='" . $haulerAttribs -> email . "', provider_website='" . $haulerAttribs -> website . "', provider_lat='" . $haulerAttribs -> lat . "', provider_lng='" . $haulerAttribs -> lng . "' WHERE provider_id='" . $providerID . "'";
		$result = $this -> dbc -> performQuery($sqlHauler);

		$response = new stdClass();

		if ($result) {
			//Result from the cartoDB query that updates the hauler names and ranks
			$cartoResult = json_decode($this -> m -> updateServiceAreas($providerID, $haulerAttribs -> rank, $haulerAttribs -> name));

			$response -> status = "success";
			$response -> provider_id = $providerID;
		} else {
			$response -> status = "error";
		}

		return $response;

		//$sql = "UPDATE service_areas SET provider_rank='".$haulerAttribs->rank."' WHERE provider_id='".$providerID."'";

		//TODO 2. Write SQL query for cartoDB info changes
	}

	public function saveArea($mode, $details) {
		switch($mode) {
			case "savezip" :
				$attributes = json_decode(stripslashes($details));

				$zip = new stdClass();
				$zip -> type = "zip";
				$zip -> provider_id = $attributes -> provider_id;
				$zip -> provider_name = $attributes -> provider_name;
				$zip -> area_type = "zip";
				$zip -> zipcodes = $attributes -> zipcodes;
				$this -> m -> setServiceAreas($zip);
				break;
			case "savecounty" :
				$attributes = json_decode(stripslashes($details));

				$counties = new stdClass();
				$counties -> type = "county";
				$counties -> provider_id = $attributes -> provider_id;
				$counties -> provider_name = $attributes -> provider_name;
				$counties -> area_type = "county";
				$counties -> counties = $attributes -> counties;
				$this -> m -> setServiceAreas($counties);
				break;
			case "saveradius" :
				$attributes = json_decode(stripslashes($details));

				$radiusgroup = array();
				array_push($radiusgroup, 0);
				foreach ($attributes->radii as $r) {
					array_push($radiusgroup, floatval($r -> radius));
				}

				$radius = new stdClass();
				$radius -> type = "radius";
				$radius -> provider_id = $attributes -> provider_id;
				$radius -> provider_name = $attributes -> provider_name;
				$radius -> area_type = "radius";
				$radius -> centerLat = floatval($attributes -> lat);
				$radius -> centerLng = floatval($attributes -> lng);
				$radius -> radii = $radiusgroup;

				$this -> m -> setServiceAreas($radius);
				break;
			case "savecustom" :
				$attributes = json_decode(stripslashes($details));
				$custom = new stdClass();
				$custom -> type = "custom";
				$custom -> provider_id = $attributes -> provider_id;
				$custom -> provider_name = $attributes -> provider_name;
				$custom -> area_type = "custom";
				$custom -> wkt = $attributes -> geometry;
				$this -> m -> setServiceAreas($custom);
				break;
		}
		//$this->m->setServiceAreas($serviceObj);
	}

	public function deleteArea($providerID, $areaID) {
		$result = $this -> m -> deleteSingleServiceArea($providerID, $areaID);
		return $result;
	}

	public function deleteAllAreas($providerID) {
		$result = $this -> m -> deleteAllServiceAreas($providerID);
		return $result;
	}

	public function deleteHauler($providerID) {
		if ($providerID == null || $providerID == "") {
			return;
		}
		$this -> dbc -> performQuery("DELETE FROM " . TBL_PROVIDERS . " WHERE provider_id='" . $providerID . "'");
		$result = $this -> m -> deleteAllServiceAreas($providerID);

		return $result;
	}

	public function getFullList() {
		$query = "SELECT * FROM " . TBL_PROVIDERS . " ORDER BY provider_name ASC, provider_rank ASC";
		$result = $this -> dbc -> performQuery($query);

		$response = new stdClass();
		$response -> type = "company_list";
		$response -> body = array();

		while ($row = mysql_fetch_assoc($result)) {
			array_push($response -> body, $row);
		}

		return $response;
	}

	public function getDetails($providerID) {
		$query = "SELECT p.*, a.Alert FROM " . TBL_PROVIDERS . " p LEFT JOIN alerts a on (p.provider_id = a.provider_id) WHERE p.provider_id='" . $providerID . "'";
		$result = $this -> dbc -> performQuery($query);

		$response = new stdClass();
		$response -> type = "company_details";
		$response -> body = array();

		/**Parse the first query results for the general details of the company*/
		while ($row = mysql_fetch_assoc($result)) {
			array_push($response -> body, $row);
		}

		/*cartodb stuff*/
		$response -> geometries = json_decode($this -> m -> getAllServiceAreas($providerID));

		return $response;
	}

}
?>