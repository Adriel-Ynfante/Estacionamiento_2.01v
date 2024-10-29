<?php
// Variables de configuración
$siteName = "Perseo";
$siteEmail = "perseoparking@gmail.com";
$sitePhone = "999 888 777";
$siteAddress = "Piura";
$currentYear = date('Y');
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php echo $siteName; ?> - Estacionamiento</title>
    <link rel="stylesheet" href="assets/css/index_styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css">
</head>
<body>
    <header>
        <h2 class="logo"><?php echo $siteName; ?></h2>
        <nav class="navegacion">
            <a href="#">Reservar</a>
            <a href="#" class="open-card1">Informacion</a>
            <a href="#" class="open-card2">Contactos</a>
            <a href="/views/user/login_register.php">login_register</a>
            <button class="btn">Iniciar Sesion</button>
        </nav>
    </header>

    <!-- Carta emergente Información -->
    <div class="popup-overlay" id="popup1">
        <div class="popup-content">
            <span class="close-btn" id="close-btn1">&times;</span>
            <h2 class="card-title">Informacion</h2>
            <p class="card_content">
                <p>En <?php echo $siteName; ?>, ofrecemos un espacio seguro y conveniente para aparcar su vehículo. 
                Nuestra ubicación estratégica en el corazón de <?php echo $siteAddress; ?> facilita el acceso a tiendas, 
                restaurantes y atracciones locales.</p>
            </p><br>
            <img class="card_img" src="https://aws-images-prod.sindonews.net/dyn/600/pena/sindo-article/original/2022/05/18/ANIME0357.jpg" alt="El mejor guerrero">
        </div>
    </div>

    <!-- Carta emergente Contacto -->
    <div class="popup-overlay" id="popup2">
        <div class="popup-content">
            <span class="close-btn" id="close-btn2">&times;</span>
            <h2 class="card-title">Contacto</h2>
            <p class="card_content">
                <strong>¿Tienes preguntas o necesitas más información? ¡Estamos aquí para ayudarte!</strong>
                <br>
                <p><i class="bi bi-telephone"></i> Teléfono: <strong><?php echo $sitePhone; ?></strong></p>
                <p><i class="bi bi-envelope-at-fill"></i> Correo Electrónico: 
                   <a href="mailto:<?php echo $siteEmail; ?>"><?php echo $siteEmail; ?></a></p>
                <p><i class="bi bi-geo-alt"></i> Dirección: <strong><?php echo $siteAddress; ?></strong></p>
                <p><i class="bi bi-calendar-event"></i> Horario de Atención: 
                   <strong>Todos los días de la semana, excepto feriados</strong></p>
                <br>
            </p>
            <img class="card_img" src="https://th.bing.com/th/id/OIP.68ZuqWqBIn-WpMRrwkGcIQHaD5?rs=1&pid=ImgDetMain" alt="El mejor guerrero">
        </div>
    </div>

    <main>
        <section>
            <h2><?php echo $siteName; ?></h2>
            <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nihil facere eaque odio laborum dignissimos 
                placeat ad totam dicta. Eligendi dicta ipsam voluptas necessitatibus officia quo, voluptatem quia 
                enim tempora corporis.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima nihil impedit, quibusdam aut quo non 
                accusantium iste omnis saepe accusamus, necessitatibus explicabo quasi doloremque voluptatibus sint 
                consequuntur natus quaerat. Officiis?
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Mollitia distinctio saepe sequi vero quisquam 
                aperiam maiores facilis, recusandae voluptates quis laudantium vel voluptatum amet fugit suscipit 
                soluta possimus praesentium optio!
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Iste aliquid exercitationem ea corrupti 
                blanditiis placeat eius obcaecati quis porro officia sint reiciendis quidem architecto quasi 
                laudantium, possimus minima incidunt. Repudiandae.
            </p>
        </section>

        <section>
            <p>
                Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nihil facere eaque odio laborum dignissimos 
                placeat ad totam dicta. Eligendi dicta ipsam voluptas necessitatibus officia quo, voluptatem quia 
                enim tempora corporis.
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Minima nihil impedit, quibusdam aut quo non 
                accusantium iste omnis saepe accusamus, necessitatibus explicabo quasi doloremque voluptatibus sint 
                consequuntur natus quaerat. Officiis?
            </p>
        </section>

        <span class="span">DESCUBRE LO QUE TENEMOS PARA TI</span>

        <article>
            <section>
                <h2>Para empresas</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum cumque aut, cupiditate vel 
                    accusantium pariatur? Totam, similique porro eius, necessitatibus dolores perferendis 
                    inventore quos vel temporibus autem ipsam delectus aliquam.
                </p>
                <button class="btn2">Ver productos</button>
            </section>

            <section>
                <h2>Para personas</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum cumque aut, cupiditate vel 
                    accusantium pariatur? Totam, similique porro eius, necessitatibus dolores perferendis 
                    inventore quos vel temporibus autem ipsam delectus aliquam.
                </p>
                <button class="btn2">Ver productos</button>
            </section>
        </article>

        <section class="info-final">
            <p>Tu vehículo merece lo mejor. Confía en <?php echo $siteName; ?> para una experiencia de 
               estacionamiento segura, conveniente y económica. ¡Te esperamos!</p>
        </section>

        <article>
            <section>
                <h2>¿Por que nosostros?</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum cumque aut, cupiditate vel 
                    accusantium pariatur? Totam, similique porro eius, necessitatibus dolores perferendis 
                    inventore quos vel temporibus autem ipsam delectus aliquam.
                </p>
            </section>

            <section>
                <h2>Ofertas</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum cumque aut, cupiditate vel 
                    accusantium pariatur? Totam, similique porro eius, necessitatibus dolores perferendis 
                    inventore quos vel temporibus autem ipsam delectus aliquam.
                </p>
            </section>

            <section>
                <h2>Reglas</h2>
                <p>
                    Lorem ipsum dolor sit amet, consectetur adipisicing elit. Harum cumque aut, cupiditate vel 
                    accusantium pariatur? Totam, similique porro eius, necessitatibus dolores perferendis 
                    inventore quos vel temporibus autem ipsam delectus aliquam.
                </p>
            </section>
        </article>
    </main>

    <footer class="datos">
        <div class="contenido">
            <p>© <?php echo $currentYear; ?> <?php echo $siteName; ?>. Derechos reservados.</p>
            <nav class="flex items-center gap-4">
                <a class="servicios" href="#">Terminos de Servicio</a>
                <a class="politicas" href="#">Politicas de privacidad</a>
            </nav>
        </div>
    </footer>

    <script src="assets/js/index_script.js></script>
</body>
</html>