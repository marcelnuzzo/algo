<?php
    function pb($x, $y, $array, $height, $width) {

        $sum = 0;
        $moy = 0;
        // Cas de figure: les coins, les bords et le centre (les cases adjacentes)
        if($x == 0 && $y == 0) {
            $sum = $array[$x][$y+1][1];
            $sum += $array[$x+1][$y][1];
            $sum += $array[$x+1][$y+1][1];
            $moy = $sum/3;
        } 
         else if($x == 0 && $y == ($height-1)) {
            $sum = $array[$x][$y-1][1];
            $sum += $array[$x+1][$y-1][1];
            $sum += $array[$x+1][$y][1];
            $moy = $sum/3;
        } else if($x == ($width-1) && $y == 0) {
            $sum = $array[$x-1][$y][1];
            $sum += $array[$x-1][$y+1][1];
            $sum += $array[$x][$y+1][1];
            $moy = $sum/3;
        } else if($x == ($width-1) && $y == ($height-1)) {
            $sum = $array[$x-1][$y][1];
            $sum += $array[$x-1][$y-1][1];
            $sum += $array[$x][$y-1][1];
            $moy = $sum/3;
        } else if($x == 0 && $y > 0 && $y < ($height-1)) {
            $sum = $array[$x][$y-1][1];
            $sum += $array[$x+1][$y-1][1];
            $sum += $array[$x+1][$y][1];
            $sum += $array[$x+1][$y+1][1];
            $sum += $array[$x][$y+1][1];
            $moy = $sum/5;
        } else if($x > 0 && $x < ($width-1) && $y == 0) {
            $sum = $array[$x-1][$y][1];
            $sum += $array[$x-1][$y+1][1];
            $sum += $array[$x][$y+1][1];
            $sum += $array[$x+1][$y][1];
            $sum += $array[$x+1][$y+1][1];
            $moy = $sum/5;
        } else if($x > 0 && $x < ($width-1) && $y == ($height-1)) {
            $sum = $array[$x-1][$y][1];
            $sum += $array[$x-1][$y-1][1];
            $sum += $array[$x][$y-1][1];
            $sum += $array[$x+1][$y-1][1];
            $sum += $array[$x+1][$y][1];
            $moy = $sum/5;
        } else if($x == ($width-1) && $y > 0 && $y < ($height-1)) {
            $sum = $array[$x][$y-1][1];
            $sum += $array[$x-1][$y-1][1];
            $sum += $array[$x-1][$y][1];
            $sum += $array[$x-1][$y+1][1];
            $sum += $array[$x][$y+1][1];
            $moy = $sum/5;
        } else if($x > 0 && $x < ($width-95) && $y > 0 && $y < ($height-64)) {
            $sum = $array[$x-1][$y-1][1];
            $sum += $array[$x-1][$y][1];
            $sum += $array[$x-1][$y+1][1];
            $sum += $array[$x][$y+1][1];
            $sum += $array[$x+1][$y+1][1];
            $sum += $array[$x+1][$y][1];
            $sum += $array[$x+1][$y-1][1];
            $sum += $array[$x][$y-1][1];
            $moy = $sum/8;
        }
        $array[$x][$y][1] = $moy;
    }
   
?>