<?php
    session_start();
    if(!isset($_SESSION["id_usuario"])){
        header("location: ../index.php");
    }
    require_once("../ccimarketplace/Model/db.conn.php");

    require_once("../ccimarketplace/Model/consultas.class.php");

    date_default_timezone_set("America/Bogota");
?>
<!doctype html>
<html lang="en">
 
<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="assets/vendor/bootstrap/css/bootstrap.min.css">
    <link href="assets/vendor/fonts/circular-std/style.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/libs/css/style.css">
    <link rel="stylesheet" href="assets/vendor/fonts/fontawesome/css/fontawesome-all.css">
    <link rel="stylesheet" href="assets/vendor/charts/chartist-bundle/chartist.css">
    <link rel="stylesheet" href="assets/vendor/charts/morris-bundle/morris.css">
    <link rel="stylesheet" href="assets/vendor/fonts/material-design-iconic-font/css/materialdesignicons.min.css">
    <link rel="stylesheet" href="assets/vendor/charts/c3charts/c3.css">
    <link rel="stylesheet" href="assets/vendor/fonts/flag-icon-css/flag-icon.min.css">

    <link rel="shorcut icon type=" href="icono/iconstruye-icon.ico"/>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.0.4.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="../Reportes_graficos/code/highcharts.js"></script>
    <script src="../Reportes_graficos/code/modules/exporting.js"></script>
    <script src="../Reportes_graficos/code/modules/export-data.js"></script>
    <script>
        $(document).ready(function () {
            $("#fecha1").change(function () { 
                var fechapri = $(this).val(); 
                var fechainicio = fechapri.replace('-','');  
                var fechainicio1 = fechainicio.replace('-','');                      
                $("#fechainicio").val(fechainicio1);
            });

           $("#fecha2").change(function () { 
                var fechafi = $(this).val();
                var fechainicio = fechafi.replace('-','');
                var fechainicio1 = fechainicio.replace('-','');
                $("#fechafinal").val(fechainicio1);
            });
        });     
    </script>
    <title>ICONSTRUYE COLOMBIA</title>
</head>

