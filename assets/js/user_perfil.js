document.addEventListener('DOMContentLoaded', function() {
    lucide.createIcons();

    const sidebar = document.getElementById('sidebar');
    const toggleSidebarBtn = document.getElementById('toggleSidebar');
    const addCardBtn = document.getElementById('addCardBtn');
    const addCardForm = document.getElementById('addCardForm');
    const addVehicleBtn = document.getElementById('addVehicleBtn');
    const addVehicleForm = document.getElementById('addVehicleForm');
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
        editProfileBtn.textContent = editMode ? 'Editar Perfil' : 'Cancelar';
    }

    // Función para mostrar/ocultar el formulario de agregar tarjeta
    addCardBtn.addEventListener('click', () => {
        addCardForm.style.display = addCardForm.style.display === 'none' ? 'block' : 'none';
    });

    // Función para mostrar/ocultar el formulario de agregar vehículo
    addVehicleBtn.addEventListener('click', () => {
        addVehicleForm.style.display = addVehicleForm.style.display === 'none' ? 'block' : 'none';
    });

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
            const response = await fetch('/assets/images', { // Cambia esta ruta según tu configuración
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

});
