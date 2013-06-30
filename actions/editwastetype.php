<?php
require '../php/classes/class.main.php';
$wt = new serviceAreaMapping();

$wastetypes = $wt -> con -> performQuery("Select * from wastetypes where ID = " . $_GET['id']);
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>BudgetDumpster</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<!-- Le styles -->
		<link href="../css/bootstrap.css" rel="stylesheet">
		<link href="../css/default.css" rel="stylesheet">
		<style>
			body {
				padding-top: 60px; /* 60px to make the container go all the way to the bottom of the topbar */
			}
		</style>
		<link href="../css/bootstrap-responsive.css" rel="stylesheet">

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
								<a href="../index.php">Add</a>
							</li>
							<li>
								<a href="../edit.php">Edit</a>
							</li>
							<li>
								<a href="../search.php">Search</a>
							</li>
							<li class="active">
								<a href="wastetypes.php">Waste Type Management</a>
							</li>
						</ul>
					</div><!--/.nav-collapse -->
				</div>
			</div>
		</div>
		<div class="container">
			<?php $row = mysql_fetch_assoc($wastetypes); ?>
			<form action = "updatewastetype.php" method="post">
				<input type="hidden" name = "ID" value ="<?php echo $row['ID']; ?>" >
				<input type="text" class="input-medium" name = "Name" value ="<?php echo $row['Name']; ?>" >
				<br>
				<button class="btn btn-primary" type="submit">
					Update
				</button>
			</form>
		</div>
		</div>
	</body>

</html>