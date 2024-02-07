// JavaScript
function buscar() {
    var valor = document.getElementById('busqueda').value;

    // Realizar una solicitud AJAX al servidor
    var xhttp = new XMLHttpRequest();
    xhttp.onreadystatechange = function() {
        if (this.readyState == 4 && this.status == 200) {
            // Manejar la respuesta del servidor
            document.getElementById('suggestions').innerHTML = this.responseText;
        }
    };
    xhttp.open("GET", "buscar.php?q=" + valor, true);
    xhttp.send();
}