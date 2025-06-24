<?php
include 'auth.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $data = [
        'titulo' => htmlspecialchars(trim($_POST['titulo'] ?? '')),
        'descripcion' => htmlspecialchars(trim($_POST['descripcion'] ?? '')),
        'url_github' => filter_var($_POST['url_github'] ?? '', FILTER_VALIDATE_URL),
        'url_produccion' => filter_var($_POST['url_produccion'] ?? '', FILTER_VALIDATE_URL)
    ];

    // Subida de imagen segura
    if (!empty($_FILES['imagen']['name']) && in_array($_FILES['imagen']['type'], ['image/jpeg', 'image/png', 'image/webp'])) {
        $ext = pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        $imgName = uniqid('img_', true) . '.' . $ext;

        $uploadPath = __DIR__ . "/../uploads/$imgName";
        if (!move_uploaded_file($_FILES['imagen']['tmp_name'], $uploadPath)) {
            die("Error: no se pudo guardar la imagen.");
        }

        $data['imagen'] = $imgName;
    } else {
        die("Error: tipo de archivo no permitido.");
    }

    // Enviar a la API
    $ch = curl_init('https://teclab.uct.cl/~nicolas.lagos/api/proyectos.php');
    curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => json_encode($data)
    ]);

    $response = curl_exec($ch);
    curl_close($ch);

    // Validación de respuesta (opcional)
    $resData = json_decode($response, true);
    if (!isset($resData['success']) || !$resData['success']) {
        die("Error: el proyecto no fue guardado. Respuesta: $response");
    }

    header("Location: admin.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="es">
<head>…</head>
<link rel="stylesheet" href="../assets/css/add-styles.css">
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>

<body>
    <header>
      <a href="./admin.php">
        <img id="logo" src="../assets/images/logo3.png" alt="">
      </a>
    </header>


  <nav class="py-3">
      <ul class="list-inline m-0">
          <li class="list-inline-item mx-3"><a href="add.php">Agregar Proyecto</a></li>
          <li class="list-inline-item mx-3"><a href="logout.php">Cerrar sesión</a></li>
      </ul>
  </nav>

  <section id="add">
    <div class="container">
      <h2 class="text-center mb-4">Agrega un proyecto</h2>
      <div class="row justify-content-center">
        <div class="col-md-6"> 
            <form method="post" enctype="multipart/form-data">
              <label for="">Titulo</label>
              <input class="form-control" type="text" name="titulo" placeholder="Titulo del proyecto" required><br>
              <label class="form-label" for="">Descripcion</label>
              <textarea class="form-control" name="descripcion" maxlength="200" placeholder="Descripción del proyecto(máx 200 palabras)" required></textarea><br>
              <label class="form-label" for="">URL GitHub</label>
              <input class="form-control" type="url" name="url_github" placeholder="URL GitHub"><br>
              <label class="form-label" for="">URL Producción</label>
              <input class="form-control" type="url" name="url_produccion" placeholder="URL Producción"><br>
              <label class="form-label" for="">Adjunte la portada del proyecto</label>
              <input class="form-control" type="file" name="imagen" required><br>
            <button class="btn btn-primary" type="submit">Guardar</button>
        </form>
        </div>
      </div>
    </div>
  </section>
</body>
</html>
