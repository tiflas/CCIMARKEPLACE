<?php

	session_start();

    $id_usuario     = $_POST["id_usuario"];
    $contrasena     = $_POST["clave"];

    try {
        if (($id_usuario == "operaciones") and ($contrasena == "0pEr4cl0NSS")){

            $_SESSION["id_usuario"] = 'operaciones';

            header("location: ../inicio.php?m=".$msn."&tm=".$tipo_msn);
          
    	}elseif(($id_usuario == "sodexo") and ($contrasena == "C0nSult4s")){

            $_SESSION["id_usuario"] = 'sodexo';

            header("location: ../exportaroc.php?m=".$msn."&tm=".$tipo_msn);
          
        }else{
            $msn = ("Usuario no Registrado Porfavor Verifique el usuario y contraseña");
            $tipo_msn = base64_encode("Advertencia");

            header("location: ../index.php?m=".$msn."&tm=".$tipo_msn);  
        }
    } catch (Exception $e) {

    	$msn = base64_encode("A ocurrido un error".$e->getMessage());
    	$tipo_msn = base64_encode("Advertencia");

    	header("Location: index.php?m=".$msn."&tm=".$tipo_msn);
    }

?>