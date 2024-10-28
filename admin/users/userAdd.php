<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Panel de Administración</title>
    <link rel="stylesheet" href="../assets/css/admin.css"> <!-- Archivo CSS externo -->
</head>
<body>
    <?php
    include_once '../../config/Conexion.php';
    $modelo = new Conexion();
    $conexion = $modelo->get_conexion();
    
    if(isset($_POST['añadir'])) {
        $nombre = $_POST['nickname'];
        $email = $_POST['email'];
        $password = $_POST['password'];
        
        $sql = "INSERT INTO usuarios (nombre, email, password_) VALUES 
        (:nombre, :email, :password_);";
        $stmt = $conexion->prepare($sql);
        $stmt->bindParam(':nombre', $nombre);
        $stmt->bindParam(':email', $email);
        $stmt->bindParam(':password', $password);
        $stmt->execute();
    }
    ?>
    <header>
        <h1>Panel de Administración</h1>
        <nav>
            <ul>
                <li><a href="">Inicio</a></li>
                <li><a href="">Cartas</a></li>
                <li><a href="">Usuarios</a></li>
                <li><a href="">Configuración</a></li>
                <li><a href="">Cerrar Sesión</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="dashboard-info">
           <div class="form-container">
            <h2>Añadir Usuario</h2>
            <form action="procesar_añadir_usuario.php" method="POST">
                <label for="nickname">Nickname:</label>
                <input type="text" name="nickname" id="nickname" required>

                <label for="email">Email:</label>
                <input type="email" name="email" id="email" required>

                <label for="password">Contraseña:</label>
                <input type="password" name="password" id="password" required>

                <button type="submit" name="añadir">Añadir Usuario</button>
            </form>
        </div>
        </section>
    </main>
</body>
</html>
