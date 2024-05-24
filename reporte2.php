<?php
    session_start();

    require_once("../Ccimarketplace/Model/db.conn.php");

    require_once("../Ccimarketplace/Model/consultas.class.php");

    $fechapri     = $_POST['fecha1'];
    $fechase      = $_POST['fecha2'];
    $articulo     = $_POST['articuloo'];
    $reporte      = $_POST['repor'];
    header('Content-type:application/xls');

    if($_POST['repor']=="Reporte articulo ".$_POST['articuloo']."-".$_POST['fecha1']."-".$_POST['fecha2'].".xls"){

    header("Content-Disposition: attachment; filename=".$reporte);        
?>
    <meta charset="utf-8">          
    <table border="1">
        <thead>
            <tr>
                <th>EMPRESA COMPRADORA</th>
                <th>EMPRESA VENDEDORA</th>
                <th>ARTICULO</th>
                <th>DESCRIPCION</th>
                <th>COMENTARIOS</th>
                <th>OBSERVACION</th>
                <th>CANTIDAD</th>
                <th>VALOR</th>                                       
            </tr>
        </thead>
        <tbody>
            <?php
                if(isset($_POST['generar_reporte'])){ 
                    $fechapri     = $_POST['fecha1'];
                    $fechase      = $_POST['fecha2'];
                    $articulo     = $_POST['articulo']; 
                    $articulo1    = $_POST['articulo1']; 
                    $articulo2    = $_POST['articulo2']; 
                    $articulo3    = $_POST['articulo3'];                                                  
                $posicion = consulta::consarticulo($fechapri,$fechase,$articulo,$articulo1,$articulo2,$articulo3);
                foreach ($posicion as $row) {
                    echo "
                        <tr>                                                    
                            <td>".$row["EMPRESACOMPRADORA"]."</td>
                            <td>".$row["EMPRESAVENDEDORA"]."</td>
                            <td>".$row["ARTICULO"]."</td>
                            <td>".$row["DESCRIPCION"]."</td>
                            <td>".$row["COMENTARIOS"]."</td>
                            <td>".$row["OBSERVACION"]."</td>
                            <td>".$row["CANTIDAD"]."</td>
                            <td>".$row["VALOR"]."</td>                                                                                 
                        </tr>";
                    }
                }
            ?>
        </tbody>
    </table>
    <?php 
    }elseif($_POST['repor']=="Reporte articulo integrados ".$_POST['articuloo']."-".$_POST['fecha1']."-".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?> 
    <meta charset="utf-8">          
    <table border="1">
        <thead>
            <tr>
                <th>EMPRESA COMPRADORA</th>
                <th>EMPRESA VENDEDORA</th>
                <th>ID EMPRESA VENDEDORA</th>
                <th>VISIBILIDAD</th>
                <th>TELEFONO</th>
                <th>EMAIL</th>
                <th>ARTICULO</th>
                <th>CANTIDAD</th>
                <th>VALOR</th>                                        
            </tr>
        </thead>
        <tbody>
            <?php
                if(isset($_POST['generar_reporte'])){ 
                    $fechapri     = $_POST['fecha1'];
                    $fechase      = $_POST['fecha2'];
                    $articulo     = $_POST['articulo'];                                                   
                $posicion = consulta::consarticulo2($fechapri,$fechase,$articulo);
                foreach ($posicion as $row) {
                    echo "
                        <tr>                                                    
                            <td>".$row["EMPRESACOMPRADORA"]."</td>
                            <td>".$row["EMPRESAVENDEDORA"]."</td>
                            <td>".$row["IDEMPRESAVENDEDORA"]."</td>
                            <td>".$row["VISIBILIDAD"]."</td>
                            <td>".$row["TELEFONO"]."</td>
                            <td>".$row["EMAIL"]."</td>
                            <td>".$row["ARTICULO"]."</td>
                            <td>".$row["CANTIDAD"]."</td>
                            <td>".$row["VALOR"]."</td>                                                                                 
                        </tr>";
                    }
                }
            ?>
        </tbody>
    </table>
    <?php 
    }
    ?>
    

    
                