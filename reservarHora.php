<?php

    $fecha = $_POST['fecha'];
    $area = $_POST['area'];
    $horasPredeterminadas = array('07:00:00', '08:00:00', '09:00:00', '10:00:00', '11:00:00', '12:00:00', '15:00:00', '16:00:00', '17:00:00', '18:00:00', '19:00:00');
    $conn = new mysqli("localhost", "root", "", "style_bd");
    $sql = "SELECT hora FROM citas where fecha = '$fecha' and area = '$area'";
    $result = $conn->query($sql);
    $horasReservadas = array();
    while ($row = $result->fetch_assoc()) {
        $horasReservadas[] = $row['hora'];
    }
    $horasDisponibles = array_diff($horasPredeterminadas, $horasReservadas);
    echo '<select class="form-select" name="horasDisponibles" id="horasDisponibles">';
    foreach ($horasDisponibles as $valor) {
        echo "<option value='$valor'>$valor</option>";
    }
    echo '</select>';

    mysqli_close($conn);

?>