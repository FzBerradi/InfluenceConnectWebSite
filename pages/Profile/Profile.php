<?php

// Démarrer la session
session_start();

// Désactiver l'affichage des erreurs
error_reporting(0);

// Récupérer les variables de l'URL
$accountId = $_GET['accountId'];
$from = $_GET['from'];

// Récupérer les variables de session
$session = $_SESSION['iduser'];
$isadmin = $_SESSION['is_admin'];
$isbrand = $_SESSION['is_brand'];
$isinf = $_SESSION['is_influencer'];

// Inclure le fichier de connexion à la base de données
include('../dbconnect.php');

// Préparer la requête pour récupérer les informations de l'utilisateur
$user = $data->prepare('SELECT * FROM user WHERE ID=?');
$user->execute([$accountId]);

// Récupérer les informations de l'utilisateur
$info = $user->fetch();

// Récupérer le rôle et le nom de l'utilisateur
$role = $info['isBrand'];
$name = $info['firstName'];

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../assets/img/1.png">
  <title>
    Profil
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <!-- Nucleo Icons -->
  <link href="../../assets/css/nucleo-icons.css" rel="stylesheet" />
  <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link href="../../assets/css/nucleo-svg.css" rel="stylesheet" />
  <!-- CSS Files -->
  <link id="pagestyle" href="../../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
  <style>

.card{
    width: 100%;
    margin: 0 0 0 30%;
}
  </style>
</head>

<body class="g-sidenav-show bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="#" target="_blank">
        <img src="../../assets/img/1.PNG" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Profil</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">

    <?php 
  // Vérifiez si l'utilisateur est une marque
  if ( $isbrand) { 
    // Si c'est le cas, incluez la barre latérale de marque
    include_once('BrandSideBar.php'); 
  // Sinon, vérifiez si l'utilisateur est un influenceur
  } else if ( $isinf) { 
    // Si c'est le cas, incluez la barre latérale de l'influenceur
    include_once('InfluencerSideBar.php'); 
  // Sinon, vérifiez si l'utilisateur est un administrateur
  } else if( $isadmin ){ 
    // Si c'est le cas, incluez la barre latérale de l'administrateur
    include_once('adminSideBar.php'); 
  } 
?>

    </div>

  </aside>
  <div class="main-content position-relative bg-gray-100 max-height-vh-100 h-100">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg bg-transparent shadow-none position-absolute px-4 w-100 z-index-2">
      <div class="container-fluid py-1">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 ps-2 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="text-white opacity-5" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-white active" aria-current="page">Profil</li>
          </ol>
          <h6 class="text-white font-weight-bolder ms-2">Profil</h6>
        </nav>

      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid">
      <div class="page-header min-height-300 border-radius-xl mt-4" style="background-image: url('../../assets/img/curved-images/curved0.jpg'); background-position-y: 50%;">
        <span class="mask bg-gradient-primary opacity-6"></span>
      </div>
      <div class="card card-body blur shadow-blur mx-4 mt-n6 overflow-hidden">
        <div class="row gx-4">
          <div class="col-auto">
            <div class="avatar avatar-xl position-relative">
              <img src="../../images/<?= $info['ImageProfile'] ?>" alt="profile_image" class="w-100 border-radius-lg shadow-sm">
            </div>
          </div>
          <div class="col-auto my-auto">
            <div class="h-100">
            <?php
if ($role == 1) { // Si l'utilisateur est une marque, affiche son prénom et son rôle
?>
  <h5 class="mb-1">
    <?= $info['firstName'] ?>
  </h5>
  <p class="mb-0 font-weight-bold text-sm">
    Marque
  </p>
<?php
} else { // Sinon, si l'utilisateur est un influenceur, affiche son prénom, son nom de famille et son rôle
?>
  <h5 class="mb-1">
    <?= $info['firstName'] ?>
    <?= $info['lastName'] ?>
  </h5>
  <p class="mb-0 font-weight-bold text-sm">
    Influenceur
  </p>
<?php
}
?>
            </div>
          </div>
          <?php
          if ($session != $accountId) {

          ?>
            <div class="col-lg-4 col-md-6 my-sm-auto ms-sm-auto me-sm-0 mx-auto mt-3">
              <div class="nav-wrapper position-relative end-0">
                <ul class="nav nav-pills nav-fill p-1 bg-transparent" role="tablist">

                  <li class="nav-item">
                    <a class="nav-link mb-0 px-0 py-1 " data-bs-toggle="tab" href="javascript:;" role="tab" aria-selected="false">
                      <span class="ms-1">Messages</span>
                    </a>
                  </li>

                </ul>
              </div>
            </div>
          <?php } ?>
        </div>
      </div>
    </div>
    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-12 col-xl-7">
          <div class="card h-100">
            <div class="card-header pb-0 p-3">
              <div class="row">
                <div class="col-md-8 d-flex align-items-center">
                  <h6 class="mb-0">Informations du profil</h6>
                </div>
                <?php
                if ($session == $accountId) {

                ?>
                  <div class="col-md-4 text-end">
                    <a style="margin:0 50px 0 0" href="./EditProfile.php?from=profile&accountId=<?= $info['ID'] ?>">
                      <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
                    </a>
                    <a href="Domand.php">
                        <i class="far fa-trash-alt me-2"></i>
                    </a>
                    
                  </div>
                <?php
                }
                ?>
              </div>
            </div>
            <div class="card-body p-3">
              <?php
              if ($role == 1) {
              ?>
                <p class="text-sm">
                  <?= $info['discription'] ?>
                </p>
                <hr class="horizontal gray-light my-4">

                <ul class="list-group">


                  <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nom de la marque:</strong> &nbsp; <?= $info['firstName'] ?></li>
                  <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Adresse:</strong> &nbsp; <?= $info['address'] ?></li>
                  <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Chiffre d'affaires:</strong> &nbsp; <?= $info['ca'] ?> MAD</li>

                <?php
              } else {
                ?>
                  <ul class="list-group">
                    <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nom complet:</strong> &nbsp; <?= $info['firstName'] ?> <?= $info['lastName'] ?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Genre:</strong> &nbsp; <?= $info['gender'] ?></li>
                    <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Age:</strong> &nbsp; <?= $info['age'] ?></li>
                  <?php
                }
                  ?>


                  <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Téléphone:</strong> &nbsp; <?= $info['PhoneNumber'] ?></li>
                  <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong> &nbsp; <?= $info['Email'] ?></li>

                  <?php
                  if ($role != 1) {

                  ?>

                    <li class="list-group-item border-0 ps-0 pb-0">
                      <strong class="text-dark text-sm">Réseaux sociaux:</strong> &nbsp;
                      <a class="btn btn-facebook btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                        <i class="fab fa-facebook fa-lg"></i>
                      </a>
                      <a class="btn btn-twitter btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                        <i class="fab fa-tiktok fa-lg"></i>
                      </a>
                      <a class="btn btn-instagram btn-simple mb-0 ps-1 pe-2 py-0" href="javascript:;">
                        <i class="fab fa-instagram fa-lg"></i>
                      </a>
                    </li>
                  <?php
                  }

                  ?>
                  </ul>
            </div>
          </div>
        </div>


      </div>
 
    </div>
  </div>

 
</body>

</html>