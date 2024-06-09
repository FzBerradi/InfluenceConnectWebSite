
<?php
// Ce code démarre la temporisation de sortie de PHP.

ob_start();
?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
    Se connecter 
  </title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
  <script src="../assets/js/signin.js"  defer></script>
  <link id="pagestyle" href="../assets/css/soft-ui-dashboard.css?v=1.0.3" rel="stylesheet" />
</head>

<body class="">

  <main class="main-content  mt-0">
    <section>
      <div class="page-header min-vh-75">
        <div class="container">
          <div class="row">
            <div class="col-xl-4 col-lg-5 col-md-6 d-flex flex-column mx-auto">
              <div class="card card-plain mt-8">
                <div class="card-header pb-0 text-left bg-transparent">
                  <h3 class="font-weight-bolder text-info text-gradient">Bienvenue</h3>
                  <p class="mb-0">Entrez votre email et mot de passe pour vous connecter</p>
                </div>
                <div class="card-body">
                <?php if(isset($_GET['erreur'])){echo $_GET['erreur'];}?>

                  <form role="form" method="POST" id="form_sign_in">
                    <label>Email</label>
                    <div class="mb-3">
                      <input name="login" type="email" class="form-control" placeholder="Email"  id="email" >
                    </div>
                    <label>Mot de passe</label>
                    <div class="mb-3">
                      <input type="password" name="mdp" class="form-control" placeholder="Password" id="password" >
                    </div>
                    <div class="form-check form-switch">
                      <input class="form-check-input" name='check' type="checkbox" id="rememberMe" checked="">
                      <label class="form-check-label" for="rememberMe">Se souvenir de moi</label>
                    </div>
                    <div class="text-center">
                      <button type="submit" class="btn bg-gradient-info w-100 mt-4 mb-0">Se connecter</button>
                    </div>
                  </form>
                </div>
                <div class="card-footer text-center pt-0 px-lg-2 px-1">
                  <p class="mb-4 text-sm mx-auto">
                  Vous n'avez pas de compte?
                    <a href="./SignUp/sign-up.php" class="text-info text-gradient font-weight-bold">S'inscrire</a>
                  </p>
                </div>
              </div>
            </div>
            <div class="col-md-6">
              <div class="oblique position-absolute top-0 h-100 d-md-block d-none me-n8">
                <div class="oblique-image bg-cover position-absolute fixed-top ms-auto h-100 z-index-0 ms-n6" style="background-image:url('../assets/img/curved-images/curved6.jpg')"></div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </section>
  </main>
  
        
      

  <?php
// Vérifie si la méthode HTTP utilisée pour la requête est POST
if($_SERVER['REQUEST_METHOD']=="POST"){
    // Extraction des données POST reçues
    extract($_POST);
    // Vérifie si les champs d'e-mail et de mot de passe sont définis et non vides
    if(isset($login) && !empty($login) &&isset($mdp) && !empty($mdp)){
        // Inclut le fichier de connexion à la base de données
        include('dbconnect.php');
        try{
            // Récupère tous les utilisateurs de la table "user"
            $userdata=$data->prepare("select * from user");
            $userdata->execute();
            $users=$userdata->fetchAll();
            $exist=false;
            // Parcourt tous les utilisateurs de la base de données
            foreach($users as $user){
                // Vérifie si l'e-mail et le mot de passe de l'utilisateur correspondent à ceux reçus en POST
                if($user['Email']==$login && password_verify($mdp,$user['Password'])){
                    // Si les informations sont correctes, crée une session utilisateur et stocke les informations de l'utilisateur dans des variables de session
                    $exist=true;
                    session_start();
                    $_SESSION['iduser']=$user['ID'];
                    $_SESSION['lastname']=$user['lastName'];
                    $_SESSION['firstname']=$user['firstName'];
                    $_SESSION['is_admin']=$user['isAdmin'];
                    $_SESSION['is_brand']=$user['isBrand'];
                    $_SESSION['is_influencer']=$user['isInfluencer'];
                    $_SESSION['id_session']=session_create_id();
                   
                    // Redirige l'utilisateur vers la page appropriée en fonction de son type d'utilisateur
                    if($user['isAdmin']){
                      header('location:./Admin/AdminDashboard.php');
                    }
                    elseif($user['isBrand']){
                      header('location:./brand/BrandDashboard.php');
                    }
                    elseif($user['isInfluencer']){
                      header('location:./influencer/InfluencerDashboard.php');
                    }
                    break;
                }
            }
            // Si les informations de connexion ne sont pas correctes, affiche un message d'erreur
            if(!$exist){
                $erreur = '<div style=color:red> L\'adresse e-mail ou le mot de passe est incorrect </div>';
                header("location:sign-in.php?erreur=$erreur");
            }
        }
        catch(Exception $e){
            die("error de selection:".$e->getMessage());
        }
    }
    // Si l'un des champs est vide, affiche un message d'erreur
    else{
        $erreur= "<div style=color:red> Une champ est vide !!</div>";
        header("location:sign-in.php?erreur=$erreur");
    }
}
?>



  
 
</body>

</html>