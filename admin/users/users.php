<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Usuarios</title>
</head>
<body>
    <?php
    include_once '../../models/UsuarioBD.php';
    session_start();

    $usuario = new UsuarioBD();
    $usuario->obtenerUsuarios();

    $sql = "SELECT COUNT(id) AS num_usuarios FROM usuarios;";
    $stmt = $conexion->query($sql);
    $fila = $stmt->fetch();
    $num_usuarios = $fila['num_usuarios'];
    $_SESSION['num_usuarios'] = $num_usuarios;
    ?>
</body>
</html>