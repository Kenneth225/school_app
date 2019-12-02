<?php 

    require('conn.php');
    $id = $_GET['id'];

    if (isset($_POST['submit'])) {
    	$id = $_POST['id'];
    	$mysqli->query("DELETE FROM `communike` WHERE `id`=$id");
    	header("location:index.php");
    }

    $members = $mysqli->query("SELECT * FROM `communike` WHERE `id`='$id'");
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
<form method="post" action="del.php" role="form">
	<p>Voulez-vous vraiment exécuter la requête de suppression ?</p>

		    <input type="hidden" class="form-control" id="id" name="id" value="<?php echo $mem['id'];?>" readonly="true"/>
		     <input type="submit" class="btn btn-primary" name="submit" value="Oui" />&nbsp;
		     <button type="button" class="btn btn-default" data-dismiss="modal">Non</button>
		     </form>
		</div>
	
</body>
</html>