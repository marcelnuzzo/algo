<?php
    function pbr($x, $y, $array, $height, $width) {
        //var_dump($array[$x][$y]["red"]);exit;
        $sum = 0;
        $moy = 0;

        
        if($x == 0 && $y == 0) {
            $sum = $array[$x][$y+1]["red"];
            $sum += $array[$x+1][$y+1]["red"];
            $sum += $array[$x+1][$y]["red"];
            $moy = $sum/3;
        } else if($x == 0 && $y == ($height-1)) {
            $sum = $array[$x][$y-1]["red"];
            $sum += $array[$x+1][$y-1]["red"];
            $sum += $array[$x+1][$y]["red"];
            $moy = $sum/3;
        } else if($x == ($width-1) && $y == 0) {
            $sum = $array[$x-1][$y]["red"];
            $sum += $array[$x-1][$y+1]["red"];
            $sum += $array[$x][$y+1]["red"];
            $moy = $sum/3;
        } else if($x == ($width-1) && $y == ($height-1)) {
            $sum = $array[$x-1][$y]["red"];
            $sum += $array[$x-1][$y-1]["red"];
            $sum += $array[$x][$y-1]["red"];
            $moy = $sum/3;
        } else if($x == 0 && $y > 0 && $y < ($height-1)) {
            $sum = $array[$x][$y-1]["red"];
            $sum += $array[$x+1][$y-1]["red"];
            $sum += $array[$x+1][$y]["red"];
            $sum += $array[$x+1][$y+1]["red"];
            $sum += $array[$x][$y+1]["red"];
            $moy = $sum/5;
        } else if($x > 0 && $x < ($width-1) && $y == 0) {
            $sum = $array[$x-1][$y]["red"];
            $sum += $array[$x-1][$y+1]["red"];
            $sum += $array[$x][$y+1]["red"];
            $sum += $array[$x+1][$y]["red"];
            $sum += $array[$x+1][$y+1]["red"];
            $moy = $sum/5;
        } else if($x > 0 && $x < ($width-1) && $y == ($height-1)) {
            $sum = $array[$x-1][$y]["red"];
            $sum += $array[$x-1][$y-1]["red"];
            $sum += $array[$x][$y-1]["red"];
            $sum += $array[$x+1][$y-1]["red"];
            $sum += $array[$x+1][$y]["red"];
            $moy = $sum/5;
        } else if($x == ($width-1) && $y > 0 && $y < ($height-1)) {
            $sum = $array[$x][$y-1]["red"];
            $sum += $array[$x-1][$y-1]["red"];
            $sum += $array[$x-1][$y]["red"];
            $sum += $array[$x-1][$y+1]["red"];
            $sum += $array[$x][$y+1]["red"];
            $moy = $sum/5;
        } else  if($x > 0 && $x < ($width-95) && $y > 0 && $y < ($height-64)) {
            $sum = $array[$x-1][$y-1]["red"];
            $sum += $array[$x-1][$y]["red"];
            $sum += $array[$x-1][$y+1]["red"];
            $sum += $array[$x][$y+1]["red"];
            $sum += $array[$x+1][$y+1]["red"];
            $sum += $array[$x+1][$y]["red"];
            $sum += $array[$x+1][$y-1]["red"];
            $sum += $array[$x][$y-1]["red"];
            $moy = $sum/8;
        }
    
        //$moy=255;
        $array[$x][$y]["red"] = $moy;
        //$array[$x][$y]["green"] = $moy;
        //$array[$x][$y]["blue"] = $moy;
        
    }