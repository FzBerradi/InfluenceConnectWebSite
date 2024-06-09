<div class="form-container sign-up-container">
  <h2 class='title' style="text-align:center;margin-top:20px">Compte d'influenceur</h2>
  <?php if (isset($_GET['erreur'])) {
    echo $_GET['erreur'];
  } ?>
  <div class="image_zone">
    <img src="../../assets/img/default_profile.png" id="in_img" class="img" alt="">
    <label for="profile_in" class="custom-file-upload">Choisissez une image
    </label>
  </div>
  <form id="form1" method="POST" enctype="multipart/form-data">
    <input type="file" name="profile_in" id="profile_in" onchange="displayImage1(event)" />
    <div class="form-group">
  <input type="text" class="form-control" placeholder="Prénom" name="firstName" required>
</div>

<div class="form-group">
  <input type="text" class="form-control" placeholder="Nom de famille" name="lastName" required>
</div>



<div class="form-group">
  <input type="number" class="form-control" placeholder="Âge" name="age" required>
</div>

<div class="form-group" style="display:flex">
  <label>Genre :</label>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="gender" id="gender_male" value="homme"  checked>
    <label class="form-check-label" for="gender_male">Homme</label>
  </div>
  <div class="form-check">
    <input class="form-check-input" type="radio" name="gender" id="gender_female" value="femme" required>
    <label class="form-check-label" for="gender_female">Femme</label>
  </div>

</div>
<div class="form-group">
  <input type="email" class="form-control" placeholder="Email" name="email" required>
</div>

<div class="form-group">
  <input type="tel" class="form-control" placeholder="Numéro de téléphone" name="phoneNumber" required>
</div>

<div class="form-group">
  <input type="password" class="form-control" id='password' placeholder="Mot de passe" name="password" required>
</div>
<div class="form-group">
  <input type="password" class="form-control" id="cpass" placeholder="Confirmer le mot de passe" name="cpass" required>
</div>
<input type="text" value="submit_1" hidden name="submit1">

<div class="form-group">
  <input type="text" class="form-control" placeholder="Compte Facebook" name="facebook">
</div>

<div class="form-group">
  <input type="text" class="form-control" placeholder="Compte Instagram" name="instagram">
</div>

<div class="form-group">
  <input type="text" class="form-control" placeholder="Compte TikTok" name="tiktok">
</div>
</form>
  <br>
  <div style="margin-top: 40px;">
    <input type="checkbox" class="form-check-input" id="agree_terms" required>
    <label class="form-check-label" style="width:100%" for="agree_terms">J'accepte les <a href="#">Termes et conditions</a></label>
  </div>
  <br>
  <div class="btn">
    <button type="submit" id="btn1" name="btn1">S'inscrire </button>
  </div>
  <p style="text-align:center">
  Vous avez un compte ?
    <a href="../sign-in.php" class="text-info text-gradient font-weight-bold">Se connecter</a>
  </p>

</div>
<?php
// vérifie si la méthode de requête HTTP est POST
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  // extrait toutes les valeurs des champs POST dans des variables
  extract($_POST);
  // vérifie si le bouton de soumission submit1 a été cliqué
  if (isset($submit1)) {
    // vérifie si tous les champs ont été remplis et que les mots de passe correspondent
    if (isset($firstName) && !empty($firstName) &&  isset($email) && !empty($email)  && isset($password) && !empty($password) && isset($cpass) && !empty($cpass) && $cpass == $password) {
      // inclut le fichier de connexion à la base de données
      include('../dbconnect.php');
      // récupère le nom du fichier image sélectionné
      $image = $_FILES['profile_in']['name'];
      // définit le chemin de destination pour l'image
      $target = "../../images" . '/' . $image;
      // téléverse le fichier image
      move_uploaded_file($_FILES['profile_in']['tmp_name'], $target);
      try {
        // prépare la requête SQL pour insérer les données dans la table user
        $userdata = $data->prepare("INSERT INTO user(firstName, lastName, email, phoneNumber, Password, gender, tk, ig, fb, isInfluencer,ImageProfile ,age) VALUES (:firstName, :lastName, :email, :phoneNumber, :password, :gender, :tk, :ig, :fb, :isInfluencer,:ImageProfile ,:age)");
        // exécute la requête en passant les valeurs en paramètres
        $userdata->execute([
          'firstName' => $firstName,
          'lastName' => $lastName,
          'email' => $email,
          'phoneNumber' => $phoneNumber,
          'password' => password_hash($password, PASSWORD_DEFAULT),
          'gender' => $gender,
          'tk' => $tiktok,
          'ig' => $instagram,
          'fb' => $facebook,
          'isInfluencer' => 1,
          'ImageProfile' => $image,
          'age' => $age
        ]);
        // redirige l'utilisateur vers la page de connexion après l'inscription réussie
        header("location:../sign-in.php");
      } catch (Exception $e) {
        // affiche un message d'erreur s'il y a eu un problème lors de l'insertion des données dans la base de données
        die("error d'insrtion:" . $e->getMessage());
      }
    } else {
      // affiche un message d'erreur si un champ n'a pas été rempli ou si les mots de passe ne correspondent pas
      $erreur = "<div style=color:red>Registration error  check your information !!!</div>";
      header("location:sign-up.php?erreur= $erreur");
    }
  }
}
?>