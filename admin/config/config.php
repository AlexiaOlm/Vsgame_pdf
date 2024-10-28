<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Configuración</title>
</head>
<body>
    <?php
    include_once '../config/Conexion.php';
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();

    if(isset($_GET['editar'])) {
        $clave = $_GET['clave'];
        $valor = $_GET['valor'];

        $sql = "UPDATE configuracion SET valor = :valor WHERE clave = :clave";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':clave', $clave);
        $stmt->bindParam(':valor', $valor);
        $stmt->execute();
    }

    function mostrarConfiguracion($conexion) {
        $sql = "SELECT * FROM configuracion";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $configuracion = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "<table border=1>";
        echo "<tr>";
        echo "<th> Clave </th>";
        echo "<th> Valor </th>";
        echo "</tr>";
        foreach($configuracion as $dato) {
            echo "<tr>";
            echo "<td> $dato[clave] </td>";
            echo "<td> $dato[valor] </td>";
            echo "</tr>";
        }
    }

    function configuracionActual($conexion) {
        $sql = "SELECT * FROM configuracion";
        $stmt = $conexion->prepare($sql);
        $stmt->execute();
        $configuracion = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach($configuracion as $dato) {
            echo "<br>";
            echo "$dato[clave]: $dato[valor]  ";
        }
    }

    mostrarConfiguracion($conexion);
    ?>
    <form action="" method="get">
        Clave: <input type="text" name="clave" required> <br>
        Valor: <input type="number" name="valor" required> <br>
        <button type="submit" name="editar">Editar</button>
    </form>
</body>
</html>