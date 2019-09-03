<?php

$login = "mabouce";

$cle = "ABCDE";

$email = "ma.sithis@gmail.com";
// Préparation du mail contenant le lien d'activation
$destinataire = $email;
$sujet = "Activer votre compte" ;
$entete = "From: Camagru" ;
 
// Le lien d'activation est composé du login(log) et de la clé(cle)
$message = 'Bienvenue sur Camagru,
 
Pour activer votre compte, veuillez cliquer sur le lien ci dessous
ou copier/coller dans votre navigateur internet.
 
http://localhost:8082/login/activation.php?log='.urlencode($login).'&cle='.urlencode($cle).'
 
---------------
Ceci est un mail automatique, Merci de ne pas y répondre.';

mail($destinataire, $sujet, $message, $entete) ;
?>