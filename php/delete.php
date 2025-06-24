<?php
if (!isset($_GET['id'])) {
    die("Error: No se especificó el ID del proyecto.");
}

$id = intval($_GET['id']);

$ch = curl_init("https://teclab.uct.cl/~nicolas.lagos/api/proyectos.php?id=$id");

curl_setopt_array($ch, [
    CURLOPT_CUSTOMREQUEST => 'DELETE',
    CURLOPT_RETURNTRANSFER => true
]);

$response = curl_exec($ch);

if ($response === false) {
    die("Error al eliminar: " . curl_error($ch));
}

curl_close($ch);

$data = json_decode($response, true);

if (!isset($data['success']) || !$data['success']) {
    die("Error: la API no confirmó la eliminación. Respuesta: $response");
}

header("Location: ./admin.php");
exit;
?>
