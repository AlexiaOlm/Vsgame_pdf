<?php
class Jugador {
    private string $nombre;
    private Mazo $mazo;

    public function __construct(string $nombre, Juego $juego) {
        $this->nombre = $nombre;
        $this->mazo = new Mazo($juego);
    }

    public function jugarCarta() {
        return $this->mazo->sacarCarta();
    }

    public function tieneCartas() {
        return $this->mazo->cartasRestantes() > 0;
    }

    public function getNombre() {
        return $this->nombre;
    }

    public function mostrarMazo() {
        $cartas = "";
        foreach($this->mazo->getCartas() as $cart) {
            $cartas .= $cart->mostrarInfo() . "\n";
        }
        return "Mazo de " . $this->nombre . "\n" . $cartas;
    }

    public function cartasRestantes() {
        return $this->mazo->cartasRestantes();
    }
}
?>