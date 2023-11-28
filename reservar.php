<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/bootstrap.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <script src="./js/scriptConsultas.js"></script>
    <link rel="stylesheet" href="./style/app.css">
    <title>Agenda tu cita</title>
</head>

<body>
    <div class="container-xl">
        <form class="form" action="reservarHora.php" method="post">
            <label for="" class="form-label">Concepto:</label>
            <!--Script para llenar el select de conceptos-->
            <?php
            $area = $_POST['area'];
            $conn = new mysqli("localhost", "root", "", "style_bd");          
            
            $sql = "SELECT concepto FROM servicios where area = '$area'";
            $result = $conn->query($sql);
            $conceptos = array();
            while ($row = $result->fetch_assoc()) {
                $conceptos[] = $row['concepto'];
            }
            echo '<select class="form-select" name="concepto" id="area">';
            foreach ($conceptos as $valor) {
                echo "<option value='$valor'>$valor</option>";
            }
            echo '</select>';
            ?>
            
            <label for="" class="form-label">Eliga una fecha:</label>
            <input class="mt-2" type="date" name="fecha" id="fecha" min="<?php echo date('Y-m-d'); ?>" required>
            <?php  echo '<input type="hidden" name="area" value="' . $area . '">' ?>
            <input type="submit" name="validarHora" class="btn btn-primary"> 
            <label class="label-form" for="responsable">Elige un responsable:</label>
            <?php       
            $sql = "SELECT nombre_resp FROM responsables where area = '$area'";
            $result = $conn->query($sql);
            $responsables = array();
            while ($row = $result->fetch_assoc()) {
                $responsables[] = $row['nombre_resp'];
            }
            echo '<select class="form-select" name="responsable" id="responsable">';
            foreach ($responsables as $valor) {
                echo "<option value='$valor'>$valor</option>";
            }
            echo '</select>';
            ?>
        </form>
       
        
    </div>


</body>

</html>