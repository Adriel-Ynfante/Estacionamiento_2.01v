document.addEventListener('DOMContentLoaded', function() {
    lucide.createIcons();

    const sidebar = document.getElementById('sidebar');
    const toggleSidebarBtn = document.getElementById('toggleSidebar');
    const addCardBtn = document.getElementById('addCardBtn');
    const addCardForm = document.getElementById('addCardForm');
    const cardList = document.getElementById('cardList'); // Lista de tarjetas
    const addVehicleBtn = document.getElementById('addVehicleBtn');
    const addVehicleForm = document.getElementById('addVehicleForm');
    const vehicleList = document.getElementById('vehicleList'); // Lista de vehículos
    const editProfileBtn = document.getElementById('editProfileBtn');
    const profileForm = document.getElementById('profileForm');
    const saveBtn = profileForm.querySelector('.save-btn');
    const inputs = profileForm.querySelectorAll('input, textarea');

    // Función para alternar la visibilidad del menú lateral
    function toggleSidebar() {
        sidebar.classList.toggle('minimized');
        const menuTitle = document.querySelector('.menu-title');
        const menuItems = document.querySelectorAll('.sidebar-menu li span');

        if (sidebar.classList.contains('minimized')) {
            menuTitle.style.display = 'none';
            menuItems.forEach(item => item.style.display = 'none');
            toggleSidebarBtn.innerHTML = '<i data-lucide="menu"></i>';
        } else {
            menuTitle.style.display = 'block';
            menuItems.forEach(item => item.style.display = 'inline');
            toggleSidebarBtn.innerHTML = '<i data-lucide="x"></i>';
        }
        lucide.createIcons();
    }

    // Función para alternar el modo de edición del perfil
    function toggleEditMode() {
        const editMode = Array.from(inputs).some(input => !input.disabled);
        inputs.forEach(input => input.disabled = editMode);
        saveBtn.style.display = editMode ? 'none' : 'block';
        editProfileBtn.textContent = editMode ? 'Cancelar' : 'Editar Perfil';
    }

    // Función para mostrar/ocultar el formulario
    function toggleVisibility(element) {
        element.style.display = element.style.display === 'none' ? 'block' : 'none';
    }

    // Eventos para mostrar/ocultar formularios
    addCardBtn.addEventListener('click', () => toggleVisibility(addCardForm));
    addVehicleBtn.addEventListener('click', () => toggleVisibility(addVehicleForm));

    // Evento para el botón de editar perfil
    editProfileBtn.addEventListener('click', toggleEditMode);
    toggleSidebarBtn.addEventListener('click', toggleSidebar);

    const profileImageInput = document.getElementById('profileImage');
    const profilePicture = document.getElementById('profilePicture');

    // Manejo del cambio de archivo de la foto de perfil
    profileImageInput.addEventListener('change', async function(event) {
        const file = event.target.files[0];
        if (!file) return;

        const formData = new FormData();
        formData.append('foto', file);

        try {
            const response = await fetch('../../config/ruta_perfil.php', {
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                profilePicture.innerHTML = `<img src="${result.foto}" alt="Foto de perfil" class="default-avatar">`;
            } else {
                alert('Error al actualizar la foto de perfil: ' + result.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error al actualizar la foto de perfil. Por favor, inténtalo de nuevo.');
        }
    });

    // Manejo del formulario de tarjetas
    addCardForm.addEventListener('submit', async (event) => {
        event.preventDefault();
        const formData = new FormData(addCardForm);
        formData.append('action', 'addCard');

        try {
            const response = await fetch('', { // Asegúrate de que esta URL sea correcta para tu lógica
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            if (result.success) {
                const cardItem = document.createElement('div');
                cardItem.textContent = `Tarjeta: ${formData.get('numero')}, Expiración: ${formData.get('expiracion')}`;
                cardList.appendChild(cardItem);
                addCardForm.reset(); // Reiniciar el formulario
                addCardForm.style.display = 'none'; // Ocultar el formulario
            } else {
                alert('Error al añadir la tarjeta: ' + result.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error al añadir la tarjeta. Por favor, inténtalo de nuevo.');
        }
    });

    // Manejo del formulario de vehículos
    addVehicleForm.addEventListener('submit', async (event) => {
        event.preventDefault();
        const formData = new FormData(addVehicleForm);
        formData.append('action', 'addVehicle');

        try {
            const response = await fetch('', { // Sin utilizar actualmente
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            if (result.success) {
                const vehicleItem = document.createElement('div');
                vehicleItem.textContent = `Vehículo: Marca ${result.vehicle.marca}, Modelo ${result.vehicle.modelo}, Placa ${result.vehicle.placa}`;
                vehicleList.appendChild(vehicleItem);
                addVehicleForm.reset(); // Reiniciar el formulario
                addVehicleForm.style.display = 'none'; // Ocultar el formulario
            } else {
                alert('Error al añadir el vehículo: ' + result.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error al añadir el vehículo. Por favor, inténtalo de nuevo.');
        }
    });

    // Cargar vehículos guardados al inicio
    async function loadVehicles() {
        try {
            const response = await fetch('../../config/ruta_perfil.php'); // 
            const result = await response.json();
            if (result.success) {
                result.vehicles.forEach(vehicle => {
                    const vehicleItem = document.createElement('div');
                    vehicleItem.textContent = `Vehículo: Marca ${vehicle.marca}, Modelo ${vehicle.modelo}, Placa ${vehicle.placa}`;
                    vehicleList.appendChild(vehicleItem);
                });
            } else {
                console.error('Error al cargar vehículos: ' + result.message);
            }
        } catch (error) {
            console.error('Error:', error);
        }
    }

    // Llamar a la función para cargar vehículos guardados
    loadVehicles();
});
