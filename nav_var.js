//nav_var.js
document.addEventListener("DOMContentLoaded", function() {
    // Cargar el contenido común
    cargarContenidoComun();
});

function cargarContenidoComun() {
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            console.log(this.responseText); // Verificar la respuesta del servidor
            document.getElementById("contenido-comun").innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "plantilla_comun.html", true);
    xhttp.send();
}