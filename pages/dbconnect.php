
<?php
 try {
     // Connexion à la base de données MySQL avec PDO avec port:3308
     $data = new PDO('mysql:host=localhost:3308;dbname=brandsInfluencers;charset=utf8', 'root', '', [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
 } catch (PDOException $e) {
     // En cas d'erreur lors de la connexion, un message d'erreur est affiché
    die('Erreur de connexion à la base de données : ' . $e->getMessage());
 }
?>
