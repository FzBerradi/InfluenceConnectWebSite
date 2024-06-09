<?php
// Démarrer une session et ne pas afficher les erreurs
session_start();
error_reporting(0);

// Vérifier si l'utilisateur est connecté
if(isset($_SESSION['iduser'])){

    // Récupérer les paramètres de l'URL
    $accountId = $_GET['accountId'];
    $from = $_GET['from'];

    // Vérifier si l'utilisateur est un admin
    if ($_SESSION['is_admin'] == 1) {
        $session = $_GET['accountId'];

    // Si l'utilisateur n'est pas un admin
    } else {
        $session = $_SESSION['iduser'];
    }

} else {
    // Rediriger l'utilisateur vers la page de connexion s'il n'est pas connecté
    header('location:../sign-in.php');
}

// Inclure le fichier de connexion à la base de données
include('../dbconnect.php');

// Récupérer les informations de l'utilisateur
$user = $data->prepare('SELECT * FROM user WHERE ID=?');
$user->execute([$accountId]);
$info = $user->fetch();
$role = $info['isBrand'];
$name = $info['firstName'];
$isadmin = $_SESSION['is_admin'];
$isbrand = $_SESSION['is_brand'];
$isinf = $_SESSION['is_influencer'];
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
    <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
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

#btn1 {
  background-color: #4CAF50; /* Définir la couleur de fond */
  border: none; /* Supprimer la bordure */
  color: white; /* Définir la couleur du texte */
  padding: 10px 20px; /* Ajouter un peu de remplissage (padding) */
  text-align: center; /* Centrer le texte */
  text-decoration: none; /* Supprimer le soulignement */
  display: inline-block; /* Afficher en tant que bloc en ligne (inline-block) */
  font-size: 16px; /* Définir la taille de police */
  margin: 10px 0; /* Ajouter une marge */
  cursor: pointer; /* Ajouter un curseur pointeur au survol */
  border-radius: 5px; /* Ajouter des coins arrondi */
}

#btn1:hover {
  background-color: #3e8e41; /* Changer la couleur de fond au survol */
}

.card{
    width: 100%;
    margin: 0 0 0 30%;
}


    </style>
</head>
<form role="form" method="POST" id="form_sign_in">

    <body class="g-sidenav-show bg-gray-100">
        <aside class="sidenav navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-3 " id="sidenav-main">
            <div class="sidenav-header">
                <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none" aria-hidden="true" id="iconSidenav"></i>
                <a class="navbar-brand m-0" href="#" target="_blank">
                    <img src="../../assets/img/1.PNG" class="navbar-brand-img h-100" alt="main_logo">
                    <span class="ms-1 font-weight-bold">Bienvenue</span>
                </a>
            </div>
            <hr class="horizontal dark mt-0">
            <div class="collapse navbar-collapse  w-auto  max-height-vh-100 h-100" id="sidenav-collapse-main">