<body>
    <!-- ============================================================== -->
    <!-- main wrapper -->
    <!-- ============================================================== -->
    <div class="dashboard-main-wrapper">
        <!-- ============================================================== -->
        <!-- navbar -->
        <!-- ============================================================== -->
        <div class="dashboard-header">
            <nav class="navbar navbar-expand-lg bg-white fixed-top">
                <a class="navbar-brand" href="inicio.php">ICONSTRUYE COLOMBIA</a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse " id="navbarSupportedContent">
                    <ul class="navbar-nav ml-auto navbar-right-top">
                        <!--<li class="nav-item">
                            <div id="custom-search" class="top-search-bar">
                                <input class="form-control" type="text" placeholder="Search..">
                            </div>
                        </li>-->
                        <li class="nav-item dropdown notification">
                            <a class="nav-link nav-icons" href="#" id="navbarDropdownMenuLink1" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-fw fa-bell"></i> <span class="indicator"></span></a>
                            <ul class="dropdown-menu dropdown-menu-right notification-dropdown">
                                <li>
                                    <div class="notification-title"> Notificación</div>
                                    <!--<div class="notification-list">
                                        <div class="list-group">
                                            <a href="#" class="list-group-item list-group-item-action active">
                                                <div class="notification-info">
                                                    <div class="notification-list-user-img"><img src="assets/images/avatar-2.jpg" alt="" class="user-avatar-md rounded-circle"></div>
                                                    <div class="notification-list-user-block"><span class="notification-list-user-name">Jeremy Rakestraw</span>accepted your invitation to join the team.
                                                        <div class="notification-date">2 min ago</div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="notification-info">
                                                    <div class="notification-list-user-img"><img src="assets/images/avatar-3.jpg" alt="" class="user-avatar-md rounded-circle"></div>
                                                    <div class="notification-list-user-block"><span class="notification-list-user-name">John Abraham </span>is now following you
                                                        <div class="notification-date">2 days ago</div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="notification-info">
                                                    <div class="notification-list-user-img"><img src="assets/images/avatar-4.jpg" alt="" class="user-avatar-md rounded-circle"></div>
                                                    <div class="notification-list-user-block"><span class="notification-list-user-name">Monaan Pechi</span> is watching your main repository
                                                        <div class="notification-date">2 min ago</div>
                                                    </div>
                                                </div>
                                            </a>
                                            <a href="#" class="list-group-item list-group-item-action">
                                                <div class="notification-info">
                                                    <div class="notification-list-user-img"><img src="assets/images/avatar-5.jpg" alt="" class="user-avatar-md rounded-circle"></div>
                                                    <div class="notification-list-user-block"><span class="notification-list-user-name">Jessica Caruso</span>accepted your invitation to join the team.
                                                        <div class="notification-date">2 min ago</div>
                                                    </div>
                                                </div>
                                            </a>
                                        </div>
                                    </div>-->
                                </li>
                                <li>
                                    <div class="list-footer"> <a href="descargar.php">Descargar aplicacion Iconstruye Colombia para escritorio en este enlace</a></div>
                                </li>
                            </ul>
                        </li>
                        <!--<li class="nav-item dropdown connection">
                            <a class="nav-link" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="fas fa-fw fa-th"></i> </a>
                            <ul class="dropdown-menu dropdown-menu-right connection-dropdown">
                                <li class="connection-list">
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="assets/images/github.png" alt="" > <span>Github</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="assets/images/dribbble.png" alt="" > <span>Dribbble</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="assets/images/dropbox.png" alt="" > <span>Dropbox</span></a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="assets/images/bitbucket.png" alt=""> <span>Bitbucket</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="assets/images/mail_chimp.png" alt="" ><span>Mail chimp</span></a>
                                        </div>
                                        <div class="col-xl-4 col-lg-4 col-md-6 col-sm-12 col-12 ">
                                            <a href="#" class="connection-item"><img src="assets/images/slack.png" alt="" > <span>Slack</span></a>
                                        </div>
                                    </div>
                                </li>
                                <li>
                                    <div class="conntection-footer"><a href="#">More</a></div>
                                </li>
                            </ul>
                        </li>-->
                        <li class="nav-item dropdown nav-user">
                            <a class="nav-link nav-user-img" href="#" id="navbarDropdownMenuLink2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img src="icono/iconstruye-icon.jpg" alt="" class="user-avatar-md rounded-circle"></a>
                            <div class="dropdown-menu dropdown-menu-right nav-user-dropdown" aria-labelledby="navbarDropdownMenuLink2">
                                <!--<div class="nav-user-info">
                                    <h5 class="mb-0 text-white nav-user-name">John Abraham </h5>
                                    <span class="status"></span><span class="ml-2">Available</span>
                                </div>
                                <a class="dropdown-item" href="#"><i class="fas fa-user mr-2"></i>Account</a>
                                <a class="dropdown-item" href="#"><i class="fas fa-cog mr-2"></i>Setting</a>-->
                                <a class="dropdown-item" href="admiccimarketplace.php"><i class="fas fa-cog mr-2"></i>Admin pagina web iconstruye colombia</a>
                                <a class="dropdown-item" href="cerrarsesion.php"><i class="fas fa-power-off mr-2"></i>Cerrar Sesion</a>
                            </div>
                        </li>
                    </ul>
                </div>
            </nav>
        </div>
        <!-- ============================================================== -->
        <!-- end navbar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- left sidebar -->
        <!-- ============================================================== -->
        <div class="nav-left-sidebar sidebar-dark">
            <div class="menu-list">
                <nav class="navbar navbar-expand-lg navbar-light">
                    <a class="d-xl-none d-lg-none" href="inicio.php">Inicio</a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                    <div class="collapse navbar-collapse" id="navbarNav">
                        <ul class="navbar-nav flex-column">
                            <li class="nav-divider">
                                Menu
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link" href="inicio.php"><i class="fa fa-fw fa-user-circle"></i>Inicio</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-2" aria-controls="submenu-2"><i class="fas fa-fw fa-columns"></i>Ordenes de Compra</a>
                                <div id="submenu-2" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="oc.php">Monitoreo Ordenes de Compra</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="exportaroc.php">Exportar Ordenes de Compra</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="ocintegrado.php">OC proveedores integrados - no integrados</a>
                                        </li>
                                         <li class="nav-item">
                                            <a class="nav-link" href="exportarproveinte.php">Exportar OC proveedores integrados - no integrados</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="ordencompraceptada.php">Ordenes de Compra aceptadas</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-3" aria-controls="submenu-3"><i class="fas fa-fw fa-chart-pie"></i>Cotizaciones</a>
                                <div id="submenu-3" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="cotizaciones.php">Monitoreo Cotizaciones</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="exportarcotizacion.php">Exportar Cotizaciones</a>
                                        </li>
                                         <li class="nav-item">
                                            <a class="nav-link" href="estadocot.php">Estado de Cotizaciónes</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="oferta.php">Ofertas enviadas a Compra</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="czaoc.php">Cotizaciones que pasaron a compra</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="exportaroferta.php">Exportar Ofertas enviadas a Compra</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="infofertas.php">Informacion Ofeta</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="ProveedoresCotizar.php">Proveedores Cotizacion</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="infofertaoc.php">Informacion Ofertas y Ordenes * codigo item</a>
                                        </li>
                                         <li class="nav-item">
                                            <a class="nav-link" href="exportarczoc.php">Exportar Informacion Ofertas y Ordenes * codigo item</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item ">
                                <a class="nav-link active" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fab fa-fw fa-wpforms"></i>Recepciones</a>
                                <div id="submenu-4" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="recepcion.php">Monitoreo Recepciones</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="exportarecepcion.php">Exportar Recepciones</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-5" aria-controls="submenu-5"><i class="fas fa-fw fa-table"></i>Maestro de Materiales</a>
                                <div id="submenu-5" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="pedidomateriales.php">Pedido de Materiales</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="exportpedidomateria.php">Exportar pedido de Materiales</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="maestro.php">Monitoreo Maestro de Materiales</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="exportarmaestro.php">Exportar Maestro de Materiales</a>
                                        </li>
                                    </ul>
                                </div>
                            </li> 
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-6" aria-controls="submenu-6"><i class="fas fa-fw fa-file"></i>Consultar Insumos</a>
                                <div id="submenu-6" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                         <li class="nav-item">
                                            <a class="nav-link" href="insumosavanzado.php">Insumos Avanzados pro.integrados no integrados</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="articulo.php">Info. Insumos</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="proveeinsumo.php">Consultar Proveedores por insumo</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="insumoporproveedor.php">Informacion general por proveedor por insumo</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-7" aria-controls="submenu-7"><i class="fas fa-fw fa-table"></i>Proveedores no Integrados</a>
                                <div id="submenu-7" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="proveedoresinte.php">Consultar Proveedores no integrados</a>
                                        </li>
                                        <li class="nav-item">
                                            <a class="nav-link" href="expotarprointe.php">Exportar Proveedores no integrados</a>
                                        </li>
                                    </ul>
                                </div>
                            </li> 
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-8" aria-controls="submenu-8"><i class="fas fa-fw fa-table"></i> Centros de costos</a>
                                <div id="submenu-8" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="centro_de_costos.php">Info Centro de costos</a>
                                        </li>
                                    </ul>
                                </div>
                            </li> 
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-9" aria-controls="submenu-9"><i class="fas fa-fw fa-chart-pie"></i> Graficos</a>
                                <div id="submenu-9" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="ventasgrafi.php">Info Ventas</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>  
                            <li class="nav-item">
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-10" aria-controls="submenu-10"><i class="fas fa-fw fa-inbox"></i>Errores Maestrolog</a>
                                <div id="submenu-10" class="collapse submenu" style="">
                                    <ul class="nav flex-column">
                                        <li class="nav-item">
                                            <a class="nav-link" href="maestrolog.php">Maestrolog</a>
                                        </li>
                                    </ul>
                                </div>
                            </li>                                                                                
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- end left sidebar -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- wrapper  -->
        <!-- ============================================================== -->
        <div class="dashboard-wrapper">
            <div class="dashboard-ecommerce">
                <div class="container-fluid dashboard-content ">
                    <!-- ============================================================== -->
                    <!-- pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
                            <div class="page-header">
                                <h2 class="pageheader-title">REPORTE RECEPCIONES</h2>
                                <section id="formu" style='width:30%'>
                                    <p>1)Asignar los datos Fechas ,(Empresa) opcional.</p> 
                                    <p>2)Click en boton consulta.</p> 
                                    <p>3)Click en boton Exportar a excel.</p>
                                    <form role="form" action="exportarecepcion.php" method="POST">
                                        <label >Seleccionar Proveedor:</label>
                                        <select class='form-control' name='idempre'>
                                            <option value="todasempresas">TODOS LOS PROVEEDORES</option>
                                            <?php
                                          $empre = consulta::empreAll();
                                          foreach ($empre as $row1) {
                                            echo"<option value='".$row1["IDEMPRESA"]."'>".$row1["NOMBFANTASIA"]."</option>";
                                            }
                                            ?>
                                        </select>
                                        <label>Fecha Inicial</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"></span>
                                            <input type="date" id="fecha1" class="form-control" required>
                                        </div>
                                        <label>Fecha Final</label>
                                        <div class="form-group input-group">
                                            <span class="input-group-addon"></span>
                                            <input type="date" id="fecha2" class="form-control" required>
                                        </div>
                                        <input type="hidden" id="fechainicio" name="fecha1">
                                        <input type="hidden" id="fechafinal"  name="fecha2">                           
                                        <!--<input type="text"  value="<?php echo $fechapri?>">-->
                                        <!--<input type="date" name="fecha" id="fecha" value="<?php echo date("Ymd");?>">-->
                                        <input type="submit" value="Consultar" class="btn btn-primary btn-lg">
                                    </form><br> 
                                </section>   
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <div class="row">
                        <div class="col-md-12">
                        <!-- Advanced Tables -->
                            <div class="panel panel-default">
                                <section style='position:relative;display:none'>
                                    <?php
                                        $fecha1    = $_POST['fecha1'];
                                        $fecha2    = $_POST['fecha2']; 
                                        $empresa   = $_POST['idempre'];
                                    ?>     
                                </section>                   
                                <div class="panel-body">
                                    <?php if ($empresa  == "todasempresas"){ ?>
                                        <form role="form" action="reporte.php" method="POST">
                                            <input type="hidden" value="<?php echo $_POST['fecha1'] ?>" name="fecha1">
                                            <input type="hidden" value="<?php echo $_POST['fecha2'] ?>" name="fecha2">
                                            <input type="hidden" value="Reporte Recepcion <?php echo $_POST['fecha1'] ?> - <?php echo $_POST['fecha2'] ?>.xls"  name="repor">
                                            <input type="submit" value="Exportar a Excel" class="btn btn-primary btn-lg" name="generar_reporte">
                                        </form>  
                                    <?php };?><?php if ($empresa  != "todasempresas"){ ?>
                                        <form role="form" action="reporte.php" method="POST">
                                            <input type="hidden" value="<?php echo $_POST['fecha1'] ?>" name="fecha1">
                                            <input type="hidden" value="<?php echo $_POST['fecha2'] ?>" name="fecha2">
                                            <input type="hidden" value="<?php echo $_POST['idempre'] ?>" name="idempre">
                                            <input type="hidden" value="Reporte Recepcion2 Fecha <?php echo $_POST['fecha1'] ?> - <?php echo $_POST['fecha2'] ?>.xls"  name="repor">
                                            <input type="submit" value="Exportar a Excel" class="btn btn-primary btn-lg" name="generar_reporteidempre">
                                        </form>
                                    <?php };?>                        
                                </div>
                            </div>
                    <!--End Advanced Tables -->
                        </div>
                    </div> 
                </div>
            </div>

            <!-- ============================================================== -->
            <!-- footer -->
            <!-- ============================================================== -->
            <div class="footer">
                <div class="container-fluid">
                    <div class="row">
                        <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-12">
                             Copyright © <?php echo date("Y");?> Derechos Reservados. ICONSTRUYE COLOMBIA<a href=""></a>.
                        </div>
                    </div>
                </div>
            </div>
            <!-- ============================================================== -->
            <!-- end footer -->
            <!-- ============================================================== -->
        </div>
        <!-- ============================================================== -->
        <!-- end wrapper  -->
        <!-- ============================================================== -->
    </div>
    <!-- ============================================================== -->
    <!-- end main wrapper  -->
    <!-- ============================================================== -->
    <!-- Optional JavaScript -->
    <!-- jquery 3.3.1 -->
    <script src="assets/vendor/jquery/jquery-3.3.1.min.js"></script>
    <!-- bootstap bundle js -->
    <script src="assets/vendor/bootstrap/js/bootstrap.bundle.js"></script>
    <!-- slimscroll js -->
    <script src="assets/vendor/slimscroll/jquery.slimscroll.js"></script>
    <!-- main js -->
    <script src="assets/libs/js/main-js.js"></script>
    <!-- chart chartist js -->
    <script src="assets/vendor/charts/chartist-bundle/chartist.min.js"></script>
    <!-- sparkline js -->
    <script src="assets/vendor/charts/sparkline/jquery.sparkline.js"></script>
    <!-- morris js -->
    <script src="assets/vendor/charts/morris-bundle/raphael.min.js"></script>
    <script src="assets/vendor/charts/morris-bundle/morris.js"></script>
    <!-- chart c3 js -->
    <script src="assets/vendor/charts/c3charts/c3.min.js"></script>
    <script src="assets/vendor/charts/c3charts/d3-5.4.0.min.js"></script>
    <script src="assets/vendor/charts/c3charts/C3chartjs.js"></script>
    <script src="assets/libs/js/dashboard-ecommerce.js"></script>
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="assets/js/jquery-1.10.2.js"></script>
      <!-- Bootstrap Js -->
    <script src="assets/js/bootstrap.min.js"></script>
    <!-- Metis Menu Js -->
    <script src="assets/js/jquery.metisMenu.js"></script>
     <!-- DATA TABLE SCRIPTS -->
    <script src="assets/js/dataTables/jquery.dataTables.js"></script>
    <script src="assets/js/dataTables/dataTables.bootstrap.js"></script>
    <script>
        $(document).ready(function () {
            $('#dataTables1').DataTable({
                    "language":
                    {
                        "url": "https://cdn.datatables.net/plug-ins/1.10.11/i18n/Spanish.json"
                    },
                responsive: true
            });
        });
    </script>
         <!-- Custom Js jailer-->
    <script src="assets/js/custom-scripts.js"></script>
</body>
 
</html>