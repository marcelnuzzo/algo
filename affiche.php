<?php
include "neg.php";
include "scale.php";
include "disp.php";
include "bright.php";
include "pixel.php";
include "passbas.php";

if(!isset($_SESSION)) 
{ 
    session_start(); 
} 

if (isset($_FILES['img']))
{
    if($_FILES['img']['size'] < 120000) {
    
    session_destroy();
    session_start();
    
    $image = $_FILES['img']['name'];
    
    $_SESSION['image'] = $image;
    $filename='images/'.$image;
    $info = new SplFileInfo($filename);
    
    $ext = $info->getExtension();
    if($ext == "jpg") {
        $aff = "image"."jpeg";
        $ext = "jpeg";
    } else {
        $aff = "image".$ext;
    }
    $_SESSION['ext'] = $ext;
    $forRecord = "image".$ext;
    
    switch ($ext) {
        case 'png':
            $cas = "imagecreatefrompng";
            $display = "imagepng";
            break;
        case 'gif':
            $cas = "imagecreatefromgif";
            $display = "imagegif";
            break;
        case 'jpeg':
            $cas = "imagecreatefromjpeg";
            $display = "imagejpeg";
            break;
        case 'jpg':
            $cas = "imagecreatefromjpeg";
            $display = "imagejpeg";
            break;
        default:
            throw new InvalidArgumentException('File "'.$filename.'" is not valid jpg, png or gif image.');
        break;
    }
    
    $_SESSION['cas'] = $cas;
    $_SESSION['display'] = $display;
    $tmp_name = $_FILES["img"]["tmp_name"];
    copy($tmp_name, $filename);
    $base = @
    $base .= $cas; 
    $img = $base($filename);
    
    if(!$img){
        //Create a blank image
        $width=150;
        $height=150;
        $newimg=imagecreatetruecolor($width,$height);
        $bgcolor=imagecolorallocate($newimg,255,255,255);
        $color=imagecolorallocate($newimg,0,0,0);
        imagefilledrectangle($newimg,0,0,$width-1,$height-1,$bgcolor);
        //Output an error message at half the height of the image
        imagestring($newimg,1,10,round($height/2),'Error loading '.$filename,$color);
    }else{
        $width=imagesx($img);
        $height=imagesy($img);         
        $array=array();
        for($x=0;$x<$width;++$x){
            for($y=0;$y<$height;++$y){         
                $bytes=imagecolorat($img,$x,$y);  
                $colors=imagecolorsforindex($img,$bytes);
                $array[$x][$y] = $colors;
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
        $aff($newimg, "allImages/".$image);   
        $_SESSION['newimg'] = $newimg;
    }
    } else {
        $_SESSION["capacite"] = "big";
        header("location: index.php");
    }
} 

if (isset($_GET["negatif"])) 
{
    negat();  
}

if (isset($_GET["scale"])) 
{
    sca();
}

if (isset($_GET["passbas"])) 
{
    $coupure1 = 127;
    passbas($coupure1);
}
if (isset($_GET["coupure1"])) 
{
    $coupure1 = $_GET['coupure1'];
    //$_SESSION["cppb"] = $coupure1;
    passbas($coupure1);
}

if (isset($_GET["disp"])) 
{
    $coupure = 5;
    disp($coupure);
}
if (isset($_GET["coupdisp"])) 
{
    $coupure = $_GET['coupdisp'];
    disp($coupure);
}

if (isset($_GET["bright"])) 
{
    $coupure = 100;
    bright($coupure);
}
if (isset($_GET["coupbright"])) 
{
    $coupure = $_GET['coupbright'];
    bright($coupure);
}

if (isset($_GET["pixel"])) 
{
    $coupure = 3;
    pixel($coupure);
}
if (isset($_GET["couppixel"])) 
{
    $coupure = $_GET['couppixel'];
    pixel($coupure);
}

if(isset($_SESSION['recupimg']))
{
    $recupimg =  $_SESSION['recupimg'];
    ?>
        <script>
        var imgResult = <?php echo json_encode($recupimg);?>;
        localStorage.setItem('recupimg', imgResult);
        </script>  
    <?php
}
/* value="<?php if(!empty($_SESSION['cppb'])) echo $_SESSION['cppb'] ?>"*/
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <!-- CSS -->
     <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/css/bootstrap.min.css" integrity="sha384-TX8t27EcRE3e/ihU7zmQxVncDAy5uIKz4rEkgIXeMed4M0jlfIDPvg6uqKI2xXr2" crossorigin="anonymous">
    <!-- jQuery and JS bundle w/ Popper.js -->
    <scrip src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <scrip src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ho+j7jyWK8fNQe+A12Hb8AhRq26LrZ/JpcUGGOn+Y7RsweNrtN/tE3MoK7ZeZDyx" crossorigin="anonymous"></scrip>
    <link rel="stylesheet" href="./css/main.css">
    <title>Document</title>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col">
                <a class="btn btn-info mt-2" href="/image">Retour au chargement d'images</a>
            </div>
        </div>
        <div class="row">
            <div class="col">
            <form>
                <div class="inline">
                    <input id="disp" type="button" value="dispersion"/>
                </div>
                <div class="inline">
                    <input id="neg" type="button" value="negatif" onclick="negatif()" />
                </div>
                <div class="inline">
                    <input type="button" value="grayscale" onclick="grayScale()"/>
                </div>
                <div class="inline">
                    <input id="bright" type="button" value="bright"/>
                </div>
                <div class="inline">
                    <input id="pixel" type="button" value="pixel"/>
                </div>
                <div class="inline">
                    <input id="passbas" type="button" value="coupure passe bas" />
                </div>
                <br>        
            </form>
            </div>
            <span class="vertical-line"></span>
            <div class="col">
                <h2>image d'origine</h2>
            </div>
        </div>
        <div class="row">
            <div class="col">
                <div id="affimg" class="margebas"></div>         
            </div>
            <span class="vertical-line"></span>
            <div class="col">
                <img src="images/<?php echo $_SESSION['image'] ?>?text=Theme 1" width="400" height="400">              
            </div>
        </div>
        <div class="row">
            <div class="col">
            <form>
                <div class="form-froup">
                    <?php if(!empty($_SESSION['disp'])) : ?>
                    <label for="vol-control">Dispersion
                    <input id="vol-control" type="range" min="0" max="20" step="1" oninput="SetVolume(this.value)" onchange="SetVolume(this.value)"></input>
                    </label>
                    <div id="affValue"></div>  
                    <?php endif ?>   
                </div>
                <div class="form-froup">
                    <?php if(!empty($_SESSION['bright'])) : ?>
                    <label for="vol-control2">Brillance
                    <input id="vol-control2" type="range" min="0" max="200" step="1" oninput="SetVolume2(this.value)" onchange="SetVolume2(this.value)"></input>
                    </label>
                    <div id="affValue2"></div>
                    <?php endif ?>   
                </div>
                <div class="form-froup">
                    <?php if(!empty($_SESSION['pixel'])) : ?>
                    <label for="vol-control3">Pixel
                    <input id="vol-control3" type="range" min="1" max="9" step="1" oninput="SetVolume3(this.value)" onchange="SetVolume3(this.value)"></input>
                    </label>
                    <div id="affValue3"></div>
                    <?php endif ?>   
                </div>
                <div class="form-froup">
                    <?php if(!empty($_SESSION['passbas'])) : ?>
                    <label for="coupure1">Coupure par le rouge
                    <input id="coupure1" type="range" min="0" max="255" step="1"  oninput="SetVolume3(this.value)" onchange="SetVolume4(this.value)"></input>
                    
                    <div id="affValue4"></div>
                    </label>
                    <?php endif ?>   
                </div>
            </form>
            </div>
        </div>
        
    </div>
</body>
</html>
<script>
/*
let b = localStorage.getItem("cp")
let o = document.getElementById("affValue4")
o.innerHTML = b
let y = document.getElementById("coupure1")
y.innerHTML = b
*/
function negatif()
{
    negatif = "negatif";
    window.location.href = "affiche.php?negatif=" + negatif ;  
}

function grayScale()
{
    let scale = "scale"
    window.location.href = "affiche.php?scale=" + scale ; 
}

window.SetVolume = function(val)
{
    let coudisp = document.getElementById("vol-control").value;
    var disp = document.getElementById("affValue");
    disp.innerHTML = coudisp;
    document.getElementById("vol-control").innerHTML=coudisp;
    window.location.href = "affiche.php?coupdisp=" + coudisp; 
}

window.SetVolume2 = function(val)
{
    let coupbright = document.getElementById("vol-control2").value;
    var bright = document.getElementById("affValue2");
    bright.innerHTML = coupbright;
    document.getElementById("vol-control2").innerHTML=coupbright;
    window.location.href = "affiche.php?coupbright=" + coupbright; 
}

window.SetVolume3 = function(val)
{
    let couppixel = document.getElementById("vol-control3").value;
    var pixel = document.getElementById("affValue3");
    pixel.innerHTML = couppixel;
    document.getElementById("vol-control3").innerHTML=couppixel;
    window.location.href = "affiche.php?couppixel=" + couppixel; 
}

window.SetVolume4 = function(val)
{
    let cppb = document.getElementById("coupure1").value;
    //localStorage.setItem('cp', coupure1);
    //let cppb = localStorage.getItem('cppb')
    var passbas = document.getElementById("affValue4");
    passbas.innerHTML = cppb;
    document.getElementById("coupure1").innerHTML=cppb;
    window.location.href = "affiche.php?coupure1=" + cppb; 
}

</script>

<script src="./js/affiche.js"></script>
<script src="./js/neg.js"></script>
<script src="./js/scale.js"></script>
<script src="./js/disp.js"></script>
<script src="./js/bright.js"></script>
<script src="./js/pixel.js"></script>
<script src="./js/passbas.js"></script>