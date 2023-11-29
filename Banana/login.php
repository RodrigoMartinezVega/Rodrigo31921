<?php
session_start();

include("conexion.php"); 

if ($_SERVER["REQUEST_METHOD"] == "POST") {
 
    $username = $_POST["username"];
    $password = $_POST["password"];

    
    $stmt = $conexion->prepare("SELECT id, password FROM usuarios WHERE username=?");

 
    $stmt->bind_param("s", $username);

    
    $stmt->execute();

  
    $result = $stmt->get_result();

   
    if ($result->num_rows == 1) {
        $row = $result->fetch_assoc();
        if (password_verify($password, $row["password"])) {
            echo "Inicio de sesión exitoso";
        } else {
            echo "Contraseña incorrecta";
        }
    } else {
        echo "Usuario no encontrado";
    }

    
    $stmt->close();
}


$conexion->close();


include("conexion.php"); 
$consulta_sql = "SELECT * FROM usuarios";
$resultado = $conexion->query($consulta_sql);
$count = mysqli_num_rows($resultado);


echo "<style>";
echo "body { background: linear-gradient(45deg, #FFD700, #FFA500); }";
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

   
    echo "<br><a href='index.php'><button>Volver al Index</button></a>";
} else {
    echo "<h1 style='color:red'>Sin Ningún registro</h1>";
}
?>
