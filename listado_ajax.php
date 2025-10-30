<?php
$conexion = mysqli_connect("localhost", "root", "", "inmobiliaria")
    or die("Error en la conexión");

$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$registrosPorPagina = 3;
$comienzo = ($pagina - 1) * $registrosPorPagina;

$filtroZona = isset($_GET['zona']) && $_GET['zona'] != "" ? "zona='{$_GET['zona']}'" : "1";
$filtroExtra = isset($_GET['extra']) && $_GET['extra'] != "" ? "extras LIKE '%{$_GET['extra']}%'" : "1";

$consulta = "SELECT * FROM viviendas WHERE $filtroZona AND $filtroExtra LIMIT $comienzo, $registrosPorPagina";
$registros = mysqli_query($conexion, $consulta);

if (mysqli_num_rows($registros) == 0) {
    echo "<p class='text-center text-muted'>No hay viviendas que coincidan con los filtros seleccionados.</p>";
} else {
    while ($v = mysqli_fetch_array($registros)) {
        echo "
        <div class='col-md-4 mb-3'>
            <div class='card p-3'>
                <h5>{$v['tipo']} en {$v['zona']}</h5>
                <p><b>Precio:</b> $ {$v['precio']}<br>
                <b>Dormitorios:</b> {$v['dormitorios']}<br>
                <b>Tamaño:</b> {$v['tamano']} m²<br>
                <b>Extras:</b> {$v['extras']}</p>
            </div>
        </div>";
    }
}
mysqli_close($conexion);
?>
