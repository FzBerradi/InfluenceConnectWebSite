<!DOCTYPE html>
<html lang="en">
<?php
// Démarrer une session PHP
session_start();

// Désactiver la notification d'erreur de PHP
error_reporting(0);

// Vérifier si l'utilisateur est connecté en tant qu'administrateur en vérifiant la variable de session "is_admin"
if ($_SESSION['is_admin'] != 1) {
  // Si l'utilisateur n'est pas connecté en tant qu'administrateur, il est redirigé vers la page de connexion
  header('location:../sign-in.php');
}
?>

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
  <style>
    .user-info {
      display: flex;
      align-items: center;
    }

    .user-info img {
      flex-shrink: 0;
      margin-right: 10px;
    }

    .user-info h6 {
      margin: 0;
      font-size: 14px;
    }
  </style>
</head>

<body class="g-sidenav-show  bg-gray-100">
  <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="#" target="_blank">
        <img src="../../assets/img/1.PNG" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Administrateur</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="./Admindashboard.php">
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
          <a class="nav-link  active" href="./ValidUser.php">
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tableau des contrats</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Administrateur</h6>
        </nav>

      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">



      <div class="row">
        <div class="col-12">
          <div class="card mb-4">
            <div class="card-header pb-0">
              <h6>Liste des contrats</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">marque</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">influenceur</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">prix</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">STATUT DE CONFIRMATION DE LA MARQUE</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">STATUT DE CONFIRMATION DE L'INFLUENCEUR</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">DATE DE DÉBUT</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">DATE DE FIN</th>
                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php
// Inclure le fichier de connexion à la base de données
include('../dbconnect.php');

// Préparer une requête pour sélectionner des données à partir des tables Partnership, user (2 fois) et user (1 fois)
// en sélectionnant les colonnes nécessaires et en joignant les tables en fonction des ID de marque et d'influenceur
$read1 = $data->prepare('SELECT u2.ImageProfile AS brandprofile , u3.ImageProfile AS influencerrofile  ,  u2.email AS brandemail ,u3.email AS influencerEmail , u2.firstName AS brandFirstName, u2.lastName AS brandLastName, u3.firstName AS influencerFirstName, u3.lastName AS influencerLastName, 
                     p.brandConfirmed, p.InfluencerConfirmed, p.price, p.StartDate, p.EndDate
              FROM Partnership p
              JOIN user u2 ON p.BrandID = u2.ID
              JOIN user u3 ON p.InfluencerID = u3.ID
              JOIN user u1 ON u1.ID = u2.ID
              
              
              ');

// Exécuter la requête en passant un tableau vide pour les paramètres
$read1->execute([]);

// Récupérer tous les résultats de la requête sous forme de tableau associatif
$res1 = $read1->fetchAll(PDO::FETCH_ASSOC);

// Parcourir chaque ligne de résultats
foreach ($res1 as $row) {
  // Le code pour traiter chaque ligne de résultats sera placé ici



                    ?>

                      <tr>
                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <img src="../../images/<?= $row["brandprofile"] ?>" class="avatar avatar-sm me-3" alt="user1">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm"><?= $row["brandFirstName"] ?></h6>
                              <p class="text-xs text-secondary mb-0"><?= $row["brandemail"] ?></p>
                            </div>
                          </div>
                        </td>

                        <td>
                          <div class="d-flex px-2 py-1">
                            <div>
                              <img src="../../images/<?= $row["influencerrofile"] ?>" class="avatar avatar-sm me-3" alt="user1">
                            </div>
                            <div class="d-flex flex-column justify-content-center">
                              <h6 class="mb-0 text-sm"><?= $row["influencerFirstName"] ?> <?= $row["influencerLastName"] ?></h6>
                              <p class="text-xs text-secondary mb-0"><?= $row["influencerEmail"] ?></p>
                            </div>
                          </div>
                        </td>

                        <td>
                          <span class="text-secondary text-xs font-weight-bold"><?= $row["price"] ?> MAD</span>

                        </td>
                        <td class="align-middle text-center text-sm">
                          <?php
                          // Vérifier si la marque est confirmée en comparant la valeur de la colonne "brandConfirmed" avec 1
                          if ($row["brandConfirmed"] == 1) {
                          ?>
                            <!-- Si la marque est confirmée, afficher un badge "Confirmé" avec une couleur de fond verte -->
                            <span class="badge badge-sm bg-gradient-success">Confirmé</span>

                          <?php
                          } else {
                          ?>
                            <!-- Si la marque n'est pas confirmée, afficher un badge "Non confirmé" avec une couleur de fond grise -->
                            <span class="badge badge-sm bg-gradient-secondary">Non confirmé</span>

                          <?php
                          }
                          ?>
                        </td>

                        <td class="align-middle text-center text-sm">
                          <?php
                          // Vérifier si l'influenceur est confirmé en comparant la valeur de la colonne "InfluencerConfirmed" avec 1
                          if ($row["InfluencerConfirmed"] == 1) {
                          ?>
                            <!-- Si l'influenceur est confirmé, afficher un badge "Confirmé" avec une couleur de fond verte -->
                            <span class="badge badge-sm bg-gradient-success">Confirmé</span>

                          <?php
                          } else {
                          ?>
                            <!-- Si l'influenceur n'est pas confirmé, afficher un badge "Non confirmé" avec une couleur de fond grise -->
                            <span class="badge badge-sm bg-gradient-secondary">Non confirmé</span>

                          <?php
                          }
                          ?>
                        </td>


                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold"><?= $row["StartDate"] ?></span>
                        </td>

                        <td class="align-middle text-center">
                          <span class="text-secondary text-xs font-weight-bold"><?= $row["EndDate"] ?></span>
                        </td>


                      </tr>


                    <?php
                    }

                    ?>

                  </tbody>
                </table>
              </div>
            </div>
          </div>
        </div>
      </div>





    </div>
  </main>


</body>

</html>