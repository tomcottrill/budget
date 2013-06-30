<?php

require 'php/classes/class.main.php';

$client = new serviceAreaMapping();

$query = "SELECT p.*, a.Alert, 
e.theyKnowUsAs,
e.flatRateOrHaul,
e.knowBroker,
e.ourPhone,
e.ourAddress,
e.contact1Name,
e.contact1Email,
e.contact1Phone,
e.contact2Name,
e.contact2Email,
e.contact2Phone,
e.contact3Name,
e.contact3Email,
e.contact3Phone,
e.contact4Name,
e.contact4Email,
e.contact4Phone,
e.CostCalculation,
e.GeneralNotes, e.timeZone
 From budgetdumpster_providers p 
LEFT JOIN alerts a ON (a.provider_id = p.provider_id)
LEFT JOIN extended_info e ON (e.ProviderID = p.provider_id)
WHERE p.provider_id = " . $_GET['id'];

$result = $client -> con -> performQuery($query);
$data = mysql_fetch_assoc($result);

$query = "SELECT p.*, w.Name from pricingstructures p LEFT JOIN wastetypes w ON (w.ID = p.WasteType) where Hauler = " . $_GET['id'];

$wt = $client -> con -> performQuery($query);
while ($row = mysql_fetch_assoc($wt)) {
	$structures[] = $row;
}
if ($data['timeZone'] == "") {$tz = "EDT";
} else {$tz = $data['timeZone'];
}
$dateTime = new DateTime("now", new DateTimeZone($tz));
?>
<!DOCTYPE html>
<html>
  <head>
    <title>Hauler Notes and Details</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet" media="screen">
  </head>
  <body>
  	<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="myModalLabel">ALERT</h3>
  </div>
  <div class="modal-body">
    <p><?php echo $data['Alert']; ?></p>
  </div>
  <div class="modal-footer">
    <button class="btn" data-dismiss="modal" aria-hidden="true">Close</button>

  </div>
</div>
   <ul class="nav nav-tabs" id="myTab">
  <li class="active"><a href="#notes">Notes</a></li>
  <?php $tabs = "";
	$tabs_content = "";
	foreach ($structures as $structure) {
		$tabs .= "<li><a href='#" . $structure['Name'] . $structure['ID'] . "' data-toggle=\"tab\">" . $structure['Name'] . "</a></li>\n";

		$tabs_content .= "<div class=\"tab-pane\" id=\"" . $structure['Name'] . $structure['ID'] . "\">\n";
		$tabs_content .= "<table class = 'table'>";
		$tabs_content .= "<tr>";
		$tabs_content .= "<td><b>Size</b></td>";
		$tabs_content .= "<td><b>Price</b></td>";
		$tabs_content .= "<td><b>Notes</b></td>";
		$tabs_content .= "</tr>";

		$psarray = array(10, 12, 15, 18, 20, 25, 30, 40);

		foreach ($psarray as $ps) {

			if (!$structure[$ps . 'Y'] == NULL) {
				$tabs_content .= "<tr>";
				$tabs_content .= "<td>$ps Y</td>";
				$tabs_content .= "<td><a href='#' class='price' data-toggle=\"popover\" data-placement=\"right\" data-content=\"Our Cost: " . $structure[$ps . 'YCost'] . "\">$" . $structure[$ps . 'Y'] . "</a></td>";
				$tabs_content .= "<td>" . $structure[$ps . 'YNotes'] . "</td>";
				$tabs_content .= "</tr>";
			}
		}

		$tabs_content .= "</table>";

		$tabs_content .= "</table>";

		$tabs_content .= "</div>\n";

	}
?>
 <?php echo $tabs; ?>
</ul>
 
