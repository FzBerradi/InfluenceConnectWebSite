<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
	<title>Demande de suppression de compte</title>
    <link rel="stylesheet" href="../../assets/css/demandeContrat.css">
</head>
<body>
    
    <div class="form-container">
  <div class="form-header">
     <h2>Demande de suppression de compte</h2>
</div>
  <form action="" method="POST">
    <div class="form-grid">

      <div style="width:100%">
        <label for="description">Raison :</label>
        <textarea id="description" name="description" placeholder="Entrez votre raison..." required></textarea>
      </div>
    </div>
    <input type="submit" value="Envoyer la demande">
  </form>
</div>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include('../../pages/dbconnect.php');
    // Récupérer les données du formulaire

    $description = $_POST['description'];

    // Valider les données du formulaire
    $errors = array();

    if (empty($description)) {
        $errors[] = 'La raison est requise.';
    }

    // S'il n'y a pas d'erreurs, traiter les données du formulaire
    if (empty($errors)) {
        try {

            $userid=$_SESSION['iduser'];
            $userdata = $data->prepare("INSERT INTO account_deletion(user_id, reason) VALUES (?,?)");
  
            $userdata->execute([$userid,$description]);
              
              
           
            
            
            
            
            
            
            
  
            header("location:./profile.php?accountId=".$userid);
          } catch (Exception $e) {
            die("Erreur d'insertion : " . $e->getMessage());
          }
        
        // Rediriger vers une page de succès
        header("location:./profile.php?accountId=".$userid);
        exit();
    }
}
?>
</body>
</html>
