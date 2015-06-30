<?php
session_start();
$url = 'http://10.191.43.53:3000/restaurateur/addresto';
    $fields = array(
                            'name' => $_POST["nom"],
                            'adresse' => $_POST["adresse"],
                            'tel' => $_POST["tel"]
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
    curl_setopt($ch, CURLOPT_COOKIE, "myApp=".$_SESSION["cookie"]);
    //execute post
    $result = curl_exec($ch);
    if(substr($result, -5) !='error')
    {
        header("location: connexion_pro.php?error=0");
    }
    else
    {
    	header('location: index_resto.php?error=1');
    }
?>