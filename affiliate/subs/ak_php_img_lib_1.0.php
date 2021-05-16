<?php
function imagecreatefrombmp($p_sFile)
{
    $file    =    fopen($p_sFile,"rb");
    $read    =    fread($file,10);
    while(!feof($file)&&($read<>""))
        $read    .=    fread($file,1024);
    $temp    =    unpack("H*",$read);
    $hex    =    $temp[1];
    $header    =    substr($hex,0,108);
    if (substr($header,0,4)=="424d")
    {
        $header_parts    =    str_split($header,2);
        $width            =    hexdec($header_parts[19].$header_parts[18]);
        $height            =    hexdec($header_parts[23].$header_parts[22]);
        unset($header_parts);
    }
    $x                =    0;
    $y                =    1;
    $image            =    imagecreatetruecolor($width,$height);
    $body            =    substr($hex,108);
    $body_size        =    (strlen($body)/2);
    $header_size    =    ($width*$height);
    $usePadding        =    ($body_size>($header_size*3)+4);
    for ($i=0;$i<$body_size;$i+=3)
    {
        if ($x>=$width)
        {
            if ($usePadding)
                $i    +=    $width%4;
            $x    =    0;
            $y++;
            if ($y>$height)
                break;
        }
        $i_pos    =    $i*2;
        $r        =    hexdec($body[$i_pos+4].$body[$i_pos+5]);
        $g        =    hexdec($body[$i_pos+2].$body[$i_pos+3]);
        $b        =    hexdec($body[$i_pos].$body[$i_pos+1]);
        $color    =    imagecolorallocate($image,$r,$g,$b);
        imagesetpixel($image,$x,$height-$y,$color);
        $x++;
    }
    unset($body);
    return $image;
}
function ak_img_resize($target, $newcopy, $w, $h, $ext) {
    list($w_orig, $h_orig) = getimagesize($target);   
	
	    $ratio = $w_orig / $h_orig;	
		$h = $w / $ratio;
		
    $img = "";
    $ext = strtolower($ext);
    if ($ext == "gif"){ 
      $img = imagecreatefromgif($target);
    } else if($ext =="png"){ 
      $img = imagecreatefrompng($target);
    } else if($ext =="bmp"){ 
      $img = imagecreatefrombmp($target);
    } else { 
      $img = imagecreatefromjpeg($target);
    }
    $tci = imagecreatetruecolor($w, $h);
	
    // imagecopyresampled(dst_img, src_img, dst_x, dst_y, src_x, src_y, dst_w, dst_h, src_w, src_h)
    imagecopyresampled($tci, $img, 0, 0, 0, 0, $w, $h, $w_orig, $h_orig);
    imagejpeg($tci, $newcopy, 100);
	imagedestroy($img);

}
?> 