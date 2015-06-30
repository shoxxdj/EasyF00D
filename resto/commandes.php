<?php
session_start();
include('./include/header.php');

#Get Request for listing my commands
        $curl_resto = curl_init();
        curl_setopt_array($curl_resto, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'http://10.191.43.53:3000/restaurateur/orders'));
        curl_setopt($curl_resto, CURLOPT_COOKIE, "myApp=".$_SESSION["cookie"]);
        $resp = curl_exec($curl_resto);
        curl_close($curl_resto);
        $json=json_decode($resp);
        print_r($json);
?>

<div class="row">
        <div class="col-md-offset-2 col-md-8">
        <br><br>
        <div class="panel panel-default">
                <div class="panel-heading">Liste de mes commandes </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th> Restaurant </th>
                                <th> Client </th>
                            </tr>
                        <thead>
                        <tbody>
                        <?php
                        foreach($json as $item)
                        {
                            echo "<tr>";
                            echo "<td>".$item->nom."</td>";
                            echo "<form method='post' action='ajout_menu.php'>";
                            echo "<input type='hidden' name='id_menu' value='".$item->id."'/>";
                            echo "<td><input id='reserve' type='image' src='pictures/ajouter.png' alt='Submit Form' /></td>";
                            echo "</tr>";
                        }
                        ?>
                        </tbody>
                    </table>
                </div>