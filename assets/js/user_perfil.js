document.addEventListener('DOMContentLoaded', function() {
    lucide.createIcons();

    const sidebar = document.getElementById('sidebar');
    const toggleSidebarBtn = document.getElementById('toggleSidebar');
    const profilePicture = document.getElementById('profilePicture');
    const fileInput = document.getElementById('fileInput');
    const editProfileBtn = document.getElementById('editProfileBtn');
    const profileForm = document.getElementById('profileForm');
    const addCardBtn = document.getElementById('addCardBtn');
    const addCardForm = document.getElementById('addCardForm');
    const cardList = document.getElementById('cardList');
    const addVehicleBtn = document.getElementById('addVehicleBtn');
    const addVehicleForm = document.getElementById('addVehicleForm');
    const vehicleList = document.getElementById('vehicleList');

    let editMode = false;

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
        editMode = !editMode;
        const inputs = profileForm.querySelectorAll('input, textarea');
        const saveBtn = profileForm.querySelector('.save-btn');

        inputs.forEach(input => input.disabled = !editMode);
        saveBtn.style.display = editMode ? 'block' : 'none';
        editProfileBtn.textContent = editMode ? 'Cancelar' : 'Editar Perfil';
    }

    // Manejo del cambio de archivo de la foto de perfil
    async function handleFileChange(event) {
        const file = event.target.files[0];
        if (!file) return;

        const formData = new FormData();
        formData.append('foto', file);

        try {
            const response = await fetch('perfil.php', { method: 'POST', body: formData });
            const result = await response.json();

            if (result.success) {
                profilePicture.innerHTML = `<img src="${result.foto}" alt="Foto de perfil">`;
            } else {
                alert('Error al actualizar la foto de perfil: ' + result.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error al actualizar la foto de perfil. Por favor, inténtalo de nuevo.');
        }
    }

    // Guardar cambios en el perfil
    async function saveProfile(event) {
        event.preventDefault();
        const formData = new FormData(profileForm);
        const datos = Object.fromEntries(formData.entries());

        try {
            const response = await fetch('perfil.php', { // La URL apunta al mismo perfil.php
                method: 'POST',
                body: new URLSearchParams(datos)
            });

            const result = await response.json();
            if (result.success) {
                alert('Perfil actualizado exitosamente');
                toggleEditMode();
            } else {
                alert('Error al actualizar el perfil: ' + result.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error al actualizar el perfil. Por favor, inténtalo de nuevo.');
        }
    }

    // Agregar una tarjeta de crédito
    async function addCard(event) {
        event.preventDefault();
        const newCard = {
            numero: addCardForm.numero.value,
            expiracion: addCardForm.expiracion.value
        };

        try {
            const response = await fetch('perfil.php', { // La URL apunta al mismo perfil.php
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'addCard', ...newCard })
            });

            const result = await response.json();
            if (result.success) {
                cardList.innerHTML += `<div>${newCard.numero} - ${newCard.expiracion}</div>`;
                addCardForm.reset();
                addCardForm.style.display = 'none';
            } else {
                alert('Error al agregar tarjeta: ' + result.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error al agregar tarjeta. Por favor, inténtalo de nuevo.');
        }
    }

    // Agregar un vehículo
    async function addVehicle(event) {
        event.preventDefault();
        const newVehicle = {
            marca: addVehicleForm.marca.value,
            modelo: addVehicleForm.modelo.value,
            placa: addVehicleForm.placa.value
        };

        try {
            const response = await fetch('perfil.php', { // La URL apunta al mismo perfil.php
                method: 'POST',
                headers: { 'Content-Type': 'application/json' },
                body: JSON.stringify({ action: 'addVehicle', ...newVehicle })
            });

            const result = await response.json();
            if (result.success) {
                vehicleList.innerHTML += `<div>${newVehicle.marca} - ${newVehicle.modelo} - ${newVehicle.placa}</div>`;
                addVehicleForm.reset();
                addVehicleForm.style.display = 'none';
            } else {
                alert('Error al agregar vehículo: ' + result.message);
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error al agregar vehículo. Por favor, inténtalo de nuevo.');
        }
    }

    // Eventos de los botones
    toggleSidebarBtn.addEventListener('click', toggleSidebar);
    editProfileBtn.addEventListener('click', toggleEditMode);
    fileInput.addEventListener('change', handleFileChange);
    profileForm.addEventListener('submit', saveProfile);
    addCardBtn.addEventListener('click', () => addCardForm.style.display = 'block');
    addCardForm.addEventListener('submit', addCard);
    addVehicleBtn.addEventListener('click', () => addVehicleForm.style.display = 'block');
    addVehicleForm.addEventListener('submit', addVehicle);
});
