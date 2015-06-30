<?php
session_start();
if(!isset($_SESSION["cookie"]) && !isset($_SESSION["login"]))
{
    header("location: index.php?error=2");
}
else
{
    include('./include/header.php');
    #Get Request for this menu
        $curl_menu = curl_init();
        $params='';
        $params=$_POST["id_menu"];
        curl_setopt_array($curl_menu, array(
            CURLOPT_RETURNTRANSFER => 1,
            CURLOPT_URL => 'http://10.191.43.53:3000/menus/'.$params));
        curl_setopt($curl_menu, CURLOPT_COOKIE, "myApp=".$_SESSION["cookie"]);
        $resp = curl_exec($curl_menu);
        curl_close($curl_menu);
        $json=json_decode($resp);
?>

<script type="text/javascript">
	function reservation(){
                  $.ajax({
                          url:'dash.php',
                          type:'POST',
                          data:$('#form_res').serialize(),
                          success:function(data){
                        $("#result").html(data);
                    }
                        });
                       return false;               
                }
</script>




<div class="row">
	<div class="col-md-8 col-md-offset-2">
		<center>
			<div id="result">
			</div>
			<br><br>
			<h1>Confirmation de la commande</h1>
			<br><br>
			<?php
			foreach($json as $item)
			{
				if($item->id == $params)
				{
					echo "<h3>Nom: ".$item->nom."</h3>";
					echo "<h3>Description: ".$item->description."</h3>";
					echo "<h3>Prix: ".$item->prix."€</h3>";
					echo "<br><br>";
					echo "<form id='form_res' method='post' action='reservation.php'>";
					echo "<label id='date' for='date'>Heure de la commande: </label>";
					echo "<input type='time' name='date'/>";
                    echo "<input type='hidden' name='resto_id' value='".$_POST["id_resto"]."'/>";
                    echo "<input type='hidden' name='menu_id' value='".$_POST["id_menu"]."'/>";
                    echo "</form>";
                    echo "<br><br>";
					echo "<button onclick='reservation()' type='submit' class='btn btn-success'>Commander</button>";
				}
			}
			?>
		</center>
	</div>
</div>
<?php


}


?>