<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="assets/css/admin.css">
</head>
<body>
    <style>
        body {
            background-image: url('../img/fondo_login.jpeg');
            background-repeat: repeat;
            background-size: 100%;
        }

        #recordarC {
            display: flex;
            flex-wrap: wrap;
        }
    </style>
    <?php
    include_once '../config/Conexion.php' ;
    session_start();

    if(isset($_COOKIE['email_c']) && isset($_COOKIE['password_c'])) {
        //$_SESSION['nickname'] = $_COOKIE['email_c'];
        header('Location: dashboard.php');
        exit();
    }

    if(isset($_POST['entrar'])) {
        $emailP = $_POST['username'];
        $password = $_POST['password'];
        $recordar = isset($_POST['recordar']);

        function validarLogin($emailP, $password, $recordar) {
            $modelo = new Conexion();
            $conexion = $modelo->get_conexion();
            $sql = "SELECT nickname, password FROM usuarios WHERE email = :email";
            $stmt = $conexion->prepare($sql);
            $stmt->bindParam(':email', $emailP);
            $stmt->execute();
            $resul = $stmt->fetch(PDO::FETCH_ASSOC);

            if($resul) {
                $nombreUsuario = $resul['nickname'];
                $pass = $resul['password'];
                if(sha1($password) == $pass) {
                    $_SESSION['nickname'] = $nombreUsuario;

                    if ($recordar) {
                        $_COOKIE['email_c'] = $emailP;
                        setcookie('email_c', $emailP, time() + (86400 * 30), "/"); // 30 días
                    }

                    header('Location: dashboard.php');
                    exit();
                } else {
                    return "Contraseña incorrecta";
                }
            } else {
                return "Usuario no encontrado";
            }
            
        }
        validarLogin($emailP, $password, $recordar);
    }

    $usuarioGuardado = isset($_COOKIE['email_c']) ? $_COOKIE['email_c'] : '';
    ?>
    <div class="login-container">
        <form action="" method="POST" class="login-form">
            <h2>Iniciar Sesión</h2>
            <label for="username">Usuario:</label>
            <input type="text" id="username" name="username" required>
            <span name="usuarioError"></span>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>
            <span name="passError"></span>

            <div id="recordarC">
            <input type="checkbox" name="recordar" id="recordar" class="recordar">
            <span class="recordar">Recordar contraseña</span>
            </div>

            <button type="submit" name="entrar">Entrar</button>
        </form>
    </div>
    <script src="assets/javascript/login.js"></script>
</body>
</html>
