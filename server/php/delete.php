<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <?php
    include("conexion.php");

    $idString = $_POST['listId'] ?? ''; // Verificar si existe el valor

    if (!empty($idString)) {
        // Convertir la cadena de IDs en un array
        $idArray = explode(',', $idString);

        foreach ($idArray as $id) {
            // Asegurarse de que el id es un número para prevenir inyecciones SQL
            $id = intval($id);

            // Ejecutar la consulta DELETE para cada ID
            $query = "DELETE FROM tabla_imagen WHERE id = '$id'";
            $result = $conexion->query($query);

            if (!$result) {
                echo "Error al eliminar la imagen con ID: $id <br>";
            }
        }
        header('Location: ../../index.html');
    } else {
        echo "NO SE HAN DETECTADO IDs";
    }
    $conexion->close();

    ?>
</body>

</html>