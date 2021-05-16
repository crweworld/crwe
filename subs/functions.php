<?php
function time_elapsed_string($datetime, $full = false) {
    $now = new DateTime;
    $ago = new DateTime($datetime);
    $diff = $now->diff($ago);

    $diff->w = floor($diff->d / 7);
    $diff->d -= $diff->w * 7;

    $string = array(
        'y' => 'year',
        'm' => 'month',
        'w' => 'week',
        'd' => 'day',
        'h' => 'hour',
        'i' => 'minute',
        's' => 'second',
    );
    foreach ($string as $k => &$v) {
        if ($diff->$k) {
            $v = $diff->$k . ' ' . $v . ($diff->$k > 1 ? 's' : '');
        } else {
            unset($string[$k]);
        }
    }

    if (!$full) $string = array_slice($string, 0, 1);
    return $string ? implode(', ', $string) . ' ago' : 'just now';
}

function classLiked($session, $usr_list){
	if (in_array($session, explode(',',$usr_list )))
	  {
		  return "liked";
	  }	
}

function zero($val){
	if($val!=0){return $val;}
}

	function txtcleaner($value) {
    // Convert all dashes to hyphens
    $value = str_replace('—', '-', $value);
    $value = str_replace('‒', '-', $value);
    $value = str_replace('―', '-', $value);
    // Convert underscores and spaces to hyphens
    $value = str_replace('_', '-', $value);
    $value = str_replace(' ', '-', $value);
    
    // Convert all accented latin-1 supplement characters to their non-accented counterparts
    // Characters are taken from https://en.wikipedia.org/wiki/Latin-1_Supplement_(Unicode_block)
    $accents   = array('À', 'Á', 'Â', 'Ã', 'Ä', 'Å', 'Æ', 'Ç', 'È', 'É', 'Ê', 'Ë', 'Ì', 'Í', 'Î', 'Ï', 'Ð', 'Ñ', 'Ò', 'Ó', 'Ô', 'Õ', 'Ö', 'Ø', 'Ù', 'Ú', 'Û', 'Ü', 'Ý', 'ß', 'à', 'á', 'â', 'ã', 'ä', 'å', 'æ', 'ç', 'è', 'é', 'ê', 'ë', 'ì', 'í', 'î', 'ï', 'ñ', 'ò', 'ó', 'ô', 'õ', 'ö', 'ø', 'ù', 'ú', 'û', 'ü', 'ý', 'ÿ', 'Ā', 'ā', 'Ă', 'ă', 'Ą', 'ą', 'Ć', 'ć', 'Ĉ', 'ĉ', 'Ċ', 'ċ', 'Č', 'č', 'Ď', 'ď', 'Đ', 'đ', 'Ē', 'ē', 'Ĕ', 'ĕ', 'Ė', 'ė', 'Ę', 'ę', 'Ě', 'ě', 'Ĝ', 'ĝ', 'Ğ', 'ğ', 'Ġ', 'ġ', 'Ģ', 'ģ', 'Ĥ', 'ĥ', 'Ħ', 'ħ', 'Ĩ', 'ĩ', 'Ī', 'ī', 'Ĭ', 'ĭ', 'Į', 'į', 'İ', 'ı', 'Ĳ', 'ĳ', 'Ĵ', 'ĵ', 'Ķ', 'ķ', 'Ĺ', 'ĺ', 'Ļ', 'ļ', 'Ľ', 'ľ', 'Ŀ', 'ŀ', 'Ł', 'ł', 'Ń', 'ń', 'Ņ', 'ņ', 'Ň', 'ň', 'ŉ', 'Ō', 'ō', 'Ŏ', 'ŏ', 'Ő', 'ő', 'Œ', 'œ', 'Ŕ', 'ŕ', 'Ŗ', 'ŗ', 'Ř', 'ř', 'Ś', 'ś', 'Ŝ', 'ŝ', 'Ş', 'ş', 'Š', 'š', 'Ţ', 'ţ', 'Ť', 'ť', 'Ŧ', 'ŧ', 'Ũ', 'ũ', 'Ū', 'ū', 'Ŭ', 'ŭ', 'Ů', 'ů', 'Ű', 'ű', 'Ų', 'ų', 'Ŵ', 'ŵ', 'Ŷ', 'ŷ', 'Ÿ', 'Ź', 'ź', 'Ż', 'ż', 'Ž', 'ž', 'ſ', 'ƒ', 'Ơ', 'ơ', 'Ư', 'ư', 'Ǎ', 'ǎ', 'Ǐ', 'ǐ', 'Ǒ', 'ǒ', 'Ǔ', 'ǔ', 'Ǖ', 'ǖ', 'Ǘ', 'ǘ', 'Ǚ', 'ǚ', 'Ǜ', 'ǜ', 'Ǻ', 'ǻ', 'Ǽ', 'ǽ', 'Ǿ', 'ǿ', 'Ά', 'ά', 'Έ', 'έ', 'Ό', 'ό', 'Ώ', 'ώ', 'Ί', 'ί', 'ϊ', 'ΐ', 'Ύ', 'ύ', 'ϋ', 'ΰ', 'Ή', 'ή');
    $noAccents = array('A', 'A', 'A', 'A', 'A', 'A', 'AE', 'C', 'E', 'E', 'E', 'E', 'I', 'I', 'I', 'I', 'D', 'N', 'O', 'O', 'O', 'O', 'O', 'O', 'U', 'U', 'U', 'U', 'Y', 's', 'a', 'a', 'a', 'a', 'a', 'a', 'ae', 'c', 'e', 'e', 'e', 'e', 'i', 'i', 'i', 'i', 'n', 'o', 'o', 'o', 'o', 'o', 'o', 'u', 'u', 'u', 'u', 'y', 'y', 'A', 'a', 'A', 'a', 'A', 'a', 'C', 'c', 'C', 'c', 'C', 'c', 'C', 'c', 'D', 'd', 'D', 'd', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'E', 'e', 'G', 'g', 'G', 'g', 'G', 'g', 'G', 'g', 'H', 'h', 'H', 'h', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'I', 'i', 'IJ', 'ij', 'J', 'j', 'K', 'k', 'L', 'l', 'L', 'l', 'L', 'l', 'L', 'l', 'l', 'l', 'N', 'n', 'N', 'n', 'N', 'n', 'n', 'O', 'o', 'O', 'o', 'O', 'o', 'OE', 'oe', 'R', 'r', 'R', 'r', 'R', 'r', 'S', 's', 'S', 's', 'S', 's', 'S', 's', 'T', 't', 'T', 't', 'T', 't', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'W', 'w', 'Y', 'y', 'Y', 'Z', 'z', 'Z', 'z', 'Z', 'z', 's', 'f', 'O', 'o', 'U', 'u', 'A', 'a', 'I', 'i', 'O', 'o', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'U', 'u', 'A', 'a', 'AE', 'ae', 'O', 'o', 'Α', 'α', 'Ε', 'ε', 'Ο', 'ο', 'Ω', 'ω', 'Ι', 'ι', 'ι', 'ι', 'Υ', 'υ', 'υ', 'υ', 'Η', 'η');
        
    $value = str_replace($accents, $noAccents, $value);
    // Remove everything except 0-9, a-z, A-Z and hyphens
    $value = preg_replace('/[^A-Za-z0-9-]+/', '', $value);
    
    // Make lowercase - no need for this to be multibyte since there are only 0-9, a-z, A-Z and hyphens left in the string 
    $value = strtolower($value);
    
    // Only allow single hyphens
    do {
    
        $value = str_replace('--', '-', $value);
    
    }
    //while (mb_substr_count($value, '--') > 0);
      while (substr_count($value, '--') > 0);
    
    return $value;
}

