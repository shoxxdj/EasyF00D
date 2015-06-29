<?php

$name=htmlspecialchars($_POST["name"]);
$adress=htmlspecialchars($_POST["adress"]);
$tel=htmlspecialchars($_POST["tel"]);


$postdata=http_build_query(array(
					'name' => $name,
					'adress' => $adress,
					'tel' => $tel));

	//Variable pour la requête post avec le protocole HTTP
	$opts = array('http' => array(
		'method' => 'POST',
		'content' => $postdata));

	$context = stream_context_create($opts);

	//Interrogation de l'API pour avoir les informations du site demandé
	$result = file_get_contents('http://10.191.43.53:3000/restaurateur/addresto',false,$context);
	print_r($result);

	if($result == "success")
	{
		echo "yes";
	}
	elseif ($result=="error") {
		echo "no";
	}
	


?>