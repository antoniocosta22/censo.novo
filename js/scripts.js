var tempo = 4000,
    currentImageIndex = 0,
    img = document.querySelectorAll("#slider img")
    max = img.length;


function proxima() {
    img[currentImageIndex].classList.remove("selected") 
    currentImageIndex++
    if (currentImageIndex >= max)
    currentImageIndex = 0
    img[currentImageIndex].classList.add("selected")
}


function start() {
    setInterval(() => { proxima() }, tempo);
}

window.addEventListener("load", start)