<?php
    function pbb($x, $y, $array, $height, $width) {
        //var_dump($array[$x][$y]["blue"]);exit;
        $sum = 0;
        $moy = 0;

        
        if($x == 0 && $y == 0) {
            $sum = $array[$x][$y+1]["blue"];
            $sum += $array[$x+1][$y+1]["blue"];
            $sum += $array[$x+1][$y]["blue"];
            $moy = $sum/3;
        } else if($x == 0 && $y == ($height-1)) {
            $sum = $array[$x][$y-1]["blue"];
            $sum += $array[$x+1][$y-1]["blue"];
            $sum += $array[$x+1][$y]["blue"];
            $moy = $sum/3;
        } else if($x == ($width-1) && $y == 0) {
            $sum = $array[$x-1][$y]["blue"];
            $sum += $array[$x-1][$y+1]["blue"];
            $sum += $array[$x][$y+1]["blue"];
            $moy = $sum/3;
        } else if($x == ($width-1) && $y == ($height-1)) {
            $sum = $array[$x-1][$y]["blue"];
            $sum += $array[$x-1][$y-1]["blue"];
            $sum += $array[$x][$y-1]["blue"];
            $moy = $sum/3;
        } else if($x == 0 && $y > 0 && $y < ($height-1)) {
            $sum = $array[$x][$y-1]["blue"];
            $sum += $array[$x+1][$y-1]["blue"];
            $sum += $array[$x+1][$y]["blue"];
            $sum += $array[$x+1][$y+1]["blue"];
            $sum += $array[$x][$y+1]["blue"];
            $moy = $sum/5;
        } else if($x > 0 && $x < ($width-1) && $y == 0) {
            $sum = $array[$x-1][$y]["blue"];
            $sum += $array[$x-1][$y+1]["blue"];
            $sum += $array[$x][$y+1]["blue"];
            $sum += $array[$x+1][$y]["blue"];
            $sum += $array[$x+1][$y+1]["blue"];
            $moy = $sum/5;
        } else if($x > 0 && $x < ($width-1) && $y == ($height-1)) {
            $sum = $array[$x-1][$y]["blue"];
            $sum += $array[$x-1][$y-1]["blue"];
            $sum += $array[$x][$y-1]["blue"];
            $sum += $array[$x+1][$y-1]["blue"];
            $sum += $array[$x+1][$y]["blue"];
            $moy = $sum/5;
        } else if($x == ($width-1) && $y > 0 && $y < ($height-1)) {
            $sum = $array[$x][$y-1]["blue"];
            $sum += $array[$x-1][$y-1]["blue"];
            $sum += $array[$x-1][$y]["blue"];
            $sum += $array[$x-1][$y+1]["blue"];
            $sum += $array[$x][$y+1]["blue"];
            $moy = $sum/5;
        } else  if($x > 0 && $x < ($width-95) && $y > 0 && $y < ($height-64)) {
            $sum = $array[$x-1][$y-1]["blue"];
            $sum += $array[$x-1][$y]["blue"];
            $sum += $array[$x-1][$y+1]["blue"];
            $sum += $array[$x][$y+1]["blue"];
            $sum += $array[$x+1][$y+1]["blue"];
            $sum += $array[$x+1][$y]["blue"];
            $sum += $array[$x+1][$y-1]["blue"];
            $sum += $array[$x][$y-1]["blue"];
            $moy = $sum/8;
        }
    
        //$moy=255;
        $array[$x][$y]["blue"] = $moy;
        //$array[$x][$y]["blue"] = $moy;
        //$array[$x][$y]["blue"] = $moy;
        
    }