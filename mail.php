<?php
function ft_sendmail($mail, $cle, $login) {
$sujet = "Activation de votre compte Camagru";
$entete = "From: Camagru" ;
$message = 'Bienvenue le Camagru de Julien et Malo powered by 42 school mac,
Pour activer votre compte, veuillez cliquer sur le lien ci dessous ou copier/coller dans votre navigateur internet.

http://' . $_SERVER['HTTP_HOST'] . '/login/activation.php?log='.urlencode($login).'&cle='.urlencode($cle).'

Merci de votre confiance.
---------------
Ceci est un mail automatique, Merci de ne pas y repondre.';
mail($mail, $sujet, $message, $entete);
}
?>