<?php
session_start();
if(!isset($_SESSION["cookie"]) && !isset($_SESSION["login"]))
{
    //extract data from the post
    extract($_POST);
    //set POST variables
    $url = 'http://10.191.43.53:3000/restaurateur/login';
    $fields = array(
                        'login' => urlencode($login),
                        'password' => urlencode($password)
                    );
    //url-ify the data for the POST
    $fields_string="";
    foreach($fields as $key=>$value) { $fields_string .= $key.'='.$value.'&'; }
    rtrim($fields_string, '&');
    
    
    //open connection
    $ch = curl_init();
    
    //set the url, number of POST vars, POST data
    curl_setopt($ch,CURLOPT_URL, $url);
    curl_setopt($ch,CURLOPT_POST, count($fields));
    curl_setopt($ch,CURLOPT_POSTFIELDS, $fields_string);
    curl_setopt($ch, CURLOPT_HEADER, 1);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
    
    //execute post
    $result = curl_exec($ch);
    // get cookie
    // multi-cookie variant contributed by @Combuster in comments
    preg_match_all('/^Set-Cookie:\s*([^;]*)/mi', $result, $matches);
    $cookies = array();
    foreach($matches[1] as $item) {
        parse_str($item, $cookie);
        $cookies = array_merge($cookies, $cookie);
    }
    //close connection
    curl_close($ch);
    if(substr($result, -5) =='error')
    {
        header("location: index.php?error=1");
    }
    else
    {
        $_SESSION["cookie"]=$cookies["myApp"];
        $_SESSION["login"]=$login;
        include('./include/header.php');
    
        #Get Request for listing my restaurants
        $curl_resto = curl_init();
        curl_setopt_array($curl_resto, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'http://10.191.43.53:3000/restaurateur/myresto'));
        curl_setopt($curl_resto, CURLOPT_COOKIE, "myApp=".$_SESSION["cookie"]);
        $resp = curl_exec($curl_resto);
        curl_close($curl_resto);
        $json=json_decode($resp);
    }
}
else
{
    include('./include/header.php');

     #Get Request for listing my restaurants
        $curl_resto = curl_init();
        curl_setopt_array($curl_resto, array(
        CURLOPT_RETURNTRANSFER => 1,
        CURLOPT_URL => 'http://10.191.43.53:3000/restaurateur/myresto'));
        curl_setopt($curl_resto, CURLOPT_COOKIE, "myApp=".$_SESSION["cookie"]);
        $resp = curl_exec($curl_resto);
        curl_close($curl_resto);
        $json=json_decode($resp);
}  
    
?>

    <div class="row">
        <div class="col-md-offset-2 col-md-8">
        <br><br>
        <?php
        if(isset($_GET["error"]))
          {
            if($_GET["error"]==0)
            {?>
              <div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
              <strong>Success ! </strong> 
              Le restaurant est bien créé !  
              </div>
          <?php
            }
            elseif ($_GET["error"]==2) {?>
               <div class='alert alert-success alert-dismissable'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
              <strong>Success ! </strong> 
              Le menu est bien créé !  
              </div><?php
            }
            elseif ($_GET["error"]==3) {?>
               <div class='alert alert-danger'>
              <button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>
              <strong>Error ! </strong> 
              Le menu n'est pas créé !  
              </div><?php
            }
        }
        ?>
            <div class="panel panel-default">
                <div class="panel-heading">Liste de mes restaurants </div>
                    <table class="table">
                        <thead>
                            <tr>
                                <th> Nom </th>
                                <th> Ajout Menu </th>
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
                <br><br>
                <div class="row">
                    <div class="col-md-offset-4 col-md-2">
                        <a href='ajout_restau.php'><button class='btn btn-success'>Ajout Restaurant</button></a>
                    </div>
                </div>
            </div>

        </div>

    </div>