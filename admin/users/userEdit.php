<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar usuarios</title>
</head>
<body>
    <?php
    include_once '../../config/Conexion.php';
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();

    if(isset($_POST['editar'])) {
        $id = $_POST['id_u'];
        $nombre = $_POST['nickname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        $imagen = '';

        if(!empty($_FILES['imagen']['name'])) {
            $ruta = "../../uploads/imagenes/";
            $file = basename($_FILES['imagen']['name']);
            $archivo = $ruta . $file;

            if(move_uploaded_file($_FILES['imagen']['i_name'], $archivo)) {
                $imagen = $archivo;
            } else {
                echo "Error al subir el archivo";
            }
        }

        $sql = "UPDATE usuarios SET nickname = :nombre, email = :email, imagen = :imagen, password_ = :pass WHERE id = :id";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':pass', $password);
        if(!empty($imagen)) {
            $stmt->bindParam(':imagen', $imagen);
        }
        $stmt->execute();
    }
    ?>
    <form action="" method="post" enctype="multipart/form-data">
        <label for="id_u">Id:</label>
        <input type="text" name="id_u" id="id_u" value="<?php echo $id; ?>">

        <label for="nickname">Nickname:</label>
        <input type="text" name="nickname" id="nickname" value="<?php echo $nombre; ?>" required>

        <label for="email">Email:</label>
        <input type="email" name="email" id="email" value="<?php echo $email; ?>" required>

        <label for="imagen">Imagen:</label>
        <input type="file" name="imagen" id="img">

        <label for="password">Contraseña:</label>
        <input type="password" name="password" id="password" required>

        <button type="submit" name="editar">Editar Usuario</button>
    </form>
</body>
</html>