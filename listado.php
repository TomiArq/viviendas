<?php
$conexion = mysqli_connect("localhost", "root", "", "inmobiliaria")
    or die("Error en la conexión");

$registros = mysqli_query($conexion, "SELECT * FROM viviendas")
    or die("Error en la consulta");

echo "<h2>Listado de Viviendas</h2>";

while ($v = mysqli_fetch_array($registros)) {
    echo "<div style='border:1px solid #ccc; padding:10px; margin:10px;'>";
    echo "<b>ID:</b> {$v['id']}<br>";
    echo "<b>Tipo:</b> {$v['tipo']}<br>";
    echo "<b>Zona:</b> {$v['zona']}<br>";
    echo "<b>Dirección:</b> {$v['direccion']}<br>";
    echo "<b>Dormitorios:</b> {$v['dormitorios']}<br>";
    echo "<b>Precio:</b> $ {$v['precio']}<br>";
    echo "<b>Tamaño:</b> {$v['tamano']} m²<br>";
    echo "<b>Extras:</b> {$v['extras']}";
    echo "</div>";
}

mysqli_close($conexion);
?>
