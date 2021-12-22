var intervalo = 3000;
function slide1() {
    document.getElementById('imgc').src = "../img/fundo1.jpg";
    setTimeout("slide2()", intervalo);
}
function slide2() {
    document.getElementById("imgc").src="img/fundo.jpeg";
    setTimeout("slide3()", intervalo );
}
function slide3() {
    document.getElementById("imgc").src="img/fundo1.jpg";
    setTimeout("slide1()", intervalo );
}