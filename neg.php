<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 
unset($_SESSION['disp']);
unset($_SESSION['bright']);
unset($_SESSION['pixel']);
unset($_SESSION['passbas']);

function negat()
{
    $base = "";
    $image = $_SESSION['image'];
    $filename='images/'.$image;
    $cas = $_SESSION['cas'];
    $base = @
    $base .= $cas;
    $img = $base($filename);
    $width=imagesx($img);
    $height=imagesy($img);
    $array=array();
    for($x=0;$x<$width;++$x){
        for($y=0;$y<$height;++$y){
            $bytes=imagecolorat($img,$x,$y);
            $colors=imagecolorsforindex($img,$bytes);
            foreach($colors as $value) {
                $tabColors[] = $value;
            }
            for($k=0; $k<4; $k++) {        
                if($k == 0) {
                    $array[$x][$y][$k] = 255 - $tabColors[$k];
                } elseif ($k == 1){
                    $array[$x][$y][$k] = 255 - $tabColors[$k];
                } elseif($k == 2) {
                    $array[$x][$y][$k] = 255 - $tabColors[$k];
                }else {
                    $array[$x][$y][$k] = $tabColors[$k];
                } 
            }
            unset($tabColors); 
        }
    } 
    $newimg=imagecreatetruecolor($width,$height);
    for($x=0;$x<$width;++$x){
        for($y=0;$y<$height;++$y){
            $r=$array[$x][$y][0];
            $g=$array[$x][$y][1];
            $b=$array[$x][$y][2];
            //$a=$array[$x][$y]['alpha'];
            $a=0; //0: opaque, 127: transparent
            $colors=imagecolorallocatealpha($newimg,$r,$g,$b,$a);
            imagesetpixel($newimg,$x,$y,$colors);                
        }
    } 
    $x = 400;
    $y = 400;
    $size = getimagesize($filename);
    $img_mini = imagecreatetruecolor ($x, $y);
    imagecopyresampled ($img_mini,$newimg,0,0,0,0,$x,$y,$size[0],$size[1]);
    imagepng($img_mini, "allImages/".$image); 

    $_SESSION['recupimg'] = $image;

}