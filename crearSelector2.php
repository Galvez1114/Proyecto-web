<?php
            $fecha =  intval($_GET['q']);
            $horasPredeterminadas = array('7:00', '8:00', '9:00', '10:00', '11:00', '12:00', '15:00', '16:00', '17:00', '18:00', '19:00');
            $conn = new mysqli("localhost", "root", "", "style_bd");
            $sql = "SELECT hora FROM citas where fecha = '$fecha'";
            $result = $conn->query($sql);
            $horasReservadas = array();
            while ($row = $result->fetch_assoc()) {
                $horasReservadas[] = $row['horas'];
            }
            $horasDisponibles = array_diff($horasPredeterminadas, $horasDisponibles);
            echo '<select class="form-select" name="horasDisponibles" id="horasDisponibles">';
            foreach ($horasDisponibles as $valor) {
                echo "<option value='$valor'>$valor</option>";
            }
            echo '</select>';

            mysqli_close($con);
            ?>

<?php
      /* $con = mysqli_connect('localhost','root','');                 

       if (!$con) {
           // imprime un mensaje de error y sale del script
           die('No se pudo conectar: ' . mysqli_error($con)); 
                                                            
       }
   
       // Selecciona la BD
       mysqli_select_db($con,'taller');                
   
       // Prepara  la consulta SQL
       $sql="SELECT id, nombre FROM datos";   
       
       // Realiza la consulta
       $result = mysqli_query($con,$sql);                     
   
       /*************  Genera la tabla respuesta ************************/
       /*echo "<form id='form'>
                <select name='users' title='ejemplo' id='seleccion2' onchange='mifuncion()'> ";
                    echo "<option> Selector-2:</option>";
                    // Obtiene cada dato del select
                    while($ren = mysqli_fetch_array($result)) {       
                        echo "<option value='" . $ren['id'] . "'>".$ren['nombre']."</option>";
                    }
                echo "</select>";
        echo "</form>";
                    
       //Cierra la conexion
       mysqli_close($con);
*/?>