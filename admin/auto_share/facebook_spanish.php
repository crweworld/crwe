<?php
require_once "src/facebook.php";
$config = array();
$config['appId'] = '541823352683035';
$config['secret'] = '444bcbc8f24d3ccbc48b3dfcfa5adeb9';
$config['fileUpload'] = false; // optional
 
$fb = new Facebook($config);
$params = array(
  "access_token" => "EAAHsyRR3uhsBABh9e3S8omfItwOOX4VTLFdfXfaU3x4ZBCnZAfeR9IVnbj4wVALn5PrLdsEIR9al0dIutEa6bmHMQ00akNYhHLVTUU66XFakvQd8ZCbQf4gVStsZC8YvRxDVHvQELaRVx02jzXNgexLTqZAIV2sDJMZAv5G2AZAfAZDZD",
  "link" => 'http://crweworld.com'.$post_url
);
 
try {
  $ret = $fb->api('/698655093636087/feed', 'POST', $params);
} catch(Exception $e) {
  //echo $e->getMessage();
}
?>