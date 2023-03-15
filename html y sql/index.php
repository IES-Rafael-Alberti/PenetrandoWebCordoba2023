<!DOCTYPE html>
<html>
<head>
        <title>Consulta de películas</title>
</head>
<body>
        <h1>Consulta de películas</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label for="nombre">Nombre de la película:</label>
                <input type="text" id="nombre" name="nombre">
                <button name="button" type="submit">Consultar</button>
        </form>

<?php
// Conexión a la base de datos
$servername = "localhost";
$username = "usuario";
$password = "password";
$dbname = "peliculas";

if(isset($_POST["button"])) {

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
        die("Error de conexión: " . mysqli_connect_error());
}

// Obtención del nombre de la película desde el formulario
$nombre = $_POST["nombre"];
// Consulta a la base de datos

$sql = "SELECT * FROM pelicula WHERE nombre = '$nombre'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
        // Si se encontró la película
        while($row = mysqli_fetch_assoc($result)) {
                echo "ID: " . $row["id"]. " - Nombre: " . $row["nombre"]. "<br>";
        }
        echo "'$sql'";
} else {
//         Si no se encontró la película
        echo "No se encontró la película.";
        echo "<br>";
        echo "<br>";
        echo "'$sql'";
        }
}
// Cierre de la conexión a la base de datos
mysqli_close($conn);
?>
</br>
<button onclick="window.location.href = 'usuarios.php';">Ir a Usuarios</button>
</body>
</html>


</body>