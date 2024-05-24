<?php

    session_start();

    if(!isset($_SESSION["id_usuario"])){
        header("location: ../index.php");
    }

    require_once("../ccimarketplace/Model/db.conn.php");

    require_once("../ccimarketplace/Model/consultas.class.php");

    date_default_timezone_set("America/Bogota");

    $fecha_li = date("Y-m-d");
    $fecha_fi1 = date('Y-m-d', strtotime("$fecha_li - 1 month"));
    $fechali = str_replace('-', '', $fecha_li);
    $fechalf1 = str_replace('-', '', $fecha_fi1);
    $totaloc = consulta::sumtotaloc($fechalf1,$fechali);

    //$numcz = consulta::numcotiza($fechali,$fechalf);

    date_default_timezone_set("America/Bogota");

    $fecha_li = date("Y-m-d");
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
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script src="../Reportes_graficos/code/highcharts.js"></script>
    <script src="../Reportes_graficos/code/modules/exporting.js"></script>
    <script src="../Reportes_graficos/code/modules/export-data.js"></script>
    <script>
        $(document).ready(function(){
        if (history.forward(1))
            location.replace(history.forward(1))
        }
        function nobackbutton(){
            window.location.hash="no-back-button";
            window.location.hash="Again-No-back-button" 
            window.onhashchange=function(){window.location.hash="no-back-button";}
        }
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
                                <a class="nav-link active" href="inicio.php"><i class="fa fa-fw fa-user-circle"></i>Inicio</a>
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
                                <a class="nav-link" href="#" data-toggle="collapse" aria-expanded="false" data-target="#submenu-4" aria-controls="submenu-4"><i class="fab fa-fw fa-wpforms"></i>Recepciones</a>
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
                                <h2 class="pageheader-title">INFORMACIO GENERAL </h2>
                                <!--<br><h3 class="pageheader-title">CERTIFICADOS IIS fecha de expiración 2019-09-09 y 2019-08-13</h3>-->
                                <div class="page-breadcrumb">
                                    <nav aria-label="breadcrumb">
                                        <ol class="breadcrumb">
                                            <li class="breadcrumb-item"><a href="#" class="breadcrumb-link">Informacion Registrada Periodo de tiempo</a></li>
                                            <li class="breadcrumb-item active" aria-current="page"><?php echo date('Y-m-d', strtotime("$fecha_li - 1 month"));?> - <?php date_default_timezone_set("America/Bogota") ; echo date("Y-m-d");?></li>
                                        </ol>
                                    </nav>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- ============================================================== -->
                    <!-- end pageheader  -->
                    <!-- ============================================================== -->
                    <div class="ecommerce-widget">

                        <div class="row">
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Ordenes de Compra</h5>
                                        <?php $fecha_fi = date('Y-m-d', strtotime("$fecha_li - 1 month"));
                                            $fechali = str_replace('-', '', $fecha_li);
                                            $fechalf = str_replace('-', '', $fecha_fi);
                                            $numoc = consulta::numordec($fechalf,$fechali);
                                            $numm = $numoc["numoc"];
                                            $numi = number_format($numm*100/15500);
                                            //$percentt =  number_format(15500*0.99/100);
                                            //$resul    =  number_format($numm-15500);
                                            if ($numi >= 70){
                                                if($numi > 100){
                                                    echo "<div class='metric-value d-inline-block'>
                                                    <h1 class='mb-1'>".$numoc["numoc"]."</h1>
                                                    </div>
                                                    <div class='metric-label d-inline-block float-right text-success font-weight-bold'>
                                                        <span><i class='fa fa-fw fa-arrow-up'></i></span><span>100%</span>
                                                    </div>";
                                                }else{
                                                    echo" <div class='metric-value d-inline-block'>
                                                    <h1 class='mb-1'>".$numoc["numoc"]."</h1>
                                                    </div>
                                                    <div class='metric-label d-inline-block float-right text-success font-weight-bold'>
                                                        <span><i class='fa fa-fw fa-arrow-up'></i></span><span>".$numi."%</span>
                                                    </div>";
                                                }
                                                 
                                            }else{
                                                echo" <div class='metric-value d-inline-block'>
                                                <h1 class='mb-1'>".$numoc["numoc"]."</h1>
                                                </div>
                                                <div class='metric-label d-inline-block float-right text-danger font-weight-bold'>
                                                    <span><i  class='fa fa-fw fa-arrow-down'></i></span><span class='ml-1 text-danger'></span><span>".$numi."%</span>
                                                </div>
                                                ";
                                            } 
                                        ?>
                                        
                                    </div>
                                    <div id="sparkline-revenue"></div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Cotizaciones</h5>
                                        <?php $fecha_fi = date('Y-m-d', strtotime("$fecha_li - 1 month"));
                                            $fechali = str_replace('-', '', $fecha_li);
                                            $fechalf = str_replace('-', '', $fecha_fi);
                                            $numcz = consulta::numcotiza($fechalf,$fechali);
                                            $num = $numcz["numcz"];
                                            //$numdi= number_format($num*0.99/100);
                                            $percent =  number_format($num*100/1500);
                                            if ($num >= 750){
                                                if($num > 1500){
                                                    echo "<div class='metric-value d-inline-block'>
                                                        <h1 class='mb-1'>".$numcz["numcz"]."</h1>
                                                        </div>
                                                        <div class='metric-label d-inline-block float-right text-success font-weight-bold'>
                                                            <span><i class='fa fa-fw fa-arrow-up'></i></span><span>100%</span>
                                                        </div>";
                                                }else{
                                                    echo" <div class='metric-value d-inline-block'>
                                                    <h1 class='mb-1'>".$numcz["numcz"]."</h1>
                                                    </div>
                                                    <div class='metric-label d-inline-block float-right text-success font-weight-bold'>
                                                        <span><i class='fa fa-fw fa-arrow-up'></i></span><span>".$percent."%</span>
                                                    </div>";
                                                }
                                            }else{
                                                echo" <div class='metric-value d-inline-block'>
                                                            <h1 class='mb-1'>".$numcz["numcz"]."</h1>
                                                        </div>
                                                <div class='metric-label d-inline-block float-right text-danger font-weight-bold'>
                                                    <span><i  class='fa fa-fw fa-arrow-down'></i></span><span class='ml-1 text-danger'></span><span>".$percent."%</span>
                                                </div>
                                                ";
                                            } 
                                        ?>
                                    </div>
                                    <div id="sparkline-revenue2"></div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Recepciones</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">0.00</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-primary font-weight-bold">
                                            <span>N/A</span>
                                        </div>
                                    </div>
                                    <div id="sparkline-revenue3"></div>
                                </div>
                            </div>
                            <div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h5 class="text-muted">Almacen</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">0.00</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-secondary font-weight-bold">
                                            <span>0.00%</span>
                                        </div>
                                    </div>
                                    <div id="sparkline-revenue4"></div>
                                </div>
                            </div>
                        </div>
                                <div class="card">
                                    <h5 class="card-header"> Top Empresas con mayor numero de 200 OC  Durante <?php echo date('Y-m-d', strtotime("$fecha_li - 1 month"));?> - <?php date_default_timezone_set("America/Bogota") ; echo date("Y-m-d");?> </h5>
                                    <div class="card-body p-0">
                                        <ul class="traffic-sales list-group list-group-flush">
                                            <?php 
                                            $fecha_fi = date('Y-m-d', strtotime("$fecha_li - 1 month"));
                                            $fechali = str_replace('-', '', $fecha_li);
                                            $fechalf = str_replace('-', '', $fecha_fi);
                                                $posicion = consulta::topoc($fechalf,$fechali);
                                                foreach ($posicion as $row) {
                                                    if ($row["sumaoc"] <= '200'){
                                                    echo"
                                                        <li class='traffic-sales-content list-group-item '><span class='traffic-sales-name'>".$row["empresa"]." <span class='  traffic-sales-amount'> | Total $".$row["total"]." |<span class='icon-circle-small icon-box-xs text-danger ml-4 bg-danger-light'><i  class='fa fa-fw fa-arrow-down'></i></span><span class='ml-1 text-danger'> Total OC: ".$row["sumaoc"]."</span></span></span>
                                                        </li>";
                                                    }else{
                                                    echo "
                                                        <li class='traffic-sales-content list-group-item'><span class='traffic-sales-name'>".$row["empresa"]." <span class='traffic-sales-amount '> | Total $".$row["total"]." |<span class='icon-circle-small icon-box-xs text-success ml-4 bg-success-light'><i class='fa fa-fw fa-arrow-up'></i></span><span class='ml-1 text-success'> Total OC: ".$row["sumaoc"]."</span></span></span>
                                                        </li>";
                                                    }
                                                }
                                            ?> 
                                        </ul>
                                    </div>
                                </div>
                        <div class="row">
                            <!-- ============================================================== -->
                      
                            <!-- ============================================================== -->

                                          <!-- recent orders  -->
                            <!-- ============================================================== -->
                            <div class="col-xl-9 col-lg-12 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">Errores Presentados en maestro log fecha: <?php echo $fecha_li ?></h5>
                                        <table class="table table-striped table-bordered table-hover" id="dataTables1">
                                            <thead>
                                                <tr>
                                                   <th>ID EMPRESA</th>               
                                                   <th>FECHA</th>
                                                   <th>RESULTADO</th>   
                                                   <th>OC</th> 
                                                   <th>TIPO DATO</th> 
                                                </tr>
                                            </thead>
                                            <tbody>
                                            <?php 
                                                $fecha1 = str_replace('-', '', $fecha_li);
                                                $posicion = consulta::errorlog($fecha1);
                                                foreach ($posicion as $row) {
                                                    echo "
                                                       <tr>
                                                           <td>".$row["idempresa"]."</td>               
                                                           <td>".$row["Fecha"]."</td>
                                                           <td>".$row["resultado"]."</td>   
                                                           <td>".$row["oc"]."</td> 
                                                           <td>".$row["timaestro"]."</td>
                                                       </tr>";
                                                    }
                                             ?>
                                            </tbody>
                                        </table>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end recent orders  -->

    
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- customer acquistion  -->
                            <!-- ============================================================== -->
                            <!--<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">Customer Acquisition</h5>
                                    <div class="card-body">
                                        <div class="ct-chart ct-golden-section" style="height: 354px;"></div>
                                        <div class="text-center">
                                            <span class="legend-item mr-2">
                                                    <span class="fa-xs text-primary mr-1 legend-tile"><i class="fa fa-fw fa-square-full"></i></span>
                                            <span class="legend-text">Returning</span>
                                            </span>
                                            <span class="legend-item mr-2">

                                                    <span class="fa-xs text-secondary mr-1 legend-tile"><i class="fa fa-fw fa-square-full"></i></span>
                                            <span class="legend-text">First Time</span>
                                            </span>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- ============================================================== -->
                            <!-- end customer acquistion  -->
                            <!-- ============================================================== -->
                        </div>
                        <div class="row">
                            <!-- ============================================================== -->
              				                        <!-- product category  -->
                            <!-- ============================================================== -->
                            <!--<div class="col-xl-3 col-lg-6 col-md-6 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header"> Product Category</h5>
                                    <div class="card-body">
                                        
                                    </div>
                                </div>
                            </div>-->
                            <!-- ============================================================== -->
                            <!-- end product category  -->
                                   <!-- product sales  -->
                            <!-- ============================================================== -->
                            <!--<div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <div class="card-header">-->
                                        <!-- <div class="float-right">
                                                <select class="custom-select">
                                                    <option selected>Today</option>
                                                    <option value="1">Weekly</option>
                                                    <option value="2">Monthly</option>
                                                    <option value="3">Yearly</option>
                                                </select>
                                            </div> -->
                                        <!--<h5 class="mb-0"> Grafico OC CZ OF</h5>
                                    </div>
                                    <!--<div class="card-body">
                                        <script type="text/javascript">
                                        Highcharts.chart('container', {
                                            chart: {
                                                plotBackgroundColor: null,
                                                plotBorderWidth: null,
                                                plotShadow: false,
                                                type: 'pie'
                                            },
                                            title: {
                                                text: 'Fecha: '
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
                                                name: 'Numero',
                                                colorByPoint: true,
                                                data: [{
                                                    name: 'Ordenes de Compra',
                                                    y: 61.41,
                                                    sliced: true,
                                                    selected: true
                                                }, {
                                                    name: 'Cotizaciones',
                                                    y: 11.84
                                                }, {
                                                    name: 'Ofertas',
                                                    y: 10.85
                                                }]
                                            }]
                                        });
                                        </script>
                                    </div>-->
                                <!--</div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end product sales  -->
                            <!-- ============================================================== -->
                            <!--<div class="col-xl-3 col-lg-12 col-md-6 col-sm-12 col-12">
                                <!-- ============================================================== -->
                                <!-- top perfomimg  -->
                                <!-- ============================================================== -->
                                <!--<div class="card">
                                    <h5 class="card-header">Top Performing Campaigns</h5>
                                    <div class="card-body p-0">
                                        <div class="table-responsive">
                                            <table class="table no-wrap p-table">
                                                <thead class="bg-light">
                                                    <tr class="border-0">
                                                        <th class="border-0">Campaign</th>
                                                        <th class="border-0">Visits</th>
                                                        <th class="border-0">Revenue</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td>Campaign#1</td>
                                                        <td>98,789 </td>
                                                        <td>$4563</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Campaign#2</td>
                                                        <td>2,789 </td>
                                                        <td>$325</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Campaign#3</td>
                                                        <td>1,459 </td>
                                                        <td>$225</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Campaign#4</td>
                                                        <td>5,035 </td>
                                                        <td>$856</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Campaign#5</td>
                                                        <td>10,000 </td>
                                                        <td>$1000</td>
                                                    </tr>
                                                    <tr>
                                                        <td>Campaign#5</td>
                                                        <td>10,000 </td>
                                                        <td>$1000</td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="3">
                                                            <a href="#" class="btn btn-outline-light float-right">Details</a>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                                <!-- ============================================================== -->
                                <!-- end top perfomimg  -->
                                <!-- ============================================================== -->
                           <!-- </div>-->
                        <!--</div>

                        <!--<div class="row">
                            <!-- ============================================================== -->
                            <!-- sales  -->
                            <!-- ============================================================== -->
                            <!--<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="card border-3 border-top border-top-primary">
                                    <div class="card-body">
                                        <h5 class="text-muted">Sales</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">$12099</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">5.86%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end sales  -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- new customer  -->
                            <!-- ============================================================== -->
                            <!--<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="card border-3 border-top border-top-primary">
                                    <div class="card-body">
                                        <h5 class="text-muted">New Customer</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">1245</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">10%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- ============================================================== -->
                            <!-- end new customer  -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- visitor  -->
                            <!-- ============================================================== -->
                            <!--<div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="card border-3 border-top border-top-primary">
                                    <div class="card-body">
                                        <h5 class="text-muted">Visitor</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">13000</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-success font-weight-bold">
                                            <span class="icon-circle-small icon-box-xs text-success bg-success-light"><i class="fa fa-fw fa-arrow-up"></i></span><span class="ml-1">5%</span>
                                        </div>
                                    </div>
                                </div>
                            </div> -->
                            <!-- ============================================================== -->
                            <!-- end visitor  -->
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- total orders  -->
                            <!-- ============================================================== -->
                           <!-- <div class="col-xl-3 col-lg-3 col-md-6 col-sm-12 col-12">
                                <div class="card border-3 border-top border-top-primary">
                                    <div class="card-body">
                                        <h5 class="text-muted">Total Orders</h5>
                                        <div class="metric-value d-inline-block">
                                            <h1 class="mb-1">1340</h1>
                                        </div>
                                        <div class="metric-label d-inline-block float-right text-danger font-weight-bold">
                                            <span class="icon-circle-small icon-box-xs text-danger bg-danger-light bg-danger-light "><i class="fa fa-fw fa-arrow-down"></i></span><span class="ml-1">4%</span>
                                        </div>
                                    </div>
                                </div>
                            </div>-->
                            <!-- ============================================================== -->
                            <!-- end total orders  -->
                            <!-- ============================================================== -->
                        <!--</div>
                        <div class="row">
                            <!-- ============================================================== -->
                            <!-- total revenue  -->
                            <!-- ============================================================== -->
  
                            
                            <!-- ============================================================== -->
                            <!-- ============================================================== -->
                            <!-- category revenue  -->
                            <!-- ============================================================== -->
                            <!--<div class="col-xl-5 col-lg-5 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header">Revenue by Category</h5>
                                    <div class="card-body">
                                        <div id="c3chart_category" style="height: 420px;"></div>
                                    </div>
                                </div>
                            </div>-->
                            <!-- ============================================================== -->
                            <!-- end category revenue  -->
                            <!-- ============================================================== -->

                            <!--<div class="col-xl-7 col-lg-7 col-md-12 col-sm-12 col-12">
                                <div class="card">
                                    <h5 class="card-header"> Total Revenue</h5>
                                    <div class="card-body">
                                        <div id="morris_totalrevenue"></div>
                                    </div>
                                    <div class="card-footer">
                                        <p class="display-7 font-weight-bold"><span class="text-primary d-inline-block">$26,000</span><span class="text-success float-right">+9.45%</span></p>
                                    </div>
                                </div>
                            </div>-->
                        </div>
                        <div class="row">
                            <div class="col-xl-4 col-lg-6 col-md-6 col-sm-12 col-12">
                                <!-- ============================================================== -->
                                <!-- sales traffice source  -->
                                <!-- ============================================================== -->
                            </div>
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
    <script src="vendor/datatables/js/jquery.dataTables.min.js"></script>
    <script src="vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
    <script src="vendor/datatables-responsive/dataTables.responsive.js"></script>
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
</body>
 
</html>