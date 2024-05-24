<?php
  require_once("../Model/db.conn.php");
  require_once("../Model/consultas.class.php");
$accion=$_REQUEST["acc"];
       switch ($accion) {      		
        case 'consultaoc':      
          $fecha1               = $_POST["fecha1"];
          $fecha2               = $_POST["fecha2"];
        
          try {                   
            $fechas =  consulta::consoc($fecha1,$fecha2);
            if($fechas != ""){
              $mensaje = "No se encuentran datos registrados entre la fecha ".$fecha1." a ".$fecha2."";
            }else{
              $mensaje = "La consulta con un rango de fecha ".$fecha1." a ".$fecha2." Fue exitosa.";
            }                     
          }catch (Exception $e){
            $mensaje="ha ocurrido un error, el error fue: ".$e->getMessage()." en ".$e->getFile(). " en la linea".$e->getLine();
          }

          header("location: ../oc.php?msn=".$mensaje);

        break;   

        case 'editprove':

          $empresa               = $_POST["idempresa"];        
          $pais                  = $_POST["pais"];
          try {     
              consulta::actualizarpro($empresa,$pais);
              
              $mensaje="Se configuro correctamente";
                          
          }catch (Exception $e){
            $mensaje="ha ocurrido un error, el error fue: ".$e->getMessage()." en ".$e->getFile(). " en la linea".$e->getLine();
          }

          header("location: ../consulta.php?msn=".$mensaje);

        break;      
  }
?>