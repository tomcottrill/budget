<?php

require '../classes/class.main.php';

$list = new serviceAreaMapping();
$id = $_GET['id'];

$query = "SELECT ps.*, wt.Name From pricingstructures ps LEFT JOIN wastetypes wt ON (WasteType = wt.ID) WHERE Hauler = $id order by Name";

$ps = $list -> con -> performQuery($query);
?>
<thead>
	<th>WasteType</th>
	<th>10Y Price</th>
	<th>12Y Price</th>
	<th>15Y Price</th>
	<th>18Y Price</th>
	<th>20Y Price</th>
	<th>25Y Price</th>
	<th>30Y Price</th>
	<th>40Y Price</th>
	<th>Action</th>
</thead>
<tbody>
	<?php
	while ($row = mysql_fetch_assoc($ps)) {
		echo "
	<tr>
		";
		echo "<td><a href='#' id='WasteType'  class = 'wtcheck' data-type='select' data-pk='" . $row['ID'] . "' data-url=\"actions/updateps.php\" data-title=\"Select WasteType\">" . $row['Name'] . "</a></td>";
		echo "<td>$<a href='#' id='10Y'  class = 'test' data-type='text' data-pk='" . $row['ID'] . "' data-url=\"actions/updateps.php\" data-title=\"Enter price\">" . $row['10Y'] . "</a></td>";
		echo "<td>$<a href='#' id='12Y'  class = 'test' data-type='text' data-pk='" . $row['ID'] . "' data-url=\"actions/updateps.php\" data-title=\"Enter price\">" . $row['12Y'] . "</a></td>";
		echo "<td>$<a href='#' id='15Y'  class = 'test' data-type='text' data-pk='" . $row['ID'] . "' data-url=\"actions/updateps.php\" data-title=\"Enter price\">" . $row['15Y'] . "</a></td>";
		echo "<td>$<a href='#' id='18Y'  class = 'test' data-type='text' data-pk='" . $row['ID'] . "' data-url=\"actions/updateps.php\" data-title=\"Enter price\">" . $row['18Y'] . "</a></td>";
		echo "<td>$<a href='#' id='20Y'  class = 'test' data-type='text' data-pk='" . $row['ID'] . "' data-url=\"actions/updateps.php\" data-title=\"Enter price\">" . $row['20Y'] . "</a></td>";
		echo "<td>$<a href='#' id='25Y'  class = 'test' data-type='text' data-pk='" . $row['ID'] . "' data-url=\"actions/updateps.php\" data-title=\"Enter price\">" . $row['25Y'] . "</a></td>";
		echo "<td>$<a href='#' id='30Y'  class = 'test' data-type='text' data-pk='" . $row['ID'] . "' data-url=\"actions/updateps.php\" data-title=\"Enter price\">" . $row['30Y'] . "</a></td>";
		echo "<td>$<a href='#' id='40Y'  class = 'test' data-type='text' data-pk='" . $row['ID'] . "' data-url=\"actions/updateps.php\" data-title=\"Enter price\">" . $row['40Y'] . "</a></td>";
		echo "<td rewspan=2><a  class=\"btn btn-danger delps\" rel = " . $row['ID'] . "> - </a></td>";

		echo "</tr><tr><td>Costs</td>";

		echo "<td>$<a href='#' id='10YCost'  class = 'test' data-type='text' data-pk='" . $row['ID'] . "' data-url=\"actions/updateps.php\" data-title=\"Enter cost\">" . $row['10YCost'] . "</a></td>";
		echo "<td>$<a href='#' id='12YCost'  class = 'test' data-type='text' data-pk='" . $row['ID'] . "' data-url=\"actions/updateps.php\" data-title=\"Enter cost\">" . $row['12YCost'] . "</a></td>";
		echo "<td>$<a href='#' id='15YCost'  class = 'test' data-type='text' data-pk='" . $row['ID'] . "' data-url=\"actions/updateps.php\" data-title=\"Enter cost\">" . $row['15YCost'] . "</a></td>";
		echo "<td>$<a href='#' id='18YCost'  class = 'test' data-type='text' data-pk='" . $row['ID'] . "' data-url=\"actions/updateps.php\" data-title=\"Enter cost\">" . $row['18YCost'] . "</a></td>";
		echo "<td>$<a href='#' id='20YCost'  class = 'test' data-type='text' data-pk='" . $row['ID'] . "' data-url=\"actions/updateps.php\" data-title=\"Enter cost\">" . $row['20YCost'] . "</a></td>";
		echo "<td>$<a href='#' id='25YCost'  class = 'test' data-type='text' data-pk='" . $row['ID'] . "' data-url=\"actions/updateps.php\" data-title=\"Enter cost\">" . $row['25YCost'] . "</a></td>";
		echo "<td>$<a href='#' id='30YCost'  class = 'test' data-type='text' data-pk='" . $row['ID'] . "' data-url=\"actions/updateps.php\" data-title=\"Enter cost\">" . $row['30YCost'] . "</a></td>";
		echo "<td>$<a href='#' id='40YCost'  class = 'test' data-type='text' data-pk='" . $row['ID'] . "' data-url=\"actions/updateps.php\" data-title=\"Enter cost\">" . $row['40YCost'] . "</a></td>";
		echo "</tr>";

		echo "</tr><tr><td colspan=6><b>Notes</b><br>";
		echo "<b>10 Y Notes:</b> <a href='#' id='10YNotes'  class = 'test' data-type='textarea' data-pk='" . $row['ID'] . "' data-url=\"actions/updateps.php\" data-title=\"Enter Notes\">" . $row['10YNotes'] . "</a><br>";
		echo "<b>12 Y Notes:</b> <a href='#' id='12YNotes'  class = 'test' data-type='textarea' data-pk='" . $row['ID'] . "' data-url=\"actions/updateps.php\" data-title=\"Enter Notes\">" . $row['12YNotes'] . "</a><br>";
		echo "<b>15 Y Notes:</b> <a href='#' id='15YNotes'  class = 'test' data-type='textarea' data-pk='" . $row['ID'] . "' data-url=\"actions/updateps.php\" data-title=\"Enter Notes\">" . $row['15YNotes'] . "</a><br>";
		echo "<b>18 Y Notes:</b> <a href='#' id='18YNotes'  class = 'test' data-type='textarea' data-pk='" . $row['ID'] . "' data-url=\"actions/updateps.php\" data-title=\"Enter Notes\">" . $row['18YNotes'] . "</a><br>";
		echo "<b>20 Y Notes:</b> <a href='#' id='20YNotes'  class = 'test' data-type='textarea' data-pk='" . $row['ID'] . "' data-url=\"actions/updateps.php\" data-title=\"Enter Notes\">" . $row['20YNotes'] . "</a><br>";
		echo "<b>25 Y Notes:</b> <a href='#' id='25YNotes'  class = 'test' data-type='textarea' data-pk='" . $row['ID'] . "' data-url=\"actions/updateps.php\" data-title=\"Enter Notes\">" . $row['25YNotes'] . "</a><br>";
		echo "<b>30 Y Notes:</b> <a href='#' id='30YNotes'  class = 'test' data-type='textarea' data-pk='" . $row['ID'] . "' data-url=\"actions/updateps.php\" data-title=\"Enter Notes\">" . $row['30YNotes'] . "</a><br>";
		echo "<b>40 Y Notes:</b> <a href='#' id='40YNotes'  class = 'test' data-type='textarea' data-pk='" . $row['ID'] . "' data-url=\"actions/updateps.php\" data-title=\"Enter Notes\">" . $row['40YNotes'] . "</a><br>";
		echo "</td></tr>";
	}
		?>
</tbody>