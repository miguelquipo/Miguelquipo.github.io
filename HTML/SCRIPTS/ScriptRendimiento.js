
document.addEventListener('DOMContentLoaded', function () {
    const form = document.getElementById('insert-form');
    const cedulaInput = document.getElementById('search-cedula');
    const productoInput = document.getElementById('search-producto');

    // Agregar eventos input a los campos
    cedulaInput.addEventListener('input', verificarCampos);
    productoInput.addEventListener('input', verificarCampos);

    function verificarCampos() {
        if (cedulaInput.value.trim() !== '' && productoInput.value.trim() !== '') {
            // Ambos campos están llenos, enviar formulario
            form.submit();
        }
    }
});
function clearInputs() {
document.getElementById("search-cedula").value = '';
document.getElementById("search-producto").value = '';
document.getElementById("search-cedula").focus();
}
document.addEventListener('DOMContentLoaded', function() {
var cedulaInput = document.getElementById("search-cedula");
cedulaInput.focus();
});
function moveToNext(event, nextFieldId) {
var currentField = event.target;
var fieldValue = currentField.value.trim();
var key = event.key;

if (key === 'Enter' && fieldValue !== '') {
  if (nextFieldId !== '') {
    var nextField = document.getElementById(nextFieldId);
    nextField.focus();

    // Verificar si ambos campos están completos para enviar el formulario
    var cedulaInput = document.getElementById("search-cedula").value.trim();
    var productoInput = document.getElementById("search-producto").value.trim();

    if (cedulaInput !== '' && productoInput !== '') {
      document.getElementById("ingreso-form").submit(); // Envío del formulario
    }
  }
}
}

document.addEventListener('DOMContentLoaded', function() {
    obtenerDatos();
});

function obtenerDatos() {
    fetch('../PHP/obtener_rendimientos.php') // Archivo PHP que devuelve los datos en formato JSON
        .then(response => response.json())
        .then(data => {
            mostrarDatosEnTabla(data);
        })
        .catch(error => {
            console.error('Error al obtener los datos:', error);
        });
}

function mostrarDatosEnTabla(data) {
    const tableBody = document.getElementById('table-body');

    // Limpiamos cualquier contenido previo en la tabla
    tableBody.innerHTML = '';

    // Iteramos sobre los datos y creamos las filas de la tabla
    data.forEach(rendimiento => {
        const row = document.createElement('tr');
        row.innerHTML = `
            <td>${rendimiento.id_rendimiento}</td>
            <td>${rendimiento.cantidad_vendida}</td>
            <td>${rendimiento.nombre_producto}</td>
            <td>${rendimiento.nombre_trabajador}</td>
            <td>${rendimiento.fecha_registro}</td>
            <td>${rendimiento.hora_registro}</td>
        `;
        tableBody.appendChild(row);
    });
}