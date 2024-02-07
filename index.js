document.addEventListener("DOMContentLoaded", function () {
    var contenedor = document.getElementById("contenedor");
    var nav = document.querySelector(".container");
    var distanciaDesdeLaCima = contenedor.getBoundingClientRect().top;

    window.addEventListener("scroll", function () {
        var distanciaDesdeLaCima = contenedor.getBoundingClientRect().top;

        if (distanciaDesdeLaCima <= 0) {
            nav.classList.add("fixed");
            contenedor.style.paddingTop = nav.clientHeight + "px"; // Ajusta según el tamaño del contenedor fijo
        } else {
            nav.classList.remove("fixed");
            contenedor.style.paddingTop = "0";
        }
    });
});

document.addEventListener("DOMContentLoaded", function () {
    const input = document.getElementById("busqueda");
    const suggestions = document.getElementById("suggestions");
    const noEncontrado = document.getElementById("no-encontrado");

    input.addEventListener("input", function () {
        const searchTerm = input.value.toLowerCase();

        if (searchTerm.trim() === "") {
            mostrarNoEncontrado();
        } else {
            const matches = buscarCoincidencias(searchTerm);

            if (matches.length > 0) {
                mostrarSugerencias(matches);
                noEncontrado.style.display = "none";
            } else {
                suggestions.style.display = "none";
                noEncontrado.style.display = "block";
            }
        }
    });

    document.addEventListener("click", function (event) {
        if (input.contains(event.target) && input.value.trim() !== "") {
            const searchTerm = input.value.toLowerCase();
            const matches = buscarCoincidencias(searchTerm);

            if (matches.length > 0) {
                mostrarSugerencias(matches);
                noEncontrado.style.display = "none";
            } else {
                suggestions.style.display = "none";
                noEncontrado.style.display = "block";
            }
        } else {
            suggestions.style.display = "none";
            noEncontrado.style.display = "none";
        }
    });

    function buscarCoincidencias(term) {
        const palabrasEnPagina = obtenerPalabrasEnPagina();
        return palabrasEnPagina.filter(palabra => palabra.toLowerCase().includes(term));
    }

    function obtenerPalabrasEnPagina() {
        const textoPagina = document.body.innerText || document.body.textContent;
        const palabras = textoPagina.match(/\b\w+\b/g) || [];
        return [...new Set(palabras)];
    }

    function mostrarSugerencias(sugerencias) {
        const searchTerm = input.value.toLowerCase();
        const sugerenciasHTML = sugerencias.slice(0, 10).map(sugerencia =>
             `<a href="#" class="sugerencia">${resaltarLetra(sugerencia, searchTerm)}</a>`
            ).join("<br>");

        suggestions.innerHTML = sugerenciasHTML;
        suggestions.style.display = "block";

        const sugerenciaItems = document.querySelectorAll('.sugerencia');
        sugerenciaItems.forEach(item => {
            item.addEventListener('click', function (event) {
            event.preventDefault();
            input.value = item.innerText;
            suggestions.style.display = 'none';
            noEncontrado.style.display = 'none';
            scrollToPalabra(item.innerText);
        });

        // Cambia el color de las letras en las sugerencias
        item.style.color = '#e9e9e9'; // Puedes ajustar el color según tus preferencias
    });
}

function resaltarLetra(sugerencia, searchTerm) {
const index = sugerencia.toLowerCase().indexOf(searchTerm);
if (index !== -1) {
const parteResaltada = `<span style="color: #252525; font-weight: bold;">${sugerencia.substring(index, index + searchTerm.length)}</span>`;
return sugerencia.substring(0, index) + parteResaltada + sugerencia.substring(index + searchTerm.length);
} else {
return sugerencia;
}
}
        function scrollToPalabra(palabra) {
        const ocurrencias = buscarOcurrencias(palabra);
        if (ocurrencias.length > 0) {
            ocurrencias[0].scrollIntoView({ behavior: 'smooth' });
        }
    }

    function buscarOcurrencias(palabra) {
        const textoPagina = document.body.innerText || document.body.textContent;
        const regex = new RegExp(`\\b${palabra}\\b`, 'gi');
        const ocurrencias = textoPagina.match(regex);
        return ocurrencias ? ocurrencias.map(ocurrencia => obtenerElementoPorTexto(ocurrencia)) : [];
    }

    function obtenerElementoPorTexto(texto) {
        const nodosDeTexto = obtenerNodosDeTexto(document.body);
        const nodoConTexto = nodosDeTexto.find(nodo => nodo.nodeValue.trim() === texto.trim());
        return nodoConTexto ? nodoConTexto.parentElement : null;
    }

    function obtenerNodosDeTexto(elemento) {
        const nodos = [];
        const walker = document.createTreeWalker(elemento, NodeFilter.SHOW_TEXT, null, false);
        let nodo;
        while (nodo = walker.nextNode()) {
            nodos.push(nodo);
        }
        return nodos;
    }

    function mostrarNoEncontrado() {
        suggestions.style.display = "none";
        noEncontrado.style.display = "block";
        noEncontrado.innerHTML = "No se encuentra nada";
    }
});


