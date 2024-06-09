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
          <a class="nav-link  active" href="./BrandList.php">
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
          <a class="nav-link  " href="./DeleteUser.php">
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tableau des marques</li>
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
              <h6>Table des marques</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Marque</th>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tel</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Adresse</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Site Web</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Chiffre d'affaires</th>
                      <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Description</th>

                      <th class="text-secondary opacity-7"></th>
                    </tr>
                  </thead>
                  <tbody>

                  <?php
// Inclure le fichier dbconnect.php qui contient les informations de connexion à la base de données
include('../dbconnect.php');

// Préparer une requête SELECT pour récupérer toutes les lignes de la table user où la valeur de la colonne isBrand est égale à 1
$read=$data->prepare('SELECT * FROM user WHERE isBrand=:isBrand');
$read->execute(['isBrand'=>1]);

// Récupérer toutes les lignes sélectionnées en utilisant la méthode fetchAll() et les stocker dans un tableau associatif
$res=$read->fetchAll(PDO::FETCH_ASSOC);

// Parcourir toutes les lignes du tableau associatif récupéré
foreach($res as $row){
    // Traiter chaque ligne de la base de données ici
    // ...

?>

                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                          <!-- Afficher info de profil de l'utilisateur en utilisant la balise HTML <img> -->
<img src="../../images/<?= $row["ImageProfile"] ?>" class="avatar avatar-sm me-3" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?= $row["firstName"] ?></h6>
                            <p class="text-xs text-secondary mb-0"><?= $row["Email"] ?></p>
                          </div>
                        </div>
                      </td>
                      <td>
                      <span class="text-secondary text-xs font-weight-bold"><?= $row["PhoneNumber"] ?></span>

                      </td>
                      <td class="align-middle text-center text-sm">
                        <span class="text-secondary text-xs font-weight-bold"><?= $row["address"] ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?= $row["Website"] ?></span>
                      </td>
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?= $row["ca"] ?></span>
                      </td>

                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?= $row["discription"] ?></span>
                      </td>

                      <td class="align-middle">
                        <a href="../Profile/EditProfile.php?from=profile&accountId=<?= $row['ID'] ?>" class="text-success font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        <i class="fas fa-edit"></i> Edit
                        </a>
                        
                      </td>
                      <td class="align-middle">
                      <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;" id="<?= $row["firstName"] ?>"  onclick="confirmAndExecute(<?= $row['ID'] ?>)" ><i class="far fa-trash-alt me-2"></i>Delete</a>

                        
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

  <script>
// Définition d'une fonction JavaScript nommée "confirmAndExecute" avec un paramètre "ID"
function confirmAndExecute(ID) {
  // Afficher une boîte de dialogue de confirmation avec le nom de l'élément à supprimer
  if (confirm(`Êtes-vous sûr de vouloir supprimer ${event.target.id} ?`)) {
    // Si l'utilisateur clique sur OK dans la boîte de dialogue de confirmation, rediriger vers la page "Delete.php" en envoyant l'identifiant de l'élément à supprimer dans l'URL
    window.location.href = "Delete.php?id=" + ID; // remplacer par l'URL de votre script PHP
  }
}
</script>
</body>

</html>