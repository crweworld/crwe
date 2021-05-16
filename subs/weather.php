<?php
#Defining the basic cURL function
    function curl($url) {
    $ch = curl_init();  // Initialising cURL
#Setting cURL's URL option with the $url variable passed into the function
    curl_setopt($ch, CURLOPT_URL, $url);
#Setting cURL's option to return the webpage data   
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE); 
#Executing the cURL request and assigning the returned data to the $data variable
    $data = curl_exec($ch); 
#Closing cURL 
    curl_close($ch); 
#Returning the data from the function  
    return $data;  
 }

$q = preg_replace('/\s+/', '', $_GET['q']);
$units=$_GET['units'];
 $baba="http://api.openweathermap.org/data/2.5/weather?q=$q&units=$units&APPID=772dced1c6c489ea078b4a3d0c425b5c";
     echo $scraped_website = curl($baba);

?>