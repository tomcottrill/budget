<?php

/*
 *	This is the main config file including all credentials necessary
 *	You can sett all cartoDB settings here if you want to change how mapping is done
 *	You can also set the mySQL credentials here
 *
 */

/*CartoDB key*/
define("CARTODB_API_KEY", "e3e16873e144142ac46e6c1bb8034970498b2d6d");
define("CARTODB_API_KEY_BD", "e065d51b53490b2f8ea6f2e3e5ecf021e83613bc");

/*CartoDB tables*/
define("ZIP_TABLE", "tl_2009_us_zcta5");
define("COUNTY_TABLE", "us_counties");
define("SERVICE_AREAS_TABLE", "service_areas");

/*CartoDB accounts*/
define("THGIS","http://thgis.cartodb.com/api/v2/sql");
define("CARTO_BUDGET_DUMPSTER","http://jmfenn.cartodb.com/api/v2/sql");
define("COMMON","http://where.cartodb.com/api/v2/sql");

/*mySQL credentials*/

define("MYSQL_HOST","localhost");
define("MYSQL_USER","root");
define("MYSQL_PW","Elance1986");
define("MYSQL_DB","dumpsterco");
define("TBL_PROVIDERS", "budgetdumpster_providers");
?>