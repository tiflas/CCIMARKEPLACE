<?php
    session_start();

    require_once("../Ccimarketplace/Model/db.conn.php");

    require_once("../Ccimarketplace/Model/consultas.class.php");

    $fechapri     = $_POST['fecha1'];
    $fechase      = $_POST['fecha2'];
    $reporte      = $_POST['repor'];
    header('Content-type:application/xls; charset=UTF-8');

    if($_POST['repor']=="Reporte OC ".$_POST['fecha1']." - ".$_POST['fecha2'].".xls"){

    header("Content-Disposition: attachment; filename=".$reporte);        
?>    
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>ID OC</th>
                    <th>ID EMPRE COMPRADORA</th>
                    <th>NOM EMPRESA COMPRADORA</th>
                    <th>ID ORGC COMPRA</th>
                    <th>NOMB ORGC COMPRADORA</th>
                    <th>idEmpresaProveedora</th>
                    <th>Nit Proveedor</th>
                    <th>EmpresaProveedora</th>
                    <th>idSucursalVenta</th>
                    <th>SucursalVenta</th>
                    <th>Fecha envio</th>
                    <th>NoOC</th>
                    <th>Moneda</th>
                    <th>Total</th>
                    <th>Id Descripcion</th>
                    <th>Descripcion</th> 
                    <th>Descripcion Forma de pago</th>
                    <th>Forma de pago</th>                                         
                </tr>
            </thead>
            <tbody>
        <?php  
            if(isset($_POST['generar_reporte'])){ 
                $fechapri     = $_POST['fecha1'];
                $fechase      = $_POST['fecha2'];                                                                                                          
                $posicion = consulta::consoc($fechapri,$fechase);
                foreach ($posicion as $row) {
                    echo"
                        <tr>                                                    
                            <td>".$row["idoc"]."</td>
                            <td>".$row["idEmpresaCompradora"]."</td>
                            <td>".$row["EmpresaCompradora"]."</td> 
                            <td>".$row["idOrgCompra"]."</td>
                            <td>".$row["nombreOrgCompra"]."</td>
                            <td>".$row["idEmpresaProveedora"]."</td>
                            <td>".$row["nitproveedor"]."</td> 
                            <td>".$row["EmpresaProveedora"]."</td> 
                            <td>".$row["idSucursalVenta"]."</td> 
                            <td>".$row["SucursalVenta"]."</td>
                            <td>".$row["fechaenvio"]."</td>
                            <td>".$row["NoOC"]."</td>
                            <td>".$row["idmoneda"]."</td> 
                            <td>".$row["total"]."</td>                                                     
                            <td>".$row["idEstadoDoc"]."</td>
                            <td>".$row["estadodoc"]."</td> 
                            <td>".$row["descripformapago"]."</td>
                            <td>".$row["formadepago"]."</td>                                                                                   
                        </tr>";
                }
            }
        ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="Reporte OC Fecha ".$_POST['fecha1']." - ".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?> 
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>ID OC</th>
                    <th>ID EMPRE COMPRADORA</th>
                    <th>NOM EMPRESA COMPRADORA</th>
                    <th>ID ORGC COMPRA</th>
                    <th>NOMB ORGC COMPRADORA</th>
                    <th>idEmpresaProveedora</th>
                    <th>Nit Proveedor</th>
                    <th>EmpresaProveedora</th>
                    <th>idSucursalVenta</th>
                    <th>SucursalVenta</th>
                    <th>Fecha envio</th>
                    <th>NoOC</th>
                    <th>Moneda</th>
                    <th>Total</th>
                    <th>Id Descripcion</th>
                    <th>Descripcion</th> 
                    <th>Descripcion Forma de pago</th>
                    <th>Forma de pago</th>                                        
                </tr>
            </thead>
            <tbody>
            <?php  
                if(isset($_POST['generar_reporteempre'])){ 
                    $fechapri     = $_POST['fecha1'];
                    $fechase      = $_POST['fecha2'];
                    $idempresa    = $_POST['idempre'];
                    $posicion = consulta::consocempre($fechapri,$fechase,$idempresa);
                    foreach ($posicion as $row) {
                        echo"
                            <tr>                                                    
                                <td>".$row["idoc"]."</td>
                                <td>".$row["idEmpresaCompradora"]."</td>
                                <td>".$row["EmpresaCompradora"]."</td> 
                                <td>".$row["idOrgCompra"]."</td>
                                <td>".$row["nombreOrgCompra"]."</td>
                                <td>".$row["idEmpresaProveedora"]."</td>
                                <td>".$row["nitproveedor"]."</td> 
                                <td>".$row["EmpresaProveedora"]."</td> 
                                <td>".$row["idSucursalVenta"]."</td> 
                                <td>".$row["SucursalVenta"]."</td>
                                <td>".$row["fechaenvio"]."</td>
                                <td>".$row["NoOC"]."</td>
                                <td>".$row["idmoneda"]."</td> 
                                <td>".$row["total"]."</td>                                                     
                                <td>".$row["idEstadoDoc"]."</td>
                                <td>".$row["estadodoc"]."</td>
                                <td>".$row["descripformapago"]."</td>
                                <td>".$row["formadepago"]."</td>                                                                                    
                            </tr>";
                    }
                }
            ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="Reporte OC Aceptada Fecha ".$_POST['fecha1']." - ".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?> 
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>ID EMPRESA CONSTRUCTORA</th>
                    <th>CONSTRUCTORA</th>
                    <th>NUM OC</th>
                    <th>ID ESTADOS OC</th>
                    <th>ESTADO OC</th>
                    <th>FECHA CREACION</th>
                    <th>FECHA APROBACION</th>
                    <th>FECHAENVIO</th>
                    <th>EMPRESA PROVEEDOR</th>
                    <th>DESCUENTOS</th>
                    <th>CARGOS</th>
                    <th>TOTAL</th>                                         
                </tr>
            </thead>
            <tbody>
            <?php  
                if(isset($_POST['generar_reporteempre'])){ 
                    $fechapri     = $_POST['fecha1'];
                    $fechase      = $_POST['fecha2'];
                    $idempresa    = $_POST['idempre'];
                    $posicion = consulta::OC_aceptadas($idempresa,$fechapri,$fechase);
                    foreach ($posicion as $row) {
                        echo"
                            <tr>                                                    
                                <td>".$row["ocidempresa"]."</td>
                                <td>".$row["CONSTRUCTORA"]."</td>
                                <td>".$row["numoc"]."</td> 
                                <td>".$row["idestadooc"]."</td>
                                <td>".$row["estadooc"]."</td>
                                <td>".$row["fechacreacion"]."</td>
                                <td>".$row["fechaaprovacion"]."</td> 
                                <td>".$row["FECHAENVIO"]."</td> 
                                <td>".$row["empresaproveedor"]."</td>
                                <td>".$row["DESCUENTOS"]."</td>
                                <td>".$row["CARGOS"]."</td>
                                <td>".$row["TOTAL"]."</td>                                                                                    
                            </tr>";
                    }
                }
            ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="Reporte OC Aceptada todas las empresas Fecha ".$_POST['fecha1']." - ".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?> 
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>ID EMPRESA CONSTRUCTORA</th>
                    <th>CONSTRUCTORA</th>
                    <th>NUM OC</th>
                    <th>ID ESTADOS OC</th>
                    <th>ESTADO OC</th>
                    <th>FECHA CREACION</th>
                    <th>FECHA APROBACION</th>
                    <th>FECHAENVIO</th>
                    <th>EMPRESA PROVEEDOR</th>
                    <th>DESCUENTOS</th>
                    <th>CARGOS</th>
                    <th>TOTAL</th>                                         
                </tr>
            </thead>
            <tbody>
            <?php  
                if(isset($_POST['generar_reporte'])){ 
                    $fechapri     = $_POST['fecha1'];
                    $fechase      = $_POST['fecha2'];
                    $posicion = consulta::OC_aceptadas_empresas($fechapri,$fechase);
                    foreach ($posicion as $row) {
                        echo"
                            <tr>                                                    
                                <td>".$row["ocidempresa"]."</td>
                                <td>".$row["CONSTRUCTORA"]."</td>
                                <td>".$row["numoc"]."</td> 
                                <td>".$row["idestadooc"]."</td>
                                <td>".$row["estadooc"]."</td>
                                <td>".$row["fechacreacion"]."</td>
                                <td>".$row["fechaaprovacion"]."</td> 
                                <td>".$row["FECHAENVIO"]."</td> 
                                <td>".$row["empresaproveedor"]."</td>
                                <td>".$row["DESCUENTOS"]."</td>
                                <td>".$row["CARGOS"]."</td>
                                <td>".$row["TOTAL"]."</td>                                                                                    
                            </tr>";
                    }
                }
            ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="Reporte CZ ".$_POST['fecha1']." - ".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?> 
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>empresaCompradora</th>
                    <th>nombreEmpresaCompradora</th>
                    <th>idcentrocostoCompradora</th> 
                    <th>nombreCcostosCompradora</th>
                    <th>nombreCotizacion</th>
                    <th>FechaCreacionCotizacion</th>
                    <th>estadoCotizacion</th> 
                    <th>IDEmpresaInvitada</th> 
                    <th>nombreempresaInvitada</th>
                    <th>idOferta</th>
                    <th>nombreOferta</th>
                    <th>nombreempresaOferto</th> 
                    <th>sucursalOferto</th> 
                    <th>Contacto</th> 
                    <th>Correo Contacto</th> 
                    <th>Telefono contacto</th>
                    <th>Celular</th> 
                    <th>ciudad</th>                                                    
                    <th>EstadoAdjudicacionOferta</th> 
                    <th>estadoOferta</th> 
                    <th>valorOfertado</th>                                          
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporte'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2'];                                                  
                    $posicion = consulta::conscz($fechapri,$fechase);
                    foreach ($posicion as $row) {
                        echo "
                            <tr>                                                    
                                <td>".$row["empresaCompradora"]."</td>
                                <td>".$row["nombreEmpresaCompradora"]."</td>
                                <td>".$row["idcentrocostoCompradora"]."</td> 
                                <td>".$row["nombreCcostosCompradora"]."</td>
                                <td>".$row["nombreCotizacion"]."</td>
                                <td>".$row["FechaCreacionCotizacion"]."</td>
                                <td>".$row["estadoCotizacion"]."</td> 
                                <td>".$row["IDEmpresaInvitada"]."</td> 
                                <td>".$row["nombreempresaInvitada"]."</td>
                                <td>".$row["idOferta"]."</td>
                                <td>".$row["nombreOferta"]."</td>
                                <td>".$row["nombreempresaOferto"]."</td> 
                                <td>".$row["sucursalOferto"]."</td> 
                                <td>".$row["Contacto"]."</td> 
                                <td>".$row["Correo Contacto"]."</td> 
                                <td>".$row["Telefono contacto"]."</td>
                                <td>".$row["Celular"]."</td> 
                                <td>".$row["ciudad"]."</td>                                                   
                                <td>".$row["EstadoAdjudicacionOferta"]."</td> 
                                <td>".$row["estadoOferta"]."</td> 
                                <td>".$row["valorOfertado"]."</td>                                                                                 
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="Reporte Proveedores CZ.xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?> 
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>Num Cotizacion</th>
                    <th>ID Empresa Comprador</th>
                    <th>Nom Empresa Comprador</th> 
                    <th>Nombre Proveedor</th>
                    <th>Email</th>
                    <th>Telefono</th>
                    <th>Fecha Publicacion</th>
                    <th>Codigo</th> 
                    <th>Nombre Articulo</th>
                    <th>Cantidad</th>                                          
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporte'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2']; 
                        $NumCotizacion= $_POST['NumCotizacion'];
                        if($NumCotizacion == ''){
                            $posicion = consulta::ProveedoresInvitadosCZ1($fechapri,$fechase);
                            foreach ($posicion as $row) {
                                echo "
                                    <tr>                                                    
                                        <td>".$row["NUM_COTIZACION"]."</td>
                                        <td>".$row["IDEMCOMPRADOR"]."</td>
                                        <td>".$row["NOMCOMPRADOR"]."</td>
                                        <td>".$row["NOMBEMPRESA"]."</td>
                                        <td>".$row["EMAIL"]."</td> 
                                        <td>".$row["TELEFONO"]."</td>
                                        <td>".$row["FECHAPUBLICACION"]."</td>
                                        <td>".$row["IDARTICULO"]."</td>
                                        <td>".$row["NOMBARTICULO"]."</td>
                                        <td>".$row["CANTIDAD"]."</td> 
                                    </tr>";
                            }  
                        }elseif($fechapri == '' and $fechase == ''){
                                $posicion = consulta::ProveedoresInvitadosCZ3($NumCotizacion);
                                foreach ($posicion as $row) {
                                    echo "
                                        <tr>                                                    
                                            <td>".$row["NUM_COTIZACION"]."</td>
                                            <td>".$row["IDEMCOMPRADOR"]."</td>
                                            <td>".$row["NOMCOMPRADOR"]."</td>
                                            <td>".$row["NOMBEMPRESA"]."</td>
                                            <td>".$row["EMAIL"]."</td> 
                                            <td>".$row["TELEFONO"]."</td>
                                            <td>".$row["FECHAPUBLICACION"]."</td>
                                            <td>".$row["IDARTICULO"]."</td>
                                            <td>".$row["NOMBARTICULO"]."</td>
                                            <td>".$row["CANTIDAD"]."</td> 
                                        </tr>";
                                    } 
                        }else{
                            $posicion = consulta::ProveedoresInvitadosCZ2($NumCotizacion,$fechapri,$fechase);
                                foreach ($posicion as $row) {
                                    echo "
                                        <tr>                                                    
                                            <td>".$row["NUM_COTIZACION"]."</td>
                                            <td>".$row["IDEMCOMPRADOR"]."</td>
                                            <td>".$row["NOMCOMPRADOR"]."</td>
                                            <td>".$row["NOMBEMPRESA"]."</td>
                                            <td>".$row["EMAIL"]."</td> 
                                            <td>".$row["TELEFONO"]."</td>
                                            <td>".$row["FECHAPUBLICACION"]."</td>
                                            <td>".$row["IDARTICULO"]."</td>
                                            <td>".$row["NOMBARTICULO"]."</td>
                                            <td>".$row["CANTIDAD"]."</td> 
                                        </tr>";
                                }
                        }                                                  
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="Reporte estado CZ ".$_POST['fecha1']." - ".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?> 
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>Empresa Compradora</th> 
                    <th>Centro de Costos</th>
                    <th>ID Cotizacion</th>
                    <th>Usuario</th>
                    <th>Nom Cotización</th> 
                    <th>Num Cotización</th> 
                    <th>Despacho</th>
                    <th>Forma de Pago</th>
                    <th>Fecha Creación</th>
                    <th>Fecha Cierre</th> 
                    <th>Estado de COT</th>                                          
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporte'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2']; 
                        $estado       = $_POST['idestado'];                                                 
                    $posicion = consulta::czestado($fechapri,$fechase,$estado);
                    foreach ($posicion as $row) {
                        echo "
                            <tr>                                                    
                                <td>".$row["EmpresaCompradora"]."</td>
                                <td>".$row["centrocostos"]."</td>
                                <td>".$row["idcotizacion"]."</td> 
                                <td>".$row["usuario"]."</td>
                                <td>".$row["nombrecot"]."</td>
                                <td>".$row["numcot"]."</td>
                                <td>".$row["despacho"]."</td> 
                                <td>".$row["formapago"]."</td> 
                                <td>".$row["fechacrea"]."</td>
                                <td>".$row["fechacie"]."</td>
                                <td>".$row["estado"]."</td>                                                                                 
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="Reporte CZ Fecha ".$_POST['fecha1']." - ".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?> 
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>empresaCompradora</th>
                    <th>nombreEmpresaCompradora</th>
                    <th>idcentrocostoCompradora</th> 
                    <th>nombreCcostosCompradora</th>
                    <th>nombreCotizacion</th>
                    <th>FechaCreacionCotizacion</th>
                    <th>estadoCotizacion</th> 
                    <th>IDEmpresaInvitada</th> 
                    <th>nombreempresaInvitada</th>
                    <th>idOferta</th>
                    <th>nombreOferta</th>
                    <th>nombreempresaOferto</th> 
                    <th>sucursalOferto</th> 
                    <th>Contacto</th> 
                    <th>Correo Contacto</th> 
                    <th>Telefono contacto</th>
                    <th>Celular</th> 
                    <th>ciudad</th>                                                    
                    <th>EstadoAdjudicacionOferta</th> 
                    <th>estadoOferta</th> 
                    <th>valorOfertado</th>                                          
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporteempre'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2'];
                        $idempresa    = $_POST['idempre'];                                                  
                    $posicion = consulta::consczempre($fechapri,$fechase,$idempresa);
                    foreach ($posicion as $row) {
                        echo "
                            <tr>                                                    
                                <td>".$row["empresaCompradora"]."</td>
                                <td>".$row["nombreEmpresaCompradora"]."</td>
                                <td>".$row["idcentrocostoCompradora"]."</td> 
                                <td>".$row["nombreCcostosCompradora"]."</td>
                                <td>".$row["nombreCotizacion"]."</td>
                                <td>".$row["FechaCreacionCotizacion"]."</td>
                                <td>".$row["estadoCotizacion"]."</td> 
                                <td>".$row["IDEmpresaInvitada"]."</td> 
                                <td>".$row["nombreempresaInvitada"]."</td>
                                <td>".$row["idOferta"]."</td>
                                <td>".$row["nombreOferta"]."</td>
                                <td>".$row["nombreempresaOferto"]."</td> 
                                <td>".$row["sucursalOferto"]."</td> 
                                <td>".$row["Contacto"]."</td> 
                                <td>".$row["Correo Contacto"]."</td> 
                                <td>".$row["Telefono contacto"]."</td>
                                <td>".$row["Celular"]."</td> 
                                <td>".$row["ciudad"]."</td>                                                   
                                <td>".$row["EstadoAdjudicacionOferta"]."</td> 
                                <td>".$row["estadoOferta"]."</td> 
                                <td>".$row["valorOfertado"]."</td>                                                                                 
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="Reporte Cotizaciones ".$_POST['fecha1']." - ".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?>
    <meta charset="utf-8"> 
        <table border="1">
            <thead>
                <tr>
                    <th>empresaCompradora</th>
                    <th>nombreEmpresaCompradora</th>
                    <th>idcentrocostoCompradora</th> 
                    <th>nombreCcostosCompradora</th>
                    <th>nombreCotizacion</th>
                    <th>FechaCreacionCotizacion</th>
                    <th>estadoCotizacion</th> 
                    <th>IDEmpresaInvitada</th> 
                    <th>nombreempresaInvitada</th>
                    <th>idOferta</th>
                    <th>nombreOferta</th>
                    <th>nombreempresaOferto</th> 
                    <th>sucursalOferto</th>                                                     
                    <th>EstadoAdjudicacionOferta</th> 
                    <th>estadoOferta</th> 
                    <th>valorOfertado</th>                                          
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporte'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2'];
                        $idempresa    = $_POST['idempre'];                                                  
                    $posicion = consulta::consczsincontacempre($fechapri,$fechase,$idempresa);                                                  
                    foreach ($posicion as $row) {
                        echo "
                            <tr>                                                    
                                <td>".$row["empresaCompradora"]."</td>
                                <td>".$row["nombreEmpresaCompradora"]."</td>
                                <td>".$row["idcentrocostoCompradora"]."</td> 
                                <td>".$row["nombreCcostosCompradora"]."</td>
                                <td>".$row["nombreCotizacion"]."</td>
                                <td>".$row["FechaCreacionCotizacion"]."</td>
                                <td>".$row["estadoCotizacion"]."</td> 
                                <td>".$row["IDEmpresaInvitada"]."</td> 
                                <td>".$row["nombreempresaInvitada"]."</td>
                                <td>".$row["idOferta"]."</td>
                                <td>".$row["nombreOferta"]."</td>
                                <td>".$row["nombreempresaOferto"]."</td> 
                                <td>".$row["sucursalOferto"]."</td>                                               
                                <td>".$row["EstadoAdjudicacionOferta"]."</td> 
                                <td>".$row["estadoOferta"]."</td> 
                                <td>".$row["valorOfertado"]."</td>                                                                                 
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="Reporte Cotizaciones pasaron a Ordenes de compra ".$_POST['fecha1']." - ".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?>
    <meta charset="utf-8"> 
        <table border="1">
            <thead>
                <tr>
                    <th>Numero de Cotización</th>
                    <th>Estado Cotización</th>
                    <th>Numero de Orden de Compra</th> 
                    <th>Estado Orden de Compra</th>
                    <th>Empresa Compradora</th>
                    <th>Empresa Proveedora</th>
                    <th>Contacto</th> 
                    <th>Total OC</th>
                    <th>Fecha Cotizacion creada</th>                                          
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporte'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2'];                                                  
                    $posicion = consulta::consunumcz($fechapri,$fechase);                                                  
                    foreach ($posicion as $row) {
                        echo "
                            <tr>                                                    
                                <td>".$row["numcz"]."</td>
                                <td>".$row["descricz"]."</td>
                                <td>".$row["numoc"]."</td> 
                                <td>".$row["descrioc"]."</td>
                                <td>".$row["emprecompra"]."</td>
                                <td>".$row["proveedor"]."</td>
                                <td>".$row["usuario"]."</td>
                                <td>".$row["total"]."</td>
                                <td>".$row["fechacz"]."</td>                                                                                 
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="Reporte Cotizaciones2 ".$_POST['fecha1']." - ".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?> 
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>empresaCompradora</th>
                    <th>nombreEmpresaCompradora</th>
                    <th>idcentrocostoCompradora</th> 
                    <th>nombreCcostosCompradora</th>
                    <th>nombreCotizacion</th>
                    <th>FechaCreacionCotizacion</th>
                    <th>estadoCotizacion</th> 
                    <th>IDEmpresaInvitada</th> 
                    <th>nombreempresaInvitada</th>
                    <th>idOferta</th>
                    <th>nombreOferta</th>
                    <th>nombreempresaOferto</th> 
                    <th>sucursalOferto</th>                                                     
                    <th>EstadoAdjudicacionOferta</th> 
                    <th>estadoOferta</th> 
                    <th>valorOfertado</th>                                          
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reportee'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2'];                                                  
                    $posicion = consulta::consczsincontac($fechapri,$fechase);
                    foreach ($posicion as $row) {
                        echo "
                            <tr>                                                    
                                <td>".$row["empresaCompradora"]."</td>
                                <td>".$row["nombreEmpresaCompradora"]."</td>
                                <td>".$row["idcentrocostoCompradora"]."</td> 
                                <td>".$row["nombreCcostosCompradora"]."</td>
                                <td>".$row["nombreCotizacion"]."</td>
                                <td>".$row["FechaCreacionCotizacion"]."</td>
                                <td>".$row["estadoCotizacion"]."</td> 
                                <td>".$row["IDEmpresaInvitada"]."</td> 
                                <td>".$row["nombreempresaInvitada"]."</td>
                                <td>".$row["idOferta"]."</td>
                                <td>".$row["nombreOferta"]."</td>
                                <td>".$row["nombreempresaOferto"]."</td> 
                                <td>".$row["sucursalOferto"]."</td>                                               
                                <td>".$row["EstadoAdjudicacionOferta"]."</td> 
                                <td>".$row["estadoOferta"]."</td> 
                                <td>".$row["valorOfertado"]."</td>                                                                                 
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="Reporte CZ Y OC Mincivil ".$_POST['fecha1']."-".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?> 
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>Nombre Empresa Compradora</th>
                    <th>Nombre Ccostos Compradora</th>
                    <th>Num cz</th>
                    <th>Nombre Cotizacion</th>
                    <th>Fecha Creacion Cotizacion</th>
                    <th>estado Cotizacion</th>
                    <th>ID Empresa Invitada</th>
                    <th>Nombre empresa Invitada</th>
                    <th>NombreOferta</th>
                    <th>Nombre empresa Oferto</th>
                    <th>Sucursal Oferto</th>
                    <th>Detalle</th>
                    <th>codigo items</th>
                    <th>Precio Unitario</th>
                    <th>Cantidad</th>
                    <th>Estado Adjudicacion Oferta</th>
                    <th>Estado Oferta</th>
                    <th>Ofertó</th>                                          
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporte'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2'];                                                  
                    $posicion = consulta::ofertasocitems($fechapri,$fechase);
                    foreach ($posicion as $row) {
                        echo "
                            <tr>                                                    
                                <td>".$row["nombreEmpresaCompradora"]."</td>
                                <td>".$row["nombreCcostosCompradora"]."</td>
                                <td>".$row["numcz"]."</td>
                                <td>".$row["nombreCotizacion"]."</td>
                                <td>".$row["FechaCreacionCotizacion"]."</td>
                                <td>".$row["estadoCotizacion"]."</td>
                                <td>".$row["IDEmpresaInvitada"]."</td>
                                <td>".$row["nombreempresaInvitada"]."</td>
                                <td>".$row["nombreOferta"]."</td>
                                <td>".$row["nombreempresaOferto"]."</td>
                                <td>".$row["sucursalOferto"]."</td>
                                <td>".$row["Detalle"]."</td>
                                <td>".$row["codigoitems"]."</td>
                                <td>".$row["precioitem"]."</td>
                                <td>".$row["cantidad"]."</td>   
                                <td>".$row["EstadoAdjudicacionOferta"]."</td>   
                                <td>".$row["estadoOferta"]."</td>   
                                <td>".$row["Oferto"]."</td>                                                                                 
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table><br><br>
        <table border="1">
            <thead>
                <tr>
                    <th>Id Empresa Compradora</th>
                    <th>Empresa Compradora</th>
                    <th>idOrg Compra</th> 
                    <th>Nombre OrgCompra</th>
                    <th>Id Empresa Proveedora</th>
                    <th>Empresa Proveedora</th>
                    <th>Id Sucursal Venta</th> 
                    <th>Sucursal Venta</th> 
                    <th>No OC</th>
                    <th>Moneda</th>
                    <th>Precio Unitario</th>
                    <th>Id Estado Doc</th> 
                    <th>Estado doc</th>                                          
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporte'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2'];                                                  
                    $posicion = consulta::infocitems($fechapri,$fechase);
                    foreach ($posicion as $row) {
                        echo "
                            <tr>                                                    
                                <td>".$row["idEmpresaCompradora"]."</td>
                                <td>".$row["EmpresaCompradora"]."</td>
                                <td>".$row["idOrgCompra"]."</td> 
                                <td>".$row["nombreOrgCompra"]."</td>
                                <td>".$row["idEmpresaProveedora"]."</td>
                                <td>".$row["EmpresaProveedora"]."</td>
                                <td>".$row["idSucursalVenta"]."</td> 
                                <td>".$row["SucursalVenta"]."</td> 
                                <td>".$row["NoOC"]."</td>
                                <td>".$row["moneda"]."</td>
                                <td>".$row["preciouni"]."</td>
                                <td>".$row["idEstadoDoc"]."</td> 
                                <td>".$row["estadodoc"]."</td>                                                                                 
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="Reporte Oferta ".$_POST['fecha1']." - ".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?> 
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>empresaCompradora</th>
                    <th>nombreEmpresaCompradora</th>
                    <th>idcentrocostoCompradora</th> 
                    <th>nombreCcostosCompradora</th>
                    <th>nombreCotizacion</th>
                    <th>numeroCotizacion</th>
                    <th>FechaCreacionCotizacion</th>
                    <th>estadoCotizacion</th> 
                    <th>IDEmpresaInvitada</th> 
                    <th>nombreempresaInvitada</th>
                    <th>idOferta</th>
                    <th>nombreOferta</th>
                    <th>nombreempresaOferto</th> 
                    <th>sucursalOferto</th> 
                    <th>Detalle</th>
                    <th>cantidad</th>                                                   
                    <th>EstadoAdjudicacionOferta</th> 
                    <th>estadoOferta</th> 
                    <th>valorOfertado</th>                                          
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporte'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2'];                                                 
                    $posicion = consulta::ofertatodas($fechapri,$fechase);
                    foreach ($posicion as $row) {
                        echo "
                            <tr>                                                    
                                <td>".$row["empresaCompradora"]."</td>
                                <td>".$row["nombreEmpresaCompradora"]."</td>
                                <td>".$row["idcentrocostoCompradora"]."</td> 
                                <td>".$row["nombreCcostosCompradora"]."</td>
                                <td>".$row["nombreCotizacion"]."</td>
                                <td>".$row["numcz"]."</td>
                                <td>".$row["FechaCreacionCotizacion"]."</td>
                                <td>".$row["estadoCotizacion"]."</td> 
                                <td>".$row["IDEmpresaInvitada"]."</td> 
                                <td>".$row["nombreempresaInvitada"]."</td>
                                <td>".$row["idOferta"]."</td>
                                <td>".$row["nombreOferta"]."</td>
                                <td>".$row["nombreempresaOferto"]."</td> 
                                <td>".$row["sucursalOferto"]."</td>
                                <td>".$row["Detalle"]."</td>
                                <td>".$row["cantidad"]."</td>                                                   
                                <td>".$row["EstadoAdjudicacionOferta"]."</td> 
                                <td>".$row["estadoOferta"]."</td> 
                                <td>".$row["valorOfertado"]."</td>                                                                                  
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="Reporte Oferta Fecha ".$_POST['fecha1']." - ".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?> 
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>empresaCompradora</th>
                    <th>nombreEmpresaCompradora</th>
                    <th>idcentrocostoCompradora</th> 
                    <th>nombreCcostosCompradora</th>
                    <th>nombreCotizacion</th>
                    <th>numeroCotizacion</th>
                    <th>FechaCreacionCotizacion</th>
                    <th>estadoCotizacion</th> 
                    <th>IDEmpresaInvitada</th> 
                    <th>nombreempresaInvitada</th>
                    <th>idOferta</th>
                    <th>nombreOferta</th>
                    <th>nombreempresaOferto</th> 
                    <th>sucursalOferto</th> 
                    <th>Detalle</th>
                    <th>cantidad</th>                                                   
                    <th>EstadoAdjudicacionOferta</th> 
                    <th>estadoOferta</th> 
                    <th>valorOfertado</th>                                           
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporte'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2'];  
                        $idempresa    = $_POST['idempre'];                                               
                    $posicion = consulta::ofertaidempresa($fechapri,$fechase,$idempresa);
                    foreach ($posicion as $row) {
                        echo "
                            <tr>                                                    
                                <td>".$row["empresaCompradora"]."</td>
                                <td>".$row["nombreEmpresaCompradora"]."</td>
                                <td>".$row["idcentrocostoCompradora"]."</td> 
                                <td>".$row["nombreCcostosCompradora"]."</td>
                                <td>".$row["nombreCotizacion"]."</td>
                                <td>".$row["numcz"]."</td>
                                <td>".$row["FechaCreacionCotizacion"]."</td>
                                <td>".$row["estadoCotizacion"]."</td> 
                                <td>".$row["IDEmpresaInvitada"]."</td> 
                                <td>".$row["nombreempresaInvitada"]."</td>
                                <td>".$row["idOferta"]."</td>
                                <td>".$row["nombreOferta"]."</td>
                                <td>".$row["nombreempresaOferto"]."</td> 
                                <td>".$row["sucursalOferto"]."</td>
                                <td>".$row["Detalle"]."</td>
                                <td>".$row["cantidad"]."</td>                                                   
                                <td>".$row["EstadoAdjudicacionOferta"]."</td> 
                                <td>".$row["estadoOferta"]."</td> 
                                <td>".$row["valorOfertado"]."</td>                                                                                  
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="Maestro de materiales ".$_POST['fecha1']." - ".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?> 
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>EMPRESA</th>
                    <th>CODIGO ITEM</th>
                    <th>DESCRIPCIÓN ITEM</th>
                    <th>ID UNIDAD MEDIDA</th> 
                    <th>UNIDAD MEDIDA</th>
                    <th>DESCRIPCIÓN CLASIFIACIÓN</th>
                    <th>RUT ITEM</th> 
                    <th>ACTIVO</th>
                    <th>FECHA CREACION</th>                                        
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporte'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2'];                                                 
                    $posicion = consulta::mmateriales($fechapri,$fechase);
                    foreach ($posicion as $row) {
                        echo "
                            <tr>  
                                <td>".$row["empresa"]."</td>                                                  
                                <td>".$row["CodigoItem"]."</td>
                                <td>".$row["DescripcionItem"]."</td>
                                <td>".$row["IdUnidadMedida"]."</td> 
                                <td>".$row["unidadMedida"]."</td>
                                <td>".$row["DescripcionClasificacion"]."</td>
                                <td>".$row["RutaItem"]."</td>
                                <td>".$row["Activo"]."</td>
                                <td>".$row["fechacreacion"]."</td>                                                                                
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="Maestro de materiales Fecha ".$_POST['fecha1']." - ".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?> 
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>EMPRESA</th>
                    <th>CODIGO ITEM</th>
                    <th>DESCRIPCIÓN ITEM</th>
                    <th>ID UNIDAD MEDIDA</th> 
                    <th>UNIDAD MEDIDA</th>
                    <th>DESCRIPCIÓN CLASIFIACIÓN</th>
                    <th>RUT ITEM</th> 
                    <th>ACTIVO</th>
                    <th>FECHA CREACION</th>                                        
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporteempre'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2'];
                        $idempresa    = $_POST['idempre'];                                                 
                    $posicion = consulta::mmateriales2($fechapri,$fechase,$idempresa);
                    foreach ($posicion as $row) {
                        echo "
                            <tr>  
                                <td>".$row["empresa"]."</td>                                                  
                                <td>".$row["CodigoItem"]."</td>
                                <td>".$row["DescripcionItem"]."</td>
                                <td>".$row["IdUnidadMedida"]."</td> 
                                <td>".$row["unidadMedida"]."</td>
                                <td>".$row["DescripcionClasificacion"]."</td>
                                <td>".$row["RutaItem"]."
                                <td>".$row["Activo"]."</td>
                                <td>".$row["fechacreacion"]."</td>                                                                              
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="Reporte Recepcion ".$_POST['fecha1']." - ".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?>
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>Empresa</th>
                    <th>Numero OrdenCompra</th>
                    <th>Proveedor</th>
                    <th>Fecha envio</th> 
                    <th>Totalneto</th>
                    <th>IvaOC</th>
                    <th>Partida Presupuestal</th>
                    <th>NumDocRecepcion</th> 
                    <th>MontoNeto Recibido</th> 
                    <th>Iva Recibido</th>
                    <th>Total</th>
                    <th>Fecha Recepcion</th>
                    <th>Estado</th>
                    <th>Comprobante Ingreso</th>
                    <th>Estado Recepcion</th>
                    <th>Estado OC</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporte'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2'];                                               
                    $posicion = consulta::recepciones($fechapri,$fechase);
                    foreach ($posicion as $row) {
                        echo "
                            <tr>                                                    
                                <td>".$row["Empresa"]."</td>                                                 
                                <td>".$row["NumOrdenCompra"]."</td>
                                <td>".$row["Proveedor"]."</td>
                                <td>".$row["Fechaenvioprov"]."</td> 
                                <td>".$row["TotalNetoOC"]."</td>
                                <td>".$row["IvaOC"]."</td>
                                <td>".$row["PartidaPresupuestal"]."</td>
                                <td>".$row["NumDocRecepcion"]."</td> 
                                <td>".$row["MontoNetoRecibido"]."</td> 
                                <td>".$row["IvaRecibido"]."</td> 
                                <td>".$row["Total"]."</td>
                                <td>".$row["FechaRecepcion"]."</td>
                                <td>".$row["estado"]."</td>
                                <td>".$row["comprobantedeingreso"]."</td>
                                <td>".$row["estadoocre"]."</td>
                                <td>".$row["estadooc"]."</td>
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="Reporte Recepcion2 Fecha ".$_POST['fecha1']." - ".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?>
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>Empresa</th>
                    <th>Numero OrdenCompra</th>
                    <th>Proveedor</th>
                    <th>Fecha envio</th> 
                    <th>Totalneto</th>
                    <th>IvaOC</th>
                    <th>Partida Presupuestal</th>
                    <th>NumDocRecepcion</th> 
                    <th>MontoNeto Recibido</th> 
                    <th>Iva Recibido</th>
                    <th>Total</th>
                    <th>Fecha Recepcion</th>
                    <th>Estado</th>
                    <th>Comprobante Ingreso</th>
                    <th>Estado Recepcion</th>
                    <th>Estado OC</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporteidempre'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2'];  
                        $idempresa    = $_POST['idempre'];                                            
                    $posicion = consulta::recepciones2($fechapri,$fechase,$idempresa);
                    foreach ($posicion as $row) {
                        echo "
                            <tr>                                                    
                                <td>".$row["Empresa"]."</td>                                                 
                                <td>".$row["NumOrdenCompra"]."</td>
                                <td>".$row["Proveedor"]."</td>
                                <td>".$row["Fechaenvioprov"]."</td> 
                                <td>".$row["TotalNetoOC"]."</td>
                                <td>".$row["IvaOC"]."</td>
                                <td>".$row["PartidaPresupuestal"]."</td>
                                <td>".$row["NumDocRecepcion"]."</td> 
                                <td>".$row["MontoNetoRecibido"]."</td> 
                                <td>".$row["IvaRecibido"]."</td> 
                                <td>".$row["Total"]."</td>
                                <td>".$row["FechaRecepcion"]."</td>
                                <td>".$row["estado"]."</td>
                                <td>".$row["comprobantedeingreso"]."</td>
                                <td>".$row["estadoocre"]."</td>
                                <td>".$row["estadooc"]."</td>
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="Proveedores integrados Fecha-".$_POST['fecha1']."-".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?>
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>Empresa</th>
                    <th>Nit</th>
                    <th>Estado Proveedor</th>
                    <th>Nomempre</th>
                    <th>Emprefan</th> 
                    <th>Tipoempre</th>
                    <th>Expr1</th>
                    <th>Expr2</th>
                    <th>Usuario</th> 
                    <th>Ubicacion</th> 
                    <th>nomusu</th> 
                    <th>Creacionusuario</th>
                    <th>Creacionempre</th>
                    <th>Expr3</th>
                    <th>Nomconta</th> 
                    <th>Teleconta</th> 
                    <th>Conmovil</th> 
                    <th>Contfax</th> 
                    <th>Contaemail</th>
                    <th>Contactivo</th> 
                    <th>Contaeliminado</th>                                                    
                    <th>Fechacreacion</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporteempre'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2'];  
                        $idempresa    = $_POST['idempre'];                                            
                    $posicion = consulta::integrados($idempresa,$fechapri,$fechase);
                    foreach ($posicion as $row) {
                        echo "
                            <tr>                                                    
                                <td>".$row["empresa"]."</td>
                                <td>".$row["nit"]."</td>
                                <td>".$row["EstadoProveedor"]."</td>
                                <td>".$row["nomempre"]."</td>
                                <td>".$row["emprefan"]."</td> 
                                <td>".$row["tipoempre"]."</td>
                                <td>".$row["Expr1"]."</td>
                                <td>".$row["Expr2"]."</td>
                                <td>".$row["usuario"]."</td> 
                                <td>".$row["ubicacion"]."</td>
                                <td>".$row["nomusu"]."</td> 
                                <td>".$row["creacionusuario"]."</td>
                                <td>".$row["creacionempre"]."</td>
                                <td>".$row["Expr3"]."</td>
                                <td>".$row["nomconta"]."</td> 
                                <td>".$row["teleconta"]."</td> 
                                <td>".$row["conmovil"]."</td> 
                                <td>".$row["contfax"]."</td> 
                                <td>".$row["contaemail"]."</td>
                                <td>".$row["contactivo"]."</td> 
                                <td>".$row["contaeliminado"]."</td>                                                    
                                <td>".$row["fechacreacion"]."</td> 
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="Proveedores integrados-".$_POST['fecha1']."-".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?>
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>Empresa</th>
                    <th>Nit</th>
                    <th>Estado Proveedor</th>
                    <th>Nomempre</th>
                    <th>Emprefan</th> 
                    <th>Tipoempre</th>
                    <th>Expr1</th>
                    <th>Expr2</th>
                    <th>Usuario</th> 
                    <th>Ubicacion</th> 
                    <th>nomusu</th> 
                    <th>Creacionusuario</th>
                    <th>Creacionempre</th>
                    <th>Expr3</th>
                    <th>Nomconta</th> 
                    <th>Teleconta</th> 
                    <th>Conmovil</th> 
                    <th>Contfax</th> 
                    <th>Contaemail</th>
                    <th>Contactivo</th> 
                    <th>Contaeliminado</th>                                                    
                    <th>Fechacreacion</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporte'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2'];                                            
                    $posicion = consulta::integradosall($fechapri,$fechase);
                    foreach ($posicion as $row) {
                        echo "
                            <tr>                                                    
                                <td>".$row["empresa"]."</td>
                                <td>".$row["nit"]."</td>
                                <td>".$row["EstadoProveedor"]."</td>
                                <td>".$row["nomempre"]."</td>
                                <td>".$row["emprefan"]."</td> 
                                <td>".$row["tipoempre"]."</td>
                                <td>".$row["Expr1"]."</td>
                                <td>".$row["Expr2"]."</td>
                                <td>".$row["usuario"]."</td> 
                                <td>".$row["ubicacion"]."</td>
                                <td>".$row["nomusu"]."</td> 
                                <td>".$row["creacionusuario"]."</td>
                                <td>".$row["creacionempre"]."</td>
                                <td>".$row["Expr3"]."</td>
                                <td>".$row["nomconta"]."</td> 
                                <td>".$row["teleconta"]."</td> 
                                <td>".$row["conmovil"]."</td> 
                                <td>".$row["contfax"]."</td> 
                                <td>".$row["contaemail"]."</td>
                                <td>".$row["contactivo"]."</td> 
                                <td>".$row["contaeliminado"]."</td>                                                    
                                <td>".$row["fechacreacion"]."</td>                                                                                
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="Pedido de materiales ".$_POST['fecha1']." - ".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?>
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>Nº Linea</th>
                    <th>EMPRESA</th>
                    <th>NOMBRE</th> 
                    <th>CENTRO COSTO</th>
                    <th>FECHA APROBACIÓN</th>
                    <th>SOLICITANTE</th>
                    <th>CODIGO</th> 
                    <th>DESCRIPCIÓN</th> 
                    <th>OBSERVACIONES</th> 
                    <th>FECHA ENTREGA</th> 
                    <th>UNIDAD</th> 
                    <th>CANTIDAD</th> 
                    <th>CANTIDAD COMPRADA</th>                                        
                    <th>CANTIDAD DESPACHO</th> 
                    <th>CANTIDAD PENDIENTE</th> 
                    <th>ESTADO</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporte'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2'];                                            
                    $posicion = consulta::pedidopm($fechapri,$fechase);
                    foreach ($posicion as $row) {
                        echo "
                            <tr>                                                    
                                <td>".$row["NLinea"]."/".$row["numlineas"]."</td>                                            
                                <td>".$row["empresa"]."</td>
                                <td>".$row["Nombre"]."</td>
                                <td>".$row["orgc"]."</td> 
                                <td>".$row["fechaprovacion"]."</td>
                                <td>".$row["solicitante"]."</td>
                                <td>".$row["codigo"]."</td>
                                <td>".$row["descripcion"]."</td>
                                <td>".$row["observaciones"]."</td>
                                <td>".$row["fechaentrega"]."</td>
                                <td>".$row["unidad"]."</td>
                                <td>".$row["cantidad"]."</td>
                                <td>".$row["cantcomprada"]."</td>
                                <td>".$row["cantdespacho"]."</td>
                                <td>".$row["cantpendiente"]."</td>
                                <td>".$row["Estado"]."</td> 
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="Pedido de materiales Fecha ".$_POST['fecha1']." - ".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?>
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>Nº Linea</th>
                    <th>EMPRESA</th>
                    <th>NOMBRE</th> 
                    <th>CENTRO COSTO</th>
                    <th>FECHA APROBACIÓN</th>
                    <th>SOLICITANTE</th>
                    <th>CODIGO</th> 
                    <th>DESCRIPCIÓN</th> 
                    <th>OBSERVACIONES</th> 
                    <th>FECHA ENTREGA</th> 
                    <th>UNIDAD</th> 
                    <th>CANTIDAD</th> 
                    <th>CANTIDAD COMPRADA</th>                                        
                    <th>CANTIDAD DESPACHO</th> 
                    <th>CANTIDAD PENDIENTE</th> 
                    <th>ESTADO</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporte'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2']; 
                        $idempresa    = $_POST['idempre'];                                           
                    $posicion = consulta::pedidopmm($fechapri,$fechase,$idempresa);
                    foreach ($posicion as $row) {
                        echo "
                            <tr>                                                    
                                <td>".$row["NLinea"]."/".$row["numlineas"]."</td>                                            
                                <td>".$row["empresa"]."</td>
                                <td>".$row["Nombre"]."</td>
                                <td>".$row["orgc"]."</td> 
                                <td>".$row["fechaprovacion"]."</td>
                                <td>".$row["solicitante"]."</td>
                                <td>".$row["codigo"]."</td>
                                <td>".$row["descripcion"]."</td>
                                <td>".$row["observaciones"]."</td>
                                <td>".$row["fechaentrega"]."</td>
                                <td>".$row["unidad"]."</td>
                                <td>".$row["cantidad"]."</td>
                                <td>".$row["cantcomprada"]."</td>
                                <td>".$row["cantdespacho"]."</td>
                                <td>".$row["cantpendiente"]."</td>
                                <td>".$row["Estado"]."</td> 
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="Proveedores integrados Fecha-".$_POST['fecha1']."-".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?>
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>empresa</th>
                    <th>nomempre</th>
                    <th>emprefan</th> 
                    <th>tipoempre</th>
                    <th>Expr1</th>
                    <th>Expr2</th>
                    <th>usuario</th> 
                    <th>nomusu</th> 
                    <th>creacionusuario</th>
                    <th>creacionempre</th>
                    <th>Expr3</th>
                    <th>nomconta</th> 
                    <th>teleconta</th> 
                    <th>conmovil</th> 
                    <th>contfax</th> 
                    <th>contaemail</th>
                    <th>contactivo</th> 
                    <th>contaeliminado</th>                                                    
                    <th>fechacreacion</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporteempre'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2'];  
                        $idempresa    = $_POST['idempre'];                                            
                    $posicion = consulta::integrados($idempresa,$fechapri,$fechase);
                    foreach ($posicion as $row) {
                        echo "
                            <tr>                                                    
                                <td>".$row["empresa"]."</td>
                                <td>".$row["nomempre"]."</td>
                                <td>".$row["emprefan"]."</td> 
                                <td>".$row["tipoempre"]."</td>
                                <td>".$row["Expr1"]."</td>
                                <td>".$row["Expr2"]."</td>
                                <td>".$row["usuario"]."</td> 
                                <td>".$row["nomusu"]."</td> 
                                <td>".$row["creacionusuario"]."</td>
                                <td>".$row["creacionempre"]."</td>
                                <td>".$row["Expr3"]."</td>
                                <td>".$row["nomconta"]."</td> 
                                <td>".$row["teleconta"]."</td> 
                                <td>".$row["conmovil"]."</td> 
                                <td>".$row["contfax"]."</td> 
                                <td>".$row["contaemail"]."</td>
                                <td>".$row["contactivo"]."</td> 
                                <td>".$row["contaeliminado"]."</td>                                                    
                                <td>".$row["fechacreacion"]."</td> 
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="Proveedores integrados-".$_POST['fecha1']."-".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?>
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>empresa</th>
                    <th>nomempre</th>
                    <th>emprefan</th> 
                    <th>tipoempre</th>
                    <th>Expr1</th>
                    <th>Expr2</th>
                    <th>usuario</th> 
                    <th>nomusu</th> 
                    <th>creacionusuario</th>
                    <th>creacionempre</th>
                    <th>Expr3</th>
                    <th>nomconta</th> 
                    <th>teleconta</th> 
                    <th>conmovil</th> 
                    <th>contfax</th> 
                    <th>contaemail</th>
                    <th>contactivo</th> 
                    <th>contaeliminado</th>                                                    
                    <th>fechacreacion</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporte'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2'];                                            
                    $posicion = consulta::integradosall($fechapri,$fechase);
                    foreach ($posicion as $row) {
                        echo "
                            <tr>                                                    
                                <td>".$row["empresa"]."</td>
                                <td>".$row["nomempre"]."</td>
                                <td>".$row["emprefan"]."</td> 
                                <td>".$row["tipoempre"]."</td>
                                <td>".$row["Expr1"]."</td>
                                <td>".$row["Expr2"]."</td>
                                <td>".$row["usuario"]."</td> 
                                <td>".$row["nomusu"]."</td> 
                                <td>".$row["creacionusuario"]."</td>
                                <td>".$row["creacionempre"]."</td>
                                <td>".$row["Expr3"]."</td>
                                <td>".$row["nomconta"]."</td> 
                                <td>".$row["teleconta"]."</td> 
                                <td>".$row["conmovil"]."</td> 
                                <td>".$row["contfax"]."</td> 
                                <td>".$row["contaemail"]."</td>
                                <td>".$row["contactivo"]."</td> 
                                <td>".$row["contaeliminado"]."</td>                                                    
                                <td>".$row["fechacreacion"]."</td> 
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="OC integrados-nointegrados1".$_POST['fecha1']."-".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?>
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>idoc</th>
                    <th>idEmpresaCompradora</th>
                    <th>EmpresaCompradora</th> 
                    <th>idOrgCompra</th>
                    <th>nombreOrgCompra</th>
                    <th>idEmpresaProveedora</th>
                    <th>EmpresaProveedora</th> 
                    <th>Nit</th>
                    <th>Visibilidad</th>
                    <th>Estado Proveedor</th>  
                    <th>idSucursalVenta</th>
                    <th>SucursalVenta</th>
                    <th>Contacto</th>
                    <th>CorreoContacto</th> 
                    <th>Telefono</th>                                                     
                    <th>Celular</th>
                    <th>direccion</th>
                    <th>ciudad</th>
                    <th>fechaenvio</th>
                    <th>NoOC</th>
                    <th>total</th>
                    <th>idEstadoDoc</th>
                    <th>estadodoc</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporte'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2'];                                            
                    $posicion = consulta::nointegrados1($fechapri,$fechase);
                    foreach ($posicion as $row) {
                        echo "
                            <tr>                                                    
                                <td>".$row["idoc"]."</td>
                                <td>".$row["idEmpresaCompradora"]."</td>
                                <td>".$row["EmpresaCompradora"]."</td> 
                                <td>".$row["idOrgCompra"]."</td>
                                <td>".$row["nombreOrgCompra"]."</td>
                                <td>".$row["idEmpresaProveedora"]."</td>
                                <td>".$row["EmpresaProveedora"]."</td> 
                                <td>".$row["Nit"]."</td>
                                <td>".$row["VISIBILIDAD"]."</td> 
                                <td>".$row["EstadoProveedor"]."</td>
                                <td>".$row["idSucursalVenta"]."</td>
                                <td>".$row["SucursalVenta"]."</td>
                                <td>".$row["Contacto"]."</td>
                                <td>".$row["CorreoContacto"]."</td> 
                                <td>".$row["Telefono"]."</td>                                                     
                                <td>".$row["Celular"]."</td>
                                <td>".$row["direccion"]."</td>
                                <td>".$row["ciudad"]."</td>
                                <td>".$row["fechaenvio"]."</td>
                                <td>".$row["NoOC"]."</td>
                                <td>".$row["total"]."</td>
                                <td>".$row["idEstadoDoc"]."</td>
                                <td>".$row["estadodoc"]."</td>
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="OC integrados-nointegrados2".$_POST['fecha1']."-".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?>
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>idoc</th>
                    <th>idEmpresaCompradora</th>
                    <th>EmpresaCompradora</th> 
                    <th>idOrgCompra</th>
                    <th>nombreOrgCompra</th>
                    <th>idEmpresaProveedora</th>
                    <th>EmpresaProveedora</th> 
                    <th>Nit</th>
                    <th>Visibilidad</th>
                    <th>Estado Proveedor</th>  
                    <th>idSucursalVenta</th>
                    <th>SucursalVenta</th>
                    <th>Contacto</th>
                    <th>CorreoContacto</th> 
                    <th>Telefono</th>                                                     
                    <th>Celular</th>
                    <th>direccion</th>
                    <th>ciudad</th>
                    <th>fechaenvio</th>
                    <th>NoOC</th>
                    <th>total</th>
                    <th>idEstadoDoc</th>
                    <th>estadodoc</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporte'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2'];  
                        $idempresa    = $_POST['idempre'];                                          
                    $posicion = consulta::nointegrados2($fechapri,$fechase,$idempresa);
                    foreach ($posicion as $row) {
                        echo "
                            <tr>                                                    
                                <td>".$row["idoc"]."</td>
                                <td>".$row["idEmpresaCompradora"]."</td>
                                <td>".$row["EmpresaCompradora"]."</td> 
                                <td>".$row["idOrgCompra"]."</td>
                                <td>".$row["nombreOrgCompra"]."</td>
                                <td>".$row["idEmpresaProveedora"]."</td>
                                <td>".$row["EmpresaProveedora"]."</td> 
                                <td>".$row["Nit"]."</td>
                                <td>".$row["VISIBILIDAD"]."</td> 
                                <td>".$row["EstadoProveedor"]."</td>
                                <td>".$row["idSucursalVenta"]."</td>
                                <td>".$row["SucursalVenta"]."</td>
                                <td>".$row["Contacto"]."</td>
                                <td>".$row["CorreoContacto"]."</td> 
                                <td>".$row["Telefono"]."</td>                                                     
                                <td>".$row["Celular"]."</td>
                                <td>".$row["direccion"]."</td>
                                <td>".$row["ciudad"]."</td>
                                <td>".$row["fechaenvio"]."</td>
                                <td>".$row["NoOC"]."</td>
                                <td>".$row["total"]."</td>
                                <td>".$row["idEstadoDoc"]."</td>
                                <td>".$row["estadodoc"]."</td> 
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="OC integrados-nointegrados3".$_POST['fecha1']."-".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?>
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>idoc</th>
                    <th>idEmpresaCompradora</th>
                    <th>EmpresaCompradora</th> 
                    <th>idOrgCompra</th>
                    <th>nombreOrgCompra</th>
                    <th>idEmpresaProveedora</th>
                    <th>EmpresaProveedora</th> 
                    <th>Nit</th>
                    <th>Visibilidad</th>
                    <th>Estado Proveedor</th>  
                    <th>idSucursalVenta</th>
                    <th>SucursalVenta</th>
                    <th>Contacto</th>
                    <th>CorreoContacto</th> 
                    <th>Telefono</th>                                                     
                    <th>Celular</th>
                    <th>direccion</th>
                    <th>ciudad</th>
                    <th>fechaenvio</th>
                    <th>NoOC</th>
                    <th>total</th>
                    <th>idEstadoDoc</th>
                    <th>estadodoc</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporte'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2'];  
                        $estado       = $_POST['estado'];                                          
                    $posicion = consulta::nointegrados3($fechapri,$fechase,$estado);
                    foreach ($posicion as $row) {
                        echo "
                            <tr>                                                    
                                <td>".$row["idoc"]."</td>
                                <td>".$row["idEmpresaCompradora"]."</td>
                                <td>".$row["EmpresaCompradora"]."</td> 
                                <td>".$row["idOrgCompra"]."</td>
                                <td>".$row["nombreOrgCompra"]."</td>
                                <td>".$row["idEmpresaProveedora"]."</td>
                                <td>".$row["EmpresaProveedora"]."</td> 
                                <td>".$row["Nit"]."</td>
                                <td>".$row["VISIBILIDAD"]."</td> 
                                <td>".$row["EstadoProveedor"]."</td>
                                <td>".$row["idSucursalVenta"]."</td>
                                <td>".$row["SucursalVenta"]."</td>
                                <td>".$row["Contacto"]."</td>
                                <td>".$row["CorreoContacto"]."</td> 
                                <td>".$row["Telefono"]."</td>                                                     
                                <td>".$row["Celular"]."</td>
                                <td>".$row["direccion"]."</td>
                                <td>".$row["ciudad"]."</td>
                                <td>".$row["fechaenvio"]."</td>
                                <td>".$row["NoOC"]."</td>
                                <td>".$row["total"]."</td>
                                <td>".$row["idEstadoDoc"]."</td>
                                <td>".$row["estadodoc"]."</td> 
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="OC integrados-nointegrados4".$_POST['fecha1']."-".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?>
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>idoc</th>
                    <th>idEmpresaCompradora</th>
                    <th>EmpresaCompradora</th> 
                    <th>idOrgCompra</th>
                    <th>nombreOrgCompra</th>
                    <th>idEmpresaProveedora</th>
                    <th>EmpresaProveedora</th> 
                    <th>Nit</th>
                    <th>Visibilidad</th>
                    <th>Estado Proveedor</th>  
                    <th>idSucursalVenta</th>
                    <th>SucursalVenta</th>
                    <th>Contacto</th>
                    <th>CorreoContacto</th> 
                    <th>Telefono</th>                                                     
                    <th>Celular</th>
                    <th>direccion</th>
                    <th>ciudad</th>
                    <th>fechaenvio</th>
                    <th>NoOC</th>
                    <th>total</th>
                    <th>idEstadoDoc</th>
                    <th>estadodoc</th> 
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporte'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2'];  
                        $visibilidad  = $_POST['visibilidad'];                                          
                    $posicion = consulta::nointegrados4($fechapri,$fechase,$visibilidad);
                    foreach ($posicion as $row) {
                        echo "
                            <tr>                                                    
                                <td>".$row["idoc"]."</td>
                                <td>".$row["idEmpresaCompradora"]."</td>
                                <td>".$row["EmpresaCompradora"]."</td> 
                                <td>".$row["idOrgCompra"]."</td>
                                <td>".$row["nombreOrgCompra"]."</td>
                                <td>".$row["idEmpresaProveedora"]."</td>
                                <td>".$row["EmpresaProveedora"]."</td> 
                                <td>".$row["Nit"]."</td>
                                <td>".$row["VISIBILIDAD"]."</td> 
                                <td>".$row["EstadoProveedor"]."</td>
                                <td>".$row["idSucursalVenta"]."</td>
                                <td>".$row["SucursalVenta"]."</td>
                                <td>".$row["Contacto"]."</td>
                                <td>".$row["CorreoContacto"]."</td> 
                                <td>".$row["Telefono"]."</td>                                                     
                                <td>".$row["Celular"]."</td>
                                <td>".$row["direccion"]."</td>
                                <td>".$row["ciudad"]."</td>
                                <td>".$row["fechaenvio"]."</td>
                                <td>".$row["NoOC"]."</td>
                                <td>".$row["total"]."</td>
                                <td>".$row["idEstadoDoc"]."</td>
                                <td>".$row["estadodoc"]."</td> 
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="OC integrados-nointegrados5".$_POST['fecha1']."-".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?>
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>idoc</th>
                    <th>idEmpresaCompradora</th>
                    <th>EmpresaCompradora</th> 
                    <th>idOrgCompra</th>
                    <th>nombreOrgCompra</th>
                    <th>idEmpresaProveedora</th>
                    <th>EmpresaProveedora</th> 
                    <th>Nit</th>
                    <th>Visibilidad</th>
                    <th>Estado Proveedor</th>  
                    <th>idSucursalVenta</th>
                    <th>SucursalVenta</th>
                    <th>Contacto</th>
                    <th>CorreoContacto</th> 
                    <th>Telefono</th>                                                     
                    <th>Celular</th>
                    <th>direccion</th>
                    <th>ciudad</th>
                    <th>fechaenvio</th>
                    <th>NoOC</th>
                    <th>total</th>
                    <th>idEstadoDoc</th>
                    <th>estadodoc</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporte'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2'];
                        $idempresa    = $_POST['idempre'];
                        $estado       = $_POST['estado'];  
                        $visibilidad  = $_POST['visibilidad'];                                          
                    $posicion = consulta::nointegrados($fechapri,$fechase,$idempresa,$estado,$visibilidad);
                    foreach ($posicion as $row) {
                        echo "
                            <tr>                                                    
                                <td>".$row["idoc"]."</td>
                                <td>".$row["idEmpresaCompradora"]."</td>
                                <td>".$row["EmpresaCompradora"]."</td> 
                                <td>".$row["idOrgCompra"]."</td>
                                <td>".$row["nombreOrgCompra"]."</td>
                                <td>".$row["idEmpresaProveedora"]."</td>
                                <td>".$row["EmpresaProveedora"]."</td> 
                                <td>".$row["Nit"]."</td>
                                <td>".$row["VISIBILIDAD"]."</td> 
                                <td>".$row["EstadoProveedor"]."</td>
                                <td>".$row["idSucursalVenta"]."</td>
                                <td>".$row["SucursalVenta"]."</td>
                                <td>".$row["Contacto"]."</td>
                                <td>".$row["CorreoContacto"]."</td> 
                                <td>".$row["Telefono"]."</td>                                                     
                                <td>".$row["Celular"]."</td>
                                <td>".$row["direccion"]."</td>
                                <td>".$row["ciudad"]."</td>
                                <td>".$row["fechaenvio"]."</td>
                                <td>".$row["NoOC"]."</td>
                                <td>".$row["total"]."</td>
                                <td>".$row["idEstadoDoc"]."</td>
                                <td>".$row["estadodoc"]."</td> 
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="OC integrados-nointegrados6".$_POST['fecha1']."-".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?>
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>idoc</th>
                    <th>idEmpresaCompradora</th>
                    <th>EmpresaCompradora</th> 
                    <th>idOrgCompra</th>
                    <th>nombreOrgCompra</th>
                    <th>idEmpresaProveedora</th>
                    <th>EmpresaProveedora</th> 
                    <th>Nit</th>
                    <th>Visibilidad</th>
                    <th>Estado Proveedor</th>  
                    <th>idSucursalVenta</th>
                    <th>SucursalVenta</th>
                    <th>Contacto</th>
                    <th>CorreoContacto</th> 
                    <th>Telefono</th>                                                     
                    <th>Celular</th>
                    <th>direccion</th>
                    <th>ciudad</th>
                    <th>fechaenvio</th>
                    <th>NoOC</th>
                    <th>total</th>
                    <th>idEstadoDoc</th>
                    <th>estadodoc</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporte'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2'];
                        $idempresa    = $_POST['idempre'];
                        $estado       = $_POST['estado'];                                           
                    $posicion = consulta::nointegrados5($fechapri,$fechase,$idempresa,$estado);
                    foreach ($posicion as $row) {
                        echo "
                            <tr>                                                    
                                <td>".$row["idoc"]."</td>
                                <td>".$row["idEmpresaCompradora"]."</td>
                                <td>".$row["EmpresaCompradora"]."</td> 
                                <td>".$row["idOrgCompra"]."</td>
                                <td>".$row["nombreOrgCompra"]."</td>
                                <td>".$row["idEmpresaProveedora"]."</td>
                                <td>".$row["EmpresaProveedora"]."</td> 
                                <td>".$row["Nit"]."</td>
                                <td>".$row["VISIBILIDAD"]."</td> 
                                <td>".$row["EstadoProveedor"]."</td>
                                <td>".$row["idSucursalVenta"]."</td>
                                <td>".$row["SucursalVenta"]."</td>
                                <td>".$row["Contacto"]."</td>
                                <td>".$row["CorreoContacto"]."</td> 
                                <td>".$row["Telefono"]."</td>                                                     
                                <td>".$row["Celular"]."</td>
                                <td>".$row["direccion"]."</td>
                                <td>".$row["ciudad"]."</td>
                                <td>".$row["fechaenvio"]."</td>
                                <td>".$row["NoOC"]."</td>
                                <td>".$row["total"]."</td>
                                <td>".$row["idEstadoDoc"]."</td>
                                <td>".$row["estadodoc"]."</td> 
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="OC integrados-nointegrados7".$_POST['fecha1']."-".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?>
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>idoc</th>
                    <th>idEmpresaCompradora</th>
                    <th>EmpresaCompradora</th> 
                    <th>idOrgCompra</th>
                    <th>nombreOrgCompra</th>
                    <th>idEmpresaProveedora</th>
                    <th>EmpresaProveedora</th> 
                    <th>Nit</th>
                    <th>Visibilidad</th>
                    <th>Estado Proveedor</th>  
                    <th>idSucursalVenta</th>
                    <th>SucursalVenta</th>
                    <th>Contacto</th>
                    <th>CorreoContacto</th> 
                    <th>Telefono</th>                                                     
                    <th>Celular</th>
                    <th>direccion</th>
                    <th>ciudad</th>
                    <th>fechaenvio</th>
                    <th>NoOC</th>
                    <th>total</th>
                    <th>idEstadoDoc</th>
                    <th>estadodoc</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporte'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2'];
                        $idempresa    = $_POST['idempre'];
                        $visibilidad  = $_POST['visibilidad'];                                           
                    $posicion = consulta::nointegrados6($fechapri,$fechase,$idempresa,$visibilidad);
                    foreach ($posicion as $row) {
                        echo "
                            <tr>                                                    
                                <td>".$row["idoc"]."</td>
                                <td>".$row["idEmpresaCompradora"]."</td>
                                <td>".$row["EmpresaCompradora"]."</td> 
                                <td>".$row["idOrgCompra"]."</td>
                                <td>".$row["nombreOrgCompra"]."</td>
                                <td>".$row["idEmpresaProveedora"]."</td>
                                <td>".$row["EmpresaProveedora"]."</td> 
                                <td>".$row["Nit"]."</td>
                                <td>".$row["VISIBILIDAD"]."</td> 
                                <td>".$row["EstadoProveedor"]."</td>
                                <td>".$row["idSucursalVenta"]."</td>
                                <td>".$row["SucursalVenta"]."</td>
                                <td>".$row["Contacto"]."</td>
                                <td>".$row["CorreoContacto"]."</td> 
                                <td>".$row["Telefono"]."</td>                                                     
                                <td>".$row["Celular"]."</td>
                                <td>".$row["direccion"]."</td>
                                <td>".$row["ciudad"]."</td>
                                <td>".$row["fechaenvio"]."</td>
                                <td>".$row["NoOC"]."</td>
                                <td>".$row["total"]."</td>
                                <td>".$row["idEstadoDoc"]."</td>
                                <td>".$row["estadodoc"]."</td> 
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="Errores Maestrolog ".$_POST['fecha1']."-".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?>
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th style="background: red">Tipo Maestro</th>
                    <th style="background: red">Fecha Proceso</th>
                    <th style="background: red">Resultado Proceso</th>
                    <th style="background: red">Dato Principal</th> 
                    <th style="background: red">Dato Principal GC</th>
                    <th style="background: red">Datos RespuestaAR</th>
                    <th style="background: red">Datos Entrada</th>
                    <th style="background: yellow">Solución</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporte'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2'];
                        $tipomaes     = $_POST['tipomaestro'];                                           
                    $posicion = consulta::maestrologo($tipomaes,$fechapri,$fechase);
                    foreach ($posicion as $row1) {
                        $xml1 = str_replace('<','{',$row1["InMalo_DatosEntrada"]);
                        $xml2 = str_replace('>','}',$xml1);
                        echo "
                            <tr>                                                    
                                <td>".$row1["InMaLo_TipoMaestro"]."</td>                                                 
                                <td>".$row1["InMaLo_FechaProcesado"]."</td>
                                <td>".$row1["InMaLo_ResultadoProceso"]."</td>
                                <td>".$row1["InMaLo_DatoPrincipal"]."</td> 
                                <td>".$row1["InMaLo_DatoPrincipalGC"]."</td>
                                <td>".$row1["InMaLo_DatoRespuestaAR"]."</td>
                                <td>".$xml2."</td> 
                                <td style='background: yellow'> </td>
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="Errores Maestrolog all ".$_POST['fecha1']."-".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?>
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th style="background: red">Tipo Maestro</th>
                    <th style="background: red">Fecha Proceso</th>
                    <th style="background: red">Resultado Proceso</th>
                    <th style="background: red">Dato Principal</th> 
                    <th style="background: red">Dato Principal GC</th>
                    <th style="background: red">Datos RespuestaAR</th>
                    <th style="background: red">Datos Entrada</th>
                    <th style="background: yellow">Solución</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporte'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2'];                                          
                    $posicion = consulta::maestrologoall($fechapri,$fechase);
                    foreach ($posicion as $row1) {
                        $xml1 = str_replace('<','{',$row1["InMalo_DatosEntrada"]);
                        $xml2 = str_replace('>','}',$xml1);
                        echo "
                            <tr>                                                    
                                <td>".$row1["InMaLo_TipoMaestro"]."</td>                                                 
                                <td>".$row1["InMaLo_FechaProcesado"]."</td>
                                <td>".$row1["InMaLo_ResultadoProceso"]."</td>
                                <td>".$row1["InMaLo_DatoPrincipal"]."</td> 
                                <td>".$row1["InMaLo_DatoPrincipalGC"]."</td>
                                <td>".$row1["InMaLo_DatoRespuestaAR"]."</td>
                                <td>".$xml2."</td> 
                                <td style='background: yellow'> </td> 
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="Centros de costos".$_POST['fecha1']." - ".$_POST['fecha2'].".xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?>
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>ESTADO</th>
                    <th>NOMBRE EMPRESA</th>
                    <th>ID EMPRESA</th>
                    <th>ID ORGC</th> 
                    <th>NOMBRE</th>
                    <th>COMENTARIOS</th>
                    <th>ID MAESTRO</th>
                    <th>ID USUARIO</th>
                    <th>FECHA ACTUALIZACION</th> 
                    <th>FECHA ACTUALIZACION MONITOR</th> 
                    <th>TELEFONO</th>
                    <th>CODIGO</th>
                    <th>CENTRO DE COSTOSUSAC</th>
                    <th>ESINTEGRADO</th> 
                    <th>FECHA ULTIMA COMPRA</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporte'])){ 
                        $fechapri     = $_POST['fecha1'];
                        $fechase      = $_POST['fecha2'];                                               
                    $posicion = consulta::centro_de_costos($fechapri,$fechase);
                    foreach ($posicion as $row) {
                        echo "
                            <tr>                                                    
                                <td>".$row["ESTADO"]."</td>
                                <td>".$row["EMPRESA"]."</td>
                                <td>".$row["idempresa"]."</td> 
                                <td>".$row["idorgc"]."</td>
                                <td>".$row["orgcnombre"]."</td>
                                <td>".$row["orgccomentarios"]."</td>
                                <td>".$row["orgcmaestro"]."</td>
                                <td>".$row["orgcusuarioini"]."</td> 
                                <td>".$row["orgcfechaactuali"]."</td> 
                                <td>".$row["orgcfechaactumoni"]."</td>
                                <td>".$row["orgctelefono"]."</td>
                                <td>".$row["orgccodigo"]."</td>
                                <td>".$row["orgccento"]."</td> 
                                <td>".$row["orgcesinte"]."</td> 
                                <td>".$row["orgcfechaulticom"]."</td> 
                            </tr>";
                        }
                    }
                ?>
            </tbody>
        </table>
    <?php 
    }elseif($_POST['repor']=="Reporte oferta.xls"){
        header("Content-Disposition: attachment; filename=".$reporte);
    ?>
    <meta charset="utf-8">
        <table border="1">
            <thead>
                <tr>
                    <th>PROVEEDOR</th>
                    <th>FECHA DE OFERTA</th>
                    <th>MONTO TOTAL</th>
                    <th>NOMBRE OFERTA</th>
                    <th>CENTRO DE COSTOS</th>
                    <th>LINEAS</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    if(isset($_POST['generar_reporte'])){ 
                        $nomoferta  = $_POST['nomoferta']; 
                        $nombreofer = $_POST['nombreofer'];                                         
                        $posicion   = consulta::calcularofertas($nomoferta);
                        $idoferta   =   $posicion["idcz"];
                        $resta      = consulta::restaoferta($idoferta);
                        $posicion2 = consulta::oferesult($idoferta);
                    foreach ($posicion2 as $row) {
                        echo "
                            <tr>                                                    
                                <td>".$row["Proveedor"]."</td>
                                <td>".$row["Fechaoferta"]."</td>
                                <td>".$row["Montototal"]."</td>
                                <td>".$row["nombreoferta"]."</td> 
                                <td>".$row["nomorgc"]."</td>
                                <td>".$row["lineas"]."</td>
                            </tr>";
                        }
                    
                ?>
            </tbody>
        </table>
        <br>
        <table border="1">
            <thead>
                <tr>
                    <th>Ofertas con total mas bajo</th>
                </tr>
            </thead>
            <tbody>
                    <?php
                    foreach ($resta as $row) {
                        echo "
                            <tr>                                                    
                                <td>".$row["Montototal"]."</td>
                            </tr>";
                        }
                    } ?> 
            </tbody>
        </table>
        <br>
        <table border="1">
            <thead>
                <tr>
                    <th>Nombre Oferta-Cotizacion</th>
                </tr>
            </thead>
            <tbody>
                <tr>                                                    
                    <td><?php echo $nombreofer; ?></td>
                </tr>
            </tbody>
        </table>
    <?php 
    }
    ?>

    
                