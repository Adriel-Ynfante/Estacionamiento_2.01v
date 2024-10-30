document.addEventListener('DOMContentLoaded', () => {
    const zonas = [
        { name: "Hospital Regional de Piura", lat: -5.1767, lon: -80.6339 },
        { name: "Centro de Piura", lat: -5.1944, lon: -80.6328 },
        { name: "Plaza de Armas de Piura", lat: -5.2044, lon: -80.6328 },
        { name: "Centro Comercial Open Plaza", lat: -5.1944, lon: -80.6228 },
        { name: "Universidad de Piura", lat: -5.1944, lon: -80.6428 }
    ];

    let parkingSpaces = {
        "Hospital Regional de Piura": Array(10).fill(null).map((_, index) => ({ id: index, status: Math.random() > 0.3 ? 'available' : 'occupied' })),
        "Centro de Piura": Array(10).fill(null).map((_, index) => ({ id: index, status: Math.random() > 0.3 ? 'available' : 'occupied' })),
        "Plaza de Armas de Piura": Array(10).fill(null).map((_, index) => ({ id: index, status: Math.random() > 0.3 ? 'available' : 'occupied' })),
        "Centro Comercial Open Plaza": Array(10).fill(null).map((_, index) => ({ id: index, status: Math.random() > 0.3 ? 'available' : 'occupied' })),
        "Universidad de Piura": Array(10).fill(null).map((_, index) => ({ id: index, status: Math.random() > 0.3 ? 'available' : 'occupied' })),
    };

    const tarifas = {
        "Hospital Regional de Piura": 20,
        "Centro de Piura": 15,
        "Plaza de Armas de Piura": 10,
        "Centro Comercial Open Plaza": 12,
        "Universidad de Piura": 18
    };

    let selectedZone = zonas[0].name;
    let reservaCode = '';

    const zonasContainer = document.getElementById('zonasContainer');
    const zonasContent = document.getElementById('zonasContent');
    const codigoInput = document.getElementById('reservationCode');
    const pagarTarjetaBtn = document.getElementById('payButton');
    const totalAmountElement = document.getElementById('totalAmount');

    // Initialize OpenStreetMap
    const map = L.map('map').setView([-5.1944, -80.6328], 13);

    L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
        attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
    }).addTo(map);

    // Add markers for zones
    const zoneMarkers = zonas.map(zona => {
        return L.marker([zona.lat, zona.lon]).addTo(map)
            .bindPopup(zona.name)
            .on('click', () => selectZone(zona.name));
    });

    function generarCodigo() {
        reservaCode = Math.random().toString(36).substring(2, 8).toUpperCase();
        codigoInput.textContent = `Código: ${reservaCode}`;
    }

    function calcularMonto() {
        const dias = parseInt(document.getElementById('dia').value) || 1;
        const tipoVehiculo = document.getElementById('vehicleType').value;
        const tarifa = tarifas[selectedZone];

        let monto = tarifa * dias;
        if (tipoVehiculo === "motocicleta") {
            monto *= 0.8; // Descuento para motocicletas
        }
        totalAmountElement.textContent = `Total: $${monto.toFixed(2)}`;
        return monto.toFixed(2);
    }

    function renderZonas() {
        zonasContainer.innerHTML = zonas.map(zona => `
            <div class="zona-template ${zona.name === selectedZone ? 'selected' : ''}" onclick="selectZone('${zona.name}')">
                <h3>${zona.name}</h3>
                <p>Tarifa: $${tarifas[zona.name]}/día</p>
                <p>Espacios: ${parkingSpaces[zona.name].filter(space => space.status === 'available').length}</p>
            </div>
        `).join('');

        zonasContent.innerHTML = `
            <div class="zona-info">
                <h3>${selectedZone}</h3>
                <p>Selecciona un espacio disponible:</p>
                <div class="parking-grid">
                    ${parkingSpaces[selectedZone].map(space => `
                        <div class="parking-space ${space.status}">
                            <button onclick="selectSpace('${selectedZone}', ${space.id})" ${space.status === 'occupied' ? 'disabled' : ''} 
                                    class="${space.status} ${space.status === 'selected' ? 'selected-space' : ''}">
                                ${space.id + 1}
                            </button>
                        </div>
                    `).join('')}
                </div>
            </div>
        `;
    }

    window.selectZone = (zona) => {
        selectedZone = zona;
        renderZonas();
        calcularMonto();
        zoneMarkers.forEach(marker => {
            if (marker.getPopup().getContent() === zona) {
                marker.openPopup();
                map.setView([marker.getLatLng().lat, marker.getLatLng().lng], 14);
            } else {
                marker.closePopup();
            }
        });
    };

    window.selectSpace = (zona, spaceId) => {
        const space = parkingSpaces[zona].find(space => space.id === spaceId);
        if (space) {
            if (space.status === 'available') {
                parkingSpaces[zona] = parkingSpaces[zona].map(s => 
                    s.id === spaceId ? { ...s, status: 'selected' } :
                    s.status === 'selected' ? { ...s, status: 'available' } : s
                );
            } else if (space.status === 'selected') {
                parkingSpaces[zona] = parkingSpaces[zona].map(s => 
                    s.id === spaceId ? { ...s, status: 'available' } : s
                );
            }
    
            renderZonas();
            generarCodigo();
            calcularMonto();
        }
    };

    document.getElementById('dia').addEventListener('input', calcularMonto);
    document.getElementById('vehicleType').addEventListener('change', calcularMonto);

    pagarTarjetaBtn.addEventListener('click', (e) => {
        e.preventDefault();
        const paymentModal = document.getElementById('paymentModal');
        paymentModal.style.display = 'block';
    });

    const closeModal = document.querySelector('.close');
    closeModal.addEventListener('click', () => {
        const paymentModal = document.getElementById('paymentModal');
        paymentModal.style.display = 'none';
    });

    // Función para calcular la distancia entre dos puntos geográficos
    function calcularDistancia(lat1, lon1, lat2, lon2) {
        const R = 6371; // Radio de la Tierra en km
        const dLat = (lat2 - lat1) * Math.PI / 180;
        const dLon = (lon2 - lon1) * Math.PI / 180;
        const a = Math.sin(dLat/2) * Math.sin(dLat/2) +
                  Math.cos(lat1 * Math.PI / 180) * Math.cos(lat2 * Math.PI / 180) *
                  Math.sin(dLon/2) * Math.sin(dLon/2);
        const c = 2 * Math.atan2(Math.sqrt(a), Math.sqrt(1-a));
        return R * c; // Distancia en km
    }

    // Función para encontrar la zona más cercana
    function encontrarZonaMasCercana(userLat, userLon) {
        let zonaMasCercana = zonas[0];
        let distanciaMinima = calcularDistancia(userLat, userLon, zonas[0].lat, zonas[0].lon);

        for (let i = 1; i < zonas.length; i++) {
            const distancia = calcularDistancia(userLat, userLon, zonas[i].lat, zonas[i].lon);
            if (distancia < distanciaMinima) {
                distanciaMinima = distancia;
                zonaMasCercana = zonas[i];
            }
        }

        return zonaMasCercana;
    }

    // Función para obtener la ubicación del usuario y seleccionar la zona más cercana
    function obtenerUbicacionYSeleccionarZona() {
        if ("geolocation" in navigator) {
            navigator.geolocation.getCurrentPosition(function(position) {
                const userLat = position.coords.latitude;
                const userLon = position.coords.longitude;
                
                const zonaMasCercana = encontrarZonaMasCercana(userLat, userLon);
                selectZone(zonaMasCercana.name);
                
                // Agregar marcador de la ubicación del usuario
                L.marker([userLat, userLon]).addTo(map)
                    .bindPopup('Tu ubicación')
                    .openPopup();

                // Centrar el mapa en la ubicación del usuario
                map.setView([userLat, userLon], 14);
            }, function(error) {
                console.error("Error al obtener la ubicación:", error);
                alert("No se pudo obtener tu ubicación. Por favor, selecciona una zona manualmente.");
            });
        } else {
            console.error("Geolocalización no soportada por este navegador.");
            alert("Tu navegador no soporta geolocalización. Por favor, selecciona una zona manualmente.");
        }
    }

    // Botón para obtener la ubicación y seleccionar la zona más cercana
    const ubicacionBtn = document.createElement('button');
    ubicacionBtn.textContent = 'Usar mi ubicación';
    ubicacionBtn.addEventListener('click', obtenerUbicacionYSeleccionarZona);
    document.body.insertBefore(ubicacionBtn, zonasContainer);

    renderZonas();

    setTimeout(() => {
        map.invalidateSize();
    }, 0);

    // PayPal
    if (typeof paypal !== 'undefined') {
        const total = calcularMonto(); // Obtener el total actualizado
        paypal.Buttons({
            style: { layout: 'horizontal' },
            createOrder: (data, actions) => {
                return actions.order.create({
                    purchase_units: [{
                        amount: { value: total.toString() }
                    }]
                });
            },
            onApprove: (data, actions) => {
                return actions.order.capture().then((details) => {
                    alert('Transacción completada por ' + details.payer.name.given_name);
                });
            },
            onCancel: (data) => {
                alert('Pago cancelado');
            }
        }).render('#paypal-button-container');
    }

    // Google Pay
    let googlePayClient;

    function onGooglePayLoaded() {
        if (typeof google !== 'undefined' && google.payments && google.payments.api) {
            googlePayClient = new google.payments.api.PaymentsClient({
                environment: 'TEST'
            });

            const clientConfiguration = {
                apiVersion: 2,
                apiVersionMinor: 0,
                allowedPaymentMethods: [cardPaymentMethod]
            };

            googlePayClient.isReadyToPay(clientConfiguration)
                .then((response) => {
                    if (response.result) {
                        const button = document.querySelector('.Google');
                        if (button) {
                            button.addEventListener('click', onGooglePayButtonClicked);
                        }
                    }
                })
                .catch((err) => {
                    console.error('Error al verificar Google Pay:', err);
                });
        }
    }

    const cardPaymentMethod = {
        type: 'CARD',
        parameters: {
            allowedAuthMethods: ['PAN_ONLY', 'CRYPTOGRAM_3DS'],
            allowedCardNetworks: ['VISA', 'MASTERCARD']
        }
    };

    function onGooglePayButtonClicked() {
        const total = calcularMonto(); // Obtener el total actualizado
        const paymentDataRequest = {
            apiVersion: 2,
            apiVersionMinor: 0,
            allowedPaymentMethods: [cardPaymentMethod],
            transactionInfo: {
                totalPriceStatus: 'FINAL',
                totalPrice: total.toString(),
                currencyCode: 'PEN',
            },
            merchantInfo: {
                merchantId: '0123456789', // Reemplaza con tu ID de comerciante real
                merchantName: 'Example Merchant'
            }
        };

        googlePayClient.loadPaymentData(paymentDataRequest)
            .then((paymentData) => {
                console.log('Pago exitoso', paymentData);
                // Aquí procesas el pago
            })
            .catch((err) => {
                console.error('Error en el pago con Google Pay:', err);
            });
    }

    // Inicializar Google Pay
    if (typeof google !== 'undefined' && google.payments && google.payments.api) {
        onGooglePayLoaded();
    } else {
        console.warn('Google Pay API no está disponible');
    }

    document.getElementById('useLocationBtn').addEventListener('click', obtenerUbicacionYSeleccionarZona);
});