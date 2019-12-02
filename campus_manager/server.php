<?php
session_start();

// initializing variables
$username = "";
$email    = "";
$role  = "";
$errors = array(); 

// connect to the database
$db = mysqli_connect('ftp.jeboostemonentreprise.com', 'jeboostemonentre_myalitousr', 'ZKSriGs*Ahk,', 'jeboostemonentre_myAlito');

// REGISTER USER
if (isset($_POST['reg_user'])) {
  // receive all input values from the form
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $nom = mysqli_real_escape_string($db, $_POST['nom']);
  $prenom = mysqli_real_escape_string($db, $_POST['prenom']);
  $email = mysqli_real_escape_string($db, $_POST['email']);
  $role = mysqli_real_escape_string($db, $_POST['role']);
  $ville = mysqli_real_escape_string($db, $_POST['ville']);
  $cel = mysqli_real_escape_string($db, $_POST['cel']);
  $naiss = mysqli_real_escape_string($db, $_POST['naiss']);
  $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
  $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

  // form validation: ensure that the form is correctly filled ...
  if ($password_1 != $password_2) {
	array_push($errors, "Mot de passe different");
  }

  // first check the database to make sure 
  // a user does not already exist with the same username and/or email
  $user_check_query = "SELECT * FROM users WHERE username='$username' OR email='$email' LIMIT 1";
  $result = mysqli_query($db, $user_check_query);
  $user = mysqli_fetch_assoc($result);
  
  if ($user) { // if user exists
    if ($user['username'] === $username) {
      array_push($errors, "Ce Pseudo existe deja");
    }

    if ($user['email'] === $email) {
      array_push($errors, "Cet email existe deja");
    }

  }

  // Finally, register user if there are no errors in the form
  if (count($errors) == 0) {
  	$password = md5($password_1);//encrypt the password before saving in the database

  	$query = "INSERT INTO users (username, nom, prenom, email, naiss, role, ville, numero, password) 
  			  VALUES('$username', '$nom', '$prenom', '$email', '$naiss', '$role', '$ville', '$cel', '$password')";
  	mysqli_query($db, $query);
  	$_SESSION['username'] = $username;
    $_SESSION['email'] = $email;
  	$_SESSION['success'] = "Inscription valider";
     array_push($errors, "Inscription valider");

  }
}

// ...
// ... 

// LOGIN USER
if (isset($_POST['login_user'])) {
  $username = mysqli_real_escape_string($db, $_POST['username']);
  $password = mysqli_real_escape_string($db, $_POST['password']);


  if (count($errors) == 0) {
    $password = md5($password);
    $query = "SELECT * FROM users WHERE username='$username' AND password='$password'";
    $results = mysqli_query($db, $query);
    if (mysqli_num_rows($results) == 1) {
      $_SESSION['username'] = $username;
      $_SESSION['success'] = "Vous ête connecté";
      header('location: examples/');
    }else {
      array_push($errors, "Mauvais pseudo /ou Mauvais Mot de passe ");
    }
  }
}

?>