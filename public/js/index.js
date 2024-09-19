const dropArea = document.querySelector('#drop');
const dropText = dropArea.querySelector('h2');
const dropButton = dropArea.querySelector('button');
const dropInput = dropArea.querySelector('input');
const preview = document.querySelector('#preview');
let files = []; // Array para almacenar los archivos seleccionados

// Eventos de drag and drop
dropArea.addEventListener('dragover', (e) => {
    e.preventDefault();
    dropArea.classList.add('active');
    dropText.textContent = 'Suelta la(s) imagen(es)';
});

dropArea.addEventListener('dragleave', (e) => {
    e.preventDefault();
    dropArea.classList.remove('active');
    dropText.textContent = 'Arrastrar Imagenes';
});

dropArea.addEventListener('drop', (e) => {
    e.preventDefault();
    dropArea.classList.remove('active');
    dropText.textContent = 'Arrastrar Imagenes';

    // Captura los archivos arrastrados
    const draggedFiles = e.dataTransfer.files;
    handleFiles(draggedFiles);
});

// Evento para abrir el selector de archivos
dropButton.addEventListener('click', (e) => {
    dropInput.click();
});

// Cuando se seleccionan archivos manualmente
dropInput.addEventListener('change', (e) => {
    const selectedFiles = e.target.files;
    handleFiles(selectedFiles);
});

// Función para manejar los archivos seleccionados o arrastrados
function handleFiles(newFiles) {
    // Agregar los archivos nuevos al array `files`
    files = [...files, ...newFiles];

    // Mostrar los archivos en el input
    updateFileInput();
    showFiles(files);
}

// Función para mostrar los archivos en la previsualización
function showFiles(files) {
    preview.innerHTML = ''; // Limpiar la previsualización

    if (files.length > 0) {
        Array.from(files).forEach(file => {
            // Crear miniatura de cada archivo
            const fileReader = new FileReader();
            fileReader.readAsDataURL(file);
            fileReader.onload = function (e) {
                const img = document.createElement('img');
                img.src = e.target.result;
                img.style.maxWidth = '100px';
                img.style.margin = '10px';
                preview.appendChild(img);
            };
        });
    }
}

// Función para simular que los archivos arrastrados se agregan al input de archivos
function updateFileInput() {
    const dataTransfer = new DataTransfer();

    files.forEach(file => {
        dataTransfer.items.add(file);
    });

    dropInput.files = dataTransfer.files; // Esto añade los archivos al input
}
