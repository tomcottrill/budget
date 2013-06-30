<?php
require '../classes/class.main.php';
$query = "Select * from extended_info where ProviderID = " . $_GET['id'];
$client = new serviceAreaMapping();
$result = $client -> con -> performQuery($query);
$row = mysql_fetch_assoc($result);
if (mysql_num_rows($result) == 0) {
	$query = "Insert Into extended_info (ProviderID) VALUES (" . $_GET['id'] . ")";
	$result = $client -> con -> performQuery($query);
	$query = "Select * from extended_info where ProviderID = " . $_GET['id'];
	$result = $client -> con -> performQuery($query);
	$row = mysql_fetch_assoc($result);

}
 ?>

<H4>What they know</H4>
<table class="table">
										
										<tbody>
											<tr>
												<td>
												<b>They know us as: </b>
												</td>
												<td>
												<a href='#' id='theyKnowusAs'  class = 'test' data-type='text' data-pk='<?php echo $row['ID']; ?>' data-url="actions/updateei.php" data-title="They know us as:"><?php echo $row['theyKnowUsAs']; ?></a>
												</td>
											
											</tr>
											<tr>
												<td>
												<b>Flat Rate or Haul Plus: </b>
												</td>
												<td>
												<a href='#' id='flatRateOrHaul'  class = 'fhp' data-type='select' data-pk='<?php echo $row['ID']; ?>' data-url="actions/updateei.php" data-title="Select One"><?php echo $row['flatRateOrHaul']; ?></a>
												</td>
											
											</tr>
											<tr>
												<td>
												<b>Do they know we're a broker: </b>
												</td>
												<td>
												<a href='#' id='knowBroker'  class = 'kb' data-type='select' data-pk='<?php echo $row['ID']; ?>' data-url="actions/updateei.php" data-title="Select One"><?php echo $row['knowBroker']; ?></a>
												</td>
											
											</tr>
											<tr>
												<td>
												<b>Our Phone Number</b>
												</td>
												<td>
												<a href='#' id='ourPhone'  class = 'test' data-type='tel' data-pk='<?php echo $row['ID']; ?>' data-url="actions/updateei.php" data-title="Our Phone:"><?php echo $row['ourPhone']; ?></a>
												</td>
											
											</tr>
											<tr>
												<td>
												<b>Our Address: </b>
												</td>
												<td>
												<a href='#' id='ourAddress'  class = 'test' data-type='wysihtml5' data-pk='<?php echo $row['ID']; ?>' data-url="actions/updateei.php" data-title="Our Address:"><?php echo $row['ourAddress']; ?></a>
												</td>
											
											</tr>
											<tr>
												<td>
												<b>Their Time Zone: </b>
												</td>
												<td>
												<a href='#' id='timeZone'  class = 'tz' data-type='select' data-pk='<?php echo $row['ID']; ?>' data-url="actions/updateei.php" data-title="Time Zone:"><?php echo $row['timeZone']; ?></a>
												</td>
											
											</tr>
											
											<tr>
												<td>
												<b>Search Text: </b>
												</td>
												<td>
												<a href='#' id='searchText'  class = 'test' data-type='text' data-pk='<?php echo $row['ID']; ?>' data-url="actions/updateei.php" data-title="Time Zone:"><?php echo $row['searchText']; ?></a>
												</td>
											
											</tr>
											
										</tbody>
									</table>
