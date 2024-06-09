<?php
// Démarre une session
session_start();

// Désactive les rapports d'erreur
error_reporting(0);

// Vérifie si l'utilisateur connecté est un administrateur en vérifiant si la variable de session "is_admin" est égale à 1
if ($_SESSION['is_admin'] != 1) {
  // Si l'utilisateur n'est pas un administrateur, redirige la page vers la page de connexion
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
    Admin
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
      <a class="navbar-brand m-0" href="https://demos.creative-tim.com/soft-ui-dashboard/pages/dashboard.php" target="_blank">
        <img src="../../assets/img/1.PNG" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Administrateur</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link" href="./Admindashboard.php">
          <div >
            <img style="width:25px" src="../../assets/img/dashboard.png" alt="">
            </div>
            <span class="nav-link-text ms-1">Tableau de bord</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link  " href="./BrandList.php">
          <div >
            <img style="width:25px" src="../../assets/img/brands.png" alt="">

            </div>
            <span class="nav-link-text ms-1">
Liste des marques</span>
          </a>
        </li>
       
        <li class="nav-item">
          <a class="nav-link  " href="./InfluencerList.php">
          <div >
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
          <div >
            <img  style="width:25px" src="../../assets/img/contrat.png" alt="">     
            </div>
            <span class="nav-link-text ms-1">Liste des contrats</span>
          </a>
        </li>

        <li class="nav-item">
          <a class="nav-link  active" href="./DeleteUser.php">
          <div >
            <img  style="width:28px" src="../../assets/img/delete.png" alt="">     
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Confirmation de suppression</li>
          </ol>
          <h6 class="font-weight-bolder mb-0">Administrateur</h6>
        </nav>

      </div>
    </nav>
    <!-- End Navbar -->
    <div class="container-fluid py-4">


    <div class="row">
        <div class="col-md-11 mt-4">
          <div class="card">
            <div class="card-header pb-0 px-3">
              <h6 class="mb-0">Confirmation de supression</h6>
            </div>
            <div class="card-body pt-4 p-3">
              <ul class="list-group">

              <?php
// Inclure le fichier de connexion à la base de données
include('../dbconnect.php');

// Sélectionner toutes les lignes de la table "account_deletion"
$read1 = $data->prepare('SELECT * FROM account_deletion');
$read1->execute();
$res1 = $read1->fetchAll(PDO::FETCH_ASSOC);

// Pour chaque ligne de la table "account_deletion", récupérer l'utilisateur correspondant et afficher ses informations
foreach ($res1 as $row1) {
    // Récupérer l'utilisateur correspondant à l'ID stocké dans la table "account_deletion"
    $read = $data->prepare('SELECT * FROM user WHERE ID=:ID');
    $read->execute(['ID' => $row1["user_id"]]);
    $res = $read->fetchAll(PDO::FETCH_ASSOC);

    // Pour chaque utilisateur récupéré, afficher ses informations
    foreach ($res as $row) {
        // code à ajouter ici pour afficher les informations de l'utilisateur récupéré
                  ?>

                <li class="list-group-item border-0 d-flex p-4 mb-2 bg-gray-100 border-radius-lg">
                  <div class="d-flex flex-column">
                  <div class="user-info" >
                    <img src="../../images/<?= $row["ImageProfile"] ?>" class="avatar avatar-sm me-3" alt="user1">
                    <h6 class="mb-3 text-sm"><?php if($row["isBrand"]==1){  ?>Marque<?php }else{ ?>Influenceur<?php } ?> </h6>
                  </div>
                    <span class="mb-2 text-xs">  <?php if($row["isBrand"]==1){  ?>Nom de marque :<span class="text-dark font-weight-bold ms-sm-2"><?= $row["firstName"] ?><?php }else{ ?>Nom complet :<span class="text-dark font-weight-bold ms-sm-2"><?= $row["firstName"] ?> <?= $row["lastName"] ?><?php } ?>  </span></span>
                    <span class="mb-2 text-xs">Adresse e-mail : <span class="text-dark ms-sm-2 font-weight-bold"><?= $row["Email"] ?></span></span>
                    <span class="mb-2 text-xs">Numéro de téléphone : <span class="text-dark ms-sm-2 font-weight-bold"><?= $row["PhoneNumber"] ?></span></span>
                    <?php if($row["isBrand"]==1){  ?>
                      <span class="mb-2 text-xs">web site: <span class="text-dark ms-sm-2 font-weight-bold"><?= $row["Website"] ?></span></span>

                      <?php }?>
                    <span class="mb-2 text-xs">Emplacement : <span class="text-dark ms-sm-2 font-weight-bold"><?= $row["Location"] ?></span></span>
                    <span class="mb-2 text-xs">Description : <span class="text-dark ms-sm-2 font-weight-bold"><?= $row["discription"] ?></span></span>

                    
                    <span class="mb-2 text-xs">Raison : <span class="text-dark ms-sm-2 font-weight-bold"><?= $row1["reason"] ?></span></span>

                  <?php  ?>
                  </div>
                  <div class="ms-auto text-end">
                    <a class="btn btn-link text-danger text-gradient px-3 mb-0" id="<?= $row["firstName"] ?>"  onclick="confirmAndExecute(<?= $row['ID'] ?>)" ><i class="far fa-trash-alt me-2"></i>Supprimer</a>
                  </div>
                </li>

                <?php 
                            }
                  }
                ?>
              </ul>
            </div>
          </div>
        </div>

      </div>

    </div>


  </main>



<script>
// fonction qui sera appelée lorsqu'on cliquera sur le bouton "Supprimer"
function confirmAndExecute(ID) {
  // affiche une boîte de dialogue pour demander une confirmation de la suppression
  if (confirm(`Etes-vous sûr que vous voulez supprimer  ${event.target.id}?`)) {
    // si l'utilisateur confirme, redirige vers une page de suppression en y passant l'ID de l'utilisateur
    window.location.href = "Delete.php?id=" + ID; // remplacer avec l'URL de votre script PHP
  }
}
</script>
</body>

</html>