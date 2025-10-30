<?php
$conexion = mysqli_connect("localhost", "root", "", "inmobiliaria")
    or die("Error en la conexión");

$filtro = isset($_GET['zona']) ? $_GET['zona'] : "";

$consulta = "SELECT * FROM viviendas";
if ($filtro != "") {
    $consulta .= " WHERE zona='$filtro'";
}

$registros = mysqli_query($conexion, $consulta);
?>
<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Listado con Filtros</title>
    <style>
        body { font-family: Arial; background: #f4f4f4; padding: 20px; }
        .card { background: white; padding: 10px; margin: 10px; border-radius: 10px; box-shadow: 0 0 5px #ccc; }
        select, button { padding: 5px; margin: 10px 0; }
    </style>
</head>
<body>
<h2>🏡 Viviendas con Filtros</h2>

<form method="get">
    <label>Filtrar por zona:</label>
    <select name="zona">
        <option value="">Todas</option>
        <option value="Norte">Norte</option>
        <option value="Sur">Sur</option>
        <option value="Centro">Centro</option>
    </select>
    <button type="submit">Filtrar</button>
</form>

<?php
while ($v = mysqli_fetch_array($registros)) {
    echo "<div class='card'>";
    echo "<b>{$v['tipo']}</b> en {$v['zona']} - $ {$v['precio']}<br>";
    echo "<small>{$v['direccion']} ({$v['dormitorios']} dorm.)</small>";
    echo "</div>";
}
mysqli_close($conexion);
?>
</body>
</html>
