<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4aa5d98126.js" crossorigin="anonymous"></script>
    <title>Eliminar Imagenes</title>
</head>

<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

        * {
            margin: 0 auto;
            text-align: center;
        }

        table,
        tr,
        td,
        th {
            border: 1px solid #aaa;
            padding: 10px;
        }

        table {
            width: 70%;
            margin: 0 auto;
            background-color: var(--background-target);
        }   

        .actions {
            display: flex;
            justify-content: space-around;
            align-items: center;
            margin: 2rem 0;
        }

        .selects {
            display: flex;
            gap: 30px
        }

        button,
        .actions {
            font-size: 1.3rem;
        }

        button {
            background-color: transparent;
            border: none;
            cursor: pointer;
            color: #d52019;
            transition: 100ms;

            &:hover {
                color: #f52019;
            }
        }

        input {
            transform: scale(3);
        }

        .sin-resultados {
            background-color: #232323;
            color: #fdfdfd;
            position: absolute;
            top: 0;
            left: 0;
            height: 100vh;
            width: 100%;
            display: flex;
            align-items: center;
            justify-content: center;
            flex-direction: column;
            gap: 1rem;

            & i {
                font-size: 4rem
            }
        }

        :root {
            --background-body: #232323;
            --background-target: #111111;
            --background-t-hover: #1469b3;
            --text-color: #dfdfdf;
        }


        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html {
            background-color: var(--background-body);
            min-height: 100vh;
            min-width: 100%;
            text-align: center;
            color: var(--text-color);
            font-family: 'Roboto';
        }
    </style>
    <div class="actions">
        <div class="selects">
            <div class="select-all" style="cursor:pointer">
                <i class="fa-solid fa-check-double"></i>
                Seleccionar Todo
            </div>
            <div class="deselect" style="cursor:pointer">
                <i class="fa-solid fa-rotate-left"></i>
                Deseleccionar
            </div>
        </div>
        <div class="delete">
            <form action="../../server/php/delete.php" method="post" onsubmit=setValue()>
                <input name="listId" id="listId" hidden>
                <button>
                    <i class="fa-solid fa-trash"></i>
                </button>
            </form>
        </div>
    </div>
    <table>
        <thead>
            <tr>
                <th>Seleccionar</th>
                <th>Imagen</th>
                <th>Fecha</th>
                <th>Nombre del Evento</th>
            </tr>
        </thead>
        <tbody>

            <?php

            include("../../server/php/conexion.php");

            $query = "SELECT * FROM tabla_imagen ORDER BY id DESC";
            $result = $conexion->query($query);

            // Verifica si hay resultados
            if ($result->num_rows > 0) {
                // Recorrer cada fila de resultados y crear las propiedades de las tablas necesarias
                while ($row = $result->fetch_assoc()) {

                    echo '<tr>' .
                        '<td><input type=checkbox id="' . $row['id'] . '"/></td>' .
                        '<th>
                                <img src="data:image/jpg;base64,' . base64_encode($row['imagen']) . '" alt="Imagen" height="130px">' .
                        '</th>' .
                        '<td><p>' . date("d/m/Y", strtotime($row['fecha'])) . '</p></td>' . //setear el formato de la fecha
                        '<td>' . $row['nombre'] . '</td>' .
                        '</tr>';
                }
            } else { //En el caso de que no haya imagenes subidas
                echo '<div class="sin-resultados">' .
                    '<h1>NO HAY IMAGENES EN ESTE MOMENTO... ' .
                    '<br>' .
                    'Agrega una antes de eliminar</h1>' .
                    '<i class="fa-regular fa-image"></i>' .
                    '</div>';
            }

            ?>

        </tbody>
    </table>
</body>
<script>
    const checkboxs = document.querySelectorAll('input[type="checkbox"]');
    let howImage = [];
    const selectAll = document.querySelector('.select-all');
    const deselectAll = document.querySelector('.deselect');
    const listIdField = document.getElementById('listId'); // Campo oculto para enviar los IDs

    // Deseleccionar todos los inputs
    deselectAll.addEventListener('click', () => {
        checkboxs.forEach(box => {
            if (box.checked) {
                box.checked = false; // Desmarcar el checkbox
                howImage = howImage.filter(id => id !== box.id); // Eliminar de la lista
            }
        });
        console.log(howImage); // Mostrar el array actualizado
        console.log(setValue())

    });

    // Marcar todos los inputs
    selectAll.addEventListener('click', () => {
        checkboxs.forEach(box => {
            if (!box.checked) {
                box.checked = true; // Marcar el checkbox
                if (!howImage.includes(box.id)) {
                    howImage.push(box.id); // Añadir a la lista si no está ya
                }
            }
        });
        console.log(howImage); // Mostrar el array actualizado
        console.log(setValue())

    });

    // Escuchar cambios en los checkboxes
    checkboxs.forEach(box => {
        box.addEventListener('change', () => {
            if (box.checked) {
                howImage.push(box.id); // Añadir al array si está marcado
            } else {
                howImage = howImage.filter(id => id !== box.id); // Eliminar si no está marcado
            }
            console.log(howImage); // Mostrar el array actualizado

            console.log(setValue())
        });
    });

    // Pasar el array de IDs a cadena para enviarlo a PHP
    function setValue() {
        listIdField.value = howImage.toString(); // Convertir el array a una cadena separada por comas
        return true; // Permitir el envío del formulario
    }
</script>

</html>