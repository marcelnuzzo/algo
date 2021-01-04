<?php

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

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
    ?>
    <table border=1 width=300 height=300>
    <?php
    for($x=0;$x<$width;++$x){   
        echo "<tr>";
        for($y=0;$y<$height;++$y){
            $bytes=imagecolorat($img,$x,$y);
            $colors=imagecolorsforindex($img,$bytes);
            foreach($colors as $value) {
                $tabColors[] = $value;
            }
            
            for($k=0; $k<4; $k++) {            
                if($k == 0) {
                    $tabColors[$k] = $coupure1;
                    $array[$x][$y][$k] = $tabColors[$k];
                    echo "<td>".$array[$x][$y][$k]."</td>";
                } else if ($k == 1) {
                    $tabColors[$k] = $coupure2;
                    $array[$x][$y][$k] = $tabColors[$k];
                    echo "<td>".$array[$x][$y][$k]."</td>";
                } else if ($k == 2) {
                    $tabColors[$k] = $coupure3;
                    $array[$x][$y][$k] = $tabColors[$k];
                    echo "<td>".$array[$x][$y][$k]."</td>";
                }
               
            }  
            unset($tabColors); 
        }
        echo "</tr>";
            
    }
    
    ?>
    </table>
    <?php
    $newimg=imagecreatetruecolor($width,$height);
    
    for($x=0;$x<$width;++$x){
        
        for($y=0;$y<$height;++$y){
            /*
            $r=$array[$x][$y]['red'];
            $g=$array[$x][$y]['green'];
            $b=$array[$x][$y]['blue'];
            */
            $r=$array[$x][$y][0];
            $g=$array[$x][$y][1];
            $b=$array[$x][$y][2];
            $a=0; //0: opaque, 127: transparent
            //$concat = $r.$g.$b;//.$a;
            //$a=$array[$x][$y]['alpha'];
            //echo "<td>".$concat."</td>";
            
            //imagecolorallocate($newimg, 255, 255, 255);
            //imagefill($newimg,0,0,$background_color);
            $colors=imagecolorallocatealpha($newimg,$r,$g,$b,$a);
            imagesetpixel($newimg,$x,$y,$colors);                
        }
        
    }
    //header('Content-Type: text/html; charset=utf-8');
    //imagepng($newimg);
   
    $ext = $_SESSION['ext'];
    //var_dump($ext);exit;
    ob_start();
    $image = "image".$ext;
    $image($newimg);
    $data = ob_get_clean(); 
    echo '<img src="data:image/$ext;base64,'.base64_encode($data).'" />';

    $_SESSION['recupimg'] = $image;

