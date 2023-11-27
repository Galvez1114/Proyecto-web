<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: index.html");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/bootstrap.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./style/app.css">
    <title>Agenda de citas</title>
</head>
<body>
    <nav class="container-fluid fondo-nav px-5 py-3">
        <div class="row">
            <div class="col-md-6 text-center mt-1">
                <a href="index.html"
                    class="nav-item text-white h2 py-0 my-0 text-center text-decoration-none">Bienvenido a <span
                        class="fw-bold">Style&Relax</span></a>
            </div>
            <div class="col-md-6 text-center mt-1 text-md-end">
               
            </div>
        </div>
    </nav>

    <h1 class="text-center">Bienvenido <?php echo $_SESSION['usuario']; ?></h1>
    <h2 class="text-center">Tus pr&oacute;ximas citas son:</h2>

    <?php
    $conn = new mysqli("localhost", "root", "", "style_bd");
    date_default_timezone_set('America/Mazatlan');
    $fechaActual = date('Y-m-d');
    $horaActuaal = date('H:i');
    

    $sql = "SELECT * FROM citas";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        echo "<div class='container-xl'>";
        echo "<table class='table table-bordered'>";
        echo "<tr><th>Cliente</th><th>Concepto</th><th>Fecha</th><th>Hora</th><th>Costo</th><th>Numero de contacto</th>";
        while ($row = $result->fetch_assoc()) {
            $fechaReservada = $row['fecha'];
            if ($fechaReservada >= $fechaActual && $row['responsable'] == $_SESSION['usuario']) {
                echo "<tr>";
                echo "<td>" . $row["cliente"] . "</td>";
                echo "<td>" . $row["concepto"] . "</td>";
                echo "<td>" . $row["fecha"] . "</td>";
                echo "<td>" . $row["hora"] . "</td>";
                echo "<td>" . $row["costo"] . "</td>";
                echo "<td>" . $row["telefono_cliente"] . "</td>";

                echo "</tr>";
            }
        }
        echo "</table>";
        echo '<div class="row">
        <div class="col-md-4">
            <a class="btn btn-danger" href="cerrarSesion.php">Cerrar Sesi&oacute;n</a>
        </div>
    </div>';
        echo "</div>";
    } elseif (isset($_POST['mostrar'])) {
        echo '<div class="gray-message">No hay usuarios registrados.</div>';
    }
    
    ?>
    
    
</body>
</html>