<?php 
	date_default_timezone_set("America/Bogota");
?>
<!DOCTYPE html>
<html>
<script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
<script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
<script src="http://code.jquery.com/jquery-1.0.4.js"></script>
<script>
    var counter = 10;

    // The countdown method.
    window.setInterval(function () {
        counter--;
        if (counter >= 0) {
            var span;
            span = document.getElementById("cnt");
            span.innerHTML = counter;
        }
        if (counter === 0) {
            clearInterval(counter);
        }

    }, 1080000); //360000 60 minutos un cero menos que milisegundos

    window.setInterval('refresh()', 10800000);//calcular milisegundos 3600000 son 60 minutos-- 1800000 30 minutos-- 25200000 -7 horas -- 3 horas 10800000

    // Refresh or reload page.
    function refresh() {
        window  .location.reload();
    }
</script>
<script>
        $(document).ready(function () {
            $("#fecha1").change(function () { 
                var fechapri = "<?php echo date('Y-m-d');?>"; 
                var fechainicio = fechapri.replace('-','');  
                var fechainicio1 = fechainicio.replace('-','');                      
                $("#fechainicio").val(fechainicio1);
            });

            $("#fecha2").change(function () { 
                var fechafi = $(this).val();
                var fechafinal = fechafi.replace('-','');
                var fechafinal1 = fechafinal.replace('-','');
                $("#fechafinal").val(fechafinal1);
            });
        });   
        
</script> 
<body>
	<input type="text" id="fechainicio" name="fecha1">
    <input type="text" id="fechafinal"  name="fecha2">
    <section style='position:relative;display:none'>
    	<?php
    	    $fechapri     = $_POST['fecha1'];
    	    $fechase      = $_POST['fecha2'];
    	?>   
   	</section> 
</body>
<?php

require_once("../Prueba excel/Model/db.conn.php");

require_once("../Prueba excel/Model/consulta.php");
	
//$sql = "SELECT top 10 IDEMPRESA,NOMBEMPRESA,FECHACREACION,PALABRASCLAVES from EMPRESAS";
//$resultado =$sql->query($sql);

require 'vendor/autoload.php';

use PhpOffice\PhpSpreadsheet\Spreadsheet;
//use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use \PhpOffice\PhpSpreadsheet\IOFactory;

$spreadsheet = new Spreadsheet();
$sheet = $spreadsheet->getActiveSheet();
$sheet->setTitle("consap");
$sheet->setCellValue('A1', 'Numero de Cotizacion');
$sheet->setCellValue('B1', 'ID Comprador');
$sheet->setCellValue('C1', 'Nombre Comprador');
$sheet->setCellValue('D1', 'Centro de Costos Comprador');
$sheet->setCellValue('E1', 'ID Centro de costos Comprador');
$sheet->setCellValue('F1', 'Nom Empresa Invitada');
$sheet->setCellValue('G1', 'ID Empresa Invitada');
$sheet->setCellValue('H1', 'Email Contacto');
$sheet->setCellValue('I1', 'Telefono Contacto');
$sheet->setCellValue('J1', 'Fecha Publicacion');
$sheet->setCellValue('K1', 'Nom Empresa Oferto');
$sheet->setCellValue('L1', 'Nombre Articulo');
$sheet->setCellValue('M1', 'Estado Cotizacion');

$fila = 2;
                                                                                                      
    $posicion = consulta::CotizacionesProveedorOferto($fechapri,$fechase);
    foreach ($posicion as $rows) {
    		
			$sheet->setCellValue('A'.$fila, $rows['NUM_COTIZACION']);
			$sheet->setCellValue('B'.$fila, $rows['IDEMCOMPRADOR']);
			$sheet->setCellValue('C'.$fila, $rows['NOMCOMPRADOR']);
			$sheet->setCellValue('D'.$fila, $rows['nombreCcostosCompradora']);
			$sheet->setCellValue('E'.$fila, $rows['idcentrocostoCompradora']);
			$sheet->setCellValue('F'.$fila, $rows['EMPRESAINVITADA']);
			$sheet->setCellValue('G'.$fila, $rows['IDEMPRESAINVITADA']);
			$sheet->setCellValue('H'.$fila, $rows['EMAIL']);
			$sheet->setCellValue('I'.$fila, $rows['TELEFONO']);
			$sheet->setCellValue('J'.$fila, $rows['FECHAPUBLICACION']);
			$sheet->setCellValue('K'.$fila, $rows['nombreempresaOferto']);
			$sheet->setCellValue('L'.$fila, $rows['NOMBARTICULO']);
			$sheet->setCellValue('M'.$fila, $rows['DESCRIPCION']);
	$fila++;
                                       
    }    
// Guardar Excel 
$writer = IOFactory::createWriter($spreadsheet, 'Xls');
$writer->save('../Prueba excel/ConsultaCZ/ConsultaCZ.xls');

?>
<div>Cargando Archivo Excel <span id="cnt" style="color:red;"> 10</span> .</div>
<!--<label for="cnt">File progress:</label>
<progress id="cnt" max="100" value="75"> 75% </progress>-->
<html>