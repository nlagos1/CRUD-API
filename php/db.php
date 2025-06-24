<?php
$host = "teclab.uct.cl";
$db = "nicolas_lagos_db1";
$user = "nicolas_lagos";
$pass = "nicolas_lagos2025";

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
  die("Error de conexión: " . $conn->connect_error);
}
?>