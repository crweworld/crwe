<?php
require_once "src/facebook.php";
$config = array();
$config['appId'] = '541823352683035';
$config['secret'] = '444bcbc8f24d3ccbc48b3dfcfa5adeb9';
$config['fileUpload'] = false; // optional
 
$fb = new Facebook($config);
$params = array(
  "access_token" => "EAAHsyRR3uhsBAE8vt8S0gp8qhyyNH6PSoPXuZAJ46rhnvebRLGu3mouEopCPp4SEESHurZBu1uUMbUiKDvq95u9uEX5eDeKcMCZA2RDYiuaLzTiKSDD2pQ0FTYDNZBGUbNksCN5DBlEPCw1wUYVi8ZBz7pFctIT0ZD",
  "link" => 'http://crweworld.com'.$post_url
);
 
try {
  $ret = $fb->api('/1611596579123327/feed', 'POST', $params);
} catch(Exception $e) {
  //echo $e->getMessage();
}
?>