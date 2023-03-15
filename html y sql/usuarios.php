<!DOCTYPE html>

<html>
<head>
        <title>Consulta de usuarios</title>
</head>
<body>
        <h1>Consulta de usuarios</h1>
        <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
                <label for="nombre">Nombre de la película:</label>
                <input type="text" id="nombre" name="nombre">
                <button name="change" type="submit">Consultar</button>
        </form>

<?php


if (isset($_POST["change"])){

// Conexión a la base de datos
$servername = "localhost";
$username = "usuario";
$password = "password";
$dbname = "peliculas";

$conn = mysqli_connect($servername, $username, $password, $dbname);

if (!$conn) {
        die("Error de conexión: " . mysqli_connect_error());
}

// Obtención del nombre de la película desde el formulario
$nombre = $_POST["nombre"];

// Consulta a la base de datos
$sql = "SELECT * FROM usuarios WHERE nombre = '$nombre'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
        // Si se encontró el usuario
        while($row = mysqli_fetch_assoc($result)) {
                echo "ID: " . $row["id"]. " - Nombre: " . $row["nombre"]. "<br>";

 }
echo "'$sql'";
} else {
        // Si no se encontró la película
        echo "No se encontró al usuario.";
        echo "<br>";
        echo "<br>";
        echo "'$sql'";
}
}
// Cierre de la conexión a la base de datos
mysqli_close($conn);
?>
<br>
<form action="index.php" method="POST">
<button type="submit" name="change">Ir a peliculas</button>
</body>
</html>