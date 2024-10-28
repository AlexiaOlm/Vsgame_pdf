<?php
include_once "config/Conexion.php";
class Juego {
    private int $numCartas;
    private int $maxAtaque;
    private int $maxDefensa;

    public function __construct(int $numCartas, int $maxAtaque, int $maxDefensa) {
        $this->numCartas = $numCartas;
        $this->maxAtaque = $maxAtaque;
        $this->maxDefensa = $maxDefensa;
    }

    public function cartasAleatorias() {
        $arrayCartas = [];

        /*$arrayNombres = ['Guardián', 'Místico', 'Sombra', 'Mago de Hielo', 'Elemental de Fuego', 'Cazador de Tormentas', 'Caballero Dragón', 'Oráculo', 'Bardo', 'Encantador', 'Domador', 'Caballero Sombrío', 'Mago Rúnico', 'Acechador Nocturno', 'Hechizero Celestial', 'Guerrero Fénix', 'Ranger', 'Druida', 'Vampiro', 'Hechicero', 'Bruja', 'Gladiador', 'Monje', 'Alquimista', 'Valquiria', 'Ilusionista', 'Maestro de Bestias', 'Cambiante', 'Elementalista', 'Nigromante'];

        for ($i=0; $i < $this->numCartas; $i++) {
            $nombre = $arrayNombres[array_rand($arrayNombres)];
            $ataque = rand(1, $this->maxAtaque);
            $defensa = rand(1, $this->maxDefensa);
            
            $carta = new CartaBase($nombre, $ataque, $defensa);
            array_push($arrayCartas, $carta);
        }*/

        $formato = new Conexion();
        $conexion = $formato->get_conexion();

        for($i=0; $i < $this->numCartas; $i++) {
            $num = rand(1, 30);
            $sql = "SELECT * FROM cartas WHERE id = :id";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id', $num);
            $stmt->execute();
            $resul = $stmt->fetch(PDO::FETCH_ASSOC);

            if($resul) {
                $id = $resul['id'];
                $nombre = $resul['nombre'];
                $ataque = $resul['ataque'];
                $defensa = $resul['defensa'];
                $carta = new CartaBase($id, $nombre, $ataque, $defensa);
                array_push($arrayCartas, $carta);
            } else {
                $i--;
            }
        }

        return $arrayCartas;
    }
}
?>