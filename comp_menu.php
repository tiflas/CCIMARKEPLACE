<?php

	session_start();

    if(!isset($_SESSION["id_usuario"])){
        header("location: ../index.php");
    }

	require_once("../Ccimarketplace/Model/db.conn.php");

    require_once("../Ccimarketplace/Model/consultas.class.php");

    if($_SESSION["id_usuario"]=="operaciones"){
 ?>
 		<nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                     <li>
                        <a href="inicio.php"><i class="fa fa-dashboard"></i> Inicio</a>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-desktop"></i>Ordenes de Compra</a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="nav-link" href="oc.php">Consultar Ordenes de Compra</a>
                            </li>
                            <li>
                                <a class="nav-link" href="exportaroc.php">Exportar Ordenes de Compra</a>
                            </li>
                            <li>
                                <a class="nav-link" href="ocintegrado.php">OC proveedores integrados - no integrados</a>
                            </li>
                            <li>
                                <a class="nav-link" href="exportarproveinte.php">Exportar OC proveedores integrados - no integrados</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="ordencompraceptada.php">Ordenes de Compra aceptadas</a>
                            </li>
                        </ul>
                    </li>
                    <li><!--<a class="active-menu" href="#">-->
                        <a href="#"><i class="fa fa-bar-chart-o"></i>Cotizaciones</a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="nav-link" href="cotizaciones.php">Consultar Cotizaciones</a>
                            </li>
                            <li>
                                <a class="nav-link" href="exportarcotizacion.php">Exportar Cotizaciones</a>
                            </li>
                             <li>
                                <a class="nav-link" href="estadocot.php">Estado de Cotizaciónes</a>
                            </li>
                            <li>
                                <a class="nav-link" href="oferta.php">Ofertas enviadas a Compra</a>
                            </li>
                            <li>
                                <a class="nav-link" href="czaoc.php">Cotizaciones que pasaron a compra</a>
                            </li>
                            <li>
                                <a class="nav-link" href="exportaroferta.php">Exportar Ofertas enviadas a Compra</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="ProveedoresCotizar.php">Proveedores Cotizacion</a>
                            </li>
                            <li>
                                <a class="nav-link" href="infofertaoc.php">Informacion Ofertas y Ordenes * codigo item</a>
                            </li>
                            <li>
                                <a class="nav-link" href="exportarczoc.php">Exportar Informacion Ofertas y Ordenes * codigo item</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-bar-chart-o"></i> Reporte recepciones</a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="nav-link" href="recepcion.php">Consultar Recepciones</a>
                            </li>
                            <li>
                                <a class="nav-link" href="exportarecepcion.php">Exportar Recepciones</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-qrcode"></i> Maestro de Materiales</a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="nav-link" href="pedidomateriales.php">Pedido de Materiales</a>
                            </li>
                            <li>
                                <a class="nav-link" href="exportpedidomateria.php">Exportar pedido de Materiales</a>
                            </li>
                            <li>
                                <a class="nav-link" href="maestro.php">Consultar Maestro de Materiales</a>
                            </li>
                            <li>
                                <a class="nav-link" href="exportarmaestro.php">Exportar Maestro de Materiales</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-table"></i>Consultar Insumos</a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="nav-link" href="insumosavanzado.php">Insumos avanzados pro.integrados no integrados</a>
                            </li>
                            <li>
                                <a class="nav-link" href="articulo.php">Info. Insumos</a>
                            </li>
                            <li>
                                <a class="nav-link" href="proveeinsumo.php">Consultar Proveedores por insumo</a>
                            </li>
                            <li>
                                <a class="nav-link" href="insumoporproveedor.php">Informacion general por proveedor por insumo</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-qrcode"></i> Proveedores no Integrados</a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="nav-link" href="proveedoresinte.php">Consultar Proveedores no integrados</a>
                            </li>
                            <li>
                                <a class="nav-link" href="expotarprointe.php">Exportar Proveedores no integrados</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-qrcode"></i> Centros de Costo</a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="nav-link" href="centro_de_costos.php">Info Centros de Costos</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-qrcode"></i> Graficos</a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="nav-link" href="ventasgrafi.php">Info Ventas</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="#"><i class="fa fa-qrcode"></i>Errores Maestro Log</a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="nav-link" href="maestrolog.php">Maestrolog</a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="cerrarsesion.php">Cerrar sesion</a>
                    </li>
                    <!--<li>
                        <a href="form.html"><i class="fa fa-edit"></i> Forms </a>
                    </li>


                    <li>
                        <a href="#"><i class="fa fa-sitemap"></i> Multi-Level Dropdown<span class="fa arrow"></span></a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a href="#">Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link</a>
                            </li>
                            <li>
                                <a href="#">Second Level Link<span class="fa arrow"></span></a>
                                <ul class="nav nav-third-level">
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>
                                    <li>
                                        <a href="#">Third Level Link</a>
                                    </li>

                                </ul>

                            </li>
                        </ul>
                    </li>
                    <li>
                        <a href="empty.html"><i class="fa fa-fw fa-file"></i> Empty Page</a>-->
                </ul>
            </div>          
        </nav>
<?php
    }elseif($_SESSION["id_usuario"]=="sodexo"){
?>
	<nav class="navbar-default navbar-side" role="navigation">
            <div class="sidebar-collapse">
                <ul class="nav" id="main-menu">
                    <li>
                        <a href="#"><i class="fa fa-desktop"></i>Ordenes de Compra</a>
                        <ul class="nav nav-second-level">
                            <li>
                                <a class="nav-link" href="oc.php">Consultar Ordenes de Compra</a>
                            </li>
                            <!--<li>
                                <a class="nav-link" href="exportaroc.php">Exportar Ordenes de Compra</a>
                            </li>
                            <li>
                                <a class="nav-link" href="ocintegrado.php">OC proveedores integrados - no integrados</a>
                            </li>
                            <li>
                                <a class="nav-link" href="exportarproveinte.php">Exportar OC proveedores integrados - no integrados</a>
                            </li>-->
                        </ul>
                    </li>
                    <li>
                        <a href="cerrarsesion.php">Cerrar sesion</a>
                    </li>
                </ul>
            </div>          
        </nav>
<?php
 	}
?>