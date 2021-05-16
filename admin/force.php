<?php

$matches = array();

$dir = '/var/cpanel/php/sessions/ea-php56';
if ( $handle = opendir( $dir ) ) {
	while ( false !== ( $entry = readdir( $handle ) ) ) {
		if ( $entry != "." && $entry != ".." ) {

			$handle2 = @fopen('/var/cpanel/php/sessions/ea-php56/'.$entry, "r");
			if ($handle2)
			{
			    while (!feof($handle2))
			    {
			        $buffer = fgets($handle2);
			        if(strpos($buffer, $_GET['useremail']) !== FALSE)
			            $matches[] = $buffer;
			    }
			    fclose($handle2);
				echo $matches?'sudo rm -f /var/cpanel/php/sessions/ea-php56/'.$entry:'';
				$matches = array();
			}
			
			//show results:
				
			
		}
	}
}




?>