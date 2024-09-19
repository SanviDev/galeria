<!-- Guardado de datos en la BD -->

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&display=swap');

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        .confirmation {
            width: 100%;
            height: 100vh;
            background-color: #232323;
            color: #dfdfdf;
            display: flex;
            flex-direction: column;
            align-items: center;
            justify-content: center;
            font-family: 'Roboto';
            gap: 30px;
        }

        a {
            color: #1469b3;
            text-decoration: none;
            transition: 250ms;
            &:hover {
                color: #187eda;
            }
        }
    </style>
    <?php

    include("conexion.php");

    $confirmation = true;
    $nombre = $_POST["evento"];
    $fecha = $_POST["fecha"];
    //Recojer la cantidad de archivos que se estan por subir 
    $cantidadDeArchivos = count($_FILES["imagen"]['tmp_name']);
    //Iterar y agregar cada una de las imagenes
    for ($file = 0; $file < $cantidadDeArchivos; $file++) {
        $archivo = addslashes(file_get_contents($_FILES["imagen"]['tmp_name'][$file]));

        $query = "INSERT INTO tabla_imagen(nombre,fecha,imagen) VALUES('$nombre', '$fecha', '$archivo')";
        $result = $conexion->query($query);
        if ($result) {
            $confirmation = true;
        } else {
            $confirmation = false;
        }
    }
    if ($confirmation) {
        echo "<div class='confirmation'><h1>Todas las imagenes se han subido correctamente :)</h1><img src='../../public/images/1b83cffa9213bb6e800bafed09130a57.jpg'/> <h4><a href='../../index.html'>Menú principal</a></h4></div>";
    } else {
        echo "<div class='confirmation'><h1>Oh no, Houston tenemos un problema</h1> <iframe width='841' height='480' src='https://www.youtube.com/embed/-jHYYzS0U-c' title='Problemas Técnicos, Los Simpson' frameborder='0' allow='accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share' referrerpolicy='strict-origin-when-cross-origin'></iframe></div> <h1><a href='../../public/html/newproject.html'>INTENTALO DE NUEVO'</a></h1>";
    }
    ?>
</body>

</html>