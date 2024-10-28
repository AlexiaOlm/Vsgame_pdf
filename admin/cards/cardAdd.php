<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>
<?php
require_once "../models/UsuarioBD.php" ;
$modelo = new Conexion();
$conexion = $modelo->get_conexion();

if($_SERVER['REQUEST_METHOD'] === 'GET') {
    $nombre = $_GET["nombre"];
    $ataque = $_GET["ataque"];
    $defensa = $_GET["defensa"];
    $tipo = $_GET["tipo"];
    $imagen = $_GET["imagen"];
    $poder_especial = $_GET["poder_especial"];

    $carta = new UsuarioBD();
    $carta->insertarCarta($nombre, $ataque, $defensa, $tipo, $imagen, $poder_especial);
}
?>
    <h1>Nueva carta</h1>
    <form action="" method="get">
        Nombre: <input type="text" name="nombre"><br>
        Ataque: <input type="number" name="ataque" min="1"><br>
        Defensa: <input type="number" name="defensa" min="1"><br>
        Tipo: <input type="text" name="tipo"><br>
        Imagen: <input type="text" name="imagen"><br>
        Poder especial: <input type="text" name="poder_especial"><br> 
        <button type="submit" name="crear">Crear carta</button>
    </form>
</body>
</html>