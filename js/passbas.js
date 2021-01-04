var passbas = $_GET('passbas')
var coupure1 = $_GET('coupure1')

if(passbas || coupure1) {
    imgResult = localStorage.getItem('recupimg')
    var url = "allImages/"
    var img = document.createElement("IMG");
    img.src = url+imgResult
    document.getElementById('affimg').appendChild(img);
}

document.getElementById("passbas").addEventListener("click", function() {
    let passbas = "passbas"
    window.location.href = "affiche.php?passbas=" + passbas; 
});