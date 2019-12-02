<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet">
<script src="bootstrap/js/jquery.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eneam</title>
    <!-- Bootstrap Core CSS -->
    <link href="../css/bootstrap.min.css" rel="stylesheet">
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.4/jquery.min.js"></script>
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
</head>
<body>
  <br><br>
<div class="container">

    <h1>Table Professeur/Matière/Salle</h1>
    <br><br>
<!-- Button trigger modal -->
<a class="btn btn-default btn-lg" href="../tables.php">
  Retour
</a>

<br>
<?php
    require('conn.php');

  $messagesParPage=5; //Nous allons afficher 6 messages par page.
 
//Une connexion SQL doit être ouverte avant cette ligne...
$retour_total=$mysqli->query('SELECT COUNT(*) AS total FROM cours'); //Nous récupérons le contenu de la requête dans $retour_total$mem = mysqli_fetch_assoc($members);
$donnees_total= mysqli_fetch_assoc($retour_total); //On range retour sous la forme d'un tableau.
$total=$donnees_total['total']; //On récupère le total pour le placer dans la variable $total.
 
//Nous allons maintenant compter le nombre de pages.
$nombreDePages=ceil($total/$messagesParPage);
 
if(isset($_GET['page'])) // Si la variable $_GET['page'] existe...
{
     $pageActuelle=intval($_GET['page']);
 
     if($pageActuelle>$nombreDePages) // Si la valeur de $pageActuelle (le numéro de la page) est plus grande que $nombreDePages...
     {
          $pageActuelle=$nombreDePages;
     }
}
else // Sinon
{
     $pageActuelle=1; // La page actuelle est la n°1    
}
 
 
$premiereEntree=($pageActuelle-1)*$messagesParPage; // On calcul la première entrée à lire
 
// La requête sql pour récupérer les messages de la page actuelle.

    $result = $mysqli->query('SELECT * FROM cours ORDER BY id DESC LIMIT '.$premiereEntree.', '.$messagesParPage.'');
?>
    <div class="row">
        <div id="member" class="col-lg-12">                            
            
<table class="table">
  <thead class="btn-light">
                <tr>
      <th scope="col">id</th>
      <th scope="col">Professeur</th>
      <th scope="col">Matière</th>
      <th scope="col">Salle</th>
      <th scope="col">Statut</th>
      <th scope="col">Mise à niveau</th>
      <th scope="col">Supprimer</th>
                </tr>
                </thead>
                <tbody><?php
     while ($mem = mysqli_fetch_assoc($result)):

        echo '<tr>';
           echo '<td>'.$mem['id'].'</td>';
           echo '<td>'.$mem['prof'].'</td>';
           echo '<td>'.$mem['matiere'].'</td>';
           echo '<td>'.$mem['salle'].'</td>';
           if ($mem['statut'] ==0) {
             echo '<td>En cours...</td>';
           }else
           echo '<td>Terminer</td>';
            echo '<td>
                    <a class="btn btn-small btn-success"
                       data-toggle="modal"
                       data-target="#exampleModal"
                       data-whatever="'.$mem['id'].' ">Update</a>
                 </td>';
            echo '<td>
                    <a class="btn btn-small btn-danger"
                       data-toggle="modal"
                       data-target="#ex"
                       data-whatever="'.$mem['id'].' ">Delete</a>
                 </td>';
                 
        echo '</tr>';
     endwhile;

echo '<p align="center">Page N°: '; //Pour l'affichage, on centre la liste des pages
for($i=1; $i<=$nombreDePages; $i++) //On fait notre boucle
{
     //On va faire notre condition
     



     if($i==$pageActuelle) //Si il s'agit de la page actuelle...
     {
         echo " <a class='btn btn-info'>| $i |</a> "; 
     }  
     else //Sinon...
     {
          echo " <a class='btn btn-light' href='index.php?page=$i '>$i</a>";
     }
     
}
     /* free result set */
     $result->close();
?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="memberModalLabel">Modification</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <div class="dash">
             <!-- Content goes in here -->
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="example" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="memberModalLabel">Informations</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <div class="dash">
             <!-- Content goes in here -->
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="ex" tabindex="-1" role="dialog" aria-labelledby="memberModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title" id="memberModalLabel">Suppresion</h4>
                <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
            </div>
            <div class="dash">
             <!-- Content goes in here -->
            </div>
        </div>
    </div>
</div>
</body>

<script>
    $('#exampleModal').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'id=' + recipient;

            $.ajax({
                type: "GET",
                url: "editdata.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    console.log(data);
                    modal.find('.dash').html(data);
                },
                error: function(err) {
                    console.log(err);
                }
            });  
    })
 </script>

<script>
    $('#example').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'id=' + recipient;

            $.ajax({
                type: "GET",
                url: "read.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    console.log(data);
                    modal.find('.dash').html(data);
                },
                error: function(err) {
                    console.log(err);
                }
            });  
    })
 </script>

<script>
    $('#ex').on('show.bs.modal', function (event) {
          var button = $(event.relatedTarget) // Button that triggered the modal
          var recipient = button.data('whatever') // Extract info from data-* attributes
          var modal = $(this);
          var dataString = 'id=' + recipient;

            $.ajax({
                type: "GET",
                url: "del.php",
                data: dataString,
                cache: false,
                success: function (data) {
                    console.log(data);
                    modal.find('.dash').html(data);
                },
                error: function(err) {
                    console.log(err);
                }
            });  
    })
 </script>

<style type="text/css">
  h1
  {
    margin-left: 230px;
    font-family: Ink Free;
  }
  .modal-title{
    padding-left: -150px;
  }
  body
  {
    background: grey;
  }
  button
  {
    font-family: Comic Sans Ms;
    color: black;
  }
  p
  {
    color: white;
  }
  td
  {
    color: white;
  }
  .p
  {
    font-family: arial;
  }
  .n
  {
    color: red;
  }
  .v
  {
    color: green;
  }
  .ou
  {
    color: yellow;
  }
  .o
  {
    color: orange;
  }
  a
  {
    color: black;
  }
</style></html>