<?php
$conexion = mysqli_connect("localhost", "root", "", "inmobiliaria")
    or die("Error en la conexión");

$pagina = isset($_GET['pagina']) ? (int)$_GET['pagina'] : 1;
$registrosPorPagina = 5;
$comienzo = ($pagina - 1) * $registrosPorPagina;

$total = mysqli_num_rows(mysqli_query($conexion, "SELECT * FROM viviendas"));
$paginasTotales = ceil($total / $registrosPorPagina);

$consulta = "SELECT * FROM viviendas LIMIT $comienzo, $registrosPorPagina";
$registros = mysqli_query($conexion, $consulta);

echo "<h2>Listado con Paginación</h2>";

while ($v = mysqli_fetch_array($registros)) {
    echo "<p>{$v['tipo']} en {$v['zona']} - $ {$v['precio']}</p>";
}

if ($pagina > 1)
    echo "<a href='?pagina=" . ($pagina - 1) . "'>⬅ Anterior</a> ";

if ($pagina < $paginasTotales)
    echo "<a href='?pagina=" . ($pagina + 1) . "'>Siguiente ➡</a>";

mysqli_close($conexion);
?>
