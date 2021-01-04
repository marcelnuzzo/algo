var scale = $_GET('scale')

if(scale) {
    imgResult = localStorage.getItem('recupimg')
    var url = "allImages/"
    var img = document.createElement("IMG");
    img.src = url+imgResult
    document.getElementById('affimg').appendChild(img);
}