function notfound($chksql){
	if($chksql== 0){
		//header("HTTP/1.0 404 Not Found"); echo 'The link you followed may be broken, or the page may have been removed. <a href="//'.$_SERVER['HTTP_HOST'].'">click here to go back</a>';
		//header("HTTP/1.1 401 Unauthorized");
		header( "HTTP/1.1 410 Gone" );
		echo 'The link you followed may be broken, or the page may have been removed. <a href="//'.$_SERVER['HTTP_HOST'].'">click here to go back</a>';
		exit();
	}
}

function strposa($haystack, $needles=array()) {
        $chr = array();
        foreach($needles as $needle) {
                $res = stripos($haystack, $needle);
                if ($res !== false) $chr[$needle] = $res;
        }
        if(empty($chr)) return false;
        return min($chr);
}

function RemoveEmptySubFolders($path)
{
  $empty=true;
  foreach (glob($path.DIRECTORY_SEPARATOR."*") as $file)
  {
     $empty &= is_dir($file) && RemoveEmptySubFolders($file);
  }
  return $empty && rmdir($path);
}

function cmtform($tag){
	echo '<div class="err_cmt alert alert-danger" style="display: none"> 
			<strong>Error!</strong> <span class="err_msg"></span>
		  </div>
		  <div class="success_cmt alert alert-success" style="display: none">
			<strong>Success!</strong> <span>Posted</span>
		  </div>
		<form action="#" class="frmUpload" enctype="multipart/form-data">  
			<div class="panel comment-box">
				<div class="panel-body">
					<div name="comment" id="comment" class="comment plaintext" contenteditable="true" spellcheck="true" role="textbox" aria-multiline="true" placeholder="Share your idea $symbol/@username" dir="ltr">'.$tag.'</div>
					<div id="list_sym" style="width: 100%"></div>
				</div>
				<div class="panel-footer clearfix">
					<ul class="nav nav-pills pull-left">
						<li role="presentation"><input id="stock_image" name="stock_image[]" type="file"  accept="image/jpeg,image/x-png" multiple  /><a href="#"><i class="fa fa-camera"></i></a></li>
						<div class="imgprv"></div>
					</ul>
					<button id="post_cmt" class="btn btn-primary pull-right">Post</button>
					<div class="pull-right" style="padding: 9px;"><span class="rchars">140</span></div>
				</div>
			</div>
		</form>';
}
if(isset($_SERVER['HTTP_USER_AGENT']))
{
	$agent=$_SERVER['HTTP_USER_AGENT'];
} else { $agent='';}
$agent =strtolower($agent);
$fliter  = array('bot', 'spider', 'slurp', 'facebook', 'crawler' ,'admantx');
$browser=array('firefox','safari','chrome','python','ucweb','whatsapp','dalvik','facebookexternalhit','webwrapper');
$fliter2  = array('trident/5.0', 'trident/4.0');

