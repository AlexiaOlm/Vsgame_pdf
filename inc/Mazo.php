<?php
class Mazo {
    private $cartas = [];

    public function __construct(Juego $juego) {
        $this->generarCartasAleatorias($juego);
    }

    public function getCartas() {
        return $this->cartas;
    }

    public function generarCartasAleatorias(Juego $juego) {
        $this->cartas = $juego->cartasAleatorias();
    }

    public function sacarCarta() {
        $cartaPrimera = array_shift($this->cartas);
        return $cartaPrimera;
    }

    public function cartasRestantes() {
        return count($this->cartas);
    }
}
?>