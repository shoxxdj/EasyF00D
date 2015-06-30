<?php
session_start();
if(isset($_POST["resto_id"]) && isset($_POST["menu_id"]) && isset($_POST["date"]))
{
	//extract data from the post
    extract($_POST);
    $date=date('d/m/y')." ".$_POST["date"];
    //set POST variables
    $url = 'http://10.191.43.53:3000/menus/'.$resto_id.'/'.$menu_id;
    $fields = array(
                            'date' => $date
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
    $return="";
    if(substr($result, -5) =='error')
    {
       
        $return.="<div class='alert alert-danger'>";
 		$return.="<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>";
		$return.="<strong>Error !</strong>";		
		$return.="Erreur sur la commande";		
		$return.="</div>";
    }
    else
    {
 		$return.="<div class='alert alert-success alert-dismissable'>";
 		$return.="<button type='button' class='close' data-dismiss='alert' aria-hidden='true'>×</button>";
		$return.="<strong>Success ! </strong>";		
		$return.="Votre commande est effectuée pour ".$_POST["date"]."h !";		
		$return.="</div>";
    }
 	
	echo $return;
 
}