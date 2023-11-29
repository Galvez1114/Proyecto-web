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
<nav class="container-fluid fondo-nav px-5 py-3">
        <div class="row">
            <div class="col-md-6 text-center mt-1">
                <p class="text-white h2 py-0 my-0 text-center" >Bienvenido a <span
                        class="fw-bold">Style&Relax</span></p>
            </div>
        </div>


    </nav>
    <div class="container-xl mt-5">
        <div class="row d-flex flex-column justify-content-center align-items-center">
                <div class="col-md-4">
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
            echo '<select class="form-select mb-2" name="concepto" id="area">';
            foreach ($conceptos as $valor) {
                echo "<option value='$valor'>$valor</option>";
            }
            echo '</select>';
            echo '<input type="hidden" name="area" value="' . $area . '">' 
            ?>
            
            <label for="fecha" class="form-label">Eliga una fecha:</label>
            <input class="form-control" type="date" name="fecha" id="fecha" min="<?php echo date('Y-m-d'); ?>" required>
            <br>
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
            <input type="submit" name="validarHora" class="btn btn-primary mt-4" value="Ver horas disponibles"> 
        </form>
       
                </div>
        </div>
       
        
    </div>


</body>

</html>