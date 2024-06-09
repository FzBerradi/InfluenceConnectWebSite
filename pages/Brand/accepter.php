<?php
// Démarrer la session
session_start();
// Vérifier si l'utilisateur est une marque enregistrée, sinon rediriger vers la page de connexion
if($_SESSION['is_brand']!= true){
  header('location:../sign-in.php');
}

// Vérifier si l'ID du partenariat est défini dans l'URL
if (isset($_GET['id'])) {
  $PartnershipID = $_GET['id'];
  
  // Se connecter à la base de données
  include('../dbconnect.php');
  
  // Mettre à jour le statut du partenariat dans la base de données
  $sql = $data->prepare("UPDATE partnership SET brandConfirmed=1 , status = 'confirmed' WHERE PartnershipID = '$PartnershipID'"); 
  $sql->execute([]);
  
  // Rediriger vers la page des invitations
  header("Location: invitations.php");
  exit();
} else {
  echo "Erreur de modification";
}
?>