<?php

$host_db = "sql113.infinityfree.com";
$user_db = "if0_35513266";
$pass_db = "pZ1ynYvQi7q";
$db_name = "if0_35513266_usuarios_db"; 


$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);


if ($conexion->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}


if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    if (isset($_POST["username"])) {
        
        $username = $_POST["username"];

        // Validar que $username no esté vacío
        if (!empty($username)) {
            
            $stmt = $conexion->prepare("DELETE FROM usuarios WHERE username = ?");
            $stmt->bind_param("s", $username);

           
            if ($stmt->execute()) {
                echo "Usuario eliminado correctamente.";
            } else {
                echo "Error al eliminar el usuario: " . $stmt->error;
            }

          
            $stmt->close();
        } else {
            echo "Nombre de usuario no válido.";
        }
    } else {
        echo "Campo 'username' no presente en el formulario.";
    }
}


$consulta_sql = "SELECT * FROM usuarios";


$resultado = $conexion->query($consulta_sql);


$count = mysqli_num_rows($resultado);


echo "<style>";
echo "body { background: linear-gradient(45deg, #FFA500, #FFD700); }";
echo "</style>";

echo "<table border='2' >
        <tr>
            <th>ID</th>
            <th>Username</th>
            <th>Password</th>
        </tr>";

if ($count > 0) {
   
    while ($row = mysqli_fetch_assoc($resultado)) {
        echo "<tr>";
        echo "<td>" . (isset($row['id']) ? $row['id'] : "") . "</td>";
        echo "<td>" . (isset($row['username']) ? $row['username'] : "") . "</td>";
        echo "<td>" . (isset($row['password']) ? $row['password'] : "") . "</td>";
        echo "</tr>";
    }
    echo "</table>";
} else {
    echo "<h1 style='color:red'>Sin Ningún registro</h1>";
}


$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Usuario por Nombre de Usuario</title>
</head>

<body>
    <h2>Eliminar Usuario por Nombre de Usuario</h2>

 
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Nombre de Usuario a Eliminar:</label>
        <input type="text" name="username" required>
        <button type="submit">Eliminar</button>
    </form>

    <a href='index.php'><button>Volver al Index</button></a>
</body>

</html>
