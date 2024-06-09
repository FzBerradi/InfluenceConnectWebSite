<?php

ob_start(); // Démarrer la temporisation de sortie

include('../dbconnect.php'); // Inclure le fichier de connexion à la base de données
session_start();// Commencer une session pour une variable de SESSION

$accountId = $_SESSION['iduser']; // Récupérer l'ID de l'utilisateur connecté à partir de la session

$user = $data->prepare('SELECT * FROM user WHERE ID=?'); // Préparer la requête pour récupérer les informations de l'utilisateur connecté
$user->execute([$accountId]); // Exécuter la requête en passant l'ID de l'utilisateur en tant que paramètre
$info = $user->fetch(); // Récupérer les informations de l'utilisateur sous forme de tableau associatif
$role = $info['isBrand']; // Récupérer le rôle de l'utilisateur (marque ou influenceur) à partir des informations récupérées

if (empty($_GET['idUserMessage'])) { // Vérifier si l'ID de l'utilisateur avec lequel l'utilisateur connecté a déjà discuté est disponible dans l'URL

  $user2 = $data->prepare('SELECT DISTINCT
  CASE
    WHEN SenderID = ? THEN RecipientID
    WHEN RecipientID = ? THEN SenderID
  END AS FirstChatUserID,
  u.firstName,
  u.lastName,
  u.ImageProfile
FROM Messages m
INNER JOIN user u ON u.ID = CASE
  WHEN SenderID = ? THEN RecipientID
  WHEN RecipientID = ? THEN SenderID
END
WHERE SenderID = ? OR RecipientID = ?
LIMIT 1;'); // Préparer la requête pour récupérer les informations du premier utilisateur avec lequel l'utilisateur connecté a discuté

  $user2->execute([$accountId, $accountId, $accountId, $accountId, $accountId, $accountId]); // Exécuter la requête en passant l'ID de l'utilisateur connecté en tant que paramètre
  $info2 = $user2 ?  $user2->fetch() : ["FirstChatUserID" => "", "lastName" => "", "firstName" => "", "ImageProfile" => ""]; // Récupérer les informations du premier utilisateur avec lequel l'utilisateur connecté a discuté sous forme de tableau associatif
  if (empty($info2)) { // Vérifier si les informations de l'utilisateur récupérées sont vides
    $info2 = array(
      "FirstChatUserID" => "",
      "lastName" => "",
      "firstName" => "",
      "ImageProfile" => ""
    );
  }
  $idUserMessage = $info2['FirstChatUserID']; // Récupérer l'ID de l'utilisateur avec lequel l'utilisateur connecté a déjà discuté à partir des informations récupérées

} else {
  $idUserMessage = $_GET['idUserMessage']; // Récupérer l'ID de l'utilisateur avec lequel l'utilisateur connecté souhaite discuter à partir de l'URL

  $user2 = $data->prepare('SELECT * from user where ID=?'); // Préparer la requête pour récupérer les informations de l'utilisateur avec lequel l'utilisateur connecté souhaite discuter
  $user2->execute([$idUserMessage]); // Exécuter la requête en passant l'ID de l'utilisateur avec lequel l'utilisateur connecté souhaite discuter en tant que paramètre
  $info2 = $user2->fetch(); // Récupérer les informations de l'utilisateur avec lequel l'utilisateur connect
}



?>




<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../assets/css/message.css">
  <link href="//netdna.bootstrapcdn.com/bootstrap/3.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
  <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
  <link rel="icon" type="image/png" href="../../assets/img/1.png">
  <!------ Inclure ce qui précède dans la balise HEAD ---------->


  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <title>Messages</title>

  <style>
    .buttonBack {
      background-color: #87CFFF;
      /* Définir la couleur de fond */
      color: white;
      /* Définir la couleur du texte */
      padding: 10px 20px;
      /* Définir le remplissage (padding) */
      text-align: center;
      /* Centrer le texte */
      text-decoration: none;
      /* Supprimer le soulignement du lien */
      display: inline-block;
      /* En faire un élément de bloc */
      border-radius: 5px;
      /* Ajouter des coins arrondis */
      border: none;
      /* Supprimer la bordure */
      font-size: 15px;
      /* Définir la taille de police */
      cursor: pointer;
      /* Ajouter un curseur au survol */
      text-decoration: none;
      position: absolute;
      top: 2%;
      left: 2%;

    }

    /* Au survol */
    .buttonBack:hover {
      background-color: #87CEEC;
      text-decoration: none;
      color: whitesmoke;
    }
  </style>
</head>

<body>
<?php
// Vérifier le rôle de l'utilisateur connecté
if ($role == 1) { // Si l'utilisateur est une marque
?>
  <a href="../Brand/listeInfluenceurs.php" class="buttonBack">⬅️ Back</a> <!-- Afficher un lien de retour vers le tableau de bord de la marque -->
<?php
} else { // Sinon, si l'utilisateur est un influenceur
?>
  <a href="../Influencer/listeBrands.php" class="buttonBack">⬅️ Back</a> <!-- Afficher un lien de retour vers le tableau de bord de l'influenceur -->
<?php
}
?>

  <div class="container app" style="float:right; width:85%; margin: 0 3% 0 0 ; border-radius:2%;">

    <div class="row app-one">
      <div class="col-sm-4 side">
        <div class="side-one">
          <div class="row heading">
            <div class="col-sm-3 col-xs-3 heading-avatar">
              <div class="heading-avatar-icon">



                <img src="../../images/<?= $info["ImageProfile"] ?>">




              </div>
            </div>

            <div class="col-sm-2 col-xs-2 heading-compose  pull-right">
              <i class="fa fa-comments fa-2x  pull-right" aria-hidden="true"></i>
            </div>
          </div>

          <div class="row sideBar">
          <?php
// Inclusion du fichier de connexion à la base de données
include('../dbconnect.php');

// Récupération de l'identifiant de l'utilisateur connecté
$accountId = $_SESSION['iduser'];

// Requête SQL pour récupérer la liste des utilisateurs avec qui l'utilisateur connecté a échangé des messages,
// en triant les résultats par date d'envoi du dernier message
$read1 = $data->prepare('SELECT user.firstName, user.lastName, user.ID, user.isBrand, user.isInfluencer, user.ImageProfile, MAX(Messages.SentTime) AS lastMessageSentTime
    FROM Messages
    INNER JOIN user ON (Messages.SenderID = user.ID OR Messages.RecipientID = user.ID)
    WHERE (Messages.SenderID = ? OR Messages.RecipientID = ?)
    AND user.ID != ?
    GROUP BY user.ID
    ORDER BY lastMessageSentTime DESC');

// Exécution de la requête en passant les identifiants de l'utilisateur connecté comme paramètres
$read1->execute([$accountId, $accountId, $accountId]);

// Récupération des résultats de la requête sous forme de tableau associatif
$res1 = $read1->fetchAll(PDO::FETCH_ASSOC);

// Boucle sur chaque résultat pour afficher les informations sur chaque utilisateur
foreach ($res1 as $row) {
    ?>
    <!-- Ici, on pourrait afficher les informations de chaque utilisateur dans le HTML de la page -->

              <a href="message.php?idUserMessage=<?= $row['ID'] ?>">

                <div class="row sideBar-body">
                  <div class="col-sm-3 col-xs-3 sideBar-avatar">
                    <div class="avatar-icon">
                      <img src="../../images/<?= $row["ImageProfile"] ?>">
                    </div>
                  </div>
                  <div class="col-sm-9 col-xs-9 sideBar-main">
                    <div class="row">
                      <div class="col-sm-8 col-xs-8 sideBar-name">
                        <span class="name-meta"><?= $row["firstName"] ?> <?= $row["lastName"] ?>
                          <small style="display:block; color:gray">
                          <?php
    // Vérifier si l'utilisateur est un "Influencer"
    if ($row["isInfluencer"] == 1) {
?>
        Influenceur
<?php
    } else {
        // L'utilisateur est une "Brand"
?>
        Marque
<?php
    }
?>

                          </small>
                        </span>
                      </div>
                      <div class="col-sm-4 col-xs-4 pull-right sideBar-time">
                        <span class="time-meta pull-right"> <?= $row["lastMessageSentTime"] ?>
                        </span>
                      </div>
                    </div>
                  </div>

                </div>
              </a>
            <?php } ?>

          </div>
        </div>

        <div class="side-two">
          <div class="row newMessage-heading">
            <div class="row newMessage-main">
              <div class="col-sm-2 col-xs-2 newMessage-back">
                <i class="fa fa-arrow-left" aria-hidden="true"></i>
              </div>
              <div class="col-sm-10 col-xs-10 newMessage-title">
                Nouvelle discussion
              </div>
            </div>
          </div>



          <div class="row compose-sideBar">

          <?php
// Inclusion du fichier de connexion à la base de données
include('../dbconnect.php');

// Préparation de la requête SQL pour sélectionner les informations des utilisateurs
$read2 = $data->prepare('SELECT ID, firstName, lastName, isBrand, isAdmin, isInfluencer, ImageProfile
FROM user
WHERE ID != ? and isAdmin is NULL;');

// Exécution de la requête SQL avec la valeur de la variable $accountId passée comme paramètre
$read2->execute([$accountId]);

// Récupération des résultats sous forme de tableau associatif
$res2 = $read2->fetchAll(PDO::FETCH_ASSOC);

// Boucle sur chaque ligne du résultat
foreach ($res2 as $row1) {
  // Code à exécuter pour chaque ligne



            ?>

              <a href="message.php?idUserMessage=<?= $row1['ID'] ?>">

                <div class="row sideBar-body">
                  <div class="col-sm-3 col-xs-3 sideBar-avatar">
                    <div class="avatar-icon">
                      <img src="../../images/<?= $row1["ImageProfile"] ?>">
                    </div>
                  </div>
                  <div class="col-sm-9 col-xs-9 sideBar-main">
                    <div class="row">
                      <div class="col-sm-8 col-xs-8 sideBar-name">
                        <span class="name-meta"> <?= $row1["firstName"] ?> <?= $row1["lastName"] ?>
                        </span>
                        <small style="display:block; color:gray">
                        <?php 
// Vérifier si l'utilisateur est un influenceur ou une marque en fonction de la valeur de 'isInfluencer' dans la ligne de la base de données correspondante
if ($row1["isInfluencer"] == 1) { ?>
    Influenceur
<?php } else { ?>
  Marque
<?php } ?>
                        </small>
                      </div>
                    </div>
                  </div>
                </div>
              </a>
            <?php } ?>

          </div>
        </div>
      </div>

      <div class="col-sm-8 conversation">
        <div class="row heading">
          <div class="col-sm-2 col-md-1 col-xs-3 heading-avatar">
            <div class="heading-avatar-icon">
            <?php if ($info2["ImageProfile"] != "") { ?>

<!-- Si l'utilisateur a une image de profil, afficher l'image -->
<img src="../../images/<?= $info2["ImageProfile"] ?>">

<?php } ?>

            </div>
          </div>
          <div class="col-sm-8 col-xs-7 heading-name">
            <a class="heading-name-meta"><?= $info2["firstName"] ?> <?= $info2["lastName"] ?>
            </a>
          </div>

        </div>

        <div class="row message" id="conversation">
          <div class="row message-previous">
            <div class="col-sm-12 previous">
              <a onclick="previous(this)" id="ankitjain28" name="20">
                Show Previous Message!
              </a>
            </div>
          </div>



          <?php
  // Inclusion du fichier de connexion à la base de données
  include('../dbconnect.php');

  // Préparation de la requête pour récupérer les messages entre deux utilisateurs
  $read3 = $data->prepare("SELECT MessageID, SenderID, RecipientID, MessageText, DATE_FORMAT(SentTime, '%a %h:%i') AS SentTimeFormatted
                            FROM Messages
                            WHERE (SenderID = ? AND RecipientID = ?) OR (SenderID = ? AND RecipientID = ?)
                            ORDER BY SentTime ASC;");
  
  // Exécution de la requête en fournissant les identifiants des deux utilisateurs
  $read3->execute([$accountId, $idUserMessage, $idUserMessage, $accountId]);
  
  // Récupération des résultats sous forme de tableau associatif
  $res3 = $read3->fetchAll(PDO::FETCH_ASSOC);
  
  // Parcours des résultats pour afficher les messages
  foreach ($res3 as $row2) {
    // Affichage de chaque message avec sa date et heure d'envoi formatées
    ?>



            <?php
    // Vérification pour savoir si le message a été envoyé ou reçu par l'utilisateur connecté

            if ($row2["RecipientID"] == $accountId) {
            ?>


              <div class="row message-body">
                <div class="col-sm-12 message-main-receiver">


                  <div class="receiver">
                    <div class="message-text">
                      <?= $row2["MessageText"] ?>
                    </div>
                    <span class="message-time pull-right">
                      <?= $row2["SentTimeFormatted"] ?>
                    </span>
                  </div>


                </div>
              </div>
              <br />
            <?php } else { ?>

              <div class="row message-body">
                <div class="col-sm-12 message-main-sender">
                  <div class="sender">
                    <div class="message-text">
                      <?= $row2["MessageText"] ?>
                    </div>
                    <span class="message-time pull-right">
                      <?= $row2["SentTimeFormatted"] ?>
                    </span>
                  </div>
                </div>
              </div>
              <br />
          <?php }
          } ?>

        </div>

        <form action="" id="form2" method="POST" enctype="multipart/form-data">

          <div class="row reply">
            <div class="col-sm-1 col-xs-1 reply-emojis">
              <i class="fa fa-smile-o fa-2x"></i>
            </div>
            <div class="col-sm-9 col-xs-9 reply-main">
              <textarea class="form-control" rows="1" name="messageText" id="comment" required></textarea>
            </div>
            <div class="col-sm-1 col-xs-1 reply-send">
              <button type="submit" id="btn2" name="btn2" style="border: 0px none white;"> <i class="fa fa-send fa-2x" aria-hidden="true"></i> </button>

            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
  <script>
    // Attendre que le DOM soit chargé
    $(function() {
    
      // Ajouter un gestionnaire d'événement de clic sur l'élément avec la classe CSS ".heading-compose"
      $(".heading-compose").click(function() {
        // Lorsque ".heading-compose" est cliqué, définir la propriété "left" de ".side-two" à "0" pour la faire glisser dans la vue
        $(".side-two").css({
          "left": "0"
        });
      });

      // Ajouter un gestionnaire d'événement de clic sur l'élément avec la classe CSS ".newMessage-back"
      $(".newMessage-back").click(function() {
        // Lorsque ".newMessage-back" est cliqué, définir la propriété "left" de ".side-two" à "-120%" pour la faire glisser hors de la vue
        $(".side-two").css({
          "left": "-120%"
        });
      });
    })
</script>

</body>

</html>

<?php

// Démarre la temporisation de sortie pour mettre en mémoire tampon la sortie de script
ob_start();

// Vérifie si le formulaire a été soumis et que le champ de texte n'est pas vide
if (isset($_POST['btn2']) && !empty($_POST['messageText'])) {

  // Récupère le texte du message à partir du formulaire
  $messageText = $_POST['messageText'];

  // Récupère la date et l'heure actuelles
  $sentTime = date('Y-m-d H:i:s');

  // Inclus le fichier de connexion à la base de données
  include('../dbconnect.php');

  // Prépare la requête SQL pour insérer le message dans la table des messages
  $messagedata = $data->prepare("INSERT INTO Messages (SenderID, RecipientID, MessageText, SentTime) VALUES (?, ?, ?, ?)");

  // Exécute la requête SQL en passant les valeurs des paramètres dans un tableau
  $messagedata->execute([$accountId, $idUserMessage, $messageText, $sentTime]);

  // Redirige l'utilisateur vers la même page en passant l'ID de l'utilisateur destinataire dans la requête
  header("Location: " . $_SERVER['PHP_SELF'] . "?idUserMessage=" . $idUserMessage);
  exit;
}

// Affiche le contenu mis en mémoire tampon
ob_end_flush();

?>