<div class="tab-content">
  <div class="tab-pane active" id="notes">
  	
  	
  	<div class="accordion" id="accordion2">
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">
        Notes
      </a>
    </div>
    <div id="collapseOne" class="accordion-body collapse in">
      <div class="accordion-inner">
      	<div class="well-small"><b>Current Time: <?php echo $dateTime -> format("H:i:s"); ?></b></div>
       <div class="well"> <?php
	echo $data['GeneralNotes'];
  	?>
  	</div>
      </div>
    </div>
  </div>
  
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseTwo">
        Hauler Info
      </a>
    </div>
    <div id="collapseTwo" class="accordion-body collapse">
      <div class="accordion-inner">
     
        
        <div class = "row">
      		<div class="span10">
        <table class="table">
        	<tr>
        		<td><b>Name:</b></td>
        		<td><?php echo $data['provider_name']; ?></td>
        		<td><b>Know we're a Broker?:</b></td>
        		<td><?php echo $data['knowBroker']; ?></td>
        	</tr>
        	<tr>
        		<td><b>Address:</b></td>
        		<td><?php echo $data['provider_address']; ?></td>
        		<td><b>They know us as:</b></td>
        		<td><?php echo $data['theyKnowUsAs']; ?></td>
        	</tr>
        	<tr>
        		<td><b>Phone:</b></td>
        		<td><?php echo $data['provider_email']; ?></td>
        		<td><b>Flat Rate or Haul Plus:</b></td>
        		<td><?php echo $data['flatRateOrHaul']; ?></td>
        	</tr>
        	<tr>
        		<td><b>Site:</b></td>
        		<td><?php echo $data['provider_website']; ?></td>
        		<td><b>Our Address:</b></td>
        		<td><?php echo $data['ourAddress']; ?>
        			
        		</td>
        	</tr>
        	<tr>
        		<td></td>
        		<td></td>
        		<td><b>Our Phone:</b></td>
        		<td>
        			<?php echo $data['ourPhone']; ?>
        		</td>
        	</tr>
        </table>
        </div>
        </div>
        
        
      </div>
    </div>
  </div>
  
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseThree">
        Contacts
      </a>
    </div>
    <div id="collapseThree" class="accordion-body collapse">
      <div class="accordion-inner">
        <table class="table">
										<thead>
											<th>Contact Name</th>
											<th>Contact Email</th>
											<th>Contact Phone</th>
										</thead>
										<tbody>
											<tr>
												<td><?php echo $data['contact1Name']; ?>
												</td>
												<td>
												<?php echo $data['contact1Email']; ?>
												</td>
												<td>
												<?php echo $data['contact1Phone']; ?>
												</td>
											</tr>
											<tr>
												<td>
												<?php echo $data['contact2Name']; ?>
												</td>
												<td>
												<?php echo $data['contact2Email']; ?>
												</td>
												<td>
												<?php echo $data['contact2Phone']; ?>
												</td>
											</tr>
											<tr>
												<td>
												<?php echo $data['contact3Name']; ?>
												</td>
												<td>
												<?php echo $data['contact3Email']; ?>
												</td>
												<td>
												<?php echo $data['contact3Phone']; ?>
												</td>
											</tr>
											<tr>
												<td>
												<?php echo $data['contact4Name']; ?>
												</td>
												<td>
												<?php echo $data['contact4Email']; ?>
												</td>
												<td>
												<?php echo $data['contact4Phone']; ?>
												</td>
											</tr>
										</tbody>
									</table>

      </div>
    </div>
  </div>
  
  <div class="accordion-group">
    <div class="accordion-heading">
      <a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseFour">
        Cost Explained
      </a>
    </div>
    <div id="collapseFour" class="accordion-body collapse">
      <div class="accordion-inner">
        <div class="well">
        	<?php
			echo $data['CostCalculation'];
  	?>
        
      </div>
    </div>
  </div>
  
  
 
  	
  	
  	
  </div>

</div>
</div>
<?php
echo $tabs_content;
?>
 

    <script src="http://code.jquery.com/jquery.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script><?php if($data['Alert'] <> ""){?>
		$('#myModal').modal();
    <?php } ?>
		$(".price").popover();
		$('#myTab a').click(function(e) {
			e.preventDefault();
			$(this).tab('show');
		})
</script>
  </body>
</html>