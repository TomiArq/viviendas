<?php
$conexion = mysqli_connect("localhost", "root", "", "inmobiliaria")
    or die("Error en la conexión");
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>🏠 Listado de Viviendas</title>
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
<style>
body { background: #f8f9fa; }
.card { box-shadow: 0 3px 6px rgba(0,0,0,0.1); border-radius: 12px; }
.card:hover { transform: scale(1.02); transition: 0.2s; }
</style>
</head>
<body class="p-4">
<div class="container">
    <h2 class="text-center mb-4">🏡 Listado de Viviendas</h2>

    <!-- Filtros -->
    <form id="filtros" class="d-flex justify-content-center mb-3 gap-2">
        <select name="zona" id="zona" class="form-select w-auto">
            <option value="">Todas las zonas</option>
            <option value="Norte">Norte</option>
            <option value="Sur">Sur</option>
            <option value="Centro">Centro</option>
        </select>
        <select name="extra" id="extra" class="form-select w-auto">
            <option value="">Todos los extras</option>
            <option value="Piscina">Piscina</option>
            <option value="Jardín">Jardín</option>
            <option value="Garage">Garage</option>
        </select>
        <button type="button" class="btn btn-primary" onclick="cargarDatos(1)">Filtrar</button>
    </form>

    <div id="listado" class="row"></div>

    <!-- Navegación -->
    <div class="d-flex justify-content-center mt-4 gap-2">
        <button id="anterior" class="btn btn-outline-secondary" onclick="paginaAnterior()">⬅ Anterior</button>
        <button id="siguiente" class="btn btn-outline-secondary" onclick="paginaSiguiente()">Siguiente ➡</button>
    </div>
</div>

<script>
let paginaActual = 1;

async function cargarDatos(pagina) {
    paginaActual = pagina;
    const zona = document.getElementById('zona').value;
    const extra = document.getElementById('extra').value;
    const res = await fetch(`listado_ajax.php?pagina=${pagina}&zona=${zona}&extra=${extra}`);
    const html = await res.text();
    document.getElementById('listado').innerHTML = html;
}

function paginaSiguiente() { cargarDatos(paginaActual + 1); }
function paginaAnterior() { if (paginaActual > 1) cargarDatos(paginaActual - 1); }

window.onload = () => cargarDatos(1);
</script>
</body>
</html>
<?php mysqli_close($conexion); ?>
