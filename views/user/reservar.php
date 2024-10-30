<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reserva de Vehículo</title>
    <link rel="stylesheet" href="/assets/css/reserva_styles.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
    <link rel="stylesheet" href="https://unpkg.com/leaflet@1.7.1/dist/leaflet.css" />
    <script src="https://unpkg.com/leaflet@1.7.1/dist/leaflet.js"></script>
</head>
<body>
    <div class="container">
        <!-- Menú lateral -->
        <aside class="sidebar">
            <nav>
                <ul>
                    <li><a href="#"><i class="bi bi-house"></i> Inicio</a></li>
                    <li><a href="#"><i class="bi bi-feather"></i> Reservar</a></li>
                    <li><a href="#"><i class="bi bi-calendar-week"></i> Mis Reservas</a></li>
                    <li><a href="#"><i class="bi bi-question-diamond-fill"></i> Ayuda</a></li>
                </ul>
            </nav>
        </aside>
    

        <!-- Contenido principal -->
        <main class="main-content mapeo">
            <h1>Reserva tu lugar de manera rápida y segura</h1>
            <!-- Botón de geolocalización -->
            <button id="useLocationBtn" class="boton"><i class="bi bi-geo-alt"></i> Usar mi ubicación</button>
            <!-- Mapa y zona -->
            <section class="card">
                <div id="map"></div>
                <div id="zonasContainer" class="zonas-container"></div>
                <div id="zonasContent"></div>
            </section>
        </main>

        <!-- Cuadro de monto y botón de pago -->
        <aside class="payment-sidebar">
            <div class="card">
                <h2>Resumen de la Reserva</h2>
                <p id="reservationCode" class="reservation-code">Código: </p>
                <form action="#" class="text-sm">
                    <div class="formData">
                        <p>Usuario</p>
                        <input type="text" id="fullName">
                    </div>
                    <div class="formData">
                        <p>Tiempo de servicio (días)</p>
                        <input type="number" id="dia" min="1" value="1">
                    </div>
                    <div class="formData">
                        <p>Servicio Adicional</p>
                        <select id="additionalService">
                            <option value="">Seleccione-</option>
                            <option value="lavado">Lavado</option>
                            <option value="mantenimiento">Mantenimiento</option>
                        </select>
                    </div>
                    <div class="formData">
                        <p>Tipo de Vehículo</p>
                        <select id="vehicleType">
                            <option value="">Seleccione-</option>
                            <option value="auto">Auto</option>
                            <option value="motocicleta">Motocicleta</option>
                        </select>
                    </div>
                </form>

                <p id="totalAmount" class="total-amount">Total: $0</p>
                <button id="payButton" class="boton">Pagar Ahora</button>

                <div id="paypal-button-container"></div>

                <div class="additional-payment-methods">
                    <button class="Google" id="btn">
                        <span class="button_top"><i class="bi bi-google"></i> Pay</span>
                    </button>
                    <button class="Yape" id="btn">
                        <span class="button_top"><i class="bi bi-brightness-alt-low-fill"></i> Yape</span>
                    </button>
                    <button class="Apple" id="btn">
                        <span class="button_top"><i class="bi bi-apple"></i> Pay</span>
                    </button>
                </div>
            </div>
        </aside>
    </div>

    <!-- Ventana emergente para pago con tarjeta -->
    <div id="paymentModal" class="modal">
        <div class="modal-content">
            <span class="close">&times;</span>
            <h2>Pago con Tarjeta</h2>
            <form id="cardPaymentForm">
                <div class="form-group">
                    <label for="cardNumber">Número de Tarjeta:</label>
                    <input type="text" id="cardNumber" required>
                </div>
                <div class="form-group">
                    <label for="cardName">Nombre en la Tarjeta:</label>
                    <input type="text" id="cardName" required>
                </div>
                <div class="form-row">
                    <div class="form-group">
                        <label for="expiryDate">Fecha de Expiración:</label>
                        <input type="text" id="expiryDate" placeholder="MM/AA" required>
                    </div>
                    <div class="form-group">
                        <label for="cvv">CVV:</label>
                        <input type="text" id="cvv" required>
                    </div>
                </div>
                <button class="pago" type="submit">Pagar</button>
            </form>
        </div>
    </div>

    <!-- Scripts -->
    <script src="https://www.paypal.com/sdk/js?client-id=ATBWApXpdu6qBl7tg0s5A43lSs57-wGfPULgRbryTF7B0fuO1WxWA6CbXc2GUMnuHUUjzMAbiGUZUhw2"></script>
    <script src="https://pay.google.com/gp/p/js/pay.js"></script>
    <script src="/assets/js/reservar_script.js"></script>
</body>
</html>