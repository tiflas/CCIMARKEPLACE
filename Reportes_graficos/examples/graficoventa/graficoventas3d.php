<?php

    session_start();

    if(!isset($_SESSION["id_usuario"])){
        header("location: ../index.php");
    }

    require_once($_SERVER['DOCUMENT_ROOT']."/ccimarketplace/Model/db.conn.php");

    require_once($_SERVER['DOCUMENT_ROOT']."/ccimarketplace/Model/consultas.class.php");

    date_default_timezone_set("America/Bogota");

    $fechapri     = $_POST['fecha1'];
    $fechase      = $_POST['fecha2'];
    $idempresa    = $_POST['idempresa'];
    $idempresa    = implode(",", $idempresa);

    $numporcentaje = consulta::numporcentventas($fechapri,$fechase,$idempresa);

?>
<!DOCTYPE HTML>
<html>
	<head>
		<link rel="shorcut icon type=" href="../icono/iconoccimarketplace.ico"/>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>CCIMARKETPLACE</title>

		<style type="text/css">

		</style>
	</head>
	<body>

<script src="../../code/highcharts.js"></script>
<script src="../../code/highcharts-3d.js"></script>
<script src="../../code/modules/exporting.js"></script>
<script src="../../code/modules/export-data.js"></script>

<div id="container" style="height: 400px"></div>


		<script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        type: 'pie',
        options3d: {
            enabled: true,
            alpha: 45,
            beta: 0
        }
    },
    title: {
        text: 'Reporte ventas Fecha:<?php echo "".$fechapri." - ".$fechase ?>'
    },
    tooltip: {
        pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
    },
    plotOptions: {
        pie: {
            allowPointSelect: true,
            cursor: 'pointer',
            depth: 35,
            dataLabels: {
                enabled: true,
                format: '{point.name}'
            }
        }
    },
    series: [{
        type: 'pie',
        name: 'Porcentaje',
        data: [
            <?php
                $posicion = consulta::graficavendedores($fechapri,$fechase,$idempresa);
                foreach ($posicion as $row) {
                    $num = $row["total"];
                    $num2 = $numporcentaje["total"];
                    $Porcentaje = ($num*100/$num2);
                    // <?php $num1 = number_format($row["total"]*100/$numporcentaje["total"]); echo $num1 
            ?>
                    ['<?php echo $row["empresavendedora"]; ?>', <?php echo $Porcentaje ?>],
            <?php
                }
            ?>
        ]
    }]
});
		</script>
	</body>
</html>