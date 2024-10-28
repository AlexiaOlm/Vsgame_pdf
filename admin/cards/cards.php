<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Crear cartas</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
<?php
    session_start();
    include_once "../config/Conexion.php" ;
    include_once "../models/UsuarioBD.php";
    include_once "../admin/header.php";

    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();

    $sql = "SELECT COUNT(id) AS num_cartas FROM cartas;";
    $stmt = $conexion->query($sql);
    $fila = $stmt->fetch();
    $num_cartas = $fila['num_cartas'];
    $_SESSION['num_cartas'] = $num_cartas;

    $sql = "SELECT id, nombre FROM cartas";
    $stmt = $conexion->query($sql);
    $cartas = $stmt->fetchAll();

    function eliminarCarta($id, $conexion) {
        $sql = "DELETE FROM cartas WHERE id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }

    if(isset($_GET['eliminar'])) {
        $id = $_GET['eliminar'];
        eliminarCarta($id, $conexion);
    }

    if (basename($_SERVER['PHP_SELF']) === 'cards.php'):
?>

<table>
    <thead>
        <tr>
            <th>Carta</th>
            <th>Opciones</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cartas as $carta): ?>
            <tr>
                <td><?php echo $carta['nombre']; ?></td>
                <td>
                    <form action="" method="get">
                        <button href="cardEdit.php?id=<?php echo $carta['id']; ?>" name="editar">Editar</button>
                        <button type="submit" name="eliminar" value="<?php echo $carta['id']; ?>" onclick="return confirm('¿Estás seguro de eliminar esta carta?');">Eliminar</button>
                    </form>
                </td>
            </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php endif; ?>
</body>
</html>