<?php
// Afficher la barre latérale en fonction du rôle de l'utilisateur connecté
if ($isbrand) {
    // Si l'utilisateur est un "brand", afficher la barre latérale "BrandSideBar.php"
    include_once('BrandSideBar.php');
} else if ($isinf) {
    // Si l'utilisateur est un "influencer", afficher la barre latérale "InfluencerSideBar.php"
    include_once('InfluencerSideBar.php');
} else if ($isadmin) {
    // Si l'utilisateur est un administrateur, afficher la barre latérale "adminSideBar.php"
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
                    <div class="collapse navbar-collapse me-md-0 me-sm-4 mt-sm-0 mt-2" id="navbar">
                        <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                            <div class="input-group">
                                <span class="input-group-text text-body"><i class="fas fa-search" aria-hidden="true"></i></span>
                                <input type="text" class="form-control" placeholder="Type here...">
                            </div>
                        </div>
                        <ul class="navbar-nav justify-content-end">
                            <li class="nav-item d-xl-none ps-3 pe-0 d-flex align-items-center">
                                <a href="javascript:;" class="nav-link text-white p-0">
                                    <a href="javascript:;" class="nav-link text-body p-0" id="iconNavbarSidenav">
                                        <div class="sidenav-toggler-inner">
                                            <i class="sidenav-toggler-line bg-white"></i>
                                            <i class="sidenav-toggler-line bg-white"></i>
                                            <i class="sidenav-toggler-line bg-white"></i>
                                        </div>
                                    </a>
                                </a>
                            </li>
                            <li class="nav-item px-3 d-flex align-items-center">
                                <a href="javascript:;" class="nav-link text-white p-0">
                                    <i class="fa fa-cog fixed-plugin-button-nav cursor-pointer"></i>
                                </a>
                            </li>
                            <li class="nav-item dropdown pe-2 d-flex align-items-center">
                                <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="fa fa-bell cursor-pointer"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
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
                                if ($role == 1) {
                                ?>
                                    <h5 class="mb-1">
                                        <?= $info['firstName'] ?>
                                    </h5>
                                    <p class="mb-0 font-weight-bold text-sm">
                                        Marque
                                    </p>
                                <?php
                                } else {
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
                                            <a href="./Profile.php">
                                                <i class="fas fa-user-edit text-secondary text-sm" data-bs-toggle="tooltip" data-bs-placement="top" title="Edit Profile"></i>
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

                                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Description:</strong>
                                            <div class="mb-3">
                                                <input name="discription" type="text" class="form-control" placeholder="discription" id="discription" value="<?= $info['discription'] ?>">
                                            </div>
                                    </p>

                                    <ul class="list-group">


                                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nom de la marque:</strong>
                                            <div class="mb-3">
                                                <input name="firstName" type="text" class="form-control" placeholder="firstName" id="firstName" value="<?= $info['firstName'] ?>">
                                            </div>

                                        </li>
                                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Adresse:</strong>

                                            <div class="mb-3">
                                                <input name="address" type="text" class="form-control" placeholder="address" id="address" value=" <?= $info['address'] ?>">
                                            </div>

                                        </li>
                                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Chiffre d'affaires:</strong>


                                            <div class="mb-3">
                                                <input name="ca" type="number" class="form-control" placeholder="ca" id="ca" value="<?= $info['ca'] ?>">
                                            </div>

                                        </li>

                                        <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Site Web:</strong>


                                            <div class="mb-3">
                                                <input name="Website" type="text" class="form-control" placeholder="Website" id="Website" value="<?= $info['Website'] ?>">
                                            </div>

                                        </li>

                                    <?php
                                } else {
                                    ?>
                                        <ul class="list-group">
                                            <li class="list-group-item border-0 ps-0 pt-0 text-sm"><strong class="text-dark">Nom complet:</strong>

                                                <div class="mb-3">
                                                    <input name="firstName" type="text" class="form-control" placeholder="firstName" id="firstName" value=" <?= $info['firstName'] ?>">
                                                </div>

                                                <div class="mb-3">
                                                    <input name="lastName" type="text" class="form-control" placeholder="lastName" id="lastName" value=" <?= $info['lastName'] ?>">
                                                </div>
                                            </li>
                                           
                                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Age:</strong>

                                                <div class="mb-3">
                                                    <input name="age" type="number" class="form-control" placeholder="age" id="age" value="<?= $info['age'] ?>">
                                                </div>

                                            </li>
                                        <?php
                                    }
                                        ?>


                                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Téléphone:</strong>

                                            <div class="mb-3">
                                                <input name="PhoneNumber" type="number" class="form-control" placeholder="PhoneNumber" id="PhoneNumber" value="<?= $info['PhoneNumber'] ?>">
                                            </div>
                                        </li>
                                        <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Email:</strong>

                                            <div class="mb-3">
                                                <input name="Email" type="Email" class="form-control" placeholder="Email" id="Email" value=" <?= $info['Email'] ?>">
                                            </div>
                                        </li>

                                        <?php
                                        if ($role != 1) {

                                        ?>
                                            <li class="list-group-item border-0 ps-0 pb-0">
                                                <strong class="text-dark text-sm">Réseaux sociaux:</strong> &nbsp;
                                                <br />
                                                <br />
                                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Facebook:</strong>
                                                <div class="mb-3">
                                                    <input name="fb" type="text" class="form-control" placeholder="fb" id="fb" value="<?= $info['fb'] ?>">
                                                </div>
                                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">TikTok:</strong>
                                                <div class="mb-3">
                                                    <input name="tk" type="text" class="form-control" placeholder="tk" id="tk" value="<?= $info['tk'] ?>">
                                                </div>
                                            <li class="list-group-item border-0 ps-0 text-sm"><strong class="text-dark">Instagram:</strong>
                                                <div class="mb-3">
                                                    <input name="ig" type="text" class="form-control" placeholder="ig" id="ig" value="<?= $info['ig'] ?>">
                                                </div>




                                            <?php
                                        }



                                            ?>

                                                <button type="submit" id="btn1" name="btn1">Edit </button>
                                            
                                            </li>
                                        </ul>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>

    </body>
</form>

</html>

<?php
ob_start();

// Vérification si la méthode de la requête est POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {

    // Récupération des données du formulaire
    extract($_POST);

    // Connexion à la base de données
    include('../dbconnect.php');

    try {
        if ($role == 1) {
            // Mise à jour des données de l'utilisateur de type "Brand"
            $userdata = $data->prepare("UPDATE user SET firstName=? , address=? ,email=? , phoneNumber=? , ca=? ,Website=? ,discription=? WHERE ID=?");
            $userdata->execute([
                $firstName, $address, $Email, $PhoneNumber, $ca, $Website, $discription, $accountId
            ]);
            if($isadmin){
                echo "<script>window.location.replace('../Admin/BrandList.php');</script>";
            }else{
            
                echo "<script>window.location.replace('../Profile/Profile.php?accountId=" . $accountId . "');</script>";
                
            }
        } else {
            // Mise à jour des données de l'utilisateur de type "Influencer"
            $userdata = $data->prepare("UPDATE user SET firstName=?, lastName=? ,email=? , age=?, phoneNumber=? , fb=? , tk=?, ig=? WHERE ID=?");
            $userdata->execute([
                $firstName, $lastName, $Email,$age, $PhoneNumber, $fb, $tk, $ig, $accountId
            ]);
            if($isadmin){
                echo "<script>window.location.replace('../Admin/InfluencerList.php');</script>";
            }else{
                echo "<script>window.location.replace('../Profile/Profile.php?accountId=" . $accountId . "');</script>";
            }    
            }

        // Redirection vers la page de profil de l'utilisateur
    } catch (Exception $e) {
        // Gestion des erreurs
        die("error d'insrtion:" . $e->getMessage());
    }
}
?>