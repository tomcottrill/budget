<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>BudgetDumpster</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Le styles -->
		<link href="css/bootstrap.css" rel="stylesheet">
		<link href="css/default.css" rel="stylesheet">
		<style>
			body {
				padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
			}
		</style>
		<link href="css/bootstrap-responsive.css" rel="stylesheet">

		<!-- HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		<script src="../assets/js/html5shiv.js"></script>
		<![endif]-->

		<!-- Fav and touch icons -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="../assets/ico/apple-touch-icon-144-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="../assets/ico/apple-touch-icon-114-precomposed.png">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="../assets/ico/apple-touch-icon-72-precomposed.png">
		<link rel="apple-touch-icon-precomposed" href="../assets/ico/apple-touch-icon-57-precomposed.png">
		<link rel="shortcut icon" href="../assets/ico/favicon.png">
	</head>

	<body>

		<div  id="header" class="navbar navbar-inverse navbar-fixed-top">
			<div class="navbar-inner">
				<div class="container">
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a class="brand" href="#">BudgetDumpster</a>
					<div class="nav-collapse collapse">
						<ul class="nav">
							<li>
								<a href="index.php">Add</a>
							</li>
							<li>
								<a href="edit.php">Edit</a>
							</li>
							<li class="active">
								<a href="index.php">Search</a>
							</li>
							<li>
								<a href="wastetypes.php">Waste Type Management</a>
							</li>
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>

		<div class="container">

			<div class="container-fluid">
				<div id="wrapper" class="row-fluid main">

					<div id="search-panel" class="span4 search-sidebar">
						<ul id="search-panel-tabs" class="nav nav-tabs">

							<li class="active">
								<a href="#tabs-zip" data-toggle="tab" data-type="zip">Zipcode</a>
							</li>
							<li>
								<a href="#tabs-county" data-toggle="tab" data-type="county">County</a>
							</li>
							<li>
								<a href="#tabs-address" data-toggle="tab" data-type="address">Address</a>
							</li>

						</ul>
						<div class="tab-content">

							<div class="tab-pane" id="tabs-zip">
								<form class="form-inline" style="width:100%">
									<input type="text" value="Enter zipcode here" id="search-zip-input" class="input-large" autocomplete="off"/>
									<button class="btn btn-success" id="btn_zip_search">
										Search
									</button>
								</form>
							</div>
							<div class="tab-pane" id="tabs-county">
								<form class="form-inline" style="width:100%">
									<input type="text" value="Enter county name here" id="search-county-input" class="input-large" autocomplete="off"/>
									<button class="btn btn-success" id="btn_county_search">
										Search
									</button>
								</form>
							</div>
							<div class="tab-pane active" id="tabs-address">
								<form class="form-inline" style="width:100%">
									<input type="text" value="Enter address here" id="search-address-input" class="input-large" autocomplete="off"/>
									<button class="btn btn-success" id="btn_address_search">
										Search
									</button>
								</form>
							</div>
						</div>
						<div id="results">
							<table class="table table-hover">
								<thead>
									<tr style="font-weight:bold;">
										<td>Company search results</td>
									</tr>
								</thead>
								<tbody id="company_resultset"></tbody>
							</table>
						</div>
					</div>

					<div id="search-area" class="span8 search-area">
						<ul id="tabs" class="nav nav-tabs">
							<li class="active">
								<a href="#tabs1-pane1" data-toggle="tab" data-type="detail">Results (MAP)</a>
							</li>
						</ul>
						<div class="tab-content">
							<div class="tab-pane active" id="tabs1-pane1">
								<div id="search-map" class="search-map"></div>

							</div>
						</div>
					</div>
				</div>
			</div>

			<div id="Mymodal" class="modal hide fade" tabindex="-1" role="dialog" style = "width:65%; left: 25%;" aria-labelledby="myModalLabel" aria-hidden="true">
				<div class="modal-header">
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">
						×
					</button>
					<h3 id="myModalLabel">Hauler Info</h3>
				</div>
				<div class="modal-body">

				</div>
				<div class="modal-footer">
					<button class="btn" data-dismiss="modal" aria-hidden="true">
						Close
					</button>

				</div>
			</div>
		</div>
		<!-- /container -->

		<!-- Le javascript
		================================================== -->
		<!-- Placed at the end of the document so the pages load faster -->
		<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
		<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js"></script>
		<script src="https://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=drawing"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery_numeric.js"></script>
		<script src="js/bootstrap-prompts-alert.js"></script>
		<script src="js/GeoJSON.js"></script>
		<script>
			function searchAreaMap(map) {
				var me = this;
				me.geocoder = new google.maps.Geocoder();
				me.results = [];
				me.plottedGeometries = [];

				me.searchMarker = [];
				me.searchArea = [];

				me.map = map;

				me.sendRequest = function(feature, callback) {
					$.post("php/search-fetch.php", feature, callback);
				}

				me.deleteOverlays = function() {
					//Delete the polygons currently on the screen
					if (me.plottedGeometries.length > 0) {
						while (me.plottedGeometries[0]) {
							me.plottedGeometries.pop().setMap(null);
						}
						me.plottedGeometries.length = 0;
						me.results.length = 0;
					}

					if (me.searchMarker.length > 0) {
						while (me.searchMarker[0]) {
							me.searchMarker.pop().setMap(null);
						}
						me.searchMarker.length = 0;
					}

					if (me.searchArea.length > 0) {
						while (me.searchArea[0]) {
							me.searchArea.pop().setMap(null);
						}
						me.searchArea.length = 0;
					}
				}
				//Processing result rows from cartoDB, add the formatted results to me.results
				me.processRows = function(rows) {
					//Loop thru the resultset and add it to a wrapper array
					for ( i = 0; i < rows.rows.length; i++) {
						var record = rows.rows[i];
						me.results.push({
							'geometry' : new GeoJSON($.parseJSON(record.geom), {
								strokeColor : "#FF7800",
								strokeOpacity : 1,
								strokeWeight : 2,
								fillColor : "#46461F",
								fillOpacity : 0.25
							}),
							'name' : record.name,
							'provider_id' : record.provider_id,
							'provider_name' : record.provider_name,
							'searchText' : record.searchText
						});
					}
					//Here comes the geometry of interest aka the geometry we use for searching

					if (me.goi != null) {
						me.goi = null;
						me.goi = {
							'geometry' : new GeoJSON($.parseJSON(rows.goi), {
								strokeColor : "#000000",
								strokeOpacity : 1,
								strokeWeight : 2,
								fillColor : "#14D400",
								fillOpacity : 0.25
							}),
							'type' : rows.goi_type
						};
					} else {
						me.goi = {
							'geometry' : new GeoJSON($.parseJSON(rows.goi), {
								strokeColor : "#000000",
								strokeOpacity : 1,
								strokeWeight : 2,
								fillColor : "#14D400",
								fillOpacity : 0.25
							}),
							'type' : rows.goi_type
						};
					}
				}
			};
		</script>
		<script>
			$(document).ready(function() {

				$("#Mymodal").draggable();
				$("#Mymodal").resizable();

				$('body').on('hidden', '.modal', function() {
					$(this).removeData('modal');
				});

				//Proper resizing
				$("#wrapper").height($(window).height() - $("#header").height() - 40);
				$("#search-area").height($(window).height() - $("#header").height() - 50);
				$("#search-panel").height($(window).height() - $("#header").height() - 30);

				$("#search-map").height(($(window).height() - $("#header").height() - 50 - $("#tabs").height()));
				$("#search-results").height((($(window).height() - $("#header").height() - 50 - $("#tabs").height()) / 2) - 5);

				$("#results").height(($(window).height() - $("#header").height() ) - 136);

				//Tabs initialization
				$("#tabs").tab();
				$("#search-panel-tabs").tab();

				var searchComponents = {
					'map' : new google.maps.Map(document.getElementById("search-map"), {
						center : new google.maps.LatLng(35, -95),
						zoom : 3,
						mapTypeId : google.maps.MapTypeId.ROADMAP
					})
				};

				var searchController = new searchAreaMap(searchComponents['map']);

				//ZIP code search input
				$("#search-zip-input").numeric();

				$("#search-zip-input").click(function() {
					$(this).val('');
				}).keyup(function(e) {
					if (e.keyCode == 13) {
						$("#btn_zip_search").trigger("click");
					}
				});

				$('#search-zip-input').typeahead({
					source : function(query, process) {
						zipCodes = [];
						map = {};

						$.post("./php/autosuggest.php", {
							'entity' : query,
							'mode' : 'zip'
						}, function(data) {

							$.each(data, function(i, zipcode) {
								map[zipcode.val] = zipcode;
								zipCodes.push(zipcode.val);
							});

							process(zipCodes);
						});
					},
					updater : function(item) {
						$("#search-zip-input").val(map[item].lab);
						$("#btn_zip_search").focus();
						return item;
					},
					matcher : function(item) {
						if (item.toLowerCase().indexOf(this.query.trim().toLowerCase()) != -1) {
							return true;
						}
					},
					sorter : function(items) {
						return items.sort();
					},
					highlighter : function(item) {
						var regex = new RegExp('(' + this.query + ')', 'gi');
						return item.replace(regex, "<strong>$1</strong>");
					},
				});

				$("#btn_zip_search").click(function(e) {
					e.preventDefault();

					$("#company_resultset").html("");

					searchController.sendRequest({
						'type' : 'zip',
						'zip' : $("#search-zip-input").val()
					}, test);
				});

				//County search input
				$("#search-county-input").click(function() {
					$(this).val('');
				}).keyup(function(e) {
					if (e.keyCode == 13) {
						$("#btn_county_search").trigger("click");
					}
				});

				$('#search-county-input').typeahead({
					source : function(query, process) {
						counties = [];
						map = {};

						$.post("./php/autosuggest.php", {
							'entity' : query,
							'mode' : 'county'
						}, function(data) {

							$.each(data, function(i, county) {
								map[county.value] = county;
								counties.push(county.value);
							});
							process(counties);
						});
					},
					updater : function(item) {
						$("#search-county-input").val(map[item].label);
						return item;
					},
					matcher : function(item) {
						if (item.toLowerCase().indexOf(this.query.trim().toLowerCase()) != -1) {
							return true;
						}
					},
					sorter : function(items) {
						return items.sort();
					},
					highlighter : function(item) {
						var regex = new RegExp('(' + this.query + ')', 'gi');
						return item.replace(regex, "<strong>$1</strong>");
					},
				});

				$("#btn_county_search").click(function(e) {
					e.preventDefault();

					$("#company_resultset").html("");

					var raw_county_input = $("#search-county-input").val();

					var countyValues = raw_county_input.split(",");

					searchController.sendRequest({
						'type' : 'county',
						'county' : countyValues[0],
						'state' : countyValues[1].replace(" ", "")
					}, test);
				});
				//Address search input

				$("#search-address-input").click(function() {
					$(this).val('');
				}).keyup(function(e) {
					if (e.keyCode == 13) {
						$("#btn_address_search").trigger("click");
					}
				});

				$("#btn_address_search").click(function(e) {
					e.preventDefault();
					if ($("#search-address-input").val() != "") {

						$("#company_resultset").html("");

						searchController.geocoder.geocode({
							'address' : $("#search-address-input").val()
						}, function(results, status) {
							if (status == google.maps.GeocoderStatus.OK) {
								var addressPoint = {
									'type' : 'address',
									'latitude' : results[0].geometry.location.lat(),
									'longitude' : results[0].geometry.location.lng()
								};
								//sendRequest takes two argument, one address as text and one callback function
								searchController.sendRequest(addressPoint, test);
							}
						});
					}
				});

				function createRankText(number) {
					switch(number) {
						case "1":
							return "high";
							break;
						case "2":
							return "medium";
						case "3":
							return "low";
							break;
					}
				}

				function test(data) {
					//Do this if there are no results
					if (data.rows.length == 0) {
						alert("Search gave no matching service area results for your criteria.");
						return;
					}

					//$("#providerlist").html("");

					searchController.deleteOverlays();

					searchController.processRows(data);

					//Set up the bounds object that will aut center and zoom on the results
					var bounds = new google.maps.LatLngBounds();

					//Plot geometry of interest

					if (searchController['goi']['type'] == "point") {
						searchController['searchMarker'].push(searchController['goi']['geometry']);
						searchController['searchMarker'][0].setMap(searchController.map);
					} else if (searchController['goi']['type'] == "area") {

						if (searchController['goi']['geometry'].length) {

							var sgeom = searchController['goi']['geometry'];

							for (var k = 0; k < sgeom.length; k++) {
								if (sgeom[k].length) {
									for (var j = 0; j < sgeom[k].length; j++) {

										sgeom[k][j].setMap(searchController.map);
										sgeom[k][j].setOptions({
											'zIndex' : 1000
										});

										var polypts = sgeom[k][j].getPath();

										for ( x = 0; x < polypts.getLength(); x++) {
											bounds.extend(polypts.getAt(x));
										}

										searchController['searchArea'].push(sgeom[k][j]);
									}
								} else {

									sgeom[k].setMap(searchController.map);
									sgeom[k].setOptions({
										'zIndex' : 1000
									});
									//sa.plottedGeometries.push(item[k]);

									var polypts = sgeom[k].getPath();

									for ( x = 0; x < polypts.getLength(); x++) {
										bounds.extend(polypts.getAt(x));
									}

									searchController['searchArea'].push(sgeom[k]);
								}
							}
						} else {

							sgeom.setMap(searchController.map);
							sgeom.setOptions({
								'zIndex' : 1000
							});
							//sa.plottedGeometries.push(item);

							var polypts = sgeom.getPath();

							for ( x = 0; x < polypts.getLength(); x++) {
								bounds.extend(polypts.getAt(x));
							}

							searchController['searchArea'].push(sgeom);
						}

					}

					//Plot intersection results
					for ( i = 0; i < searchController.results.length; i++) {

						var record = searchController.results[i];
						var item = searchController.results[i]['geometry'];

						if (item.length) {
							for (var k = 0; k < item.length; k++) {
								if (item[k].length) {
									for (var j = 0; j < item[k].length; j++) {
										item[k][j].setMap(searchController.map);

										searchController.plottedGeometries.push(item[k][j]);

										var polypts = item[k][j].getPath();

										for ( x = 0; x < polypts.getLength(); x++) {
											bounds.extend(polypts.getAt(x));
										}

										$("#company_resultset").append($('<tr id="provider_' + record['provider_id'] + '" data-provider="' + record['provider_id'] + '"><td>' + record['provider_name'] + ' (' + record['name'] + ')' + record['searchText'] + '</td></tr>'));
										//sideBarItemOver('provider_' + record['provider_id'], item[k][j]);
									}
								} else {
									item[k].setMap(searchController.map);

									searchController.plottedGeometries.push(item[k]);

									var polypts = item[k].getPath();

									for ( x = 0; x < polypts.getLength(); x++) {
										bounds.extend(polypts.getAt(x));
									}

									$("#company_resultset").append($('<tr id="provider_' + record['provider_id'] + '" data-provider="' + record['provider_id'] + '"><td><a data-toggle="modal" href="provider.php?id=' + record['provider_id'] + '" data-target="#Mymodal">' + record['provider_name'] + '</a> (' + record['name'] + ')<br>' + record['searchText'] + '</td></tr>'));
									//sideBarItemOver('provider_' + record['provider_id'], item[k]);
								}
							}
						} else {

							item.setMap(searchController.map);

							searchController.plottedGeometries.push(item);

							var polypts = item.getPath();

							for ( x = 0; x < polypts.getLength(); x++) {
								bounds.extend(polypts.getAt(x));
							}

							$("#company_resultset").append($('<tr id="provider_' + record['provider_id'] + '" data-provider="' + record['provider_id'] + '"><td><a data-toggle="modal" href="provider.php?id=' + record['provider_id'] + '" data-target="#Mymodal">' + record['provider_name'] + '</a> (' + record['name'] + ')</td></tr>'));
							//sideBarItemOver('provider_' + record['provider_id'], item);
						}

					}

					searchController.map.fitBounds(bounds);

					$("#company_resultset > tr").click(function() {

						//alert($(this).attr('data-provider'));

						$.post("php/fetch.php", {
							'id' : $(this).attr('data-provider')
						}, function(data) {
							if (data.length == 0 || data == 'undefined') {
								alert("Error fetching provider information");
								return;
							}

							//$("#result_details").html("");
							//$("#result_details").append( $('<tr><td>'+data['provider_name']+'</td><td>'+createRankText(data['provider_rank'])+'</td><td>'+data['provider_address']+'</td><td><a href="https://maps.google.com/?ll='+data['provider_lat']+','+data['provider_lng']+'&t=m&z=4" target="_blank">Locate on map</a></td><td>'+data['provider_phone']+'</td><td>'+data['provider_email']+'</td><td>'+data['provider_website']+'</td></tr>') );

						});
					});
				}

			});
		</script>

	</body>
</html>
