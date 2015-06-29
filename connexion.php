<?php

/*$login=htmlspecialchars($_POST["login"]);
$password=htmlspecialchars($_POST["password"]);


$postdata=http_build_query(array(
					'login' => $login,
					'password' => $password));

	//Variable pour la requête post avec le protocole HTTP
	$opts = array('http' => array(
		'method' => 'POST',
		'content' => $postdata));

	$context = stream_context_create($opts);

	//Interrogation de l'API pour avoir les informations du site demandé
	$result = file_get_contents('http://10.191.43.53:3000/login',false,$context);
	if($result == "success")
	{
		echo "yes";
	}
	else
	{
		echo "no";
	}

*/
    include('./include/header.php');
?>

    <div class="row">
        <br><br>
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Liste des restaurants à proximité </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th> Adresse </th>
                                <th> Prix </th>
                                <th> Téléphone </th>
                                <th> Notes </th>
                            </tr>
                        <thead>
                        <tbody>
                            <tr>
                                <td> <a href="restaurant.php?resto=coucou">L'annexe</a></td>
                                <td> 9 Cours de la Martinique, 33000 Bordeaux </td>
                                <td> ~15 € </td>
                                <td> 05 56 79 70 75 </td>
                                <td> 4/5 </td>
                            </tr>
                             <tr>
                                <td> Macdo </td>
                                <td> Boulevard Alfred Daney Place Latule 33000 Bordeaux </td>
                                <td> ~10 € </td>
                                <td> 05 57 19 11 87</td>
                                <td> 3/5 </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
