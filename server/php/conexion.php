
<!-- Conección con la BD -->

<?php

$conexion = new mysqli("localhost", "root", "", "galeria");

if ($conexion) {
    echo "<p style='color:#232323'>Si ves esto, HOLA jeje</p>";
}
?>