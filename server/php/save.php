
<!-- Guardado de datos en la BD -->

<?php 

    include("conexion.php");


    $nombre = $_POST["evento"];
    $archivo = addslashes(file_get_contents($_FILES["imagen"]['tmp_name']));

$query = "INSERT INTO tabla_imagen(nombre,imagen) VALUES('$nombre', '$archivo')";
$result = $conexion -> query($query);
if($result){
    echo"se inserto";
} else {
    echo "No se inserto";
}