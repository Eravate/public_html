httpRequest = new XMLHttpRequest();
var arrayDatosPersonal = new Array();
function rellenarDatos(num) {
    document.getElementById("datos").innerHTML = "DATOS DE LA PERSONA SELECCIONADA<br>Nombre: "+arrayDatosPersonal[num].name+"<br>Email: "+arrayDatosPersonal[num].email+"<br>Teléfono: "+arrayDatosPersonal[num].phone+"<br>Compañia: "+arrayDatosPersonal[num].company.name+"<br>Web: "+arrayDatosPersonal[num].website+"<br>Ciudad: "+arrayDatosPersonal[num].address.city;
}
function rellenarLi(arrayObjetos) {
    console.log(arrayObjectos.length);
    arrayUsuarios = [];
    for (i=0;i<arrayObjetos.length;i++) {
        arrayUsuarios.push(arrayObjetos[i].name);
        document.getElementById("usuarios").innerHTML += "<li onmouseover=\"rellenarDatos("+i+")\">"+arrayObjetos[i].name+"</li>";
        arrayDatosPersonal.push(arrayObjetos[i]);
    }
}
function procesarRequest() {
    if (httpRequest.readyState==4) {
        if (httpRequest.status==200) {
            textoJson = httpRequest.responseText;
            arrayObjectos = JSON.parse(textoJson);
            rellenarLi(arrayObjectos);
        }
    }
}
function obtenerJSON() {
    document.getElementById("usuarios").innerHTML = "";
    httpRequest.open("POST","users.json",true);
    httpRequest.onreadystatechange=procesarRequest;
    httpRequest.send(null);
}