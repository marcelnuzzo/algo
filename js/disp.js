var disp = $_GET('disp')
var coupdisp = $_GET('coupdisp')

if(disp || coupdisp) {
    imgResult = localStorage.getItem('recupimg')
    var url = "allImages/"
    var img = document.createElement("IMG");
    img.src = url+imgResult
    document.getElementById('affimg').appendChild(img);
}

document.getElementById("disp").addEventListener("click", function() {
    let disp = "disp"
    window.location.href = "affiche.php?disp=" + disp; 
});