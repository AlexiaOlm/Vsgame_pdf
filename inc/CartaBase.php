<?php
class CartaBase implements Carta {
    private int $id;
    private string $nombre;
    private int $ataque;
    private int $defensa;
    public function __construct(int $id, string $nombre, int $ataque, int $defensa) {
        $this->id = $id;
        $this->nombre = $nombre;
        $this->ataque = $ataque;
        $this->defensa = $defensa;
    }

    public function getId() {
        return $this->id;
    }
    public function getAtaque() {
        return $this->ataque;
    }
    public function getDefensa() {
        return $this->defensa;
    }
    public function getNombre() {
        return $this->nombre;
    }

    function mostrarInfo() {
        $nombre = $this->getNombre();
        $ataque = $this->getAtaque();
        $defensa = $this->getDefensa();

        return "Nombre: " . $nombre . " | Ataque: " . $ataque . " | Defensa: " . $defensa;
    }
}
?>