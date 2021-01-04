var pixel = $_GET('pixel')
var couppixel = $_GET('couppixel')

if(pixel || couppixel) {
    imgResult = localStorage.getItem('recupimg')
    var url = "allImages/"
    var img = document.createElement("IMG");
    img.src = url+imgResult
    document.getElementById('affimg').appendChild(img);
}

document.getElementById("pixel").addEventListener("click", function() {
    let pixel = "pixel"
    window.location.href = "affiche.php?pixel=" + pixel; 
});