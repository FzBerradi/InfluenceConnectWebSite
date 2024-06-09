<?php
session_start();
if($_SESSION['is_influencer']!= true){
  header('location:../sign-in.php');
}
// Vérifie si PartnershipID est défini dans l'URL
if (isset($_GET['id'])) {
  $PartnershipID = $_GET['id'];
  
  // Connecte à la base de données
  include('../dbconnect.php');
  
  // Met à jour le statut du partenariat dans la base de données
  $sql = $data->prepare("UPDATE partnership SET InfluencerConfirmed=0 , status = 'canceled' WHERE PartnershipID = '$PartnershipID'"); 
  $sql->execute([]);
  
  // Redirige l'utilisateur vers la page des invitations
  header("Location: invitations.php");
  exit();
} else {
  echo "Erreur de modification";
}
?>
