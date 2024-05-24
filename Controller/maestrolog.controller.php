<?php
    
    require_once("../Model/db.conn.php");

    require_once("../Model/consultas.class.php");

       $accion=$_REQUEST["acc"];
         switch ($accion) {
         	  case 'ofe':
              try{
                $usuario = consulta::maestrologofer($_REQUEST["ui"]);
                $mensaje="La oferta ha sido corregida y enviada correctamente";
                header("location: ../maestrolog.php?msn=".$mensaje);
              }catch (Exception $e){
                $mensaje="Ha ocurrido un error, el error fue: ".$e->getMessage()." en ".$e->getFile(). " en la linea".$e->getLine();
                header("location: ../maestrolog.php?m=".$mensaje);
              }     
            break;
            case 'coti':
              try{
                $usuario = consulta::maestrologcoti($_REQUEST["ui"]);
                $mensaje="Se ha corregido la cotización y envieda correctamente";
                header("location: ../maestrolog.php?msn=".$mensaje);
              }catch (Exception $e){
                $mensaje="Ha ocurrido un error, el error fue: ".$e->getMessage()." en ".$e->getFile(). " en la linea".$e->getLine();
                header("location: ../maestrolog.php?m=".$mensaje);
              }     
            break;
        }

?>