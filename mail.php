<?php
function ft_sendmail($mail, $cle, $login) {
$sujet = "Activation de votre compte Camagru";
$entete = "From: Camagru" ;
$message = 'Bienvenue sur le Camagru de Julien et Malo powered by 42 school mac,
Pour activer votre compte, veuillez cliquer sur le lien ci dessous ou le copier/coller dans votre navigateur internet.

http://' . $_SERVER['HTTP_HOST'] . '/login/activation.php?log='.urlencode($login).'&cle='.urlencode($cle).'

Merci de votre confiance.
---------------
Ceci est un mail automatique, Merci de ne pas y repondre.';
mail($mail, $sujet, $message, $entete);
}

function ft_sendmail_forget($mail, $login, $code) {
	$sujet = "Activation de votre compte Camagru";
	$entete = "From: Camagru" ;
	$message = 'Bienvenue sur le Camagru de Julien et Malo powered by 42 school mac,
	Pour modifier votre mdp, veuillez inscrire ce code : ' + $code + ' et entre votre nouveau
	mot de passe sur la page.
	
	---------------
	Ceci est un mail automatique, Merci de ne pas y repondre.';
	mail($mail, $sujet, $message, $entete);
	}
?>