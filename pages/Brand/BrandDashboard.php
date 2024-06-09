<?php
// Démarrer la session
session_start();
// Vérifier si l'utilisateur est une marque enregistrée, sinon rediriger vers la page de connexion
if($_SESSION['is_brand']!= true){
  header('location:../sign-in.php');
}

// Inclure le fichier de connexion à la base de données
include('../dbconnect.php');

// Récupérer la liste des contrats confirmés pour l'utilisateur en tant que marque
$listContrat = $data->prepare("
    SELECT u.*, p.*
    FROM user u
    JOIN partnership p ON u.ID = p.InfluencerID
    WHERE p.BrandID = :BrandID
    AND p.status = 'confirmed'
");

$listContrat->execute([
    'BrandID' => $_SESSION['iduser']
]);

// Obtenir le nombre de contrats confirmés pour l'utilisateur en tant que marque
$countContart = $listContrat->rowCount();

// Récupérer la liste des influenceurs disponibles pour l'utilisateur en tant que marque
$listinfluenceurs=$data->prepare('SELECT * FROM user WHERE isInfluencer and id  not in (select InfluencerID from partnership where BrandID=:BrandID and status ="confirmed")');
$listinfluenceurs->execute([
    'BrandID'=>$_SESSION['iduser']
]);

// Obtenir le nombre d'influenceurs disponibles pour l'utilisateur en tant que marque
$countInfluenceur = $listinfluenceurs->rowCount();

// Récupérer la liste des invitations en attente pour l'utilisateur en tant que marque
$listinv=$data->prepare('
    SELECT u.*, p.*
    FROM user u
    JOIN partnership p ON u.ID = p.BrandID
    WHERE p.BrandID = :BrandID
    and p.brandConfirmed is null
    and p.status != "accepted"
    and p.status !="canceled"
');

$listinv->execute([
    'BrandID'=>$_SESSION['iduser']
]);

// Obtenir le nombre d'invitations en attente pour l'utilisateur en tant que marque
$countinv = $listinv->rowCount();

// Récupérer la liste des partenaires confirmés pour l'utilisateur en tant que marque
$listpart=$data->prepare('SELECT * FROM user WHERE isInfluencer and id  in (select InfluencerID from partnership where BrandID=:BrandID and status="confirmed")');
$listpart->execute([
    'BrandID'=>$_SESSION['iduser']
]);

// Obtenir le nombre de partenaires confirmés pour l'utilisateur en tant que marque
$countpartenaires = $listpart->rowCount();
?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="../../assets/img/1.png">

  <title>
    Dashboard
  </title>

  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>

  <link id="pagestyle" href="../../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />

</head>

<body class="g-sidenav-show  bg-gray-100">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="#" target="_blank">
        <img src="../../assets/img/1.PNG" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Marques</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link  active" href="#">
            <div >
            <img style="width:25px" src="../../assets/img/dashboard.png" alt="">
            </div>
            <span class="nav-link-text ms-1">Tableau de bord</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./listeInfluenceurs.php">
            <div >
            <img style="width:25px" src="../../assets/img/brands.png" alt="">

            </div>
            <span class="nav-link-text ms-1">Les influenceurs</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./partenaires.php">
            <div >
              <img  style="width:25px" src="../../assets/img/partners.png" alt="">
            </div>
            <span class="nav-link-text ms-1">Les partenaires</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./contrats.php">
            <div >
            <img  style="width:25px" src="../../assets/img/contrat.png" alt="">
              
            </div>
            <span class="nav-link-text ms-1">Les contrats</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./invitations.php">
            <div >
            <img  style="width:30px" src="../../assets/img/invi.webp" alt="">

            </div>
            <span class="nav-link-text ms-1">Les invitations</span>
          </a>
        </li>
          
        <li class="nav-item mt-3">
          <hr>
        </li>
        <li class="nav-item">
        <a class="nav-link  " href="../Profile/Profile.php?from=profile_influencer&accountId=<?php echo $_SESSION['iduser']?>">
          <div >
            <img  style="width:25px" src="../../assets/img/profile.png" alt="">

            </div>
            <span class="nav-link-text ms-1">Profil</span>
          </a>
        </li>
        <li class="nav-item">
        <a class="nav-link  " href="../../pages/messages/message.php">
          <div >
            <img style="width:25px" src="../../assets/img/conversation.svg" alt="">
            </div>
            <span class="nav-link-text ms-1">Messages</span>
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
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Dashboard</li>
          </ol>
        </nav>
        
      </div>
    </nav>



    <div class="container-fluid py-4">
      <div class="row">
        <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
          <div class="card">
            <div class="card-body p-3">
              <div class="row">
                <div class="col-8">
                  <div class="numbers">
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">les influenceurs
                    </p>
                    <h5 class="font-weight-bolder mb-0">
                      <?= $countInfluenceur ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"><img style="width: 70%; margin-top: -10px;" src="../../assets//img/influ.png" alt=""></i>
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
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Les contrats</p>
                    <h5 class="font-weight-bolder mb-0">
                      <?= $countContart ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-world text-lg opacity-10" aria-hidden="true"><img style="width: 70%; margin-top: -10px;" src="../../assets//img/Contract.png" alt=""></i>
                    
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
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Les invitations</p>
                    <h5 class="font-weight-bolder mb-0">
                      +<?= $countinv ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-paper-diploma text-lg opacity-10" aria-hidden="true"><img style="width: 70%; margin-top: -10px;" src="../../assets//img/add.png" alt=""></i>
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
                    <p class="text-sm mb-0 text-capitalize font-weight-bold">Les partenaires</p>
                    <h5 class="font-weight-bolder mb-0">
                      +<?= $countpartenaires ?>
                    </h5>
                  </div>
                </div>
                <div class="col-4 text-end">
                  <div class="icon icon-shape bg-gradient-primary shadow text-center border-radius-md">
                    <i class="ni ni-cart text-lg opacity-10" aria-hidden="true"><img style="width: 80%; margin-top: -10px;" src="../../assets//img/partenaires.png" alt=""></i>
                  </div>
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