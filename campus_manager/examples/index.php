<?php
session_start(); 

  if (!isset($_SESSION['username'])) {
    $_SESSION['msg'] = "Vous devez vous connecté d'abord";
    header('location: index.php');
  }
  if (isset($_GET['logout'])) {
    session_destroy();
    unset($_SESSION['username']);
    header("location: index.php");
  }
include "../server_api/dbconnection.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../assets/img/favicon.png">
  <title>
    Eneam
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Poppins:200,300,400,600,700,800" rel="stylesheet" />
  <link href="https://use.fontawesome.com/releases/v5.0.6/css/all.css" rel="stylesheet">
  <!-- Nucleo Icons -->
  <link href="../assets/css/nucleo-icons.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="../assets/css/black-dashboard.css?v=1.0.0" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../assets/demo/demo.css" rel="stylesheet" />
</head>

<body class="">
  <div class="wrapper">
    <div class="sidebar">
      <!--
        Tip 1: You can change the color of the sidebar using: data-color="blue | green | orange | red"
    -->
      <div class="sidebar-wrapper">
        <div class="logo">
          <a href="javascript:void(0)" class="simple-text logo-mini">
            Campus
          </a>
          <a href="javascript:void(0)" class="simple-text logo-normal">
            Manager
          </a>
        </div>
        <ul class="nav">
          <li class="active ">
            <a href="./index.php">
              <i class="tim-icons icon-chart-pie-36"></i>
              <p>Dashboard</p>
            </a>
          </li>
          <li>
            <a href="./communique.php">
              <i class="tim-icons icon-volume-98"></i>
              <p>Communiqué</p>
            </a>
          </li>
          <li>
            <a href="./ajouter.php">
              <i class="tim-icons icon-simple-add"></i>
              <p>Ajouter</p>
            </a>
          </li>
          <li>
            <a href="./tables.php">
              <i class="tim-icons icon-puzzle-10"></i>
              <p>Tables</p>
            </a>
          </li>
          <li>
            <a href="./note_prof.php">
              <i class="tim-icons icon-chart-bar-32"></i>
              <p>Notes Professeur</p>
            </a>
          </li>
          <li >
            <a href="./senateur.php">
              <i class=" tim-icons icon-bullet-list-67"></i>
              <p>Définir Sénateur</p>
            </a>
          </li>
        </ul>
      </div>
    </div>
    <div class="main-panel">
      <!-- Navbar -->
      <nav class="navbar navbar-expand-lg navbar-absolute navbar-transparent">
        <div class="container-fluid">
          <div class="navbar-wrapper">
            <div class="navbar-toggle d-inline">
              <button type="button" class="navbar-toggler">
                <span class="navbar-toggler-bar bar1"></span>
                <span class="navbar-toggler-bar bar2"></span>
                <span class="navbar-toggler-bar bar3"></span>
              </button>
            </div>
            <a class="navbar-brand" href="javascript:void(0)">Dashboard</a>
          </div>
          <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navigation" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
            <span class="navbar-toggler-bar navbar-kebab"></span>
          </button>
          <div class="collapse navbar-collapse" id="navigation">
            <ul class="navbar-nav ml-auto">
              <li class="search-bar input-group">
                <button class="btn btn-link" id="search-button" data-toggle="modal" data-target="#searchModal"><i class="tim-icons icon-zoom-split" ></i>
                  <span class="d-lg-none d-md-block">Search</span>
                </button>
              </li>
              <li class="dropdown nav-item">
                <a href="#" class="dropdown-toggle nav-link" data-toggle="dropdown">
                  <div class="photo">
                    <img src="../assets/img/anime3.png" alt="Profile Photo">
                  </div>
                  <b class="caret d-none d-lg-block d-xl-block"></b>
                  <p class="d-lg-none">
                    Log out
                  </p>
                </a>
                <ul class="dropdown-menu dropdown-navbar">
                  <li class="dropdown-divider"></li>
                                          <?php  
            $rq = $bdd->query("SELECT * FROM users WHERE role='homme' LIMIT 1");
  while ($donnees = $rq->fetch())
{?>
                  <li class="nav-link"><a href="./map.php" class="nav-item dropdown-item">Ajouter</a></li>
                  <?php
} // Fin de la boucle des billets
$rq->closeCursor();
?>
                  <li class="nav-link"><a href="../index.php?logout='1'" class="nav-item dropdown-item">Log out</a></li>
                </ul>
              </li>
              <li class="separator d-lg-none"></li>
            </ul>
          </div>
        </div>
      </nav>
      <div class="modal modal-search fade" id="searchModal" tabindex="-1" role="dialog" aria-labelledby="searchModal" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <input type="text" class="form-control" id="inlineFormInputGroup" placeholder="SEARCH">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <i class="tim-icons icon-simple-remove"></i>
              </button>
            </div>
          </div>
        </div>
      </div>
      <!-- End Navbar -->
      <div class="content">

        <div class="row">
          <div class="col-lg-4">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Total Etudiants</h5>
                <h3 class="card-title"><?php 
                        $req = $bdd->prepare('SELECT COUNT(*) FROM membres ' );