<H4> Contact Information</H4>
<table class="table">
										<thead>
											<th>Contact Name</th>
											<th>Contact Email</th>
											<th>Contact Phone</th>
										</thead>
										<tbody>
											<tr>
												<td>
												<a href='#' id='contact1Name'  class = 'test' data-type='text' data-pk='<?php echo $row['ID']; ?>' data-url="actions/updateei.php" data-title="Name:"><?php echo $row['contact1Name']; ?></a>
												</td>
												<td>
												<a href='#' id='contact1Email'  class = 'test' data-type='email' data-pk='<?php echo $row['ID']; ?>' data-url="actions/updateei.php" data-title="Email:"><?php echo $row['contact1Email']; ?></a>
												</td>
												<td>
												<a href='#' id='contact1Phone'  class = 'test' data-type='tel' data-pk='<?php echo $row['ID']; ?>' data-url="actions/updateei.php" data-title="Phone:"><?php echo $row['contact1Phone']; ?></a>
												</td>
											</tr>
											<tr>
												<td>
												<a href='#' id='contact2Name'  class = 'test' data-type='text' data-pk='<?php echo $row['ID']; ?>' data-url="actions/updateei.php" data-title="Name:"><?php echo $row['contact2Name']; ?></a>
												</td>
												<td>
												<a href='#' id='contact2Email'  class = 'test' data-type='email' data-pk='<?php echo $row['ID']; ?>' data-url="actions/updateei.php" data-title="Email:"><?php echo $row['contact2Email']; ?></a>
												</td>
												<td>
												<a href='#' id='contact2Phone'  class = 'test' data-type='tel' data-pk='<?php echo $row['ID']; ?>' data-url="actions/updateei.php" data-title="Phone:"><?php echo $row['contact2Phone']; ?></a>
												</td>
											</tr>
											<tr>
												<td>
												<a href='#' id='contact3Name'  class = 'test' data-type='text' data-pk='<?php echo $row['ID']; ?>' data-url="actions/updateei.php" data-title="Name:"><?php echo $row['contact3Name']; ?></a>
												</td>
												<td>
												<a href='#' id='contact3Email'  class = 'test' data-type='email' data-pk='<?php echo $row['ID']; ?>' data-url="actions/updateei.php" data-title="Email:"><?php echo $row['contact3Email']; ?></a>
												</td>
												<td>
												<a href='#' id='contact3Phone'  class = 'test' data-type='tel' data-pk='<?php echo $row['ID']; ?>' data-url="actions/updateei.php" data-title="Phone:"><?php echo $row['contact3Phone']; ?></a>
												</td>
											</tr>
											<tr>
												<td>
												<a href='#' id='contact4Name'  class = 'test' data-type='text' data-pk='<?php echo $row['ID']; ?>' data-url="actions/updateei.php" data-title="Name:"><?php echo $row['contact4Name']; ?></a>
												</td>
												<td>
												<a href='#' id='contact4Email'  class = 'test' data-type='email' data-pk='<?php echo $row['ID']; ?>' data-url="actions/updateei.php" data-title="Email:"><?php echo $row['contact4Email']; ?></a>
												</td>
												<td>
												<a href='#' id='contact4Phone'  class = 'test' data-type='tel' data-pk='<?php echo $row['ID']; ?>' data-url="actions/updateei.php" data-title="Phone:"><?php echo $row['contact4Phone']; ?></a>
												</td>
											</tr>
										</tbody>
									</table>
									


<H4> Notes</H4>
<table class="table">
										<thead>
											<th>Notes</th>
											
										</thead>
										<tbody>
											<tr>
												<td>
												<a href='#' id='GeneralNotes'  class = 'test' data-type='wysihtml5' data-pk='<?php echo $row['ID']; ?>' data-url="actions/updateei.php" data-title="Notes:"><?php echo $row['GeneralNotes']; ?></a>
												</td>
											
											</tr>
										</tbody>
									</table>
									
<H4>Cost Calculation Notes</H4>
<table class="table">
										<thead>
											<th>Notes</th>
											
										</thead>
										<tbody>
											<tr>
												<td>
												<a href='#' id='CostCalculation'  class = 'test' data-type='wysihtml5' data-pk='<?php echo $row['ID']; ?>' data-url="actions/updateei.php" data-title="Cost Calculation:"><?php echo $row['CostCalculation']; ?></a>
												</td>
											
											</tr>
										</tbody>
									</table>
									
