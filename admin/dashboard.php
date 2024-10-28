<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="./assets/css/admin.css"> <!-- Archivo CSS externo -->
</head>
<body>
    <?php 
    include_once "cards/cards.php";
    include_once "../config/Conexion.php";

    /*session_start();*/

    if(isset($_SESSION['nickname'])) {
        $nickname = $_SESSION['nickname'];
    } else {
        header('Location: login.php');
        exit();
    }
    ?>
</body>
</html>
