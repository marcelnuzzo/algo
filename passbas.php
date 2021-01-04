<?php

include "funcr.php";
include "funcg.php";
include "funcb.php";
include "fonction.php";

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

function passbas($coupure1)
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
                if($tabColors[1] > $coupure1) {
                    $tabColors[1] = $coupure1;
                } 
                $array[$x][$y][$k] = $tabColors[1];
                
                /*
                if($k == 0) {
                    $array[$x][$y][$k] = $tabColors[1];
                } elseif ($k == 1){
                    $array[$x][$y][$k] = $tabColors[1];
                } elseif($k == 2) {
                    $array[$x][$y][$k] = $tabColors[1];
                }else {
                    $array[$x][$y][$k] = $tabColors[$k];
                } 
                */
            }
            unset($tabColors); 
        }     
    } 
    $newimg=imagecreatetruecolor($width,$height);
    for($x=0;$x<$width;++$x){
        for($y=0;$y<$height;++$y){
            $r = $array[$x][$y][0];
            $g = $array[$x][$y][1];
            $b = $array[$x][$y][2];
            if($g == $coupure1) {
                $g=pb($x, $y, $array, $height, $width); 
            } else {
                $g = $array[$x][$y][1];
            }
            $r=$g;
            $b=$g;
            /*
            if($g > $coupure1) {
                $g=pbg($x, $y, $array, $height, $width); 
            }
            if($b > $coupure1) {
                $b=pbb($x, $y, $array, $height, $width); 
            }
            */
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
    $_SESSION['passbas'] = "passbas";
}