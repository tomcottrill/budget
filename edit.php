<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>BudgetDumpster</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0,user-scalable=no">
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
              <li><a href="index.php">Add</a></li>
              <li class="active"><a href="edit.php">Edit</a></li>
              <li><a href="search.php">Search</a></li>
            </ul>
          </div><!--/.nav-collapse -->
        </div>
      </div>
    </div>

    <div class="container">

		<div class="container-fluid">
			<div id="wrapper" class="row-fluid main">
				<div class="span4 edit-sidebar">
					<ul id="edit-sidebar-tabs" class="nav nav-tabs">
						<li class="active"><a href="#sidebar-company-enter" data-toggle="tab" data-type="sidebar-company-enter">Enter hauler</a></li>
						<li><a href="#sidebar-company-choose" data-toggle="tab" data-type="sidebar-company-choose">Select hauler</a></li>
					</ul>				
					<div class="tab-content">
						<div class="tab-pane active" id="sidebar-company-enter">
							<!--<input type="text" id="load-companies" autocomplete="off" placeholder="Enter company here" class="input-block-level"/>-->
							<div class="input-append">
							  <input class="input-block-level" id="load-companies" autocomplete="off" placeholder="Enter hauler here" type="text"/>
							  <input type="hidden" id="cid"/>
							  <button class="btn" type="button" id="load-company-subm"><i class="icon-play"></i></button>
							</div>							
							
						</div>
						<div class="tab-pane company-list-table" id="sidebar-company-choose">
							<table id="company-list-table" class="table table-hover table-condensed">
								<tbody id="company-list"></tbody>
							</table>
						</div>						
					</div>	
					
				</div>
				<div class="span8 edit-main">
					<ul id="edit-tabs" class="nav nav-tabs">
						<li class="active"><a href="#company-summary" data-toggle="tab" data-type="company-summary">Summary</a></li>
						<li><a href="#company-areas" data-toggle="tab" data-type="company-areas" id="main-tab-areas">Areas</a></li>
						<li><a href="#company-addarea" data-toggle="tab" data-type="company-edit">Add more areas</a></li>
					</ul>
					<div class="tab-content">
						<div class="tab-pane active" id="company-summary">
							<div id="company-summary-details" data-companyid="" data-companyname="" data-companylat="" data-companylng="" class="span12" style="display:none;margin-left:0px;">
								<div class="form-horizontal">
									<div class="control-group row-fluid form-inline">
										<label for="edit-company-name" class="control-label"><p class="text-info">Hauler name&nbsp;</p></label>
										<div class="controls">
											<input type="text" id="edit-company-name" class="span8">
										</div>
									</div>
								</div>
								<div class="form-horizontal">
									<div class="control-group row-fluid form-inline">
										<label for="edit-company-address" class="control-label"><p class="text-info">HQ address&nbsp;</p></label>
										<div class="controls">
											<input type="text" id="edit-company-address" class="span8">
											<input type="hidden" id="edit-company-location-lat"/>
											<input type="hidden" id="edit-company-location-lng"/>
										</div>
									</div>
								</div>
								<div class="form-horizontal">
									<div class="control-group row-fluid form-inline">
										<label for="edit-company-telephone" class="control-label"><p class="text-info">Telephone&nbsp;</p></label>
										<div class="controls">
											<input type="text" id="edit-company-telephone" class="span8">
										</div>
									</div>
								</div>
								<div class="form-horizontal">
									<div class="control-group row-fluid form-inline">
										<label for="edit-company-email" class="control-label"><p class="text-info">Email&nbsp;</p></label>
										<div class="controls">
											<input type="text" id="edit-company-email" class="span8">
										</div>
									</div>
								</div>
								<div class="form-horizontal">
									<div class="control-group row-fluid form-inline">
										<label for="edit-company-website" class="control-label"><p class="text-info">Website&nbsp;</p></label>
										<div class="controls">
											<input type="text" id="edit-company-website" class="span8">
										</div>
									</div>
								</div>
								
								<div class="form-horizontal">
									<div class="control-group row-fluid form-inline">
										<label for="edit-company-rank" class="control-label"><p class="text-info">Hauler usage rank&nbsp;</p></label>
										<div class="controls">
											<select id="edit-company-rank" class="span8">
												<option value="1">High</option>
												<option value="2">Medium</option>
												<option value="3">Low</option>
											</select>
										</div>
									</div>
								</div>

								<div class="form-horizontal">
								<div class="control-group row-fluid form-inline">									
									<div class="controls">
										<button id="edit-company-submit" class="btn btn-info"><i class="icon-ok icon-white"></i>&nbsp;Save changes</button>
										<button id="edit-company-delete" class="btn btn-danger"><i class="icon-trash icon-white"></i>&nbsp;Delete company</button>
									</div>
								</div>
							</div>							
							</div>
							<div id="company-summary-welcome" class="span12" style="margin-left:0px;padding:10px;">
								<h4>Welcome to the management console</h4>
								<p>Before using the edit interface, please take your time to learn how it works, and how it would be the easiest for you to use it!</p>
								<p>To the top left corner you will find the hauler lookup interface, which has two modes:</p>
								<ul>
									<li>input with auto-completion</li>
									<li>and the hauler list</li>
								</ul>							
								<p>Once you selected your desired hauler, follow the next step based on the nature of action you want to do with the hauler:</p>
								<ul>
									<li>If you want to manage the areas of the hauler, click on the areas tab! There you can easily delete or add hauler areas, while a visual representation of the areas will be shown on a google map</li>
									<li>If you want to change hauler details, click on the summary tab! Once you are done with your changes, simply click on the Save Changes button.You can also delete the hauler and its areas completely by clicking on the Delete button.</li>
									<li>If you want to add more hauler areas right away, click on the Add more areas tab! There you can select what type of hauler area you want to add.</li>
								</ul>
								<p>IMPORTANT: On the Summary page, when you change to HQ address of a hauler, please make sure that you enter a valid address, otherwise the app will return an error, that it was unable to geocode your request!</p>
							</div>
						</div>
						<div class="tab-pane" id="company-areas">
							<div id="edit-company-map" class="span12"></div>
							<div id="edit-company-areas" class="span12" style="overflow-y:auto;overflow-x:none;margin-left:0px;">
								<table class="table table-condensed table-bordered table-hover">
									<thead>
										<tr class=" table-thickheadered"><td class="text-center">Provider ID</td><td class="text-center">Area type</td><td class="text-center">Area description</td><td class="text-center">Available operations</td></tr>
									</thead>
									<tbody id="company-areas-list">
										<tr><td colspan="4" style="text-align:center;">No hauler areas are loaded. Please select a hauler first!</td></tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="tab-pane" id="company-addarea">
							<div id="edit-company-addarea" class="span12" style="overflow:hidden;margin-left:0px;">
								<ul id="edit-company-addarea-pill-types" class="nav nav-pills">
									<li class="active"><a data-toggle="tab" data-type="addarea-zip" href="#edit-company-addarea-pill-zip">ZIP code area</a></li>
									<li><a data-toggle="tab" data-type="addarea-county" href="#edit-company-addarea-pill-county">County area</a></li>
									<li><a data-toggle="tab" data-type="addarea-radial" href="#edit-company-addarea-pill-radius">Radial area</a></li>
									<li><a data-toggle="tab" data-type="addarea-custom" href="#edit-company-addarea-pill-custom">Custom area</a></li>
								</ul>	
								<div class="pill-content">
									<div class="active pill-pane" id="edit-company-addarea-pill-zip">
										<div id="edit-company-addarea-zipcode-controls" class="form-horizontal">
											<div class="control-group row-fluid form-inline">									
												<div class="controls">
													<input id="edit-company-addarea-zipcode" type="text" placeholder="" data-provide="typeahead" autocomplete="off">
													<button id="edit-company-addarea-zipcode-submit" class="btn btn-info">Add ZIP code to list</button>
												</div>
											</div>
										</div>
										<div class="span12" id="edit-company-addarea-zipcode-list" style="overflow-y:auto;overflow-x:hidden;margin:0px;">
											<table class="table table-bordered table-condensed table-hover" style="height:auto">
												<thead>
													<tr class=" table-thickheadered"><td class="text-center">ZIP code</td><td class="text-center">Operation</td></tr>
												</thead>
												<tbody id="edit-company-addarea-zipcode-list-table"></tbody>
											</table>
										</div>	
							
										<div class="row">
											<div class="span12" style="text-align:center;margin-top:20px;">
												<button id="edit-company-addarea-zipcode-save" class="btn btn-info"><i class="icon-ok icon-white"></i>&nbsp;Save ZIP codea areas to database</button>
											</div>
										</div>
										
									</div>
									
									<div class="pill-pane" id="edit-company-addarea-pill-county">
										<div id="edit-company-addarea-county-controls" class="form-horizontal">
											<div class="control-group row-fluid form-inline">									
												<div class="controls">
													<input id="edit-company-addarea-county" type="text" placeholder="" data-provide="typeahead" autocomplete="off">
													<button id="edit-company-addarea-county-submit" class="btn btn-info">Add county to list</button>
												</div>
											</div>
										</div>
										<div class="span12" id="edit-company-addarea-county-list" style="overflow-y:auto;overflow-x:hidden;margin:0px;">
											<table class="table table-bordered table-condensed table-hover" style="height:auto">
												<thead>
													<tr class=" table-thickheadered"><td class="text-center">County name</td><td class="text-center">Operation</td></tr>
												</thead>
												<tbody id="edit-company-addarea-county-list-table">
												</tbody>
											</table>
										</div>	
							
										<div class="row">
											<div class="span12" style="text-align:center;margin-top:20px;">
												<button id="edit-company-addarea-county-save" class="btn btn-info"><i class="icon-ok icon-white"></i>&nbsp;Save county areas to database</button>
											</div>
										</div>									
									</div>
									
									<div class="pill-pane" id="edit-company-addarea-pill-radius">

										<div class="row" style="margin-top:20px;text-align:center;">
											<div class="btn-group">
												<button class="btn" id="radi_1">1</button>
												<button class="btn" id="radi_2">2</button>
												<button class="btn" id="radi_3">3</button>
												<button class="btn" id="radi_4">4</button>
											</div>
										</div>									
									
										<div class="row" style="margin-top:20px;">
											<div id="edit-company-addarea-radiusmap" class="edit-radius-map span12"></div>
										</div>

										
										<div id="edit-company-addarea-radius-categories" class="row" style="margin-top:20px;padding-left:30px;"></div>
			  
										<div class="row" style="margin-top:20px;">
											<div class="span12" style="text-align:center;">
												<button id="edit-company-addarea-radius-save" class="btn btn-info"><i class="icon-ok icon-white"></i>&nbsp;Save radius area(s) to database</button>
												<button id="edit-company-addarea-radius-display" class="btn btn-info"><i class="icon-play icon-white"></i>&nbsp;Test</button>
												<button id="edit-company-addarea-radius-cancel" class="btn btn-danger"><i class="icon-trash icon-white"></i>&nbsp;Clear</button>
											</div>
										</div>										
									</div>
									
									<div class="pill-pane" id="edit-company-addarea-pill-custom">
										
										<div class="row">
											<div class="span12 form-inline" style="text-align:center;">
												<input id="edit-company-addarea-custom" type="text" placeholder="" data-provide="typeahead" autocomplete="off">
												<button id="edit-company-addarea-custom-locate" class="btn btn-info"><i class="icon-map-marker icon-white"></i>&nbsp;Zoom to location</button>	
											</div>	
										</div>
										
										<div class="row" style="margin-top:20px;">
											<div id="edit-company-addarea-custommap" class="edit-custom-map span12"></div>
										</div>
										
										<div class="row" style="margin-top:20px;">
											<div class="span12" style="text-align:center;">
												<button id="edit-company-addarea-custom-save" class="btn btn-info"><i class="icon-ok icon-white"></i>&nbsp;Save custom area to database</button>
												<button id="edit-company-addarea-custom-cancel" class="btn btn-danger"><i class="icon-trash icon-white"></i>&nbsp;Clear</button>
											</div>
										</div>										
									</div>									
								</div>	
							</div>
						</div>						
					</div>					
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
	<script src="js/GeoJSON.js"></script>
	<script>
		if (!google.maps.Polygon.prototype.getBounds) {

			google.maps.Polygon.prototype.getBounds = function(latLng) {

				var bounds = new google.maps.LatLngBounds();
				var paths = this.getPaths();
				var path;
							
				for (var p = 0; p < paths.getLength(); p++) {
					path = paths.getAt(p);
					for (var i = 0; i < path.getLength(); i++) {
						bounds.extend(path.getAt(i));
					}
				}

				return bounds;
			}
		}
		
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
	</script>
	<script>
	
		var providerManager = new editDumpsterProviders();
	
	
		$(window).resize(function(){
			$("#wrapper").height( $(window).height() - $("#header").height() - 20);
			$(".edit-main").height( $(window).height() - $("#header").height() - 30);
			$(".edit-sidebar").height( $(window).height() - $("#header").height() - 30);	
			$("#sidebar-company-choose").height( $(".edit-sidebar").height() - $("#edit-sidebar-tabs").height() - 20);
			$("#edit-company-areas").height( $(".edit-main").height() - $("#edit-company-map").height() - $("#edit-tabs").height() - 20);	
			$("#edit-company-addarea").height($(".edit-main").height() - $("#edit-tabs").height() - 20);		
			$("#edit-company-addarea-zipcode-list").height( $("#edit-company-addarea").height() / 2);
			$("#edit-company-addarea-county-list").height( $("#edit-company-addarea").height() / 2);			
		});
		
		$(document).ready(function(){
			
			//Proper resizing
			$("#wrapper").height( $(window).height() - $("#header").height() - 20);
			$(".edit-main").height( $(window).height() - $("#header").height() - 30);
			$(".edit-sidebar").height( $(window).height() - $("#header").height() - 30);
			$("#sidebar-company-choose").height( $(".edit-sidebar").height() - $("#edit-sidebar-tabs").height() - 20);
			$("#edit-company-areas").height( $(".edit-main").height() - $("#edit-company-map").height() - $("#edit-tabs").height() - 20);
			$("#edit-company-addarea").height($(".edit-main").height() - $("#edit-tabs").height() - 20);
			$("#edit-company-addarea-zipcode-list").height( $("#edit-company-addarea").height() / 2);
			$("#edit-company-addarea-county-list").height( $("#edit-company-addarea").height() / 2);
			
			
			//Start all tabs
			$("#edit-tabs").tab();
			$("#edit-sidebar-tabs").tab();
			$("#edit-company-addarea-pill-types").tab();
			
			//Load the haulers to the list
			loadHaulers();
			
			//Click handler on the autocomplete field to the left
			$("#load-companies").click(function(){
				$(this).val("");
				$("#cid").val("");
			});
			
			//Click handler to submit the company 
			$("#load-company-subm").click(function(){
				companyDetails($("#cid").val(), $("#load-company-subm > i"), {a: "icon-time", b: "icon-play"});
			});
			
			
			/*This function loads all stuff related to the chose company*/
			function companyDetails(id, iconContainer, icons){
				if(id != ""){
					
					//Switch to load icon
					iconContainer.attr("class", icons.a);
					
					//Set the company id so that the interface knows which company we are dealing with currently
					$("#company-summary-details").attr("data-companyid", id);
					
					
					//Load company related data to the fields
					$.post("php/manage.php", {"pid": id, "mode": "details"}, function(data){
						
						$("#company-summary-details").attr("data-companyname", data.body[0].provider_name);
						
						$("#company-summary-details").attr("data-companylat", data.body[0].provider_lat);
						$("#company-summary-details").attr("data-companylng", data.body[0].provider_lng);
						
						/*Fill out the general details on the first screen*/
						$("#edit-company-name").val(data.body[0].provider_name);
						$("#edit-company-address").val(data.body[0].provider_address);
						$("#edit-company-telephone").val(data.body[0].provider_phone);
						$("#edit-company-email").val(data.body[0].provider_email);
						$("#edit-company-website").val(data.body[0].provider_website);
						$("#edit-company-rank").val(data.body[0].provider_rank);
						
						$("#company-areas-list").html("");
						
						//console.log(data);
						/*Load the geometries to the second tab map*/
						
						//Modify the Area tab to show how many area the hauler has
						$("#main-tab-areas").html("Areas (" + data.geometries.rows.length + ")");
						
						fillAreaDetails(data);
						
						//Switch back from the load icon
						iconContainer.attr("class", icons.b);
						$("#company-summary-welcome").hide();
						$("#company-summary-details").show();
					});
				}
				else
				{
					alert("Please choose a company first");
				}				
			}
			
			function fillAreaDetails(data){
						
						while(providerManager.areas[0]){
							providerManager.areas.pop().setMap(null);
						}
						providerManager.areas.length = 0;
						
						var bounds = new google.maps.LatLngBounds();
						
						if(data.geometries.rows.length<=0){
							providerManager.map.fitBounds(new google.maps.LatLngBounds(new google.maps.LatLng(25.837377,-124.211606),new google.maps.LatLng(49.384359,-67.158958)));
							return;
						}
						
						for(i=0;i<data.geometries.rows.length;i++){
							var record = data.geometries.rows[i];
														
							var currentFeature_or_Features = new GeoJSON( $.parseJSON(record.geom) , {strokeColor: "#FFFF00",strokeWeight: 2,strokeOpacity: 0.75});
							
							if (currentFeature_or_Features.type && currentFeature_or_Features.type == "Error"){
								return;
							}							
							
							if (currentFeature_or_Features.length){
								for (var k = 0; k < currentFeature_or_Features.length; k++){
									if(currentFeature_or_Features[k].length){
										for(var j = 0; j < currentFeature_or_Features[i].length; j++){
											currentFeature_or_Features[k][j].setMap(providerManager.map);
											
											currentFeature_or_Features[k][j].cdbid = record.cdbid;
											
											bounds.extend(currentFeature_or_Features[k][j].getBounds().getSouthWest());
											bounds.extend(currentFeature_or_Features[k][j].getBounds().getNorthEast());
											providerManager.areas.push(currentFeature_or_Features[k][j]);
										}
									}
									else{
										currentFeature_or_Features[k].setMap(providerManager.map);
										
										currentFeature_or_Features[k].cdbid = record.cdbid;
										
										bounds.extend(currentFeature_or_Features[k].getBounds().getSouthWest());
										bounds.extend(currentFeature_or_Features[k].getBounds().getNorthEast());
										providerManager.areas.push(currentFeature_or_Features[k]);
									}
								}
							}
							else
							{
								currentFeature_or_Features.setMap(providerManager.map);
								
								currentFeature_or_Features.cdbid = record.cdbid;
								
								bounds.extend(currentFeature_or_Features.getBounds().getSouthWest());
								bounds.extend(currentFeature_or_Features.getBounds().getNorthEast());
								providerManager.areas.push(currentFeature_or_Features);
							}	

							$("#company-areas-list").append($('<tr id="tr_'+record.cdbid+'" data-highlight="'+record.cdbid+'"><td class="text-center">'+record.pid+'</td><td class="text-center">'+record.type+'</td><td class="text-center">'+record.name+'</td><td class="text-center" id="del_'+record.cdbid+'" data-cid="'+record.pid+'" data-cdbid="'+record.cdbid+'"><i class="icon-trash"></i> Delete</label></td></tr>'));
							
							$("#del_"+record.cdbid).click(function(){
								$(this).find("i").removeClass("icon-trash").addClass("icon-time");
								$.post("php/manage.php",{mode:"deletesingle", pid:$(this).attr("data-cid"),aid: $(this).attr("data-cdbid")},function(data){
									//Area deleted
									companyDetails($("#company-summary-details").attr("data-companyid"), $("#load-company-subm > i"), {a: "icon-time", b: "icon-play"});
								});
							});
							
							$("#tr_"+record.cdbid).mouseover(function(){
								for(i=0;i<providerManager.areas.length;i++){
									if($(this).attr("data-highlight") == providerManager.areas[i].cdbid){
										providerManager.areas[i].setOptions({
											strokeColor: "#00FF00",
											strokeWeight: 5,
											strokeOpacity: 1,
											fillColor: "#00FF00"
										});
									}
								}
							});
							
							$("#tr_"+record.cdbid).mouseout(function(){
								for(i=0;i<providerManager.areas.length;i++){
									if($(this).attr("data-highlight") == providerManager.areas[i].cdbid){
										providerManager.areas[i].setOptions({strokeColor: "#FFFF00",strokeWeight: 2,strokeOpacity: 0.75, fillColor: "#000000"});
									}
								}								
							});
							
							
							
						}
						providerManager.currentBounds = null;
						providerManager.currentBounds = bounds;
						
						providerManager.map.fitBounds(providerManager.currentBounds);		
			}
			
			//Function deleteCompany accepts one parameter: companyID, the ID of the company to be deleted
			function deleteCompany(companyID){
				if(companyID == null ||companyID == ""){return;}
				
				$("#edit-company-delete > i").removeClass("icon-trash");
				$("#edit-company-delete > i").addClass("icon-time")
						
				$.post("php/manage.php",{"mode":"deletehauler", "pid": companyID},function(data){
					if(data.status == "success"){
						
						//Switch back to normal icon
						$("#edit-company-delete > i").removeClass("icon-time");
						$("#edit-company-delete > i").addClass("icon-trash");
						
						loadHaulers();
						resetHaulerInfo();
						
						alert("Hauler sucessfully deleted!");
					}
					else
					{
						alert("Either an internal error occurred or there were already no records in the areas table.");
					}				
				});
			}
			
			function loadHaulers(){
				//Load all companies to the tab
				$.post("php/manage.php",{"mode": "list"},function(data){
					if(data.body.length > 0){
						$("#company-list").html("");
						for(i=0;i<data.body.length;i++){
							$("#company-list").append( $('<tr><td id="'+data.body[i].provider_id+'" data-pid="'+data.body[i].provider_id+'"><i class="icon-arrow-right"></i> '+data.body[i].provider_name+'</td></tr>') );
							
							
							
							$("#"+data.body[i].provider_id).click(function(){
								var record = $(this).find("i");
								companyDetails($(this).attr("data-pid"), record, {a:"icon-time",b:"icon-arrow-right"});
							});
						}
					}
				
				});
			}			
			
			function resetHaulerInfo(){
				$("#company-summary-details").hide();
				$("#company-summary-welcome").show();
				$("#main-tab-areas").html("Areas");
				$("#company-areas-list").html("");
				providerManager.clearAreaOverlays();
				providerManager['validZipInput'] = false;
				providerManager['validCountyInput'] = false;
			}
			
			//clearlist accepts one parameter: the id of the list container
			function clearList(listID){
				$("#"+listID).html("");
			}
			
			//Save zip code function
			function saveZIP(){
				//Read in the provider ID and provider NAME
				var providerID = $("#company-summary-details").attr("data-companyid");
				var providerNAME = $("#company-summary-details").attr("data-companyname");	

				//Check if its value is valid and makes sense
				if(providerID == null || providerID == ""){
					alert("ERROR: No company is selected! Please select a company first!");
					return;
				}

				var zips = [];

				$("#edit-company-addarea-zipcode-list-table > tr").each(function(){
					zips.push($(this).attr("data-zipcode"));
				});	
				
				var zipObj =  {"provider_id":providerID,"provider_name":providerNAME,"zipcodes": zips};
				var zipString = JSON.stringify(zipObj);

				$.post("php/manage.php",{"mode":"savezip", "attributes": zipString},function(data){
					if(data.status == "success"){
						
						//Switch back to normal icon
						$("#edit-company-addarea-zipcode-save > i").removeClass("icon-time");
						$("#edit-company-addarea-zipcode-save > i").addClass("icon-ok");
						
						//Delete the contents of the county input
						$("#edit-company-addarea-zipcode").val('');
						
						//Clear the county list
						clearList("edit-company-addarea-zipcode-list-table");
						
						//and load the whole stuff again
						companyDetails($("#company-summary-details").attr("data-companyid"), $("#load-company-subm > i"), {a: "icon-time", b: "icon-play"});
						
						alert(data.total_rows + " ZIP area recorded sucessfully into the database!");
					}
					else
					{
						alert("There was an internal error when processing your request. Please try again!");
					}
				});				
				
				
			}
			
			//Save county function
			function saveCounties(){
				//Read in the provider ID and provider NAME
				var providerID = $("#company-summary-details").attr("data-companyid");
				var providerNAME = $("#company-summary-details").attr("data-companyname");
				
				//Check if its value is valid and makes sense
				if(providerID == null || providerID == ""){
					alert("ERROR: No company is selected! Please select a company first!");
					return;
				}
				
				var areas = [];
				$("#edit-company-addarea-county-list-table > tr").each(function(){
					var countyDetails = $(this).attr("data-county").split(", ");
					var county = countyDetails[0];
					var state = countyDetails[1];
					
					areas.push({"county": county, "state": state});
					
					//console.log($(this).attr("data-county") + ", " + providerID + ", " + providerNAME);
				});
			
				var countyObj = {"provider_id":providerID,"provider_name":providerNAME,"counties": areas};
				var countyString = JSON.stringify(countyObj);
				
				$.post("php/manage.php",{"mode":"savecounty", "attributes": countyString},function(data){
					if(data.status == "success"){
						
						//Switch back to normal icon
						$("#edit-company-addarea-county-save > i").removeClass("icon-time");
						$("#edit-company-addarea-county-save > i").addClass("icon-ok");
						
						//Delete the contents of the county input
						$("#edit-company-addarea-county").val('');
						
						//Clear the county list
						clearList("edit-company-addarea-county-list-table");
						
						//and load the whole stuff again
						companyDetails($("#company-summary-details").attr("data-companyid"), $("#load-company-subm > i"), {a: "icon-time", b: "icon-play"});
						
						alert(data.total_rows + " county/ies recorded sucessfully into the database!");
					}
					else
					{
						alert("There was an internal error when processing your request. Please try again!");
					}
				});
			}			
			
			function saveRadInputs(){
			
				//Lets wait
				$("#edit-company-addarea-radius-save > i").removeClass("icon-ok");
				$("#edit-company-addarea-radius-save > i").addClass("icon-time");				
			
				//Read in the provider ID and provider NAME
				var providerID = $("#company-summary-details").attr("data-companyid");
				var providerNAME = $("#company-summary-details").attr("data-companyname");				
				
				var radii = [];
				$("#edit-company-addarea-radius-categories > div").each(function(){
					if($(this).find("[data-dtype='radius']").val() != ""){
						radii.push({radius: $(this).find("[data-dtype='radius']").val(), note: $(this).find("[data-dtype='note']").val()});
					}
				});
				
				var obj = {"lat": $("#company-summary-details").attr("data-companylat"),
								 "lng": $("#company-summary-details").attr("data-companylng") ,
								 "provider_id": providerID,
								 "provider_name": providerNAME,
								 "radii": radii
								};
												
				$.post("php/manage.php",{"mode":"saveradius", "attributes": JSON.stringify(obj) },function(data){
				
				//Now its ok, don't wait any more
				$("#edit-company-addarea-radius-save > i").removeClass("icon-time");
				$("#edit-company-addarea-radius-save > i").addClass("icon-ok");					
					
				if(data.status == "success"){
					$("#edit-company-addarea-radius-categories").html("");
					companyDetails($("#company-summary-details").attr("data-companyid"), $("#load-company-subm > i"), {a: "icon-time", b: "icon-play"});
					alert(data.total_rows + " radial area(s) recorded sucessfully into the database!");
				}
				else
				{
					alert("There was an internal error when processing your request. Please try again!");
				}
				
				});
			}
			
			//Saving of custom area function
			function saveCustom(g){

				$("#edit-company-addarea-custom-save > i").removeClass("icon-ok");
				$("#edit-company-addarea-custom-save > i").addClass("icon-time");			
				
				
				//Read in the provider ID and provider NAME
				var providerID = $("#company-summary-details").attr("data-companyid");
				var providerNAME = $("#company-summary-details").attr("data-companyname");
				
				//Check if its value is valid and makes sense
				if(providerID == null || providerID == ""){
					alert("ERROR: No company is selected! Please select a company first!");
					return;
				}
				
				var customObj = {"provider_id":providerID,"provider_name":providerNAME,"geometry": g};
				var customString = JSON.stringify(customObj);
				
				$.post("php/manage.php",{"mode":"savecustom", "attributes": customString},function(data){
					if(data.status == "success"){
						
						//Switch back to normal icon
						$("#edit-company-addarea-custom-save > i").removeClass("icon-time");
						$("#edit-company-addarea-custom-save > i").addClass("icon-ok");
						
						//Delete the contents of the county input
						$("#edit-company-addarea-custom").val('');
						
						//and load the whole stuff again
						companyDetails($("#company-summary-details").attr("data-companyid"), $("#load-company-subm > i"), {a: "icon-time", b: "icon-play"});
						providerManager.clearCustomArea();
						providerManager.custommap.fitBounds(providerManager.custombounds);
						
						alert(data.total_rows + " areas recorded sucessfully into the database!");
					}
					else
					{
						alert("There was an internal error when processing your request. Please try again!");
					}					
				});
			}
		
			function fetchLocationGeocode(address, callback){
				if(address==null || address==""){
					alert("ERROR: No hauler location information is available!");
					return;
				}
				providerManager.geocoder.geocode({"address": address}, function(results, status){
					if (status == google.maps.GeocoderStatus.OK) {
						$("#edit-company-location-lat").val(results[0].geometry.location.lat());
						$("#edit-company-location-lng").val(results[0].geometry.location.lng());
						callback();
					}
				});
			}
		
			function saveHaulerAttributeChanges(){

				$("#edit-company-submit > i").removeClass("icon-ok");
				$("#edit-company-submit > i").addClass("icon-time");	
				
				fetchLocationGeocode( $("#edit-company-address").val(), function(){
					var attributes = {
						name: $("#edit-company-name").val(),
						address: $("#edit-company-address").val(),
						lat: $("#edit-company-location-lat").val(),
						lng: $("#edit-company-location-lng").val(),
						tel: $("#edit-company-telephone").val(),
						email: $("#edit-company-email").val(),
						website: $("#edit-company-website").val(),
						rank: $("#edit-company-rank").val()
					}
				
					var providerID = $("#company-summary-details").attr("data-companyid");
					
					$.post("php/manage.php",{"mode":"changeinfo", "attributes": JSON.stringify(attributes), "pid": providerID},function(data){
						$("#edit-company-submit > i").removeClass("icon-time");
						$("#edit-company-submit > i").addClass("icon-ok");	
						//alert("Changes were saved to database!");						
						if(data.status="success"){
							companyDetails(data.provider_id, $("#load-company-subm > i"), {a: "icon-time", b: "icon-play"});
							alert("Hauler details successfully saved!");
						}
						else
						{
							alert("ERROR: An error occurred when processing your request. Please try again!");
						}
						
					});					
				});
			}

			function addRadInputs(quantity){
				$("#edit-company-addarea-radius-categories").html('');
				for(i=1;i<parseInt(quantity)+1;i++){
					if(i%2==0){
						$("#edit-company-addarea-radius-categories").append($('<div class="span3"><input data-dtype="radius" type="text" id="radius_'+i+'" class="span12" placeholder="'+i+'. Radius"/><input data-dtype="note" type="text"  id="notes_'+i+'" class="span12" placeholder="Notes"/></div>'));
						//Restricting input characters to only numbers
						$("#radius_"+i).numeric();
					}
					else
					{
						$("#edit-company-addarea-radius-categories").append($('<div class="span2"><input data-dtype="radius" type="text" id="radius_'+i+'" class="span12" placeholder="'+i+'. Radius"/><input data-dtype="note" type="text"  id="notes_'+i+'" class="span12" placeholder="Notes"/></div>'));
						//Restricting input characters to only numbers
						$("#radius_"+i).numeric();
					}
				}
			}
			
			
			//TYPEAHEADS
			$('#load-companies').typeahead({
				source: function (query, process) {
					zipCodes = [];
					map = {};
					
					
					//var data = [{"val": "A Comp."},{"val": "B Comp."},{"val": "C Comp."},{"val": "D Comp."},{"val": "E Comp."},{"val": "F Comp."}];
					$.post("./php/autosuggest.php", {'entity': query, 'mode': 'company'}, function(data){
						
						$.each(data, function (i, zipcode) {
							map[zipcode.lab] = zipcode;
							zipCodes.push(zipcode.lab);
						});
					 
						process(zipCodes);
					});	
				},
				updater: function (item) {
					$("#load-companies").val(map[item].lab);

					$("#cid").val(map[item].val);
					
					$("#load-companies").focus();
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


			$('#edit-company-addarea-zipcode').typeahead({
				source: function (query, process) {
					zipCodes = [];
					map = {};
					
					providerManager.validZipInput = false;
					
					$.post("./php/autosuggest.php", {'entity': query, 'mode': 'zip'}, function(data){
						
						$.each(data, function (i, zipcode) {
							map[zipcode.val] = zipcode;
							zipCodes.push(zipcode.val);
						});
					 
						process(zipCodes);
					});	
				},
				updater: function (item) {
					$("#edit-company-addarea-zipcode").val(map[item].lab);
					providerManager.validZipInput = true;
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
			
			$('#edit-company-addarea-county').typeahead({
				source: function (query, process) {
					counties = [];
					map = {};
					
					providerManager.validCountyInput = false;
					
					$.post("./php/autosuggest.php", {'entity': query, 'mode': 'county'}, function(data){
						
						$.each(data, function (i, county) {
							map[county.value] = county;
							counties.push(county.value);
						});
						process(counties);
					});	
					
				},
				updater: function (item) {
					$("#edit-company-addarea-county").val(map[item].label);
					providerManager.validCountyInput = true;
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
			
			
			
			
			/*Do this when the user wants to save his edits to the company details on the summary page*/
			$("#edit-company-submit").click(function(){
				saveHaulerAttributeChanges();
			});
			
			$("#edit-company-delete").click(function(){
				deleteCompany($("#company-summary-details").attr("data-companyid"));
			});
			
			/*Fire this when the tabs are switched to the map areas view*/
			$('a[data-toggle="tab"]').on('shown', function (e) {
				if(e.target.dataset.type == "company-areas"){
					//This is necessary to resize the map when you click the Areas tab				
					google.maps.event.trigger( providerManager['map'], 'resize' );
					providerManager['map'].fitBounds(providerManager.currentBounds);
				}
				else if(e.target.dataset.type == "addarea-custom"){	
					//This is necessary to resize the map when you click the Custom subtab			
					google.maps.event.trigger( providerManager['custommap'], 'resize' );				
					providerManager['custommap'].fitBounds(providerManager.custombounds);
				}
				else if(e.target.dataset.type == "addarea-radial"){
					//This is necessary to resize the map when you click the Radius subtab	
					google.maps.event.trigger( providerManager['radiusmap'], 'resize' );				
					providerManager['radiusmap'].fitBounds(providerManager.radiusBounds);					
				}
			});
			


			/*Area addition tab stuff*/
			
			

			$("#edit-company-addarea-zipcode").click(function(){
				$(this).val('');
			});
			
			$("#edit-company-addarea-zipcode-submit").click(function(){
				if(providerManager.validZipInput){
					$("#edit-company-addarea-zipcode-list-table").append($('<tr data-zipcode="'+$("#edit-company-addarea-zipcode").val()+'"><td class="text-center">'+$("#edit-company-addarea-zipcode").val()+'</td><td class="text-center" id="zip_'+$("#edit-company-addarea-zipcode").val()+'"><label><i class="icon-trash"></i> Delete</label></td></tr>'));
					$('#zip_'+$("#edit-company-addarea-zipcode").val()).click(function(){
						$(this).parent().remove();
					});
				}
				else
				{
					alert("Please make sure your ZIP code input is valid. Choose only from the dropdown list!");
				}
			});
			
			$("#edit-company-addarea-county").click(function(){
				$(this).val('');
			});
			
			$("#edit-company-addarea-county-submit").click(function(){
				if(providerManager.validCountyInput){
					$("#edit-company-addarea-county-list-table").append($('<tr data-county="'+$("#edit-company-addarea-county").val()+'"><td class="text-center">'+$("#edit-company-addarea-county").val()+'</td><td class="text-center" id="county_'+$("#edit-company-addarea-county").val().replace(" ","_").replace(",","_")+'"><label><i class="icon-trash"></i> Delete</label></td></tr>'));
					
					$('#county_'+$("#edit-company-addarea-county").val().replace(" ","_").replace(",","_")).click(function(){
						$(this).parent().remove();
					});
				}
				else
				{
					alert("Please make sure your ZIP code input is valid. Choose only from the dropdown list!");
				}
			});

			//County save button event
			$("#edit-company-addarea-county-save").click(function(){
				
				//Switch to loading icon
				$("#edit-company-addarea-county-save > i").removeClass("icon-ok");
				$("#edit-company-addarea-county-save > i").addClass("icon-time");
				
				//Start the process
				saveCounties();
			});
			
			//Zipcode save button event		
			$("#edit-company-addarea-zipcode-save").click(function(){
				
				//Switch to loading icon
				$("#edit-company-addarea-zipcode-save > i").removeClass("icon-ok");
				$("#edit-company-addarea-zipcode-save > i").addClass("icon-time");
				
				//Start the process
				saveZIP();
			});
			
			$("#edit-company-addarea-custom").keypress(function(e){
				if(e.which == 13){
					$("#edit-company-addarea-custom-locate").trigger('click');
				}
				else
				{
					return;
				}
			});
			
			//Locate button event custom area
			$("#edit-company-addarea-custom-locate").click(function(){
				providerManager.customLocate($("#edit-company-addarea-custom").val());
			});			
			
			//Cancellation of saving custom area button event
			$("#edit-company-addarea-custom-cancel").click(function(){
				providerManager.clearCustomArea();	
			});

			//Save custom area button event
			$("#edit-company-addarea-custom-save").click(function(){
				var geometry = providerManager.getCustomGeometry();				
				if(geometry){
					saveCustom(geometry);	
				}
				else
				{
					alert("ERROR: An error ocurred while trying to save your custom area. Please try again!");
					return;				
				}
			});
						
			//This happens when we want to visualize the radial areas
			$("#edit-company-addarea-radius-display").click(function(){

				while(providerManager.radiusAreas[0]){
					providerManager.radiusAreas.pop().setMap(null);
				}
				providerManager.radiusAreas.length = 0;
				
				var radii = [];
					radii.push(0);
				
				$("#edit-company-addarea-radius-categories > div").each(function(){
					if($(this).find("[data-dtype='radius']").val() != ""){
						radii.push(parseFloat($(this).find("[data-dtype='radius']").val()));
					}
				});
				
				if( $("#company-summary-details").attr("data-companylat") != "" && $("#company-summary-details").attr("data-companylng") != ""){
					var centerLat = parseFloat($("#company-summary-details").attr("data-companylat"));
					var centerLng = parseFloat($("#company-summary-details").attr("data-companylng"));
				}
				for(i=0;i<radii.length;i++){
					providerManager.radiusAreas.push(new google.maps.Polygon({paths: [drawCircle(new google.maps.LatLng(centerLat, centerLng), parseInt(radii[i]), 1), drawCircle(new google.maps.LatLng(centerLat, centerLng), parseInt(radii[i+1]), -1)],strokeColor: "#0000FF",strokeOpacity: 0.8,strokeWeight: 2,fillColor: "#FF0000",fillOpacity: 0.35,map: providerManager['radiusmap']}));
				}
				
				providerManager.radiusmap.setCenter(new google.maps.LatLng(centerLat, centerLng));
				providerManager.radiusmap.setZoom(6);
			});
			
			$("#edit-company-addarea-radius-cancel").click(function(){
				while(providerManager.radiusAreas[0]){
					providerManager.radiusAreas.pop().setMap(null);
				}
				providerManager.radiusAreas.length = 0;
				providerManager.radiusmap.fitBounds(providerManager.radiusBounds);
				
				$("#edit-company-addarea-radius-categories").html("");
				
			});
			
			$("#edit-company-addarea-radius-save").click(function(){
				saveRadInputs();
			});
			
			$(".btn-group button").each(function(){
				var button = $(this);
				button.click(function(){
					addRadInputs(button.html());
				});
			});
			

		
		
		});
		
		
		function editDumpsterProviders(){
			var me = this;
				 me.geocoder = new google.maps.Geocoder();
			/*Hauler area display*/
			me.currentBounds = new google.maps.LatLngBounds(new google.maps.LatLng(25.837377,-124.211606),new google.maps.LatLng(49.384359,-67.158958));
			me.areas = [];
			
			/*Custom area overlay(s)*/
			me.overlays = [];
			
			me.validZipInput = false;
			me.validCountyInput = false;
			
			me.map = new google.maps.Map(document.getElementById("edit-company-map"), {
				center: new google.maps.LatLng(45,-95),
				zoom:3,
				mapTypeId: google.maps.MapTypeId.ROADMAP
			});
			
			
			me.clearAreaOverlays = function(){
				while(me.areas[0]){
					me.areas.pop().setMap(null);
				}
				me.areas.length = 0;
				me.currentBounds = new google.maps.LatLngBounds(new google.maps.LatLng(25.837377,-124.211606),new google.maps.LatLng(49.384359,-67.158958));
				me.map.fitBounds(me.currentBounds);
			}
			
			/*--------*/
			
			/*Custom hauler area addition map*/
			
			me.custombounds = new google.maps.LatLngBounds(new google.maps.LatLng(25.837377,-124.211606),new google.maps.LatLng(49.384359,-67.158958));
			
			me.custommap = new google.maps.Map(document.getElementById("edit-company-addarea-custommap"), {
				center: new google.maps.LatLng(45,-95),
				zoom:3,
				mapTypeId: google.maps.MapTypeId.ROADMAP				
			});
			
			me.customDrawingManager = new google.maps.drawing.DrawingManager({
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
			});
			
			me.customDrawingManager.setMap(me.custommap); 
			
			google.maps.event.addListener(me['customDrawingManager'], 'overlaycomplete', function(e) {
				me['customDrawingManager'].setDrawingMode(null);
				me['overlays'].push(e.overlay);
			});	
					
			google.maps.event.addListener(me['customDrawingManager'], 'drawingmode_changed', function(e){
				if(me['overlays'].length > 0 && me['customDrawingManager']['drawingMode'] == "polygon"){
					me['customDrawingManager'].setDrawingMode(null);
				}
			});				
			
			me.customLocate = function(address){
				if(address==null || address==""){return;}
				me.geocoder.geocode({"address": address},function(results, status){
					if (status == google.maps.GeocoderStatus.OK) {
						me.custommap.setCenter(results[0].geometry.location);
						me.custommap.setZoom(12);
					}
				});
				
			}
			
			me.clearCustomArea = function(){
				if(me['overlays'].length==0){return;}
				while(me['overlays'][0]){
					me['overlays'].pop().setMap(null);
				}
				me['overlays'].length = 0;				
			}
		
			me.getCustomGeometry = function(){
				if(me['overlays'].length>0){
					
					var path = me['overlays'][0].getPath();
					var coordinates = [];
					
					path.forEach(function(latlng, index){
						coordinates.push([latlng.lng(), latlng.lat()].join(" "));
					});
					
					coordinates.push(path.getAt(0).lng() + " " + path.getAt(0).lat());
					
					return coordinates.join(",");
										
				}	
				else
				{
					return false;
				}				
			}
		
			/*Radius area map*/
			
			me.radiusAreas = [];
			me.radiusBounds = new google.maps.LatLngBounds(new google.maps.LatLng(25.837377,-124.211606),new google.maps.LatLng(49.384359,-67.158958));
			
			me.radiusmap = new google.maps.Map(document.getElementById("edit-company-addarea-radiusmap"), {
				center: new google.maps.LatLng(45,-95),
				zoom:3,
				mapTypeId: google.maps.MapTypeId.ROADMAP					
			});
		
		}
		
	</script>

  </body>
</html>
