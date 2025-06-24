<?php
include './db.php'; // conexión con $conn
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $username = $_POST['username'];
  $password = md5($_POST['password']); // reemplazar luego por password_hash()

  $sql = "SELECT * FROM users WHERE username='$username' AND password='$password'";
  $result = $conn->query($sql);

  if ($result->num_rows === 1) {
    $_SESSION['user'] = $username;
    header("Location: ./admin.php");
    exit;
  } else {
    $error = "Credenciales incorrectas.";
  }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Login</title>
  <link rel="stylesheet" href="../assets/css/login-styles.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
  <header>
    <a href="../index.php">
      <img id="logo" src="../assets/images/logo2.png" alt="">
    </a>
  </header>

  <section id="login">
    <div class="container">
      <h2 class="text-center mb-4">Inicia Sesión!</h2>
      <?php if (!empty($error)): ?>
        <div class="alert alert-danger text-center"><?= $error ?></div>
      <?php endif; ?>
      <div class="row justify-content-center">
        <div class="col-md-6">
          <form method="post">
            <input class="form-control mb-3" type="text" name="username" placeholder="Usuario" required>
            <input class="form-control mb-3" type="password" name="password" placeholder="Contraseña" required>
            <button class="btn btn-primary w-100" type="submit">Iniciar Sesión</button>
          </form>
        </div>
      </div>
    </div>
  </section>
</body>
</html>