$req->execute(array($_SESSION['username']));
while ($donnees = $req->fetch()){
echo $donnees[0];
}
?></h3>
              </div>
              <div class="card-body">
                <i class="tim-icons icon-bell-55 text-primary"></i>
              </div>
            </div>
          </div>

          <div class="col-lg-4">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Total Inscrit</h5>
                <h3 class="card-title"><?php 
                        $req = $bdd->prepare('SELECT COUNT(*) FROM etudiant ' );
$req->execute(array($_SESSION['username']));
while ($donnees = $req->fetch()){
echo $donnees[0];
}
?></h3>
              </div>
              <div class="card-body">
               <i class="tim-icons icon-delivery-fast text-info"></i> 
            </div>
          </div>
        </div>
          <div class="col-lg-4">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Total Messages</h5>
                <h3 class="card-title"><?php 
                        $req = $bdd->prepare('SELECT COUNT(*) FROM msge ' );
$req->execute(array($_SESSION['username']));
while ($donnees = $req->fetch()){
echo $donnees[0];
}
?></h3>
              </div>
              <div class="card-body">
                <i class="tim-icons icon-send text-success"></i> 
              </div>
            </div>
          </div>
        </div>

        <hr>

       <div class="row">
          <div class="col-lg-4">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Total Professeurs</h5>
                <h3 class="card-title"><?php 
                        $req = $bdd->prepare('SELECT COUNT(*) FROM prof ' );
$req->execute(array($_SESSION['username']));
while ($donnees = $req->fetch()){
echo $donnees[0];
}
?></h3>
              </div>
              <div class="card-body">
                <i class="tim-icons icon-bell-55 text-primary"></i> 
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Total Communiqués Publiés</h5>
                <h3 class="card-title"><?php 
                        $req = $bdd->prepare('SELECT COUNT(*) FROM communike ' );
$req->execute(array($_SESSION['username']));
while ($donnees = $req->fetch()){
echo $donnees[0];
}
?></h3>
              </div>
              <div class="card-body">
                <i class="tim-icons icon-delivery-fast text-info"></i> 
              </div>
            </div>
          </div>
          <div class="col-lg-4">
            <div class="card card-chart">
              <div class="card-header">
                <h5 class="card-category">Professeur/Matière/Salle</h5>
                <h3 class="card-title"><?php 
                        $req = $bdd->prepare('SELECT COUNT(*) FROM cours ' );
