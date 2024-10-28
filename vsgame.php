<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="Css/main.css">
    <title>Juego de Cartas</title>
</head>
<body>  

<?php
  require_once "inc/Carta.php";
  require_once "inc/CartaBase.php";
  require_once "inc/Juego.php";
  require_once "inc/Mazo.php";
  require_once "inc/TipoCartaEspecial.php";
  require_once "inc/Jugador.php";

  session_start();

  if(!isset($_SESSION['juego'])) {
    iniciarJuego();
  }

  function iniciarJuego() {
    $juego = new Juego(10, 100, 100);

    $_SESSION['jugador1'] = new Jugador("Jugador 1", $juego);
    $_SESSION['jugador2'] = new Jugador("Máquina", $juego);
    $_SESSION['puntosJugador1'] = 0;
    $_SESSION['puntosJugador2'] = 0;
    $_SESSION['rondas'] = 0;
    $_SESSION['cartaJugador1'] = null;
    $_SESSION['cartaJugador2'] = null;
    $_SESSION['juego'] = true;
    $_SESSION['resulatdo'] = [];

    $_SESSION['cartaJugador1'] = $_SESSION['jugador1']->jugarCarta();
    $_SESSION['cartaJugador2'] = $_SESSION['jugador2']->jugarCarta();
  }
    

  if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['reiniciar'])) {
    session_destroy();
    session_start();
    iniciarJuego();
  }

  $ganador = '';
  $resultados = [];

  if($_SERVER['REQUEST_METHOD'] === 'GET' && isset($_GET['opcionJugada'])) {
    $cartaJugador1 = $_SESSION['cartaJugador1'];
    $cartaJugador2 = $_SESSION['cartaJugador2'];
    $opcion = $_GET['opcionJugada'];

    if($opcion === 'ataque') {
      if($cartaJugador1->getAtaque() > $cartaJugador2->getDefensa()) {
        $_SESSION['puntosJugador1'] += 1;
        $ganador = "Jugador 1 gana la ronda";
      } else if ($cartaJugador1->getAtaque() < $cartaJugador2->getDefensa()) {
        $_SESSION['puntosJugador2'] += 1;
        $ganador = "Jugador 2 gana la ronda";
      } else {
        $ganador = 'Empate';
      }
    } else if ($opcion === 'defensa') {
      if($cartaJugador1->getDefensa() > $cartaJugador2->getAtaque()) {
        $_SESSION['puntosJugador1'] += 1;
        $ganador = "Jugador 1 gana la ronda";
      } else if ($cartaJugador1->getDefensa() < $cartaJugador2->getAtaque()) {
        $_SESSION['puntosJugador2'] += 1;
        $ganador = "Jugador 2 gana la ronda";
      } else {
        $ganador = 'Empate';
      }

    }

    $_SESSION['resultado'] = [
      'cartaJugador1' => $cartaJugador1->mostrarInfo(),
      'cartaJugador2' => $cartaJugador2->mostrarInfo(),
      'ganador' => $ganador
    ];

    $_SESSION['rondas']++;

    $_SESSION['cartaJugador1'] = $_SESSION['jugador1']->jugarCarta();
    $_SESSION['cartaJugador2'] = $_SESSION['jugador2']->jugarCarta();

    echo "<script>document.getElementById('popup').classList.add('active');</script>";
  }

  function obtenerResultados() {
    if(!empty($_SESSION['resultado'])) {
      $resultados = $_SESSION['resultado'];
      echo "Carta Jugador 1: <br>" . $resultados['cartaJugador1'] . "<br>";
      echo "Carta Jugador 2: <br>" . $resultados['cartaJugador2'] . "<br>";
      echo $resultados['ganador'];
    } else {
      echo "No hay resultados para mostar.";
    }
  }


  $rondas = $_SESSION['rondas'];
  $puntosJ1 = $_SESSION['puntosJugador1'];
  $puntosJ2 = $_SESSION['puntosJugador2'];

  $carta1 = $_SESSION['cartaJugador1'];
  $carta2 = $_SESSION['cartaJugador2'];
?>

<form action="" method="GET" id="formEnvio" style="display: none";>
  <select name="opcionJugada" id="opcionJugada">
    <option value="ataque">Ataque</option>
    <option value="defensa">Defensa</option>
  </select>
  <input type="submit" value="Enviar">
</form>

<div class="container">
  <div class="card">
    <img src="models/imagenGD.php?id=<?php echo $carta1->getId(); ?>" alt="Carta del Jugador" >
  </div>
  <img src="img/vs.png" alt="VS" class="vs">
  <div class="card">
    <img src="models/imagenGD.php?id=<?php echo $carta2->getId(); ?>" alt="Carta de la Máquina">
  </div>
</div>

<div class="container">
  <div class="buttons" >
    <a href="#" id="atacar" onclick=" atacar(); return false">
      <img src="img/atacar.png" alt="Carta del Jugador" class="btn" >
    </a>
    <a href="#" id="defensa"  onclick="defender(); return false">
      <img src="img/defender.png" alt="Carta del Jugador" class="btn" >
    </a>
</div> 

<a href="vsgame.php?reiniciar=1">
  <img src="img/restartgame.png" alt="reiniciar" id="restartGame">
</a>

<div class="score">
  <div class="contentScore">
  <div id="bandera" class="show">
    <img src="img/win1.png" alt="win1" class="win1">
  </div>
  <img src="img/score.png" alt="reiniciar" id="scoreGame">
  <div class="ronda">
    <?php echo $rondas; ?>
  </div>
  <div class="puntuacionJ1">
    <?php echo $puntosJ1; ?>
  </div>
  <div class="puntuacionJ2">
    <?php echo $puntosJ2; ?>
  </div>
  </div>
</div>

<div class="popup active" id="popup">
  <div class="popup-content">
    <button class="close-btn" id="closePopupBtn">&times;</button>
    <h2>Jugada</h2>
    <?php echo obtenerResultados();?>
  </div>
</div>

<div class="login" style="position: absolute; bottom: 20px; right: 0px; ">
  <a href="admin/login.php">
    <img src="img/Login.png" alt="Login" style="width: 200px; height: auto; bottom: 20px; right: 20px;">
  </a>
</div>

<script>
  const selectOculto = document.getElementById('opcionJugada');
  const formulario = document.getElementById('formEnvio');

  function atacar(){
    selectOculto.value = 'ataque';
    formulario.submit();
  };

  function defender() {
    selectOculto.value = 'defensa';
    formulario.submit();
  };

  const closePopupBtn = document.getElementById('closePopupBtn');
  const popup = document.getElementById('popup');

  closePopupBtn.addEventListener('click', function() {
    popup.classList.remove('active');
  });

  window.addEventListener('click', function(e) {
  if (e.target === popup) {
    popup.classList.remove('active');
  }
  });
</script>

</body>
</html>
