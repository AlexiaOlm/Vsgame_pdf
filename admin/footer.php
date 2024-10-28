<body>
    <?php 
    include_once 'cards/cards.php';
    session_start();

    if(isset($_SESSION['nickname'])) {
        $nombre = $_SESSION['nickname'];
    } else {
        $nombre = 'Invitado';
    }

    if(isset($_SESSION['num_cartas'])) {
        $num_cartas = $_SESSION['num_cartas'];
    }

    if(isset($_SESSION['num_usuarios'])) {
        $num_usuarios = $_SESSION['num_usuarios'];
    }
    ?>
<header>
        <h1>Panel de Administración</h1>
        <nav>
            <ul>
                <li><a href="dashboard.php">Inicio</a></li>
                <li><a href="cards/cards.php">Cartas</a></li>
                <li><a href="config/configuracion.php">Configuración</a></li>
                <li><a href="logout.php">Hola <?php echo $nombre; ?> (Cerrar Sesión)</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section class="dashboard-info">
            <h2>Información del juego</h2>
            <p>Número total de cartas: <?php echo $num_cartas; ?></p>
            <p>Configuración actual: <?php echo $num_usuarios; ?></p>
        </section>
    </main>
</body>