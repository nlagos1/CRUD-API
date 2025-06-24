<?php

$ch = curl_init();
curl_setopt($ch, CURLOPT_URL, 'https://teclab.uct.cl/~nicolas.lagos/api/proyectos.php');
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
$json = curl_exec($ch);
curl_close($ch);

$proyectos = json_decode($json, true);

?>

<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta name="description" content="Nicolas Lagos, estudiante de Técnico Universitario en Informática. Muestra proyectos en desarrollo web y habilidades en HTML5, CSS3, JavaScript, y React.js." />
        <title>Portafolio de Nicolas Lagos - Desarrollador Web | Diseño Web y Programación</title>
        <meta name="robots" content="index, follow">
        <script type="application/ld+json">
        {
            "@context": "https://schema.org",
            "@type": "Person",
            "name": "Nicolas Lagos",
            "jobTitle": "Desarrollador Web",
            "url": "www.https://teclab.uct.cl/~/nicolas.lagos/",
            "image": "https://i.pinimg.com/736x/14/e4/ba/14e4bac387d6776401d02262fad7cb97.jpg",
            "description": "Estudiante de Técnico Universitario en Informática con pasión por el diseño web y desarrollo frontend."
        }
        </script>
        <link rel="stylesheet" href="./assets/css/index-styles.css" />
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css"/>
        <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.5/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-SgOJa3DmI69IUzQ2PVdRZhwQ+dy64/BUtbMJw1MZ8t5HZApcHrRKUc4W0kG879m7" crossorigin="anonymous" />
    </head>
    

    <body id="light-mode">
        <header>
        </header>

        <nav class="py-3">
            <ul class="list-inline m-0">
                <li class="list-inline-item mx-3"><a href="#perfil">Descripción</a></li>
                <li class="list-inline-item mx-3"><a href="#skills">Habilidades</a></li>
                <li class="list-inline-item mx-3"><a href="#projects">Proyectos</a></li>
                <li><button id="redirectBtn" class="btn btn-outline-light">admin</button></li>
            </ul>
        </nav>

        <div class="position-absolute top-0 end-0 p-3">
            <button id="modoToggle" class="btn btn-outline-light"><i class="fa-solid fa-moon"></i></button>
        </div>

        <main class="container py-4">
            <section class="home" id="home">
                <div class="home-img">
                    <img src="assets\images\lightmode.jpg" alt="Foto de perfil" id="perfil-img">
                </div>

                <div class="home-content">
                    <h1>Hola, soy <span>Nicolas Lagos</span></h1>
                    <h3 class="typing-text">Lorem ipsum dolor sit amet consectetur, adipisicing elit. Eos magni in saepe, ducimus beatae rerum quod optio consequuntur sed dolorum maxime omnis, adipisci molestias laboriosam molestiae quidem? Doloribus, numquam soluta?</h3>
                    <div class="social-icon">
                        <a href="https://www.github.com/nlagos1/"><i class="fa-brands fa-github"></i></a>
                        <a href="https://www.x.com/asciifer_dev/"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="https://www.instagram.com/asciifer/"><i class="fa-brands fa-instagram"></i></a>
                    </div>
                    <a href="#contact" class="btn">Contactame!</a>
                </div>
            </section>

<section id="skills" class="mb-5">
            <h2 class="mb-4">Habilidades</h2>
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="card bg-dark text-white h-100 shadow skill-card">
                        <div class="card-body text-center">
                            <i class="fab fa-html5 fa-3x mb-3 text-warning"></i>
                            <h5 class="card-title">HTML5</h5>
                            <p class="card-text">Maquetado semántico, accesible y adaptado a SEO.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-dark text-white h-100 shadow skill-card">
                        <div class="card-body text-center">
                            <i class="fab fa-css3-alt fa-3x mb-3 text-primary"></i>
                            <h5 class="card-title">CSS3</h5>
                            <p class="card-text">Diseños responsivos, animaciones, gradientes y efectos modernos.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-dark text-white h-100 shadow skill-card">
                        <div class="card-body text-center">
                            <i class="fab fa-js-square fa-3x mb-3 text-warning"></i>
                            <h5 class="card-title">JavaScript</h5>
                            <p class="card-text">Lógica funcional, manipulación del DOM, asincronía y APIs.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-dark text-white h-100 shadow skill-card">
                        <div class="card-body text-center">
                            <i class="fab fa-react fa-3x mb-3 text-info"></i>
                            <h5 class="card-title">React.js</h5>
                            <p class="card-text">Componentes reutilizables, hooks, estados y enrutamiento.</p>
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="card bg-dark text-white h-100 shadow skill-card">
                        <div class="card-body text-center">
                            <i class="fab fa-bootstrap fa-3x mb-3 text-purple"></i>
                            <h5 class="card-title">Bootstrap</h5>
                            <p class="card-text">Diseño rápido y eficiente con grillas y componentes predefinidos.</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>

            <section id="projects" class="mb-5">
                <h2>Proyectos</h2>
                <div class="row row-cols-1 row-cols-sm-2 row-cols-lg-3 g-4">
    
                <?php foreach ($proyectos as $p): ?>
                    <div class="col">
                        <div class="card h-100 shadow-sm">
                            <img src="uploads/<?= htmlspecialchars($p['imagen']) ?>" class="card-img-top" alt="Imagen del proyecto">
                            <div class="card-body d-flex flex-column">
                            <h5 class="card-title"><?= htmlspecialchars($p['titulo']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($p['descripcion']) ?></p>
                            <div class="mt-auto">
                                <div class="mb-2">
                                <a href="<?= htmlspecialchars($p['url_github']) ?>" class="btn btn-outline-dark btn-sm me-2" target="_blank">GitHub</a>
                                <a href="<?= htmlspecialchars($p['url_produccion']) ?>" class="btn btn-outline-primary btn-sm" target="_blank">Producción</a>
                                </div>
                            </div>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>
                </div>
            </section>

            <section id="contact">
                <div class="container">
                <h2 class="text-center mb-4">¡Contáctanos!</h2>
                <div class="row justify-content-center">
                    <div class="col-md-6">
                    <form>
                        <div class="mb-3">
                        <label for="nombre" class="form-label">Nombre</label>
                        <input type="text" class="form-control" id="nombre" name="nombre" placeholder="Tu nombre">
                        </div>
                        <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="ejemplo@correo.com">
                        </div>
                        <div class="mb-3">
                        <label for="telefono" class="form-label">Número de Teléfono</label>
                        <input type="tel" class="form-control" id="telefono" name="telefono" placeholder="+56912345678">
                        </div>
                        <div class="mb-3">
                        <label for="mensaje" class="form-label">Mensaje</label>
                        <textarea class="form-control" id="mensaje" name="mensaje" rows="3" placeholder="Escribe tu mensaje..."></textarea>
                        </div>
                        <input class="btn btn-primary" type="submit" value="Enviar">
                    </form>
                    </div>
                </div>
                </div>
            </section>

            <script src="./assets/js/script.js"></script>
            <script src="./assets/js/mode.js"></script>
            <script src="./assets/js/redirect.js"></script>
        </main>

        <footer>
            <p>© 2025 Nicolas L. Todos los derechos reservados.</p>
        </footer>
</body>
</html>
