<?php
class TipoCartaEspecial extends CartaBase {
    private string $poderEspecial;

    public function __construct($nombre, $ataque, $defensa, $poderEspecial) {
        parent::__construct($nombre,$ataque,$defensa);
        $this->poderEspecial = $poderEspecial;
    }
    
    public function getPoderEspecial() {
        return $this->poderEspecial;
    }

    public function mostrarInfo() {
        $poder = $this->getPoderEspecial();
        return parent::mostrarInfo() . " | Poder especial: " . $poder;
    }
}
?>