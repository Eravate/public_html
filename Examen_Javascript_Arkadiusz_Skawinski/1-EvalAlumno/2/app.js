httpRequest = new XMLHttpRequest();
function realizarAlert(resultado) {
    var esprimo;
    var espalindromo;
    if (resultado == "YES") {
        esprimo = " primo y";
    } else {
        esprimo = " no primo y";
    }
    var num = document.getElementById("numero").value;
    var numArray = num.split('');
    var esPalindro = true;
    for (var i=0;i<numArray.length;i++) {
        if (numArray[0] != numArray[i]) {
            esPalindro = false;
            break;
        }
    }
    if (esPalindro) {
        espalindromo = " palindromo";
    } else {
        espalindromo = " no palindromo";
    }
    alert(num+esprimo+espalindromo);
}
function procesarRequest() {
    if (httpRequest.readyState==4) {
        if (httpRequest.status==200) {
            resultadoJson = httpRequest.responseText;
            resultado = JSON.parse(resultadoJson);
            realizarAlert(resultado.esPrimo);
        }
    }
}
function comprobar() {
    num = document.getElementById("numero").value;
    httpRequest.open("POST","2-EsPrimo.php",true);
    httpRequest.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
    httpRequest.onreadystatechange=procesarRequest;
    httpRequest.send("numero="+num);
}