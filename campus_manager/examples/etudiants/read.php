<?php
    require('conn.php');
    $id = $_GET['id'];

    $members = $mysqli->query("SELECT * FROM resto WHERE id='$id'");
    $mem = mysqli_fetch_assoc($members);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Using Bootstrap modal</title>

    <!-- Bootstrap Core CSS -->
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
	<div class="modal-body">
<ul>
	<li><?php echo $mem['id'];?></li>
	<li><?php echo $mem['nom'];?></li>
	<li><?php echo $mem['adresse'];?></li>
	<li><?php echo $mem['tel'];?></li>
 </ul>
	</div>
		
</body>
</html>