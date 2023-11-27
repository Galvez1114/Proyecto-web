<?php


    $area = $_POST['area'];
    $concepto = $_POST['concepto'];
    $costo = $_POST['costo'];
    $descripcion = $_POST['desc'];
    


    try {
        $dsn = "mysql:host=localhost;dbname=style_bd";
        $dbh = new PDO($dsn, 'root', '');
        $dbh->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

        $stm = $dbh->prepare("insert into servicios(area,concepto,costo,descripcion) values (?,?,?,?)");

        $stm->bindPAram(1, $area);
        $stm->bindPAram(2, $concepto);
        $stm->bindPAram(3, $costo);
        $stm->bindPAram(4, $descripcion);
        


        $stm->execute();
        header("Location: admin.php");
    } catch (PDOException $e) {
        echo $e->getMessage();
    }

?>
