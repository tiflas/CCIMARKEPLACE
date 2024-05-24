<?php

    require_once("../Ccimarketplace/Model/db.conn.php");

    require_once("../Ccimarketplace/Model/consultas.class.php");

    $editarpro = consulta::editarprove(base64_decode($_REQUEST["ui"]));
?>
<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/xhtml">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>ICONSTRUYE COLOMBIA</title>
    <!-- Bootstrap Styles-->
    <link href="assets/css/bootstrap.css" rel="stylesheet" />
    <!-- FontAwesome Styles-->
    <link href="assets/css/font-awesome.css" rel="stylesheet" />
    <!-- Morris Chart Styles-->
    <link href="assets/js/morris/morris-0.4.3.min.css" rel="stylesheet" />
    <!-- Custom Styles-->
    <link href="assets/css/custom-styles.css" rel="stylesheet" />
    <!-- Google Fonts-->
    <link rel="shorcut icon type=" href="icono/iconstruye-icon.ico"/>
    <link href='http://fonts.googleapis.com/css?family=Open+Sans' rel='stylesheet' type='text/css' />
    <script src="https://code.jquery.com/jquery-1.11.3.min.js"></script>
    <script src="http://code.jquery.com/jquery-1.0.4.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
       <!--<script type="text/javascript">
            $(document).ready(function(){
                var fecha1  = $("#fecha1").val();
                var fecha2  = $("#fecha2").val(); 
                //var fechainicio = fecha1.replace("/", ""); 
                //var fechafinal  = fecha2.replace("/", "");           
                
                //$("#fechainicio").val(fechainicio);  
                //$("#fechafinal").val(fechafinal);            
            });
       </script>--> 
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
</head>

<body>
    <div id="wrapper">
        <nav class="navbar navbar-default top-navbar" role="navigation">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".sidebar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="inicio.php"><!--<b>CCI</b>-->ICONSTRUYE</a>
            </div>
        </nav>
        <!--/. NAV TOP  -->
        <nav class="navbar-default navbar-side" role="navigation">
                    
        </nav>
        <!-- /. NAV SIDE  -->
        <div id="page-wrapper" >
                <div id="page-inner">
		    	        <div class="row">
                            <div class="col-md-12">
                                <h1 class="page-header">
                                    CONFIGURAR EMPRESA 
                                </h1>                      
                            </div>
                        </div> 
                       <!-- /. ROW  -->
                       <section id="formu" style='width:30%'>
                                <form role="form" action="Controller/consultas.controller.php" method="POST">
                                    <label>ID EMPRESA</label>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" name="idempresa" class="form-control" value="<?php echo $editarpro["idempresa"] ?>" readonly>
                                    </div>
                                    <label>NOMBRE</label>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" name="nombre" class="form-control" value="<?php echo $editarpro["nombre"] ?>" readonly>
                                    </div>
                                    <label>NIT</label>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" name="rut" class="form-control" value="<?php echo $editarpro["rut"] ?>" readonly >
                                    </div>
                                    <label>PAIS</label>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" name="pais" class="form-control" value="<?php echo $editarpro["pais"] ?>" required>
                                    </div>
                                    <label>ESTADO</label>
                                    <div class="form-group input-group">
                                        <span class="input-group-addon"></span>
                                        <input type="text" name="estado" class="form-control" value="<?php echo $editarpro["estado"] ?>" readonly>
                                    </div>
                                    <input type="submit" name="acc" value="editprove" class="btn btn-default">
                                </form><br> 
                        </section>                         
                    <div class="row">
                    </div>        
                </div>
               <footer><p>Derechos Reservados ICONSTRUYE COLOMBIA<a href=""></a></p></footer>
        </div>
    </div>
             <!-- /. PAGE INNER  -->
            
         <!-- /. PAGE WRAPPER  -->
     <!-- /. WRAPPER  -->
    <!-- JS Scripts-->
    <!-- jQuery Js -->
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
                $('#dataTables-example').DataTable({
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