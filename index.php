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
              <li class="active"><a href="index.php">Add</a></li>
              <li><a href="edit.php">Edit</a></li>
              <li><a href="search.php">Search</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

		<div class="container-fluid">
			<div id="wrapper" class="row-fluid main">
				<div id="sidebar" class="span8 sidebar">
					<ul id="tabs" class="nav nav-tabs">
						<li class="active"><a href="#tabs1-pane1" data-toggle="tab" data-type="detail">Add provider details</a></li>
						<li><a href="#tabs1-pane2" data-toggle="tab" data-type="zip">Add ZIP code area(s)</a></li>
						<li><a href="#tabs1-pane3" data-toggle="tab" data-type="county">Add county area(s)</a></li>
						<li><a href="#tabs1-pane4" data-toggle="tab" data-type="radius">Add radius area(s)</a></li>
						<li><a href="#tabs1-pane5" data-toggle="tab" data-type="custom">Add custom area(s)</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="tabs1-pane1">
							<fieldset>
								<legend>Add provider details</legend>
								<div class="span5">
									<label>Company name</label>
									<input id="pd_name" type="text" class="input-xlarge" placeholder="">
									<label>Companys' headquarters address</label>
									<input id="pd_address" type="text" class="input-medium" placeholder="">
									<button id="btnpinit" class="btn btn-success btnpinit">Pin and save</button>
									<label>Telephone</label>
									<input id="pd_tel" type="text" class="input-xlarge" placeholder="">
									<label>Email</label>
									<input id="pd_email" type="text" class="input-xlarge" placeholder="">
									<label>Website</label>
									<input id="pd_website" type="text" class="input-xlarge" placeholder="">
									<label>Usage rank</label>
									<select id="pd_rank" class="span8">
										<option value="1">High</option>
										<option value="2">Medium</option>
										<option value="3">Low</option>
									</select>									
									<span class="help-block">Save company first to proceed</span>

									<button id="pd_save" class="btn btn-success">Save details</button>
								</div>
								<div id="main-map" class="span6 main-map">
								</div>
							</fieldset>
						</div>
						<div class="tab-pane" id="tabs1-pane2">
							<fieldset>
								<legend>Add ZIP code area(s)</legend>
								<form class="form-inline">
									<label>Enter ZIP code</label>
									<input id="in_zipcode" type="text" placeholder="" data-provide="typeahead" autocomplete="off">
									<button id="add_zipcode" class="btn">Add to list</button>
									<button id="save_zipcode" class="btn btn-success">Save ZIP codes</button>
								</form>
								<label id="list_zipcodes_count">List of ZIP codes (0)</label>
								<ul id="list_zipcodes" class="list_of_zipcodes">
										
								</ul>								
							</fieldset>
						</div>
						<div class="tab-pane" id="tabs1-pane3">
							<fieldset>
								<legend>Add county area(s)</legend>
								<form class="form-inline">
									<label>Enter county name</label>
									<input id="in_county" type="text" placeholder="" data-provide="typeahead" autocomplete="off">
									<button id="add_county" class="btn">Add to list</button>
									<button id="save_county" class="btn btn-success">Save counties</button>
								</form>
								<label id="list_counties_count">List of counties (0)</label>
								<ul id="list_counties" class="list_of_counties">
										
								</ul>								
							</fieldset>
						</div>
						<div class="tab-pane" id="tabs1-pane4">
							<fieldset>
									<legend>Add radius area(s)</legend>
									<label>Choose a number of radial ranges and assign distance values in miles</label>
									<select id="nrRanges" class="range-selector">
										<option value="1">1</option>
										<option value="2">2</option>
										<option value="3">3</option>
										<option value="4">4</option>
									</select>	
									<ul id="ranges" class="radial_ranges">
									</ul>
									
									<button class="btn btn-success saveranges" id="ranges_cancel">Cancel</button>
									<button class="btn btn-success saveranges" id="saveranges">Save</button>
									<button class="btn btn-success saveranges" id="displayranges">Display</button>
									
									<div id="rangemap" class="rangemap">
									</div>									
							</fieldset>
						</div>	
						<div class="tab-pane" id="tabs1-pane5">
							<fieldset>
									<legend>Add custom area</legend>
									<label style="clear:right;">Draw a custom area on the map to define the service area</label>	
									<button class="btn btn-danger" id="custom_clear" style="float:right;margin:5px;">Clear</button>
									<button class="btn btn-success" id="custom_save" style="float:right;margin:5px;">Save</button>
									<div id="custommap" class="custommap">
									</div>									
							</fieldset>
						</div>							
					</div>
				</div>
				<div id="main" class="span4 main-content" style="padding:10px;">
					<!--Body content-->
					<button class="btn btn-danger" id="start_new" style="float:left;">Start new</button>
					<button class="btn btn-success" id="save_information" style="float:right;">Save All</button>
					<ul class="span12" id="record_steps" style="height:auto;margin:20px 0 0 0;list-style:none;">
					
					</ul>
				</div>
			</div>
		</div>


    </div> <!-- /container -->

    <!-- Le javascript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.0/jquery.min.js"></script>
	<script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.1/jquery-ui.min.js"></script>
	<script src="https://maps.googleapis.com/maps/api/js?sensor=false&amp;libraries=drawing"></script>
    <script src="js/bootstrap.min.js"></script>
	<script src="js/jquery_numeric.js"></script>
	<script src="js/bootstrap-prompts-alert.js"></script>
	<script>
		function dumpsterController(mainmap, radiusmap, custommap){
			var me = this;
				 me.geocoder = new google.maps.Geocoder();
				 me.providerDetails = {};
				 me.zipCodeDetails = {
					'zipcodes': []
				 };
				 me.countyDetails = {
					'counties': []
				 };
				 me.radiiDetails = {
					'radii': []
				 };
				 me.customAreaDetails = {
					'geometry': []
				 };
				 
				 me.providerDetailsSet = false;
				 me.zipCodeDetailsSet = false;
				 me.countyDetailsSet = false;
				 me.radiiDetailsSet = false;
				 me.customAreaDetailsSet = false;
				 
				me.getRank = function(){
					return me.rank;
				}
				me.setRank = function(arg){
					me.rank = arg;
				}				
			
				me.getHqAddress = function(){
					return me.providerDetails.address;
				}
				
				me.setHqAddress = function(arg){
					me.providerDetails.address = arg;
				}
				
				me.geocodeHqAddress = function(addressInput){
					
					if(addressInput == ""){return false;}
					
					me.geocoder.geocode({"address": addressInput}, function(results, status){
						if (status == google.maps.GeocoderStatus.OK) {
							me.setHqAddressLocation(results[0].geometry.location);
							me.displayHqAddress(mainmap);
						}
						else
						{
							me.setHqAddressLocation(false);
						}
					});
					
				}
				
				me.displayHqAddress = function(mapObject){
					if( me.providerDetails.addressLocation != false){
						mapObject['map'].setCenter( me.providerDetails.addressLocation );
						mapObject['marker'].setOptions({
							position: me.providerDetails.addressLocation,
							map: mapObject['map']
						});
					}
				}
				
				me.getHqAddressLocation = function(){
					return me.providerDetails.addressLocation;
				}
				
				me.setHqAddressLocation = function(latlng){
					me.providerDetails.addressLocation = latlng;
				}
				
				me.getName = function(){
					return me.providerDetails.name;
				}
				
				me.setName = function(arg){
					me.providerDetails.name = arg;
				}
				
				me.getPhone = function(){
					return me.providerDetails.phone;
				}
				
				me.setPhone = function(arg){
					me.providerDetails.phone = arg;
				}
				
				me.getEmail = function(){
					return me.providerDetails.email;
				}
				
				me.setEmail = function(arg){
					me.providerDetails.email = arg;
				}
				
				me.getSite = function(){
					return me.providerDetails.website;
				}
				
				me.setSite = function(arg){
					me.providerDetails.website = arg;
				}	
		
				me.reset = function(){
					me.setSite("");
					me.setRank("");
					me.setEmail("");
					me.setPhone("");
					me.setName("");
					me.setHqAddress("");
					me.setHqAddressLocation(new google.maps.LatLng(45, -95));
					
					me.providerDetailsSet = false;
					me.zipCodeDetailsSet = false;
					me.countyDetailsSet = false;
					me.radiiDetailsSet = false;
					me.customAreaDetailsSet = false;		

					me.zipCodeDetails.zipcodes.length = 0;
					me.countyDetails.counties.length = 0;
					me.radiiDetails.radii.length = 0;	
					me.customAreaDetails.geometry.length = 0;					
					me.providerDetails = {};					
				}
		};
	</script>
	<script>
		$(document).ready(function(){
			
			//Proper resizing
			$("#wrapper").height( $(window).height() - $("#header").height() - 20);
			$("#main").height( $(window).height() - $("#header").height() - 20);
			$("#sidebar").height( $(window).height() - $("#header").height() - 20);
			
			//Tabs initialization
			$("#tabs").tab();		
			
			//Hq address map code
			var hqItems = {
				'map': new google.maps.Map(document.getElementById("main-map"), {
							center: new google.maps.LatLng(45, -95),
							mapTypeId: google.maps.MapTypeId.ROADMAP,
							zoom: 3
						}),
				'marker': new google.maps.Marker({})				
			};
			var rangeItems = {
				'map': new google.maps.Map(document.getElementById("rangemap"), {
							center: new google.maps.LatLng(45, -95),
							mapTypeId: google.maps.MapTypeId.ROADMAP,
							zoom: 3
						}),
				'marker': new google.maps.Marker({})		
			};
			var customItems = {
				'map': new google.maps.Map(document.getElementById("custommap"), {
							center: new google.maps.LatLng(45, -95),
							mapTypeId: google.maps.MapTypeId.ROADMAP,
							zoom: 3
						}),
				'marker': new google.maps.Marker({}),
				'drawingManager': new google.maps.drawing.DrawingManager({
											drawingMode: google.maps.drawing.OverlayType.POLYGON,
											drawingControl: true,
											drawingControlOptions: {
												position: google.maps.ControlPosition.TOP_CENTER,
											drawingModes: [
												google.maps.drawing.OverlayType.POLYGON
											]
											},
											polygonOptions:{
												fillColor: "#FF0000",
												strokeColor: "#000000",
												editable:true,
												fillOpacity: 0.5,
												clickable: false,
												strokeWeight: 2
											}			
										}),
				'overlays':[]								
			};			
			
			var rangeValues = [];	
			var rangeGeometries = [];			
			
			//Initializing the main controller
			var mainController = new dumpsterController(hqItems, rangeItems, null);
			
			/*
			 *	Details addition tab actions
			 *
			 *
			 */
			
			$("#btnpinit").click(function(){
				mainController.geocodeHqAddress( $("#pd_address").val() );
			});

			
			$("#pd_save").click(function(){
				var errors = [];
				var serviceItems = [
					{'name': 'Name', 'fieldValue': $("#pd_name").val()},
					{'name': 'Address', 'fieldValue': $("#pd_address").val()},
					{'name': 'Address location (press Pin and Save)', 'fieldValue': hqItems.marker.getPosition()},
					{'name': 'Telephone', 'fieldValue': $("#pd_tel").val()},
					{'name': 'Email', 'fieldValue': $("#pd_email").val()},
					{'name': 'Website', 'fieldValue': $("#pd_website").val()},
					{'name': 'Rank', 'fieldValue': $("#pd_rank").val()},					
				];
				$.each(serviceItems, function(key, value){
					if( value['fieldValue'] == "" || value['fieldValue'] == undefined){
						errors.push(value['name']);
					}
				});
				
				if(errors.length > 0){
					alert("Please fill out the missing field(s): " + errors.join(", "));
					return false;
				}
				else
				{
					mainController.setName(serviceItems[0]['fieldValue']);
					mainController.setHqAddress(serviceItems[1]['fieldValue']);
					mainController.setHqAddressLocation(serviceItems[2]['fieldValue']); 
					mainController.setPhone(serviceItems[3]['fieldValue']); 
					mainController.setEmail(serviceItems[4]['fieldValue']); 
					mainController.setSite(serviceItems[5]['fieldValue']);
					mainController.setRank(serviceItems[6]['fieldValue']);					
					
				
				if(!mainController.providerDetailsSet){
					$('#record_steps').append( 
						$('<li id="pdetails" class="final_item"><div><h5>Provider details</h5><ul><li>'+mainController.getName()+'</li><li>'+mainController.getHqAddress()+'</li><li>'+mainController.getPhone()+'</li><li>'+mainController.getEmail()+'</li><li>'+mainController.getSite()+'</li><li>'+mainController.getRank()+'</li></ul></div></li>') 
					);
				}
				else
				{
					$("#pdetails").html("");
					$("#pdetails").html('<div><h5>Provider details</h5><ul><li>'+mainController.getName()+'</li><li>'+mainController.getHqAddress()+'</li><li>'+mainController.getPhone()+'</li><li>'+mainController.getEmail()+'</li><li>'+mainController.getSite()+'</li><li>'+mainController.getRank()+'</li></ul></div>');
					
				}
				
				mainController.providerDetailsSet = true;
				
				}
				

			});			
			
			
			
			/*
			 *	ZIP Code area addition TAB
			 *
			 */
			var zipDefaultSelectionMode = false;
			
			$("#in_zipcode").numeric();
			
			$('#in_zipcode').typeahead({
				source: function (query, process) {
					zipCodes = [];
					map = {};

					if(zipDefaultSelectionMode){
						zipDefaultSelectionMode = false;
					}
					
					$.post("./php/autosuggest.php", {'entity': query, 'mode': 'zip'}, function(data){
						
						$.each(data, function (i, zipcode) {
							map[zipcode.val] = zipcode;
							zipCodes.push(zipcode.val);
						});
					 
						process(zipCodes);
					});	
				},
				updater: function (item) {
					$("#in_zipcode").val(map[item].lab);
					zipDefaultSelectionMode = true;
					return item;
				},
				matcher: function (item) {
					if (item.toLowerCase().indexOf(this.query.trim().toLowerCase()) != -1) {
						return true;
					}
				},
				sorter: function (items) {
					return items.sort();
				},
				highlighter: function (item) {
					var regex = new RegExp( '(' + this.query + ')', 'gi' );
					return item.replace( regex, "<strong>$1</strong>" );
				},
			});	

			$("#in_zipcode").click(function(){$(this).val('');});
			
			$("#add_zipcode").click(function(e){
				e.preventDefault();
				
				//Block if input is not selected from the dropdown list
				if(!zipDefaultSelectionMode){
					alert('Please select from the dropdown list');
					return false;
				}
				
				if( $("#in_zipcode").val() != "" ){
					$("#list_zipcodes").append( $('<li data-zip="'+$("#in_zipcode").val()+'"><button class="zipcode_item btn" id="btn_' + $("#in_zipcode").val() + '" class="btn">' + $("#in_zipcode").val() + '</button></li>'));
					
					//alert( $("#list_zipcodes li").size());
					$("#list_zipcodes_count").html("List of ZIP codes ("+ $("#list_zipcodes li").size() +")");
					
					$("#btn_"+ $("#in_zipcode").val() )
					.click(function(){
						$(this).parent().remove();
						$("#list_zipcodes_count").html("List of ZIP codes ("+ $("#list_zipcodes li").size() +")");
					})
					.mouseover(function(){
						$(this).addClass('btn-danger');
					})
					.mouseout(function(){
						$(this).removeClass('btn-danger');
					});
					
					$("#in_zipcode").val('');
					
					zipDefaultSelectionMode = false;
				}
			});		
		
			$("#save_zipcode").click(function(e){
				
				e.preventDefault();
				
				mainController.zipCodeDetails.zipcodes.length = 0;
				
				$("#list_zipcodes > li").each(function(){
					mainController.zipCodeDetails.zipcodes.push($(this).attr('data-zip'));
				});
				
				var nrOfZipCodes = mainController.zipCodeDetails.zipcodes.length;
				
				if(!mainController.zipCodeDetailsSet){
					$('#record_steps').append( 
						$('<li id="zdetails" class="final_item"><div><h5>ZIP details</h5><ul><li>'+nrOfZipCodes+' ZIP code areas added. See list under the \'Add ZIP codes\' tab</li></ul></div></li>') 
					);	
					mainController.zipCodeDetailsSet = true;					
				}
				else
				{
					$("#zdetails").html("");
					$("#zdetails").html('<div><h5>ZIP details</h5><ul><li>'+nrOfZipCodes+' ZIP code areas added. See list under the \'Add ZIP codes\' tab</li></ul></div>');
				}				
			});
			/*
			 *	County addition TAB
			 *
			 */
			 var countyDefaultSelectionMode = false;
			$('#in_county').typeahead({
				source: function (query, process) {
					counties = [];
					map = {};
					
					if(countyDefaultSelectionMode){
						countyDefaultSelectionMode = false;
					}
					
					$.post("./php/autosuggest.php", {'entity': query, 'mode': 'county'}, function(data){
						
						$.each(data, function (i, county) {
							map[county.value] = county;
							counties.push(county.value);
						});
						process(counties);
					});	
				},
				updater: function (item) {
					$("#in_county").val(map[item].label);
					countyDefaultSelectionMode = true;
					return item;
				},
				matcher: function (item) {
					if (item.toLowerCase().indexOf(this.query.trim().toLowerCase()) != -1) {
						return true;
					}
				},
				sorter: function (items) {
					return items.sort();
				},
				highlighter: function (item) {
					var regex = new RegExp( '(' + this.query + ')', 'gi' );
					return item.replace( regex, "<strong>$1</strong>" );
				},
			});	

			$("#in_county").click(function(){$(this).val('');});
			
			$("#add_county").click(function(e){
				e.preventDefault();
				
				//Block if input is not selected from the dropdown list
				if(!countyDefaultSelectionMode){
					alert('Please select from the dropdown list');
					return false;
				}
				
				if( $("#in_county").val() != "" ){
					
					/*Details*/
					var details = $("#in_county").val().split(", ");
					var county = details[0];
					var state = details[1];
					
					
					$("#list_counties").append( $('<li data-county="'+county+'" data-state="'+state+'"><button class="county_item btn" id="btn_' + county.replace(" ", "") + '_'+state+'" class="btn">' + $("#in_county").val() + '</button></li>'));
					
					//alert( $("#list_zipcodes li").size());
					$("#list_counties_count").html("List of counties ("+ $("#list_counties li").size() +")");
					
					$("#btn_"+ county.replace(" ", "") + '_' + state)
					.click(function(){
						$(this).parent().remove();
						$("#list_counties_count").html("List of counties ("+ $("#list_counties li").size() +")");
					})
					.mouseover(function(){
						$(this).addClass('btn-danger');
					})
					.mouseout(function(){
						$(this).removeClass('btn-danger');
					});
					
					$("#in_county").val("");
					
					//Set countyDefaultSelectionMode back to default
					countyDefaultSelectionMode = false;
				}
			});	
			
			$("#save_county").click(function(e){
				e.preventDefault();
				
				mainController.countyDetails.counties.length = 0;
				
				//Loop through the list of the counties
				$("#list_counties > li").each(function(){
					mainController.countyDetails.counties.push({'county': $(this).attr('data-county'), 'state': $(this).attr('data-state')});
				});
				
				var nrOfCounties = mainController.countyDetails.counties.length;
				
				if(!mainController.countyDetailsSet){
					$('#record_steps').append( 
						$('<li id="cdetails" class="final_item"><div><h5>County details</h5><ul><li>'+nrOfCounties+' counties added. See list under the \'Add counties\' tab</li></ul></div></li>') 
					);	
					mainController.countyDetailsSet = true;					
				}
				else
				{
					$("#cdetails").html("");
					$("#cdetails").html('<div><h5>County details</h5><ul><li>'+nrOfCounties+' counties added. See list under the \'Add counties\' tab</li></ul></div>');
				}
			});
			/*
			 *	Radial ranges addition TAB
			 *
			 */	
			
			 $("#nrRanges").change(function(){
				$("#ranges").html("");
				//Number of ranges selected in the dropdown, converted to integer
				var quantity = parseInt( $(this).val() );
				
				for(i=1;i<quantity+1;i++){
					$("#ranges").append( $('<li><input type="text" id="range_'+i+'" class="input-small rangeitem" placeholder="'+i+'. range"></li>') );
					$("#range_"+i).numeric();
				}
				
				if( !$("#saveranges").is(":visible") ){
					$("#saveranges").show();
					$("#displayranges").show();
					$("#ranges_cancel").show();
				}
				
				//Empty the geometry container before pushing in the new set of geometries
				while(rangeGeometries[0]){
					rangeGeometries.pop().setMap(null);
				}
				rangeGeometries.length = 0;	
				
			 });
			 
			 
			$("#saveranges").click(function(){
				
				//Delete members before assigning new radii values
				mainController.radiiDetails.radii.length = 0;
				
				$('#ranges li input[type="text"]').each(function(){
					var value = parseInt($(this).val());
					
					if( !isNaN(value) ){
						mainController.radiiDetails.radii.push( parseInt($(this).val()) );
					}
				});	
				
				var radiusList = "";
				$.each(mainController.radiiDetails.radii, function(key,value){
					radiusList += '<li>'+ value +' miles</li>';
				});		
				var radiusMarkup = "<div><h5>Radius details</h5><ul>"+radiusList+"</ul></div>";

				mainController.radiiDetails.radii.unshift(0);
				
				if(!mainController.radiiDetailsSet){	
					$('#record_steps').append( 
						$('<li id="rdetails" class="final_item">'+radiusMarkup+'</li>') 
					);				
					mainController.radiiDetailsSet = true;
				}
				else
				{
					$("#rdetails").html("");
					$("#rdetails").html(radiusMarkup);
				}
				
			});
			 
			 
			 $("#displayranges").click(function(){

				rangeValues.length = 0;
				//set the first member of rangevalues (the origo)
				rangeValues.push(0);
				
				//Empty the geometry container before pushing in the new set of geometries
				while(rangeGeometries[0]){
					rangeGeometries.pop().setMap(null);
				}
				rangeGeometries.length = 0;
				
				$('#ranges li input[type="text"]').each(function(){
					var value = parseInt($(this).val());
					
					if( !isNaN(value) ){
						rangeValues.push( parseInt($(this).val()) );
					}
				});	
				
				
				for(i=0;i<rangeValues.length;i++){
					rangeGeometries.push(new google.maps.Polygon({paths: [drawCircle(mainController.getHqAddressLocation(), parseInt(rangeValues[i]), 1), drawCircle(mainController.getHqAddressLocation(), parseInt(rangeValues[i+1]), -1)],strokeColor: "#0000FF",strokeOpacity: 0.8,strokeWeight: 2,fillColor: "#FF0000",fillOpacity: 0.35,map: rangeItems['map']}));
				}
			 
			});
			 

			 /*
			  *		Custom area logic
			  *
			  *
			  */

			 $("#custom_save").click(function(){
			 
				if(customItems['overlays'].length>0){
					
					var path = customItems['overlays'][0].getPath();
					var coordinates = [];
					
					path.forEach(function(latlng, index){
						coordinates.push([latlng.lng(), latlng.lat()].join(" "));
					});
					
					coordinates.push(path.getAt(0).lng() + " " + path.getAt(0).lat());
					
					mainController.customAreaDetails.geometry = coordinates.join(",");
					
					
					if(!mainController.customDetailsSet){
						$('#record_steps').append( 
							$('<li id="cudetails" class="final_item"><div><h5>Custom area details</h5><ul><li>Custom area added. See list under the \'Add custom area(s)\' tab</li></ul></div></li>') 
						);	
						mainController.customAreaDetailsSet = true;					
					}
					else
					{
						$("#cudetails").html("");
						$("#cudetails").html('<div><h5>Custom area details</h5><ul><li>Custom area added. See list under the \'Add custom area(s)\' tab</li></ul></div>');
						mainController.customAreaDetailsSet = true;	
					}						
				}			 
			 });
			 
			 $("#custom_clear").click(function(){
				if(customItems['overlays'].length==0){return;}
				while(customItems['overlays'][0]){
					customItems['overlays'].pop().setMap(null);
				}
				customItems['overlays'].length = 0;		
				
				mainController.customDetailsSet = false;		

				$("#cudetails").remove();	
			 });			 
			  
			  
			 
			 
			 /*
			  *	Save all information to system
			  *
			  *
			  */
			 $("#save_information").click(function(){
			 
				$.post("php/process.php", {'data': JSON.stringify(mainController)}, function(data){
					//if(data);
					alert(data.status);
				});
				//console.log(JSON.stringify(mainController));
			 });
			 
			 
			 
			 $("#start_new").click(function(){
				$("#record_steps").html('');
				
				$("#custom_clear").trigger("click");
				$("#saveranges").hide();
				$("#displayranges").hide();
				$("#ranges_cancel").hide();
				$("#ranges").html('');					
				$("#list_zipcodes").html("");
				$("#list_zipcodes_count").html('List of ZIP codes (0)');
				$("#list_counties").html("");
				$("#list_counties_count").html('List of counties (0)');

				$("#pd_name").val("");
				$("#pd_address").val("");
				$("#pd_tel").val("");
				$("#pd_email").val("");
				$("#pd_website").val("");
			
				
				$('a[href="#tabs1-pane1"]').trigger('click');
				
				mainController.reset();
				
				
				
			 });
			 
			 /*
			  *		If provider details are not set, don't let the user proceed - If there are problems with the initial data or it hasnt yet been filled out, don't let the user switch away to another tab
			  */
			 
			 $('a[data-toggle="tab"]').on('click', function(e){
				if(!mainController.providerDetailsSet){
					alert("Add provider details and save first to proceed");
					return false;
				}
				
				if(e.target.dataset.type == "detail"){
					if(!mainController.providerDetailsSet){
						
					}
				}				
			 });
			 
			 
			//Event listener firing to resize the map when the user moves to a new tab 
			$('a[data-toggle="tab"]').on('shown', function (e) {			
				if(e.target.dataset.type == "radius"){
					google.maps.event.trigger( rangeItems['map'], 'resize' );
					rangeItems['map'].setCenter( mainController.getHqAddressLocation() );
				}
				else if(e.target.dataset.type == "custom"){
					google.maps.event.trigger( customItems['map'], 'resize' );
					customItems['map'].setCenter( mainController.getHqAddressLocation() );
					customItems['drawingManager'].setMap(customItems['map']);
					
					google.maps.event.addListener(customItems['drawingManager'], 'overlaycomplete', function(e) {
						customItems['drawingManager'].setDrawingMode(null);
						customItems['overlays'].push(e.overlay);
					});	
					
					google.maps.event.addListener(customItems['drawingManager'], 'drawingmode_changed', function(e){
						if(customItems['overlays'].length > 0 && customItems['drawingManager']['drawingMode'] == "polygon"){
							customItems['drawingManager'].setDrawingMode(null);
						}
					});					
				}
				else if(e.target.dataset.type == "detail"){
					google.maps.event.trigger( hqItems['map'], 'resize' );
				}
				//e.target // activated tab
				//e.relatedTarget // previous tab
			});	



			/*
			 *	Range mapping code
			 *
			 */
			 
			function drawCircle(point, radius, dir) { 
				var d2r = Math.PI / 180;   // degrees to radians 
				var r2d = 180 / Math.PI;   // radians to degrees 
				var earthsradius = 3963; // 3963 is the radius of the earth in miles

			   var points = 32; 

			   // find the raidus in lat/lon 
			   var rlat = (radius / earthsradius) * r2d; 
			   var rlng = rlat / Math.cos(point.lat() * d2r); 


			   var extp = new Array(); 
			   if (dir==1)	{var start=0;var end=points+1} // one extra here makes sure we connect the
			   else		{var start=points+1;var end=0}
			   for (var i=start; (dir==1 ? i < end : i > end); i=i+dir)  
			   { 
				  var theta = Math.PI * (i / (points/2)); 
				  ey = point.lng() + (rlng * Math.cos(theta)); // center a + radius x * cos(theta) 
				  ex = point.lat() + (rlat * Math.sin(theta)); // center b + radius y * sin(theta) 
				  extp.push(new google.maps.LatLng(ex, ey)); 
			   } 
			   // alert(extp.length);
			   return extp;
			}
			
			
			 
		});
	</script>

  </body>
</html>
