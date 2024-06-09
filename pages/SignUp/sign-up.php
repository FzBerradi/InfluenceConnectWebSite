<?php ob_start() ?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <link rel="apple-touch-icon" sizes="76x76" href="../../assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../../assets/img/favicon.png">
  <title>
    Sign Up
  </title>
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet" />
  <link rel="stylesheet" href="../../assets/css/signup.css">
  <script defer src="../../assets/js/signup.js"></script>
</head>

<body class="g-sidenav-show  bg-gray-100">


  <div class="container" id="container">


    <!-- Inclusion du fichier signup_influencer.php -->
    <?php include_once('signup_influencer.php'); ?>

    <!-- Inclusion du fichier signup_brand.php -->
    <?php include_once('signup_brand.php'); ?>

    <div class="overlay-container">
      <div class="overlay">
        <div class="overlay-panel overlay-left">
          <h2>Bienvenue, Marque!</h2>
          <p>
            Si vous souhaitez vous inscrire en tant que marque, veuillez cliquer sur le bouton ci-dessous. Cela vous amènera à la page d'inscription où vous pourrez fournir les informations de votre marque et créer votre compte. Merci de choisir de vous inscrire avec nous !
          </p>
          <button class="ghost" id="signIn">S'inscrire en tant que marque</button>
        </div>
        <div class="overlay-panel overlay-right">
          <h2>Bienvenue, Influenceur !</h2>
          <p> Si vous souhaitez vous inscrire en tant qu'influenceur, veuillez cliquer sur le bouton ci-dessous. Cela vous amènera à la page d'inscription où vous pourrez fournir vos informations et créer votre compte. Merci de choisir de vous inscrire avec nous !</p>
          <button class="ghost" id="signUp">S'inscrire en tant qu'influenceur</button>
        </div>
      </div>
    </div>

  </div>



</body>

</html>