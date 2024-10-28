<?php 
class UsuarioBD {
    private $conexion;

    public function __construct() {
        $db = new Conexion();
        $this->conexion = $db->get_conexion();
    }

    public function insertarCarta($nombre, $ataque, $defensa, $tipo, $imagen, $poder_especial) {
        if(!empty($poder_especial) || $poder_especial == null) {
            $sql = "INSERT INTO cartas (nombre, ataque, defensa, tipo, imagen, poder_especial VALUES
            (:nombre, :ataque, :defensa, :tipo, :imagen, :poder_especial);";
        } else {
            $sql = "INSERT INTO cartas (nombre, ataque, defensa, tipo, imagen) VALUES
            (:nombre, :ataque, :defensa, :tipo, :imagen);";
        }
        $statement = $this->conexion->prepare($sql);
        $statement->bindParam(':nombre', $nombre);
        $statement->bindParam(':ataque', $ataque);
        $statement->bindParam(':defensa', $defensa);
        $statement->bindParam(':tipo', $tipo);
        $statement->bindParam(':imagen', $imagen);
        if(!empty($poder_especial) || $poder_especial == null) {
            $statement->bindParam(':poder_especial', $poder_especial);
        }

        if(!$statement) {
            return "Error al crear el registro";
        } else {
            $statement->execute();
            return "Carta creada correctamente";
        }
    }

    public function obtenerUsuarios() {
        $sql = "SELECT * FROM cartas";
        $resultado1 = $this->conexion->query($sql);
        echo "<table border='1'>";
        echo "<tr>";
        echo "<th>Nombre</th>";
        echo "<th>Ataque</th>";
        echo "<th>Defensa</th>";
        echo "<th>Tipo</th>";
        echo "<th>Imagen</th>";
        echo "<th>Poder Especial</th>";
        echo "</tr>";
        $query = $this->conexion->prepare($sql);
        $query->execute();
        $resul = $query->fetchAll(PDO::FETCH_OBJ);
        foreach($resul as $carta) {
            echo "<tr>";
            echo "<td> $carta->nombre </td>";
            echo "<td> $carta->ataque </td>";
            echo "<td> $carta->defensa </td>";
            echo "<td> $carta->tipo </td>";
            echo "<td> $carta->imagen </td>";
            echo "<td> $carta->poder_especial </td>";
            echo "</tr>";
        }
        echo "</table>";
    }

    public function obtenerUsuarioPorID($id) {
        $sql = "SELECT * FROM usuarios WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $res = $stmt->fetchAll(PDO::FETCH_ASSOC);
        echo "<table border=1>";
        echo "<tr>";
        echo "<th> Nickname </th>";
        echo "<th> Email </th>";
        echo "<th> Password </th>";
        echo "<th> Imagen </th>";
        echo "<th> Fecha registro </th>";
        echo "</tr>";
        foreach($res as $usuario) {
            echo "<tr>";
            echo "<td>" . $usuario['nickname'] . "</td>";
            echo "<td>" . $usuario['email'] . "</td>";
            echo "<td>" . $usuario['password_'] . "</td>";
            echo "<td>" . $usuario['imagen'] . "</td>";
            echo "<td>" . $usuario['fecha_registro'] . "</td>";
            echo "</tr>";
        }
    }

    public function actualizarUsuario($id, $nombre, $email, $password, $imagen) {
        $sql = "UPDATE usuarios SET nickname = :nombre, email = :email, password_ = :pass, imagen = :imagen WHERE id = :id";
        if($id == null || empty($id)) {
            echo "Debe introducir un id para realizar los cambios";
        } else {
            $passwordEncriptado = sha1($password);
            $stmt = $this->conexion->prepare($sql);
            $stmt->bindParam(':nombre', $nombre);
            $stmt->bindParam(':email', $email);
            $stmt->bindParam(':pass', $passwordEncriptado);
            $stmt->bindParam(':imagen', $imagen);
            $stmt->execute();
        }
    }

    public function eliminarUsuario($id) {
        $sql = "DELETE FROM usuarios WHERE id = :id";
        $stmt = $this->conexion->prepare($sql);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
    }
}
?>