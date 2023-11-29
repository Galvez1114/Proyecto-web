<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style/bootstrap.css">
    <script src="js/bootstrap.bundle.min.js"></script>
    <link rel="stylesheet" href="./style/app.css">
    <title></title>
</head>

<body>
<nav class="container-fluid fondo-nav px-5 py-3">
        <div class="row">
            <div class="col-md-6 text-center mt-1">
                <p class="text-white h2 py-0 my-0 text-center">Bienvenido a <span class="fw-bold">Style&Relax</span></p>
            </div>
        </div>


    </nav>
    <div class="container-xl">
        <?php
        session_start();

        $area = $_POST['area'];
        $fecha = $_POST['fecha'];
        $hora = $_POST['horaDisponible'];
        $responsable = $_POST['responsable'];
        $cliente = $_SESSION['usuario'];
        $concepto = $_POST['concepto'];

        $conn = new mysqli("localhost", "root", "", "style_bd");

        $sql = "SELECT costo FROM servicios where concepto = '$concepto'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $costo = $row['costo'];

        $sql = "SELECT num_telefono FROM clientes where nombre_cliente = '$cliente'";
        $result = $conn->query($sql);
        $row = $result->fetch_assoc();
        $telefono_cliente = $row['num_telefono'];

        mysqli_close($conn);
        $dsn = "mysql:host=localhost;dbname=choixcom_Galvez";
        $dbh = new PDO($dsn, 'choixcom', 'Cherry123-');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stm = $dbh->prepare("insert into citas(fecha,hora,responsable,concepto,costo,cliente,telefono_cliente,area) values (?,?,?,?,?,?,?,?)");

        $stm->bindPAram(1, $fecha);
        $stm->bindPAram(2, $hora);
        $stm->bindPAram(3, $responsable);
        $stm->bindPAram(4, $concepto);
        $stm->bindPAram(5, $costo);
        $stm->bindPAram(6, $cliente);
        $stm->bindPAram(7, $telefono_cliente);
        $stm->bindPAram(8, $area);
        $stm->execute();

        echo '<div class=" mt-5 alert alert-success">
<strong>Cita Registrada!</strong> No olvides asistir 15 minutos antes.
</div>';

        ?>
        <div class="row">
            <div class="col-md-4">
                <a class="btn btn-primary" href="catalogo.php">Volver al catalogo</a>    
            </div>
        </div>
    </div>



</body>

</html>