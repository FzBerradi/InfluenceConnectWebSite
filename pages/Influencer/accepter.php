<?php
session_start(); // démarrer une session

if($_SESSION['is_influencer']!= true){ // vérifier si l'utilisateur est un influenceur
  header('location:../sign-in.php'); // rediriger vers la page de connexion si l'utilisateur n'est pas un influenceur
}

// Vérifier si l'ID de partenariat est défini dans l'URL
if (isset($_GET['id'])) {
  $PartnershipID = $_GET['id']; // récupérer l'ID de partenariat à partir de l'URL
  
  // Se connecter à la base de données
  include('../dbconnect.php');
  
  // Mettre à jour le statut du partenariat dans la base de données
  $sql = $data->prepare("UPDATE partnership SET InfluencerConfirmed=1 , status = 'confirmed' WHERE PartnershipID = '$PartnershipID'"); 
  $sql->execute([]); // exécuter la requête SQL pour mettre à jour les données

  // Rediriger vers la page d'invitation une fois que la mise à jour a été effectuée
  header("Location: invitations.php");
  exit(); // quitter le script
} else {
  echo "Erreur de modification"; // afficher un message d'erreur si l'ID de partenariat n'est pas défini dans l'URL
}
?>

