<?php
include "./auth.php";

$response = file_get_contents('http://teclab.uct.cl/~nicolas.lagos/api/proyectos.php');
$proyectos = json_decode($response, true);

?>
<!DOCTYPE html>
<html lang="es">
<head>…</head>

<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous">
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/js/bootstrap.bundle.min.js" integrity="sha384-k6d4wzSIapyDyv1kpU366/PK5hCdSbCRGRCMv+eplOQJWyd1fbcAu9OCUj5zNLiq" crossorigin="anonymous"></script>
<link rel="stylesheet" href="../assets/css/admin-styles.css">

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
  <section id="project">
    <div class="container text-center">
      <h2 class="text-light">Proyectos</h2>
          <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
            <?php foreach ($proyectos as $p): ?>
              <div class="col">
                <div class="card h-100 shadow-sm">
                  <img src="../uploads/<?= htmlspecialchars($p['imagen']) ?>" class="card-img-top" alt="Imagen del proyecto">
                  <div class="card-body d-flex flex-column">
                    <h5 class="card-title"><?= htmlspecialchars($p['titulo']) ?></h5>
                    <p class="card-text"><?= htmlspecialchars($p['descripcion']) ?></p>
                    <div class="mt-auto">
                      <div class="mb-2">
                        <a href="<?= htmlspecialchars($p['url_github']) ?>" class="btn btn-outline-dark btn-sm me-2" target="_blank">GitHub</a>
                        <a href="<?= htmlspecialchars($p['url_produccion']) ?>" class="btn btn-outline-primary btn-sm" target="_blank">Producción</a>
                      </div>
                      <a href="edit.php?id=<?= htmlspecialchars($p['id']) ?>" class="btn btn-warning btn-sm me-2">Editar</a>
                      <a href="delete.php?id=<?= htmlspecialchars($p['id']) ?>" class="btn btn-danger btn-sm" onclick="return confirm('¿Seguro que deseas eliminar este proyecto?')">Eliminar</a>
                    </div>
                  </div>
                </div>
              </div>
            <?php endforeach; ?>
          </div>
    </div>
  </section>
</body>
</html>
    
