<?php
session_start();
if($_SESSION['is_brand']!= true){
  header('location:../sign-in.php');
}
?>
<!DOCTYPE html>
<html>
<head>
	<title>Demande de contrat</title>
    <link rel="stylesheet" href="../../assets/css/demandeContrat.css">
    <link rel="icon" type="image/png" href="../../assets/img/1.png">

    <script src="../../assets/js/demandeContrat.js" defer></script>
</head>
<body>
    
    <div class="form-container">
  <div class="form-header">
     <h2>Demande de contrat</h2>
</div>
  <form action="" method="POST">
    <div class="form-grid">
      <div>
        <label for="start-date">Date de début:</label>
        <input type="date" id="start-date" name="start-date" placeholder="Entrez la date de début...">
      </div>
      <div>
        <label for="end-date">Date de fin:</label>
        <input type="date" id="end-date" name="end-date" placeholder="Entrez la date de fin...">
      </div>
      <div>
        <label for="price">Prix:</label>
        <input type="number" id="price" name="price" placeholder="Entrez le prix...">
      </div>
      <div style="width:100%">
        <label for="description">Description:</label>
        <textarea id="description" name="description" placeholder="Entrez la description..."></textarea>
      </div>
    </div>
    <input type="submit" value="Envoyer la demande">
  </form>
</div>
<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    include('../../pages/dbconnect.php');
    // Récupérer les données du formulaire
    $start_date = $_POST['start-date'];
    $end_date = $_POST['end-date'];
    $price = $_POST['price'];
    $description = $_POST['description'];

    // Valider les données du formulaire
    $errors = array();
    if (empty($start_date)) {
        $errors[] = 'La date de début est requise.';
    }
    if (empty($end_date)) {
        $errors[] = 'La date de fin est requise.';
    }
    if (empty($price)) {
        $errors[] = 'Le prix est requis.';
    }
    if (empty($description)) {
        $errors[] = 'La description est requise.';
    }

    // Si aucune erreur n'est détectée, traiter les données du formulaire
    if (empty($errors)) {
        try {
            $InfluencerID=$_GET['id'];
            $BrandID=$_SESSION['iduser'];
            $userdata = $data->prepare("INSERT INTO partnership(BrandID, InfluencerID,BrandConfirmed, price, StartDate, EndDate,description,Status) VALUES (:BrandID, :InfluencerID,:BrandConfirmed,:price,:StartDate,:EndDate,:description,:Status)");
  
            $userdata->execute([
              'BrandID' => $BrandID,
              'InfluencerID' => $InfluencerID,
              'BrandConfirmed' => 1,
              'price' => $price,
              'StartDate' => $start_date,
              'EndDate' => $end_date,
              'description' => $description,
              'Status' => 0,
            
            ]);
              
            // Rediriger vers une page de succès
            header("location:../contrats.php");
          } catch (Exception $e) {
            die("Erreur d'insertion:" . $e->getMessage());
          }
        
        // Rediriger vers une page de succès
        header('location:./contrats.php');
        exit();
    }
}
?>

</body>
</html>
