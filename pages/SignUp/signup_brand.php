<div class="form-container sign-in-container">
      <h2 class='title' style="text-align:center;margin-top:20px">Compte Marque</h2>
      <?php if (isset($_GET['erreur'])) {
        echo $_GET['erreur'];
      } ?>
      <div class="image_zone">
        <img src="../../assets/img/default_profile.png" id="br_img" class="img" alt="">
        <label for="profil_brand" class="custom-file-upload">Choisir une image</label>
        </div>
  <form action="#" id="form2" method="POST" enctype="multipart/form-data">
  <input type="file" name="profil_brand" id="profil_brand" onchange="displayImage2(event)">

    <div class="form-group">
      <input type="text" class="form-control" placeholder="Nom de marque" name="name" required>
    </div>
    <div class="form-group">
      <input type="text" class="form-control" placeholder="Adresse" name="address" required>
    </div>
    <div class="form-group">
      <input type="number" class="form-control" placeholder="Chiffre d'affaires" name="ca" required>
    </div>


    <div class="form-group">
      <input type="email" class="form-control" id="e2" placeholder="Email" name="email2" required>
    </div>
    <input type="text" hidden name="submit2">
    <div class="form-group">
      <input type="tel" class="form-control" id="p2" placeholder="Numéro de téléphone" name="phoneNumber2" required>
    </div>
    <div class="form-group">
      <input type="password" class="form-control" id='password2' placeholder="Mot de passe" name="password2" required>
    </div>
    <div class="form-group">
      <input type="password" class="form-control" id='cpass2' placeholder="Confirmer le mot de passe" name="cpass2" required>
    </div>

    <div class="form-group">
      <input type="text" class="form-control" placeholder="Site web" name="website">
    </div>
    <div class="form-group">
      <input type="text" class="form-control" placeholder="Description" name="description">
    </div>



  </form>
  <br>
  <div style="margin-top: 30px;">
    <input type="checkbox" class="form-check-input" id="agree_terms" required>
    <label class="form-check-label" style="width:100%" for="agree_terms">J'accepte les <a href="#">termes et conditions</a></label>
  </div>
  <br>
  <div class="btn">
    <button type="submit" id="btn2" name="btn2" >S'inscrire</button> 

  </div>
  <p style="text-align:center">
                Vous avez un compte ?
                <a href="../sign-in.php" class="text-info text-gradient font-weight-bold">Se connecter</a>
</p>
</div>

    <?php
if ($_SERVER['REQUEST_METHOD'] == "POST") {
  extract($_POST);
  if (isset($submit2)) {

    // Vérifier que toutes les données nécessaires sont présentes et non vides
    if (isset($name) && !empty($name)  && isset($email2) && !empty($email2) && isset($password2) && !empty($password2) && isset($cpass2) && !empty($cpass2) && $cpass2 == $password2) {
      include('../dbconnect.php');
      $image = $_FILES['profil_brand']['name'];
      $target = "../../images/" . '/' . $image;

      // Télécharger le fichier image
      move_uploaded_file($_FILES['profil_brand']['tmp_name'], $target);
      try {
        $userdata = $data->prepare("INSERT INTO user(firstName, address,email, phoneNumber, Password, ca,website, isBrand,ImageProfile,discription) VALUES (:firstName, :address, :email, :phoneNumber, :password, :ca, :website, :isBrand,:ImageProfile,:discription)");

        // Insérer les données de l'utilisateur dans la base de données
        $userdata->execute([
          'firstName' => $name,
          'address' => $address,
          'email' => $email2,
          'phoneNumber' => $phoneNumber2,
          'password' => password_hash($password2, PASSWORD_DEFAULT),
          'ca' => $ca,
          'website' => $website,
          'isBrand' => 1,
          'ImageProfile' => $image,
          'discription' => $description
        ]);

        // Rediriger l'utilisateur vers la page de connexion
        header("location:../sign-in.php");
      } catch (Exception $e) {
        // Afficher l'erreur d'insertion
        die("error d'insertion:" . $e->getMessage());
      }
    } else {
      // Si une erreur est détectée dans les données, afficher un message d'erreur et rediriger l'utilisateur vers la page d'inscription
      $erreur = "<div style=color:red>Erreur d'inscription. Veuillez vérifier vos informations !!!</div>";
      header("location:sign-up.php?erreur= $erreur");
    }
  }
}
?>