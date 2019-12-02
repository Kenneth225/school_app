<?php
    require('conn.php');
    $id = $_GET['id'];

    if (!empty($_POST['submit'])) {
    	$id = $_POST['id'];
    	$prof = $_POST['prof'];
    	$matiere = $_POST['matiere'];
    	$salle = $_POST['salle'];
    	$statut = $_POST['statut'];
    	$mysqli->query("UPDATE `cours` SET `prof`='$prof', `matiere`='$matiere', `salle`='$salle', `statut` ='$statut' WHERE `id`='$id'");

    	header("location:index.php");
    }

    $members = $mysqli->query("SELECT * FROM `cours` WHERE `id`='$id'");
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
<form method="post" action="editdata.php" role="form">
	<div class="modal-body">
		<div class="form-group">
		    <label for="id">ID</label>
		    <input type="text" class="form-control" id="id" name="id" value="<?php echo $mem['id'];?>" readonly="true"/>
		</div>
		<div class="form-group">
		    <label for="name">Professeur</label>
	            <input type="text" class="form-control"  name="prof" value="<?php echo $mem['prof'];?>" />
		</div>
		<div class="form-group">
		    <label for="phone">Matiere</label>
	            <input type="text" class="form-control"  name="matiere" value="<?php echo $mem['matiere'];?>" />
		</div>
		<div class="form-group">
		     <label for="address">Salle</label>
		     <input type="text" class="form-control"  name="salle" value="<?php echo $mem['salle'];?>" />
		</div>
		<div class="form-group">
		     <label for="statut">Statut</label>
		     <select name="statut" class="form-control">
		     	<option value="<?php echo $mem['statut'];?>">En cours..</option>
		     	<option value="1">Terminer</option>
		     </select>

		</div>
		</div>
		<div class="modal-footer">
		     <input type="submit" class="btn btn-primary" name="submit" value="Update" />&nbsp;
		     <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	</form>
</body>
</html>