<?php
// Démarrer la session et désactiver les rapports d'erreur
session_start();
error_reporting(0);

// Vérifier si l'utilisateur est connecté en tant qu'administrateur
if ($_SESSION['is_admin'] != 1) {
  // Rediriger vers la page de connexion si l'utilisateur n'est pas un administrateur
  header('location:../sign-in.php');
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="../../assets/img/1.png">
  <title>
    Administrateur
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
</head>

<body class="g-sidenav-show  bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" target="_blank">
        <img src="../../assets/img/1.png" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Administrateur
        </span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link  active" href="./Admindashboard.php">
            <div>
              <img style="width:25px" src="../../assets/img/dashboard.png" alt="">
            </div>
            <span class="nav-link-text ms-1">Tableau de bord</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="./BrandList.php">
            <div>
              <img style="width:25px" src="../../assets/img/brands.png" alt="">

            </div>
            <span class="nav-link-text ms-1">Liste des marques</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link  " href="./InfluencerList.php">
            <div>
              <img style="width:25px" src="../../assets/img/inf.png" alt="">

            </div>

            <span class="nav-link-text ms-1">Liste des influenceurs</span>
          </a>
        </li>
        <li class="nav-item mt-3">
          <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">GESTION DES UTILISATEURS</h6>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="./Contract.php">
            <div>
              <img style="width:25px" src="../../assets/img/contrat.png" alt="">
            </div>
            <span class="nav-link-text ms-1">Liste des contrats</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link  " href="./DeleteUser.php">
            <div>
              <img style="width:28px" src="../../assets/img/delete.png" alt="">
            </div>
            <span class="nav-link-text ms-1">Suppression</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="../Deconnexion.php">
          <div >
            <img style="width:25px" src="../../assets/img/logout.png" alt="">
            </div>
            <span class="nav-link-text ms-1">Se déconnecter</span>
          </a>
        </li>


      </ul>
    </div>

  </aside>
  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tableau de bord</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Administrateur</h6>
        </nav>

      </div>
    </nav>
    <!-- End Navbar -->

    <?php
    // Inclure le fichier de connexion à la base de données
    include('../dbconnect.php');

    // Préparer une requête pour extraire des données de la base de données
    $read1 = $data->prepare('SELECT
    (SELECT COUNT(*) FROM user WHERE isBrand = 1) as TotalBrands,
    (SELECT COUNT(*) FROM user WHERE isInfluencer = 1) as TotalInfluencers,
    (SELECT COUNT(*) FROM Partnership) as TotalContracts,
    (SELECT COUNT(*) FROM account_deletion) as TotalDeletions;  
');
    $read1->execute([]);
    // Stocker les données extraites dans un tableau associatif
    $res1 = $read1->fetchAll(PDO::FETCH_ASSOC);
    ?>


    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0  font-weight-bold">Total des marques
                    </p>
                    <h5 class="font-weight-bolder mb-0">
                      <?= $res1[0]['TotalBrands'] ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"><img style="width: 80%;  margin-top: -10px;" src="../../assets//img/brand.png" alt=""></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0  font-weight-bold">Total des influenceurs</p>
                    <h5 class="font-weight-bolder mb-0">
                      <?= $res1[0]['TotalInfluencers'] ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"><img style="width: 70%; margin-top: -10px;" src="../../assets//img/influ.png" alt=""></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0  font-weight-bold">Nouveau contrat</p>
                    <h5 class="font-weight-bolder mb-0">
                      +<?= $res1[0]['TotalContracts'] ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"><img style="width: 70%; margin-top: -10px;" src="../../assets//img/Contract.png" alt=""></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="col-xl-3 col-sm-6">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Suppression</p>
                    <h5 class="font-weight-bolder mb-0">
                      +<?= $res1[0]['TotalDeletions'] ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"><img style="width: 80%; margin-top: -10px;" src="../../assets/img/del.png" alt=""></i>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>




    </div>
  </main>




</body>

</html>