var bright = $_GET('bright')
var coupbright = $_GET('coupbright')

if(bright || coupbright) {
    imgResult = localStorage.getItem('recupimg')
    var url = "allImages/"
    var img = document.createElement("IMG");
    img.src = url+imgResult
    document.getElementById('affimg').appendChild(img);
}

document.getElementById("bright").addEventListener("click", function() {
    let bright = "bright"
    window.location.href = "affiche.php?bright=" + bright; 
});