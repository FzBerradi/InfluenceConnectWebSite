<?php
// Démarrage de la session
session_start();

// Vérification que l'utilisateur est bien un influenceur
if($_SESSION['is_influencer']!= true){
  header('location:../sign-in.php'); // Redirection vers la page de connexion si l'utilisateur n'est pas un influenceur
}

// Inclusion de la connexion à la base de données
include('../dbconnect.php');

// Récupération des marques avec lesquelles l'influenceur a un partenariat confirmé
$listbrands=$data->prepare('SELECT * FROM user WHERE isBrand and id  in (select BrandID from partnership where InfluencerID=:InfluencerID and status="confirmed")');
$listbrands->execute([
    'InfluencerID'=>$_SESSION['iduser']
]);
$brandes=$listbrands->fetchAll(PDO::FETCH_ASSOC);
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="icon" type="image/png" href="../../assets/img/1.png">

  <title>
  Partenaires
  </title>
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />

  <!-- Font Awesome Icons -->
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <link id="pagestyle" href="../../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
  <link rel="stylesheet" href="../../assets/css/style.css">
</head>

<body class="g-sidenav-show  bg-gray-100">
<aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
    <div class="sidenav-header">
      <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
      <a class="navbar-brand m-0" href="https://demos.creative-tim.com/soft-ui-dashboard/pages/dashboard.php" target="_blank">
        <img src="../../assets/img/1.PNG" class="navbar-brand-img h-100" alt="main_logo">
        <span class="ms-1 font-weight-bold">Influenceurs</span>
      </a>
    </div>
    <hr class="horizontal dark mt-0">
    <div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
      <ul class="navbar-nav">
        <li class="nav-item">
          <a class="nav-link  " href="./InfluencerDashboard.php">
          <div >
            <img style="width:25px" src="../../assets/img/dashboard.png" alt="">
            </div>
            <span class="nav-link-text ms-1">Tableau de bord</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./listeBrands.php">
          <div >
            <img style="width:25px" src="../../assets/img/brands.png" alt="">
            </div>
            <span class="nav-link-text ms-1">Les marques</span>
          </a>
        </li>
        <li class="nav-item ">
          <a class="nav-link active" href="./partenaires.php">
            <div >
              <img  style="width:25px" src="../../assets/img/partners.png" alt="">
            </div>
            <span class="nav-link-text ms-1">Les partenaires</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link " href="./contrats.php">
          <div >
            <img style="width:25px" src="../../assets/img/contrat.png" alt="">
            </div>              
            <span class="nav-link-text ms-1">Les contrats</span>
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="./invitations.php">
          <div >
            <img style="width:25px" src="../../assets/img/invi.webp" alt="">
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
            <img style="width:25px" src="../../assets/img/profile.png" alt="">
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

  </aside>  <main class="main-content position-relative max-height-vh-100 h-100 mt-1 border-radius-lg ">
    <!-- Navbar -->
    <nav class="navbar navbar-main navbar-expand-lg px-0 mx-4 shadow-none border-radius-xl" id="navbarBlur" navbar-scroll="true">
      <div class="container-fluid py-1 px-3">
        <nav aria-label="breadcrumb">
          <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" href="javascript:;">Pages</a></li>
            <li class="breadcrumb-item text-sm text-dark active" aria-current="page">Partenaires</li>
          </ol>
        </nav>
        
      </div>
    </nav>

        <div class="col-12 mt-4">
          <div class="card mb-4">
            <div class="card-header pb-0 p-3">
              <h6 class="mb-1">Partenaires</h6>
              <p class="text-sm">La liste de vos partenaires:</p>
            </div>
    <div class="container-fluid py-4 cards">
            
  <?php
    foreach ($brandes as $brand) {
      echo '            

      <div class="col-xl-3 col-md-6 mb-xl-0 mb-4 item">
  <div class="card card-blog card-plain">
    <div class="position-relative" style="text-align:center">
      <img src="../../images/'. $brand['ImageProfile'] .'" alt="img-blur-shadow" class="img">
    </div>
    <div class="card-body px-1 pb-0">
      <a href="javascript:;" style="text-align:center">
        <h5>' . $brand['firstName'] . '</h5>
      </a>
      <p class="mb-4 text-sm">
        ' . $brand['discription'] . '
      </p>
      
      <div class="brand-info">
        <ul>
          <li><i class="fa fa-phone"></i> ' . $brand['PhoneNumber'] . '</li>
          <li><i class="fa fa-envelope"></i> ' . $brand['Email'] . '</li>
          <li><i class="fa fa-globe"></i> ' . $brand['Website'] . '</li>
          <li><i class="fa fa-money"></i> Chiffre d\'affaire: ' . $brand['ca'] . '</li>
        </ul>
      </div>
      <div style="text-align:center">
        <button type="button" class="contact-button"> <a  href="../../pages/messages/message.php?idUserMessage='.$brand['ID'].'">   <i style="color:#3498db" class="fa fa-comment"></i>   </a></button>
      </div>
    </div>
  </div>
</div>

            ';
    }
  ?>

           
    </div>
    
  </main>
  
  
</body>

</html>