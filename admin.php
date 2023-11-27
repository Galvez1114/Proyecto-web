<?php
session_start();

if (!$_SESSION['usuario']) {
    header("Location: inicio.php");
}

// Conexión a la base de datos
$conn = new mysqli("localhost", "root", "", "style_bd");

// Verifica la connexión
if ($conn->connect_error) {
    die("Error de conexión a la base de datos: " . $conexion->connect_error);
}


// Inicializar variables para los mensajes
$successMessage = "";
$errorMessage = "";

// Eliminar usuario
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminar'])) {
    $email = $_POST['email'];

    $sql = "DELETE FROM responsables WHERE email = '$email'";
    if ($conn->query($sql) === TRUE) {
        $successMessage = "Usuario eliminado con éxito.";
    } else {
        $errorMessage = "Error al eliminar usuario: " . $conn->error;
    }
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['eliminarServicio'])) {
    $concepto = $_POST['concepto'];

    $sql = "DELETE FROM servicios WHERE concepto = '$concepto'";
    if ($conn->query($sql) === TRUE) {
        $successMessage = "Servicio eliminado con éxito.";
    } else {
        $errorMessage = "Error al eliminar el servicio: " . $conn->error;
    }
}

// Mostrar usuarios
$sql = "SELECT nombre_resp, apellidos, email, num_telefono, area, turno FROM responsables";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html>

<head>
    <title>Página de Administrador</title>
    <link rel="stylesheet" href="./style/admin.css">
    <link rel="stylesheet" href="style/bootstrap.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./style/app.css">
</head>

<body>
    <h1>Bienvenido Administrador</h1>



    <!-- Mostrar mensajes -->
    <?php

    if (!empty($successMessage)) {
        echo '<div class="success-message">' . $successMessage . '</div>';
    }

    if (!empty($errorMessage)) {
        echo '<div class="error-message">' . $errorMessage . '</div>';
    }
    ?>

    <!-- Mostrar tabla de usuarios o mensaje de "No hay usuarios registrados" -->
    <h2 class="text-center">Tabla de Empleados</h2>
    <?php
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Nombre</th><th>Apellido</th><th>Correo</th><th>Telefono</th><th>Area</th><th>Turno</th><th>Accion</th></tr>";
        while ($row = $result->fetch_assoc()) {
            if ($row['nombre_resp'] != $_SESSION['usuario']) {
                echo "<tr>";
                echo "<td>" . $row["nombre_resp"] . "</td>";
                echo "<td>" . $row["apellidos"] . "</td>";
                echo "<td>" . $row["email"] . "</td>";
                echo "<td>" . $row["num_telefono"] . "</td>";
                echo "<td>" . $row["area"] . "</td>";
                echo "<td>" . $row["turno"] . "</td>";

                echo '<td>
                    <form method="post" onsubmit="return confirm(\'¿Estás seguro de que deseas eliminar este usuario?\');">
                        <input type="hidden" name="email" value="' . $row["email"] . '">
                        <input type="submit" name="eliminar" value="Eliminar">
                    </form>
                  </td>';
                echo "</tr>";
            }
        }
        echo "</table>";
    } elseif (isset($_POST['mostrar'])) {
        echo '<div class="gray-message">No hay usuarios registrados.</div>';
    }
    ?>

    <h2 class="text-center">Tabla de Servicios</h2>
    <?php
    $sql = "SELECT * FROM servicios";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        echo "<table>";
        echo "<tr><th>Area</th><th>Concepto</th><th>Costo</th><th>Descripci&oacute;n</th><th>Accion</th>";
        while ($row = $result->fetch_assoc()) {
           
                echo "<tr>";
                echo "<td>" . $row["area"] . "</td>";
                echo "<td>" . $row["concepto"] . "</td>";
                echo "<td>" . $row["costo"] . "</td>";
                echo "<td>" . $row["descripcion"] . "</td>";

                echo '<td>
                    <form method="post" onsubmit="return confirm(\'¿Estás seguro de que deseas eliminar este servicio?\');">
                        <input type="hidden" name="concepto" value="' . $row["concepto"] . '">
                        <input type="submit" name="eliminarServicio" value="Eliminar">
                    </form>
                  </td>';
                echo "</tr>";
            
        }
        echo "</table>";
    } elseif (isset($_POST['mostrar'])) {
        echo '<div class="gray-message">No hay usuarios registrados.</div>';
    }
    ?>

    <div class="container-xxl">
        <div class="row">
            <div class="col-md-4 text-center">
                <a class="btn btn-success" href="registro-emp.html">Agregar empleado</a>
            </div>
            <div class="col-md-4 text-center">
                <a class="btn btn-info" href="servicios.html">Agregar servicio</a>
            </div>
            <div class="col-md-4 text-center">
                <a class="btn btn-primary" href="cerrarSesion.php">Cerrar sesi&oacute;n</a>
            </div>
        </div>
    </div>


</body>

</html>

<?php
$conn->close();
?>