<?php

require_once("../Model/db.conn.php");

require_once("../Model/consultas.class.php");
$accion=$_REQUEST["subirdocu"];
 switch ($accion) {
       		case 'docu':

          $nombreimagen  = $_POST["nombreimagen"]; 
          $archivopdf    = $_POST["archivopdf"];
          /*$nombre_usu_documento = strtolower(str_replace('ñ', 'n', $nombreimagen));
          $nombre_usu_documento = strtolower(str_replace(' ', '', $nombre_usu_documento));
          $nombre_pdf = strtolower(str_replace('ñ', 'n', $archivopdf));
          $nombre_pdf = strtolower(str_replace(' ', '', $nombre_pdf)); */       

          try {
              $formatos = array('.jpg','.png','.doc','.xlsx','.docx','.pdf');
              if(isset($_POST['subirdocu'])){
                $nombrearchivo = $_FILES['documentoimagen']['name'];
                $nombretmparchivo =  $_FILES['documentoimagen']['tmp_name'];
                $nombrearchivo2 =  $_FILES['documentopdf']['name'];
                $nombretmparchivo2 = $_FILES['documentopdf']['tmp_name'];
                $ext  = substr($nombrearchivo, strrpos($nombrearchivo, '.'));
                $ext2 = substr($nombrearchivo2, strrpos($nombrearchivo2, '.'));
                if ((in_array($ext, $formatos) and (in_array($ext2, $formatos)))){
                  if((move_uploaded_file($nombretmparchivo, "../archivos/$nombrearchivo")) and (move_uploaded_file($nombretmparchivo2, "../archivos/$nombrearchivo2")))
                  {
                    $mensaje= "Se Ha Guardado Exitosamente el archivo img $nombrearchivo y pdf nombrearchivo2";
                    consulta::creararchivo($nombreimagen,$archivopdf);
                  }else{
                    $mensaje= "Ocurrio un error.";
                  }
                }else{
                    $mensaje= "Archivo no permitido";
                }
              }     
          }catch (Exception $e){
              switch ($e->getCode()) {
                case '23000':
                  $mensaje = "El nombre del archivo ya existe intenta con otro nombre diferente";
            break;
            
            default:
              $mensaje=$e->getMessage();
              break;
              }
          }

        header("location: ../admiccimarketplace.php?msn=".$mensaje);

        break; 
        case 'imagenoti':

          $nombreimagen  = $_POST["nombreimagen"]; 

       		try {
              $formatos = array('.jpg','.png','.doc','.xlsx','.docx','.pdf');
              if(isset($_POST['subirdocu'])){
                $nombrearchivo = $_FILES['documentoimagen']['name'];
                $nombretmparchivo =  $_FILES['documentoimagen']['tmp_name'];
                $ext  = substr($nombrearchivo, strrpos($nombrearchivo, '.'));
                if (in_array($ext, $formatos)){
                  if(move_uploaded_file($nombretmparchivo, "../archivos/$nombrearchivo"))
                  {
                    $mensaje= "Se Ha Guardado Exitosamente el archivo $nombrearchivo";
                    consulta::creararchivo($nombreimagen);
                  }else{
                    $mensaje= "Ocurrio un error.";
                  }
                }else{
                    $mensaje= "Archivo no permitido";
                }
              }     
          }catch (Exception $e){
              switch ($e->getCode()) {
                case '23000':
                  $mensaje = "El nombre del archivo ya existe intenta con otro nombre diferente";
            break;
            
            default:
              $mensaje=$e->getMessage();
              break;
              }
          }

        		header("location: ../admiccimarketplace.php?msn=".$mensaje);

        break;

  }
?>