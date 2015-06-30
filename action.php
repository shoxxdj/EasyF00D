<?php

$login=htmlspecialchars($_POST["pseudo"]);
$password=htmlspecialchars($_POST["password"]);
$mail=htmlspecialchars($_POST["mail"]);

$postdata=http_build_query(array(
					'login' => $login,
					'password' => $password,
					'mail' => $mail));

	//Variable pour la requête post avec le protocole HTTP
	$opts = array('http' => array(
		'method' => 'POST',
		'content' => $postdata));

	$context = stream_context_create($opts);

	//Interrogation de l'API pour avoir les informations du site demandé
	$result = file_get_contents('http://10.191.43.53:3000/register',false,$context);

	if($result == "error")
	{
		header('location: index.php?error=3');
	}
	elseif ($result=="success") {
		header('location: index.php?error=0');
	}
	
?>