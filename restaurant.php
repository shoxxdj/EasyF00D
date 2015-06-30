<?php
session_start();
if(!isset($_SESSION["cookie"]) && !isset($_SESSION["login"]))
{
    header("location: index.php?error=2");
}
else
{
    include('./include/header.php');
    #Get Request for this restaurant
        $curl_resto = curl_init();
        $params='';
        $params=$_GET["resto"];
        curl_setopt_array($curl_resto, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://10.191.43.53:3000/menus/'.$params));
        curl_setopt($curl_resto, CURLOPT_COOKIE, "myApp=".$_SESSION["cookie"]);
        $resp = curl_exec($curl_resto);
        curl_close($curl_resto);
        $json=json_decode($resp);
?>
<br><br>
<div class="row">
        <div class="col-md-offset-2 col-md-8">
            <div class="panel panel-default">
                <div class="panel-heading">Menus disponibles dans ce restaurant </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th>Nom</th>
                                <th>Description</th>
                                <th>Prix</th>
                                <th>Restant(s)</th>
                                <th>Réserver</th>
                            </tr>
                        <thead>
                        <tbody>
                            <?php
                            foreach ($json as $item) 
                            {
                                echo "<tr>";
                                echo "<td>".$item->nom."</td>";
                                echo "<td>".$item->description."</td>";
                                echo "<td>".$item->prix."</td>";
                                echo "<td>5</td>";
                                echo "<form method='post' action='reservation.php'>";
                                echo "<input type='hidden' name='id_resto' value='".$_GET["resto"]."'/>";
                                echo "<input type='hidden' name='id_menu' value='".$item->id."'/>";
                                echo "<td><input id='reserve' type='image' src='pictures/ajouter.png' alt='Submit Form' /></td>";
                                echo "</form>";
                                echo "</tr>";
                            }
                            ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
<?php
}
?>