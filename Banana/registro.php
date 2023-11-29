<?php
session_start();

include("conexion.php"); 
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $username = $_POST["username"];
    $password = password_hash($_POST["password"], PASSWORD_DEFAULT);

    
    $stmt = $conexion->prepare("INSERT INTO usuarios (username, password) VALUES (?, ?)");

    
    $stmt->bind_param("ss", $username, $password);

    
    if ($stmt->execute()) {
        echo "Usuario registrado exitosamente";
    } else {
        echo "Error al registrar el usuario";
    }

    
    $stmt->close();
}


$conexion->close();
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de Usuarios</title>
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <style>
        body {
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(45deg, #FFD700, #FFA500);
        }


        form {
            text-align: center;
            margin: 20px;
            width: 45%;
        }

        table {
            border-collapse: collapse;
            width: 45%;
            margin: 20px;
        }

        th,
        td {
            border: 1px solid #fff;
            padding: 10px;
            background-color: #fff;
            color: #333;
        }

        button {
            margin-top: 20px;
            padding: 10px;
            background-color: #FFA500;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>
   


    <?php
  
    require "conexion.php";
    mysqli_set_charset($conexion, 'utf8');

 
    $consulta_sql = "SELECT * FROM usuarios";

 
    $resultado = $conexion->query($consulta_sql);

 
    $count = mysqli_num_rows($resultado);

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


    <a href="index.php"><button>Volver al Inicio</button></a>

</body>

</html>
