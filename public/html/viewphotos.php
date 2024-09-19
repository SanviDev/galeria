<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://kit.fontawesome.com/4aa5d98126.js" crossorigin="anonymous"></script>
    <link rel="stylesheet" href="../css/viewphotos.css">
    <title>Fotos</title>
</head>

<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

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

        .container {
            display: flex;
            flex-wrap: wrap;
            width: 70%;
            margin: 5rem auto;
            gap: 25px;

        }

        .container-image {
            width: 400px;
            margin: 0 auto;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        img {
            object-fit:cover;
            width: 100%;
            border-radius: 10px;
        }

        .sin-resultados {
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
    </style>
    <div class="container">
        <?php
        include("../../server/php/conexion.php");

        $query = "SELECT * FROM tabla_imagen ORDER BY id DESC";
        $result = $conexion->query($query);

        // Verificar si hay resultados
        if ($result->num_rows > 0) {
            // Recorrer cada fila de resultados
            while ($row = $result->fetch_assoc()) {
                //Impresión de las imagenes
                echo '<div class="container-image"><img src="data:image/jpg;base64,' . base64_encode($row['imagen']) . '" alt="Imagen"></div>';
            }
        } else {
            //Respuesta en el caso de que no haya imagenes en la base de datos
            echo '<div class="sin-resultados"><h1>NO HAY IMAGENES EN ESTE MOMENTO... <br> VUELVA MAS TARDE</h1><i class="fa-regular fa-image"></i></div>';
        }
        ?>
    </div>
</body>

</html>