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

    // Manejo del cambio de archivo de la foto de perfil
    async function handleFileChange(event) {
        const file = event.target.files[0];
        if (!file) return;

        const formData = new FormData();
        formData.append('foto', file);

        try {
            const response = await fetch('./assets/uploads', { // Cambia esta ruta según tu configuración
                method: 'POST',
                body: formData
            });

            const result = await response.json();

            if (result.success) {
                const profilePicture = document.getElementById('profilePicture');
                profilePicture.innerHTML = `<img src="${result.foto}" alt="Foto de perfil">`;
            } else {
                alert('Error al actualizar la foto de perfil: ' + result.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error al actualizar la foto de perfil. Por favor, inténtalo de nuevo.');
        }
    }

    // Evento para manejar el cambio de archivo
    document.getElementById('fileInput').addEventListener('change', handleFileChange);

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
                // Crear un nuevo elemento de tarjeta y añadirlo a la lista
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
            const response = await fetch('', { // Asegúrate de que esta URL sea correcta para tu lógica
                method: 'POST',
                body: formData
            });

            const result = await response.json();
            if (result.success) {
                // Crear un nuevo elemento de vehículo y añadirlo a la lista
                const vehicleItem = document.createElement('div');
                vehicleItem.textContent = `Vehículo: Marca ${formData.get('marca')}, Modelo ${formData.get('modelo')}, Placa ${formData.get('placa')}`;
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
});
