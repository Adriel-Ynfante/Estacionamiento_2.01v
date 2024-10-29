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

    function toggleEditMode() {
        editMode = !editMode;
        const inputs = profileForm.querySelectorAll('input, textarea');
        const saveBtn = profileForm.querySelector('.save-btn');

        inputs.forEach(input => input.disabled = !editMode);
        saveBtn.style.display = editMode ? 'block' : 'none';
        editProfileBtn.textContent = editMode ? 'Cancelar' : 'Editar Perfil';
    }

    async function handleFileChange(event) {
        const file = event.target.files[0];
        if (file) {
            const formData = new FormData();
            formData.append('foto', file);

            try {
                const response = await fetch('/usuario/foto', {
                    method: 'POST',
                    body: formData
                });

                const result = await response.json();
                if (result.success) {
                    profilePicture.innerHTML = `<img src="${result.foto}" alt="Foto de perfil">`;
                } else {
                    alert('Error al actualizar la foto de perfil');
                }
            } catch (error) {
                console.error('Error:', error);
                alert('Error al actualizar la foto de perfil');
            }
        }
    }

    async function saveProfile(event) {
        event.preventDefault();
        const formData = new FormData(profileForm);
        const datos = Object.fromEntries(formData.entries());

        try {
            const response = await fetch('/usuario/actualizar', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(datos)
            });

            const result = await response.json();
            if (result.success) {
                alert('Perfil actualizado exitosamente');
                toggleEditMode();
            } else {
                alert('Error al actualizar el perfil');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error al actualizar el perfil');
        }
    }

    async function addCard(event) {
        event.preventDefault();
        const newCard = {
            numero: addCardForm.numero.value,
            expiracion: addCardForm.expiracion.value
        };

        try {
            const response = await fetch('/usuario/tarjeta', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(newCard)
            });

            const result = await response.json();
            if (result.success) {
                cardList.innerHTML += `<div>${newCard.numero} - ${newCard.expiracion}</div>`;
                addCardForm.reset();
                addCardForm.style.display = 'none';
            } else {
                alert('Error al agregar tarjeta');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error al agregar tarjeta');
        }
    }

    async function addVehicle(event) {
        event.preventDefault();
        const newVehicle = {
            marca: addVehicleForm.marca.value,
            modelo: addVehicleForm.modelo.value,
            placa: addVehicleForm.placa.value
        };

        try {
            const response = await fetch('/usuario/vehiculo', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json'
                },
                body: JSON.stringify(newVehicle)
            });

            const result = await response.json();
            if (result.success) {
                vehicleList.innerHTML += `<div>${newVehicle.marca} - ${newVehicle.modelo} - ${newVehicle.placa}</div>`;
                addVehicleForm.reset();
                addVehicleForm.style.display = 'none';
            } else {
                alert('Error al agregar vehículo');
            }
        } catch (error) {
            console.error('Error:', error);
            alert('Error al agregar vehículo');
        }
    }

    toggleSidebarBtn.addEventListener('click', toggleSidebar);
    editProfileBtn.addEventListener('click', toggleEditMode);
    fileInput.addEventListener('change', handleFileChange);
    profileForm.addEventListener('submit', saveProfile);
    addCardBtn.addEventListener('click', () => addCardForm.style.display = 'block');
    addCardForm.addEventListener('submit', addCard);
    addVehicleBtn.addEventListener('click', () => addVehicleForm.style.display = 'block');
    addVehicleForm.addEventListener('submit', addVehicle);
});
