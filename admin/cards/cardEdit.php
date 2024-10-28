<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar cartas</title>
    <link rel="stylesheet" href="../assets/css/admin.css">
</head>
<body>
    <?php
    include_once "../../config/Conexion.php";
    include_once "../header.php";
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    
    $nombre = '';
    $ataque = 0;
    $defensa = 0;
    $tipo = '';
    $imagen = '';
    $poder_especial = '';

    if(isset($_GET['editar'])) {
        $id = $_GET['editar'];

        function datosCarta($id, $conexion) {
            $sql = "SELECT * FROM cartas WHERE id = :id";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->execute();
            $resul = $stmt->fetchAll(PDO::FETCH_OBJ);
            return $resul;
        }
        $carta = datosCarta($id, $conexion);

        if($carta) {
            $nombre = $carta->nombre;
            $ataque = $carta->ataque;
            $defensa = $carta->defensa;
            $tipo = $carta->tipo;
            $imagen = $carta->imagen;
            $poder_especial = $carta->poder_especial;
        }

        if(isset($_POST['cambios'])) {
            $nombre = $_POST['nombre'];
            $ataque = $_POST['ataque'];
            $defensa = $_POST['defensa'];
            $tipo = $_POST['tipo'];
            $imagen = '';
            $poder_especial = $_POST['poder_especial'];

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

            $sql = "UPDATE cartas SET nombre = :nombre, ataque = :ataque, defensa = :defensa, tipo = :tipo, imagen = :imagen, poder_especial = :poder_especial WHERE id = :id";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':id', $id);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':ataque', $ataque);
            $stmt->bindParam(':defensa', $defensa);
            $stmt->bindParam(':tipo', $tipo);
            $stmt->bindParam(':imagen', $imagen);
            $stmt->bindParam(':poder_especial', $poder_especial);
            $stmt->execute();
        }

    }
    ?>
    <h1>Editor de cartas</h1>
    <form action="" method="post" enctype="multipart/form-data">
        Nombre: <input type="text" name="text" value="<?php echo $nombre ?>"> <br>
        Ataque: <input type="number" name="ataque" value="<?php echo $ataque ?>"> <br>
        Defensa: <input type="number" name="defensa" value="<?php echo $defensa ?>"> <br>
        Tipo: <input type="text" name="tipo" value="<?php echo $tipo ?>"> <br>
        Imagen: <input type="file" name="imagen" accept="image/*"> <br>
        Poder especial: <input type="text" name="poder_especial" value="<?php echo $poder_especial ?>"> <br>
        <button type="submit" name="cambios">Editar</button> 
    </form>
</body>
</html>