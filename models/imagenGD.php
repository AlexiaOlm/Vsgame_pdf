<?php
session_start();
include_once "../config/Conexion.php";

$modelo = new Conexion();
$conexion = $modelo->get_conexion();
$id = isset($_GET['id']) ? intval($_GET['id']) : 0;

function obtenerCarta($id, $conexion) {
    $sql = "SELECT * FROM cartas WHERE id = :id";
    $stmt = $conexion->prepare($sql);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    $resul = $stmt->fetch(PDO::FETCH_ASSOC);
    return $resul;
}

function obtenerImagen($id, $conexion) {
    $carta = obtenerCarta($id, $conexion);
    $imagen = '../img/cards/' . $carta['imagen'];
    return $imagen;
}

function obtenerImagenGD($id, $conexion) {
    $carta = obtenerCarta($id, $conexion);

    $cartaGD = imagecreatefromjpeg(obtenerImagen($id, $conexion));
    $verde = imagecolorallocate($cartaGD, 21, 200, 8);
    $rojo = imagecolorallocate($cartaGD, 255, 0, 0);
    $blanco = imagecolorallocate($cartaGD, 255, 255, 255);

    imagefilledellipse($cartaGD, 30, 450, 60, 60, $verde);
    imagefilledellipse($cartaGD, 310, 450, 60, 60, $rojo);

    imagestring($cartaGD, 80, 28, 443, $carta['ataque'], $blanco);
    imagestring($cartaGD, 80, 307, 443, $carta['defensa'], $blanco);

    header("Content-Type: image/jpeg");
    imagejpeg($cartaGD);
    imagedestroy($cartaGD);
}

obtenerImagenGD($id, $conexion);
?>