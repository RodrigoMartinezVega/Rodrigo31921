<?php
$host_db = "sql113.infinityfree.com";
$user_db = "if0_35513266";
$pass_db = "pZ1ynYvQi7q";
$db_name = "if0_35513266_usuarios_db"; 

$conexion = new mysqli($host_db, $user_db, $pass_db, $db_name);

if ($conexion->connect_error) {
    echo "<h1>MySQL no te está dando permisos para ejecutar las consultas</h1>";
}
?>