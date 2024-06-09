<?php
session_start(); // Démarrer une session PHP pour stocker les données de l'utilisateur entre les pages
if ($_SESSION['is_admin'] != 1) { // Vérifier si l'utilisateur est un administrateur
  header('location:../sign-in.php'); // Rediriger l'utilisateur vers la page de connexion s'il n'est pas un administrateur
}

$accountId = $_GET['id']; // Obtenir l'identifiant du compte à supprimer à partir du paramètre de requête d'URL
include('../dbconnect.php'); // Inclure le fichier qui établit une connexion à la base de données
if (isset($accountId)) { // Vérifier si l'ID du compte est défini dans le paramètre d'URL

    // Préparer une instruction SQL pour supprimer l'utilisateur ayant l'ID spécifié
    $remove = $data->prepare('DELETE FROM user WHERE ID=?');
    
    // Exécuter l'instruction SQL avec l'ID du compte à supprimer
    $remove->execute([$accountId]);
    
    // Rediriger l'utilisateur vers la page du tableau de bord de l'administrateur après avoir supprimé le compte avec succès
    header('location:./Admindashboard.php');
}
?>