//compressor
 define('X',"\x1A");$SS='"(?:[^"\\\]++|\\\.)*+"|\'(?:[^\'\\\\]++|\\\.)*+\'';$CC='\/\*[\s\S]*?\*\/';$CH='<\!--[\s\S]*?-->';$TB='<%1$s(?:>|\s[^<>]*?>)[\s\S]*?<\/%1$s>';function __minify_x($input){return str_replace(array("\n","\t",' '),array(X.'\n',X.'\t',X.'\s'),$input);}function __minify_v($input){return str_replace(array(X.'\n',X.'\t',X.'\s'),array("\n","\t",' '),$input);}function _minify_html($input){return preg_replace_callback('#<\s*([^\/\s]+)\s*(?:>|(\s[^<>]+?)\s*>)#',function($m){if(isset($m[2])){if(stripos($m[2],' style=')!==false){$m[2]=preg_replace_callback('#( style=)([\'"]?)(.*?)\2#i',function($m){return $m[1].$m[2].minify_css($m[3]).$m[2];},$m[2]);}return '<'.$m[1].preg_replace(array('#\s(checked|selected|async|autofocus|autoplay|controls|defer|disabled|hidden|ismap|loop|multiple|open|readonly|required|scoped)(?:=([\'"]?)(?:true|\1)?\2)#i','#\s*([^\s=]+?)(=(?:\S+|([\'"]?).*?\3)|$)#','#\s+\/$#'),array(' $1',' $1$2','/'),str_replace("\n",' ',$m[2])).'>';}return '<'.$m[1].'>';},$input);}function minify_html($input){if(!$input=trim($input))return $input;global $CH,$TB;$input=preg_replace('#(<(?:img|input)(?:\s[^<>]*?)?\s*\/?>)\s+#i','$1'.X.'\s',$input);$input=preg_split('#('.$CH.'|'.sprintf($TB,'pre').'|'.sprintf($TB,'code').'|'.sprintf($TB,'script').'|'.sprintf($TB,'style').'|'.sprintf($TB,'textarea').'|<[^<>]+?>)#i',$input,-1,PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);$output="";foreach($input as $v){if($v!==' '&&trim($v)==="")continue;if($v[0]==='<'&&substr($v,-1)==='>'){if($v[1]==='!'&&substr($v,0,4)==='<!--'){if(substr($v,-12)!=='<![endif]-->')continue;$output.=$v;}else {$output.=__minify_x(_minify_html($v));}}else {$v=str_replace(array('&#10;','&#xA;','&#xa;'),X.'\n',$v);$v=str_replace(array('&#32;','&#x20;'),X.'\s',$v);$output.=preg_replace('#\s+#',' ',$v);}}$output=preg_replace(array('#>([\n\r\t]\s*|\s{2,})<#','#\s+(<\/[^\s]+?>)#'),array('><','$1'),$output);$output=__minify_v($output);return preg_replace('#<(code|pre|script|style)(>|\s[^<>]*?>)\s*([\s\S]*?)\s*<\/\1>#i','<$1$2$3</$1>',$output);}function _minify_css($input){if(stripos($input,'calc(')!==false){$input=preg_replace_callback('#\b(calc\()\s*(.*?)\s*\)#i',function($m){return $m[1].preg_replace('#\s+#',X.'\s',$m[2]).')';},$input);}return preg_replace(array('#(?<![,\{\}])\s+(\[|:\w)#','#\]\s+#','#\)\s+\b#','#\#([\da-f])\1([\da-f])\2([\da-f])\3\b#i','#\s*([~!@*\(\)+=\{\}\[\]:;,>\/])\s*#','#\b(?:0\.)?0([a-z]+\b|%)#i','#\b0+\.(\d+)#','#:(0\s+){0,3}0(?=[!,;\)\}]|$)#','#\b(background(?:-position)?):(0|none)\b#i','#\b(border(?:-radius)?|outline):none\b#i','#(^|[\{\}])(?:[^\s\{\}]+)\{\}#','#;+([;\}])#','#\s+#'),array(X.'\s$1',']'.X.'\s',')'.X.'\s','#$1$2$3','$1','0','.$1',':0','$1:0 0','$1:0','$1','$1',' '),$input);}function minify_css($input){if(!$input=trim($input))return $input;global $SS,$CC;$input=preg_replace('#('.$CC.')\s+('.$CC.')#','$1'.X.'\s$2',$input);$input=preg_split('#('.$SS.'|'.$CC.')#',$input,-1,PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);$output="";foreach($input as $v){if(trim($v)==="")continue;if(($v[0]==='"'&&substr($v,-1)==='"')||($v[0]==="'"&&substr($v,-1)==="'")||(substr($v,0,2)==='/*'&&substr($v,-2)==='*/')){if($v[0]==='/'&&substr($v,0,3)!=='/*!')continue;$output.=$v;}else {$output.=_minify_css($v);}}$output=preg_replace(array('#('.$CC.')|(?<!\bcontent\:)([\'"])([a-z_][-\w]*?)\2#i','#('.$CC.')|\b(url\()([\'"])([^\s]+?)\3(\))#i'),array('$1$3','$1$2$4$5'),$output);return __minify_v($output);}function _minify_js($input){return preg_replace(array('#\s*\/\/.*$#m','#\s*([!%&*\(\)\-=+\[\]\{\}|;:,.<>?\/])\s*#','#[;,]([\]\}])#','#\btrue\b#','#\bfalse\b#','#\breturn\s+#'),array("",'$1','$1','!0','!1','return '),$input);}function minify_js($input){if(!$input=trim($input))return $input;global $SS,$CC;$input=preg_split('#('.$SS.'|'.$CC.'|\/[^\n]+?\/(?=[.,;]|[gimuy]|$))#',$input,-1,PREG_SPLIT_NO_EMPTY|PREG_SPLIT_DELIM_CAPTURE);$output="";foreach($input as $v){if(trim($v)==="")continue;if(($v[0]==='"'&&substr($v,-1)==='"')||($v[0]==="'"&&substr($v,-1)==="'")||($v[0]==='/'&&substr($v,-1)==='/')){if(substr($v,0,2)==='//'||(substr($v,0,2)==='/*'&&substr($v,0,3)!=='/*!'&&substr($v,0,8)!=='/*@cc_on'))continue;$output.=$v;}else {$output.=_minify_js($v);}}return preg_replace(array('#('.$CC.')|([\{,])([\'])(\d+|[a-z_]\w*)\3(?=:)#i','#([\w\)\]])\[([\'"])([a-z_]\w*)\2\]#i'),array('$1$2$4','$1.$3'),$output);}ob_start('minify_html');
?>