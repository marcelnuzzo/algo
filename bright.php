<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

function bright($coupure)
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
                $bytes=imagecolorat($img,$x,$y);         
                $colors=imagecolorsforindex($img,$bytes);
                $array[$x][$y] = $colors;
            }
            unset($tabColors); 
        }
    } 
    $newimg=imagecreatetruecolor($width,$height);
    for($x=0;$x<$width;++$x){
        for($y=0;$y<$height;++$y){
            $r=$array[$x][$y]['red'];
            $g=$array[$x][$y]['green'];
            $b=$array[$x][$y]['blue'];
            //$a=$array[$x][$y]['alpha'];
            $a=0; //0: opaque, 127: transparent
            $colors=imagecolorallocatealpha($newimg,$r,$g,$b,$a);
            imagesetpixel($newimg,$x,$y,$colors);     
        }
    } 
    imagefilter($newimg, IMG_FILTER_BRIGHTNESS, $coupure);
    $x = 400;
    $y = 400;
    $size = getimagesize($filename);
    $img_mini = imagecreatetruecolor ($x, $y);
    imagecopyresampled ($img_mini,$newimg,0,0,0,0,$x,$y,$size[0],$size[1]);
    imagepng($img_mini, "allImages/".$image);
    $_SESSION['recupimg'] = $image;
    $_SESSION['bright'] = "bright";
}
?>