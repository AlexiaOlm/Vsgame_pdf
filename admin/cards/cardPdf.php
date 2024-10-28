<?php
include_once "../../lib/tcpdf/tcpdf.php";
include_once "../../lib/tcpdf/config/tcpdf_config.php";
include_once "../../config/Conexion.php" ;

$modelo = new Conexion();
$conexion = $modelo->get_conexion();

$documento = new TCPDF();
$documento->AddPage();
$documento->setPrintHeader(false);
$documento->setPrintFooter(false);
$documento->SetTitle("Informe de Cartas de VSGAME");

$documento->Image(
    '../../img/logo.jpeg', 10, 20, 30, 0, '', '', true
);

function tablacartas($conexion) {
    $sql = "SELECT * FROM cartas";
    $query = $conexion->prepare($sql);
    $query->execute();
    $resul = $query->fetchAll(PDO::FETCH_OBJ);

    $html = "<table style='border: 1px solid black; border-collapse: collapse;'>";
    $html .= "<tr>";
    $html .= "<th style='border: 1px solid black;'>Nombre</th>";
    $html .= "<th style='border: 1px solid black;'>Ataque</th>";
    $html .= "<th style='border: 1px solid black;'>Defensa</th>";
    $html .= "</tr>";
    foreach($resul as $carta) {
        $html .= "<tr>";
        $html .= "<td style='border: 1px solid black;'> $carta->nombre </td>";
        $html .= "<td style='border: 1px solid black;'> $carta->ataque </td>";
        $html .= "<td style='border: 1px solid black;'> $carta->defensa </td>";
        $html .= "</tr>";
    }
    $html .= "</table>";
    return $html;
}
$html = tablacartas($conexion);
$documento->writeHTML($html);

$sql = "SELECT COUNT(id) AS num_cartas FROM cartas;";
$stmt = $conexion->query($sql);
$fila = $stmt->fetch();
$num_cartas = $fila['num_cartas'];
$total_cartas = "En el mazo se encuentran " . $num_cartas . " cartas.";

$documento->Write(0, $total_cartas);

$s = "<br>";
$documento->writeHTML($s);

$fecha = date('d-m-Y H:i:s');
$documento->Write(0, $fecha);

$documento->Output('informe_cartas.pdf', 'I');
?>