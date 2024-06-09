<?php
session_start();
try{
session_unset();
session_destroy();
header('location:sign-in.php');
}
catch(Exception $e){
    die("erreur deconnexion:".$e->getMessage());
}
// Ce code permet de déconnecter l'utilisateur actuellement connecté 
// en détruisant sa session. Une fois la déconnexion réussie, 
// l'utilisateur est redirigé vers la page de connexion. 
// Si une exception est levée, un message d'erreur est affiché. 
?>