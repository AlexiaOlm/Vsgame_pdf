<?php
include_once "../config/Conexion.php";

$modelo = new Conexion();
$conexion = $modelo->get_conexion();

$sql = "DROP TABLE cartas;";
$stmt = $conexion->prepare($sql);
$stmt->execute();

$sql = "CREATE TABLE IF NOT EXISTS cartas (
id INT AUTO_INCREMENT PRIMARY KEY,
nombre VARCHAR(50) NOT NULL,
ataque NUMERIC(3) NOT NULL,
defensa NUMERIC(3) NOT NULL,
tipo VARCHAR(50),
imagen VARCHAR(255) NOT NULL,
poder_especial VARCHAR(100)
);";
$stmt = $conexion->prepare($sql);
$stmt->execute();
/*
$sql = "DROP TABLE configuracion;";
$stmt = $conexion->prepare($sql);
$stmt->execute();

$sql = "CREATE TABLE IF NOT EXISTS configuracion (
clave VARCHAR(50) NOT NULL,
valor NUMERIC(3) NOT NULL
);";
$stmt = $conexion->prepare($sql);
$stmt->execute();

$sql = "DROP TABLE usuarios";
$stmt = $conexion->prepare($sql);
$stmt->execute();

$sql = "CREATE TABLE IF NOT EXISTS usuarios ( 
id INT AUTO_INCREMENT PRIMARY KEY, 
nickname VARCHAR(50) NOT NULL, 
email VARCHAR(100) NOT NULL, 
password_ VARCHAR(255) NOT NULL, 
imagen VARCHAR(255), 
fecha_registro TIMESTAMP DEFAULT CURRENT_TIMESTAMP 
);";
$stmt = $conexion->prepare($sql);
$stmt->execute();
*/

$sql = "INSERT INTO cartas (nombre, ataque, defensa, tipo, imagen, poder_especial) VALUES
('Guardián', 80, 70, 'Guardián', '1_card.jpg', 'Escudo Protector'),
('Místico', 75, 75, 'Místico', '2_card.jpg', 'Maldición Mística'),
('Sombra', 70, 60, 'Sombra', '3_card.jpg', 'Esquivar'),
('Mago de Hielo', 65, 80, 'Mago de Hielo', '4_card.jpg', 'Congelación'),
('Elemental de Fuego', 85, 55, 'Elemental de Fuego', '5_card.jpg', 'Llamas Devastadoras'),
('Cazador de Tormentas', 90, 50, 'Cazador de Tormentas', '6_card.jpg', 'Rayo Fulminante'),
('Caballero Dragón', 95, 90, 'Caballero Dragón', '7_card.jpg', 'Vuelo'),
('Oráculo', 60, 70, 'Oráculo', '8_card.jpg', 'Visión del Futuro'),
('Bardo', 65, 65, 'Bardo', '9_card.jpg', 'Inspiración Musical'),
('Encantador', 70, 60, 'Encantador', '10_card.jpg', 'Encantamiento'),
('Domador', 75, 65, 'Domador', '11_card.jpg', 'Invocación Bestial'),
('Caballero Sombrío', 80, 75, 'Caballero Sombrío', '12_card.jpg', 'Sombras Vengadoras'),
('Mago Rúnico', 70, 70, 'Mago Rúnico', '13_card.jpg', 'Runa de Poder'),
('Acechador Nocturno', 80, 65, 'Acechador Nocturno', '14_card.jpg', 'Sigilo'),
('Hechicero Celestial', 95, 85, 'Hechicero Celestial', '15_card.jpg', 'Magia Celestial'),
('Guerrero Fénix', 90, 70, 'Guerrero Fénix', '16_card.jpg', 'Renacer de las Cenizas'),
('Ranger', 70, 60, 'Ranger', '17_card.jpg', 'Tiro Certero'),
('Druida', 65, 75, 'Druida', '18_card.jpg', 'Transformación Natural'),
('Vampiro', 75, 65, 'Vampiro', '19_card.jpg', 'Sangre Vital'),
('Hechicero', 80, 70, 'Hechicero', '20_card.jpg', 'Conjuro Poderoso'),
('Bruja', 65, 60, 'Bruja', '21_card.jpg', 'Hechizo Maléfico'),
('Gladiador', 85, 70, 'Gladiador', '22_card.jpg', 'Furia de Combate'),
('Monje', 75, 80, 'Monje', '23_card.jpg', 'Meditación'),
('Alquimista', 60, 65, 'Alquimista', '24_card.jpg', 'Transmutación'),
('Valquiria', 85, 75, 'Valquiria', '25_card.jpg', 'Cruzada Celestial'),
('Ilusionista', 70, 55, 'Ilusionista', '26_card.jpg', 'Truco de Ilusión'),
('Maestro de Bestias', 80, 75, 'Maestro de Bestias', '27_card.jpg', 'Comando Bestial'),
('Cambiante', 70, 60, 'Cambiante', '28_card.jpg', 'Transformación'),
('Elementalista', 75, 70, 'Elementalista', '29_card.jpg', 'Control Elemental'),
('Nigromante', 80, 65, 'Nigromante', '30_card.jpg', 'Resurrección de Muertos');";
$stmt = $conexion->prepare($sql);
$stmt->execute();

?>