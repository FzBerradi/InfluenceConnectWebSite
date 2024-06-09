<?php
session_start(); // Démarrer la session
error_reporting(0); // Désactiver l'affichage des erreurs PHP
if ($_SESSION['is_admin'] != 1) { // Vérifier si l'utilisateur est connecté en tant qu'administrateur
  header('location:../sign-in.php'); // Rediriger vers la page de connexion si l'utilisateur n'est pas un administrateur
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
          <a class="nav-link  " href="./BrandList.php">
          <div >
            <img style="width:25px" src="../../assets/img/brands.png" alt="">

            </div>
            <span class="nav-link-text ms-1">Liste des marques</span>
          </a>
        </li>
       
        <li class="nav-item">
          <a class="nav-link  active" href="./InfluencerList.php">
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Tableau des influenceurs</li>
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
              <h6>Total des influenceurs</h6>
            </div>
            <div class="card-body px-0 pt-0 pb-2">
              <div class="table-responsive p-0">
                <table class="table align-items-center mb-0">
                  <thead>
                    <tr>
                      <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">influenceur</th>
                        <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tel</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">âge</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Genre</th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Facebook </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Instagram </th>
                        <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">TikTok </th>
                        <th class="text-secondary opacity-7"></th>
                      </tr>
                  </thead>
                  <tbody>

                  <?php
// Inclure le fichier de connexion à la base de données
include('../dbconnect.php');

// Sélectionner tous les utilisateurs qui sont des influenceurs
$read=$data->prepare('SELECT * FROM user WHERE isInfluencer=:isInfluencer');
$read->execute(['isInfluencer'=>1]);
$res=$read->fetchAll(PDO::FETCH_ASSOC);

// Parcourir les résultats et afficher les informations des influenceurs
foreach($res as $row){
  // Code à exécuter pour chaque ligne
                  ?>

                    <tr>
                      <td>
                        <div class="d-flex px-2 py-1">
                          <div>
                            <img src="../../images/<?= $row["ImageProfile"] ?>" class="avatar avatar-sm me-3" alt="user1">
                          </div>
                          <div class="d-flex flex-column justify-content-center">
                            <h6 class="mb-0 text-sm"><?= $row["firstName"] ?>  <?= $row["lastName"] ?></h6>
                            <p class="text-xs text-secondary mb-0"><?= $row["Email"] ?></p>
                          </div>
                        </div>
                      </td>
                      <td>
                      <span class="text-secondary text-xs font-weight-bold"><?= $row["PhoneNumber"] ?></span>

                      </td>
                      
                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?= $row["age"] ?></span>
                      </td>

                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?= $row["gender"] ?></span>
                      </td>

                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?= $row["fb"] ?></span>
                      </td>

                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?= $row["ig"] ?></span>
                      </td>

                      <td class="align-middle text-center">
                        <span class="text-secondary text-xs font-weight-bold"><?= $row["tk"] ?></span>
                      </td>

                      <td class="align-middle">
                        <a href="../Profile/EditProfile.php?from=profile&accountId=<?= $row['ID'] ?>" class="text-success font-weight-bold text-xs" data-toggle="tooltip" data-original-title="Edit user">
                        <i class="fas fa-edit"></i> Edit
                        </a>
                      </td>

                      <td class="align-middle">
                      <a class="btn btn-link text-danger text-gradient px-3 mb-0" href="javascript:;"  id="<?= $row["firstName"] ?>"  onclick="confirmAndExecute(<?= $row['ID'] ?>)" ><i class="far fa-trash-alt me-2"></i>Delete</a>

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
function confirmAndExecute(ID) { // Définir une fonction avec un paramètre "ID"
  if (confirm(`Are you sure you want to Delete  ${event.target.id}?`)) { // Afficher un message de confirmation avec l'ID de l'élément cible
    window.location.href = "Delete.php?id=" + ID; // Si l'utilisateur confirme, rediriger vers l'URL spécifiée avec l'ID ajouté à celui-ci
  }
}
</script>
</body>

</html>