$req->execute(array($_SESSION['username']));
while ($donnees = $req->fetch()){
echo $donnees[0];
}
?></h3>
              </div>
              <div class="card-body">
                <i class="tim-icons icon-send text-success"></i> 
              </div>
            </div>
          </div>
        </div>

        <div class="row">
          <div class="col-lg-6 col-md-12">
            <div class="card card-tasks">
              <div class="card-header ">
                <h6 class="title d-inline">Communiqués</h6>
                <p class="card-category d-inline">(5)Derniers</p>
              </div>
              <div class="card-body ">
                <div class="table-full-width table-responsive">
                  <table class="table">
                    <tbody>
                           <?php  
            $rq = $bdd->query("SELECT * FROM communike ORDER BY id DESC LIMIT 5");
  while ($donnees = $rq->fetch())
{?>
  <tr>
                        <td>
                          
                        </td>
                        <td>
                          <p class="title"><?php echo $donnees['titre'];?></p>
                          <p class="text-muted"><?php echo $donnees['contenu'];?></p>
                        </td>
                        <td class="td-actions text-right">
                         Posté  le <?php echo $donnees['creation'];?>
                        </td>
                      </tr>

<?php
} // Fin de la boucle des billets
$rq->closeCursor();
?>
                      
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>

          <div class="col-lg-6 col-md-12">
           <div class="card card-tasks">
              <div class="card-header ">
                <h6 class="title d-inline">Messages</h6>
                <p class="card-category d-inline">(5)Derniers</p>
              </div>
              <div class="card-body ">
                <div class="table-full-width table-responsive">
                  <table class="table">
                    <tbody>
                                               <?php  
            $rq = $bdd->query("SELECT * FROM msge ORDER BY id DESC LIMIT 5");
  while ($donnees = $rq->fetch())
{?>
  <tr>
                        <td>
                          
                        </td>
                        <td>
                          <p class="title"><?php echo $donnees['auteur'];?></p>
                          <p class="text-muted"><?php echo $donnees['contenu'];?></p>
                        </td>
                        <td class="td-actions text-right">
                          <?php echo $donnees['creation'];?>
                        </td>
                      </tr>

<?php
} // Fin de la boucle des billets
$rq->closeCursor();
?>
                    </tbody>
                  </table>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>


      <footer class="footer">
        <div class="container-fluid">
          
          <div class="copyright">
            ©
            <script>
              document.write(new Date().getFullYear())
            </script>-2018
            <a href="javascript:void(0)" target="_blank">SQUAD</a>Copyright.
          </div>
        </div>
      </footer>
    </div>
  </div>
  <div class="fixed-plugin">
    <div class="dropdown show-dropdown">
      <a href="#" data-toggle="dropdown">
        <i class="fa fa-cog fa-2x"> </i>
      </a>
      <ul class="dropdown-menu">
        <li class="header-title"> Sidebar Arrière Plan</li>
        <li class="adjustments-line">
          <a href="javascript:void(0)" class="switch-trigger background-color">
            <div class="badge-colors text-center">
              <span class="badge filter badge-primary active" data-color="primary"></span>
              <span class="badge filter badge-info" data-color="blue"></span>
              <span class="badge filter badge-success" data-color="green"></span>
            </div>
            <div class="clearfix"></div>
          </a>
        </li>
        <li class="adjustments-line text-center color-change">
          <span class="color-label">LIGHT MODE</span>
          <span class="badge light-badge mr-2"></span>
          <span class="badge dark-badge ml-2"></span>
          <span class="color-label">DARK MODE</span>
        </li>
        
       
      </ul>
    </div>
  </div>
  <!--   Core JS Files   -->
  <script src="../assets/js/core/jquery.min.js"></script>
  <script src="../assets/js/core/popper.min.js"></script>
  <script src="../assets/js/core/bootstrap.min.js"></script>
  <script src="../assets/js/plugins/perfect-scrollbar.jquery.min.js"></script>
  <!--  Google Maps Plugin    -->
  <!-- Place this tag in your head or just before your close body tag. -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Chart JS -->
  <script src="../assets/js/plugins/chartjs.min.js"></script>
  <!--  Notifications Plugin    -->
  <script src="../assets/js/plugins/bootstrap-notify.js"></script>
  <!-- Control Center for Black Dashboard: parallax effects, scripts for the example pages etc -->
  <script src="../assets/js/black-dashboard.min.js?v=1.0.0"></script><!-- Black Dashboard DEMO methods, don't include it in your project! -->
  <script src="../assets/demo/demo.js"></script>
  <script>
    $(document).ready(function() {
      $().ready(function() {
        $sidebar = $('.sidebar');
        $navbar = $('.navbar');
        $main_panel = $('.main-panel');

        $full_page = $('.full-page');

        $sidebar_responsive = $('body > .navbar-collapse');
        sidebar_mini_active = true;
        white_color = false;

        window_width = $(window).width();

        fixed_plugin_open = $('.sidebar .sidebar-wrapper .nav li.active a p').html();



        $('.fixed-plugin a').click(function(event) {
          if ($(this).hasClass('switch-trigger')) {
            if (event.stopPropagation) {
              event.stopPropagation();
            } else if (window.event) {
              window.event.cancelBubble = true;
            }
          }
        });

        $('.fixed-plugin .background-color span').click(function() {
          $(this).siblings().removeClass('active');
          $(this).addClass('active');

          var new_color = $(this).data('color');

          if ($sidebar.length != 0) {
            $sidebar.attr('data', new_color);
          }

          if ($main_panel.length != 0) {
            $main_panel.attr('data', new_color);
          }

          if ($full_page.length != 0) {
            $full_page.attr('filter-color', new_color);
          }

          if ($sidebar_responsive.length != 0) {
            $sidebar_responsive.attr('data', new_color);
          }
        });

        $('.switch-sidebar-mini input').on("switchChange.bootstrapSwitch", function() {
          var $btn = $(this);

          if (sidebar_mini_active == true) {
            $('body').removeClass('sidebar-mini');
            sidebar_mini_active = false;
            blackDashboard.showSidebarMessage('Sidebar mini deactivated...');
          } else {
            $('body').addClass('sidebar-mini');
            sidebar_mini_active = true;
            blackDashboard.showSidebarMessage('Sidebar mini activated...');
          }

          // we simulate the window Resize so the charts will get updated in realtime.
          var simulateWindowResize = setInterval(function() {
            window.dispatchEvent(new Event('resize'));
          }, 180);

          // we stop the simulation of Window Resize after the animations are completed
          setTimeout(function() {
            clearInterval(simulateWindowResize);
          }, 1000);
        });

        $('.switch-change-color input').on("switchChange.bootstrapSwitch", function() {
          var $btn = $(this);

          if (white_color == true) {

            $('body').addClass('change-background');
            setTimeout(function() {
              $('body').removeClass('change-background');
              $('body').removeClass('white-content');
            }, 900);
            white_color = false;
          } else {

            $('body').addClass('change-background');
            setTimeout(function() {
              $('body').removeClass('change-background');
              $('body').addClass('white-content');
            }, 900);

            white_color = true;
          }


        });

        $('.light-badge').click(function() {
          $('body').addClass('white-content');
        });

        $('.dark-badge').click(function() {
          $('body').removeClass('white-content');
        });
      });
    });
  </script>
  <script>
    $(document).ready(function() {
      // Javascript method's body can be found in assets/js/demos.js
      demo.initDashboardPageCharts();

    });
  </script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "black-dashboard-free"
      });
  </script>
</body>

</html>