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
<script src="../../code/modules/exporting.js"></script>
<script src="../../code/modules/export-data.js"></script>

<div id="container" style="min-width: 310px; height: 400px; max-width: 600px; margin: 0 auto"></div>



        <script type="text/javascript">
Highcharts.chart('container', {
    chart: {
        plotBackgroundColor: null,
        plotBorderWidth: null,
        plotShadow: false,
        type: 'pie'
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
            dataLabels: {
                enabled: true,
                format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                style: {
                    color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                }
            }
        }
    },
    series: [{
        name: 'Porcentaje',
        colorByPoint: true,
        data: [
            <?php
                $posicion = consulta::graficavendedores($fechapri,$fechase,$idempresa);
                foreach ($posicion as $row) {
                    $num = $row["total"];
                    $num2 = $numporcentaje["total"];
                    $Porcentaje = ($num*100/$num2);
                    // <?php $num1 = number_format($row["total"]*100/$numporcentaje["total"]); echo $num1 
            ?>
                    {
                        name: '<?php echo $row["empresavendedora"]; ?>',
                        y: <?php echo $Porcentaje ?>
                    },
            <?php
                }
            ?>
        ]
    }]
});
        </script>
    </body>
</html>
