<?php
include 'auth.php';

if (!isset($_GET['id'])) {
    die("Error: No se especificó el ID del proyecto.");
}

$id = intval($_GET['id']);

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, "https://teclab.uct.cl/~nicolas.lagos/api/proyectos.php?id=$id");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$json = curl_exec($ch);
if ($json === false) {
    die("Error al obtener datos: " . curl_error($ch));
}
curl_close($ch);

$proyectos = json_decode($json, true);
if (json_last_error() !== JSON_ERROR_NONE || empty($proyectos)) {
    die("Error al decodificar JSON o el proyecto no existe.");
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $data = [
        'titulo' => htmlspecialchars(trim($_POST['titulo'] ?? '')),
        'descripcion' => htmlspecialchars(trim($_POST['descripcion'] ?? '')),
        'url_github' => filter_var($_POST['url_github'] ?? '', FILTER_VALIDATE_URL),
        'url_produccion' => filter_var($_POST['url_produccion'] ?? '', FILTER_VALIDATE_URL)
    ];

    if (!empty($_FILES['imagen']['name']) && in_array($_FILES['imagen']['type'], ['image/jpeg', 'image/png', 'image/webp'])) {
        $imgName = uniqid('img_', true) . '.' . pathinfo($_FILES['imagen']['name'], PATHINFO_EXTENSION);
        move_uploaded_file($_FILES['imagen']['tmp_name'], "uploads/$imgName");
        $data['imagen'] = $imgName;
    }

    $ch = curl_init("https://teclab.uct.cl/~nicolas.lagos/api/proyectos.php?id=$id");
    curl_setopt_array($ch, [
        CURLOPT_POST => true,
        CURLOPT_HTTPHEADER => ['Content-Type: application/json'],
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_POSTFIELDS => json_encode($data)
    ]);

    echo "<h3>Datos enviados a la API:</h3>";
    echo "<pre>";
    echo "URL: https://teclab.uct.cl/~nicolas.lagos/api/proyectos.php?id=$id\n";
    print_r($data);
    echo "</pre>";

    $response = curl_exec($ch);
    if ($response === false) {
        die("Error en POST: " . curl_error($ch));
    }

    echo "<h3>Respuesta de la API:</h3>";
    echo "<pre>";
    echo $response;
    echo "</pre>";

    curl_close($ch);

    header("Location: admin.php");
    exit;
}

?>

  <!DOCTYPE html>
  <html lang="es"></html>
  <link rel="stylesheet" href="../assets/css/edit-styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
  
  <body>

    <header>
            <a href="./admin.php" ><img src="../assets/images/logo3.png" alt=""></a>
    </header>

    <nav class="py-3">
        <ul class="list-inline m-0">
            <li class="list-inline-item mx-3"><a href="add.php">Agregar Proyecto</a></li>
            <li class="list-inline-item mx-3"><a href="logout.php">Cerrar sesión</a></li>
        </ul>
    </nav>



    <section id="edit">
      <div class="container">
        <h2 class="text-center mb-4">Editar</h2>
        <div class="row justify-content-center">
          <form method="post" enctype="multipart/form-data">
            <label class="form-label">Título del proyecto</label>
            <input class="form-control" type="text" name="titulo" value="<?= htmlspecialchars($proyectos['titulo'] ?? '') ?>" required><br>

            <label class="form-label">Descripción del proyecto</label>
            <textarea class="form-control" name="descripcion"><?= htmlspecialchars($proyectos['descripcion'] ?? '') ?></textarea><br>

            <label class="form-label" for="">URL de GitHub</label>
            <input class="form-control" type="url" name="url_github" value="<?= htmlspecialchars($proyectos['url_github'] ?? '') ?>"><br>

            <label class="form-label">URL Producción</label>
            <input class="form-control" type="url" name="url_produccion" value="<?= htmlspecialchars($proyectos['url_produccion'] ?? '') ?>"><br>
            
            <?php if (!empty($proyectos['imagen'])): ?>
              <div class="mb-3">
                <label class="form-label d-block">Portada actual:</label>
                <img src="uploads/<?= htmlspecialchars($proyectos['imagen']) ?>" alt="Portada actual" class="img-thumbnail" style="max-width: 200px;">
              </div>
            <?php endif; ?>

            <label class="form-label">Adjunte la portada del proyecto</label>

            <input class="form-control" type="file" name="imagen"><br>


            <button class="btn btn-primary" type="submit">Actualizar</button>
          </form>
        </div>
      </div>
    </section>

</body>