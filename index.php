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
            <button class="btn"> <a href="/views/user/login_register.php">Iniciar Sesion</a></button>
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
            Bienvenidos a ParkSeo, el estacionamiento premium que revoluciona la forma de cuidar tu vehículo. 
            Nuestras instalaciones de última generación cuentan con tecnología de vigilancia 24/7, iluminación 
            LED inteligente y sistemas automatizados de control de acceso que garantizan la máxima seguridad 
            para tu automóvil.

            Ubicados estratégicamente en el corazón de la ciudad, ofrecemos más que un simple espacio de 
            estacionamiento: brindamos una experiencia completa de servicio y tranquilidad. Nuestro personal 
            altamente capacitado está siempre disponible para asistirte, mientras que nuestras amplias bahías 
            de estacionamiento aseguran la integridad de tu vehículo.

            Con certificación de calidad ISO 9001 y reconocidos con 5 estrellas por la Asociación Internacional 
            de Estacionamientos, ParkSeo establece el estándar en servicios de estacionamiento de primera clase.
            Disfruta de nuestras instalaciones climatizadas, sistema de reserva en línea y servicios adicionales 
            que hacen de cada visita una experiencia excepcional.
        </p>
    </section>

    <section>
        <p>
            En ParkSeo, la innovación se encuentra con la seguridad. Nuestro sistema de circuito cerrado con 
            más de 100 cámaras de alta definición, guardias de seguridad certificados y control biométrico de 
            acceso garantizan la protección total de tu vehículo. Además, nuestro seguro de cobertura completa 
            te brinda la tranquilidad que mereces durante tu estancia.
        </p>
    </section>

    <span class="span">DESCUBRE LO QUE TENEMOS PARA TI</span>

    <article>
        <section>
            <h2>Para empresas</h2>
            <p>
                Optimiza la gestión de tu flota empresarial con nuestros planes corporativos personalizados. 
                Ofrecemos espacios reservados, facturación centralizada, reportes detallados de uso y acceso 
                prioritario. Nuestro servicio de valet parking y sistema de gestión en tiempo real maximizarán 
                la eficiencia de tus operaciones vehiculares.
            </p>
            <button class="btn2">Ver productos</button>
        </section>

        <section>
            <h2>Para personas</h2>
            <p>
                Disfruta de una experiencia de estacionamiento sin preocupaciones con nuestras membresías 
                personales. Incluyen lavado básico mensual, servicio de recarga para vehículos eléctricos, 
                asistencia vehicular de emergencia y acceso a nuestra sala de espera VIP con café gourmet 
                gratuito y Wi-Fi de alta velocidad.
            </p>
            <button class="btn2">Ver productos</button>
        </section>
    </article>

    <section class="info-final">
        <p>Tu vehículo merece lo mejor. Confía en <?php echo $siteName; ?> para una experiencia de 
           estacionamiento 5 estrellas con la máxima seguridad y comodidad. ¡Te esperamos en ParkSeo, donde tu 
           tranquilidad es nuestra prioridad!</p>
    </section>

    <article>
        <section>
            <h2>¿Por qué nosotros?</h2>
            <p>
                Elegir ParkSeo significa optar por la excelencia. Somos el único estacionamiento de la ciudad 
                con certificación 5 estrellas, sistema anti-incendios de última generación y seguro de 
                cobertura total. Nuestro compromiso con la satisfacción del cliente se refleja en nuestra 
                calificación perfecta en servicios y atención personalizada.
            </p>
        </section>

        <section>
            <h2>Ofertas</h2>
            <p>
                Aprovecha nuestras promociones exclusivas: 50% de descuento en tu primer mes de membresía, 
                tarifas preferenciales para estancias largas, y paquetes especiales de fin de semana. 
                Regístrate en nuestra aplicación móvil y obtén beneficios adicionales como reservas 
                prioritarias y puntos canjeables por servicios premium.
            </p>
        </section>

        <section>
            <h2>Reglas</h2>
            <p>
                Para garantizar una experiencia excepcional, mantenemos estándares estrictos de seguridad y 
                servicio. Contamos con protocolos de sanitización constante, espacios especialmente diseñados 
                para vehículos de lujo y sistema de monitoreo ambiental. Tu seguridad y satisfacción son 
                nuestra prioridad.
            </p>
        </section>
    </article>
</main>
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

    <script src="assets/js/index_script.js"></script>
</body>
</html>