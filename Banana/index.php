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

        img {
            width: 200px;
           
            height: auto;
            margin-bottom: 20px;
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
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }
    </style>
</head>

<body>

    <img src="https://c.tenor.com/zVMkNY-4MXcAAAAC/tenor.gif" alt="Banana">
    <h1 style="color: rgb(235, 235, 243); text-align: center;">Welcome to banana !!!</h1>
 
    <form action="login.php" method="POST">
        <h2>Iniciar Sesión</h2>
        <label for="login_username">Usuario:</label>
        <input type="text" id="login_username" name="username" required>
        <br>
        <label for="login_password">Contraseña:</label>
        <input type="password" id="login_password" name="password" required>
        <br>
        <button type="submit">Iniciar Sesión</button>
    </form>

    <form action="registro.php" method="POST">
        <h2>Registrarse</h2>
        <label for="registro_username">Usuario:</label>
        <input type="text" id="registro_username" name="username" required>
        <br>
        <label for="registro_password">Contraseña:</label>
        <input type="password" id="registro_password" name="password" required>
        <br>
        <button type="submit">Registrarse</button>
    </form>

    <form action="eliminar.php" method="POST">
        <h2>Eliminar Usuario</h2>
        <label for="eliminar_username">Usuario a eliminar:</label>
        <input type="text" id="eliminar_username" name="username" required>
        <br>
        <button type="submit">Eliminar Usuario</button>
    </form>

   
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

    <button id="btnActualizarPagina">Actualizar Página</button>

    <script>
        
        $('#btnActualizarPagina').on('click', function () {
            location.reload(true); 
        });
    </script>
</body>

</html>
