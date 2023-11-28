<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/bootstrap.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./style/app.css">
    <title>Termina tu reserva</title>
</head>

<body>

    <div class="container">
        <form action="registrarCita.PHP" method="post" class="form">
            <h1 class="text-center">Concluye tu reserva</h1>
            <label for="" class="label-form">Elige la hora:</label>
            <?php

            $fecha = $_POST['fecha'];
            $area = $_POST['area'];
            $responsable = $_POST['responsable'];
            $concepto = $_POST['concepto'];

            $horasPredeterminadas = array('07:00:00', '08:00:00', '09:00:00', '10:00:00', '11:00:00', '12:00:00', '15:00:00', '16:00:00', '17:00:00', '18:00:00', '19:00:00');
            $conn = new mysqli("localhost", "root", "", "style_bd");
            $sql = "SELECT hora FROM citas where fecha = '$fecha' and area = '$area' and responsable = '$responsable'";
            $result = $conn->query($sql);
            $horasReservadas = array();
            while ($row = $result->fetch_assoc()) {
                $horasReservadas[] = $row['hora'];
            }
            $horasDisponibles = array_diff($horasPredeterminadas, $horasReservadas);
            echo '<select class="form-select mb-4" name="horaDisponible" id="horaDisponible">';
            foreach ($horasDisponibles as $valor) {
                echo "<option value='$valor'>$valor</option>";
            }
            echo '</select>';

            mysqli_close($conn);

            ?>
             <?php  echo '<input type="hidden" name="area" value="' . $area . '">' ?>
             <?php  echo '<input type="hidden" name="fecha" value="' . $fecha . '">' ?>
             <?php  echo '<input type="hidden" name="responsable" value="' . $responsable . '">' ?>
             <?php  echo '<input type="hidden" name="concepto" value="' . $concepto . '">' ?>
            <button class="btn btn-primary" type="submit">Registrar cita</button>
            <a  class="btn btn-danger" href="catalogo.php">Elegir fecha diferetne</a>
        </form>
    </div>

</body>

</html>