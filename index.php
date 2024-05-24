<!DOCTYPE html>
<html lang="en">
<head>
	<title>ICONSTRUYE COLOMBIA</title>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<!--===============================================================================================-->	
	<link rel="shorcut icon type=" href="icono/iconstruye-icon.ico"/>
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/bootstrap/css/bootstrap.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/font-awesome-4.7.0/css/font-awesome.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="fonts/iconic/css/material-design-iconic-font.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animate/animate.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/css-hamburgers/hamburgers.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/animsition/css/animsition.min.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="vendor/select2/select2.min.css">
<!--===============================================================================================-->	
	<link rel="stylesheet" type="text/css" href="vendor/daterangepicker/daterangepicker.css">
<!--===============================================================================================-->
	<link rel="stylesheet" type="text/css" href="css/util.css">
	<link rel="stylesheet" type="text/css" href="css/main.css">
<!--===============================================================================================-->
    
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-2.1.1.min.js"></script>
    <script>
        $(document).ready(function(){
            <?php
                if(isset($_GET["msn"])){
                    echo "swal('".$_GET["msn"]."','', 'success')";  
                }elseif(isset($_GET["m"])){
                    echo "swal('".$_GET["m"]."','', 'warning')";
                }
            ?>  
        });
    </script>
    <script type="text/javascript">
       javascript:window.history.forward(1); //Esto es para cuando le pulse al botón de Atrás
        //javascript:window.history.back(1); //Esto para cuando le pulse al botón de Adelante
    </script>
</head>
<body>
	
	<div class="limiter">
		<div class="container-login100" style="background-image: url('images/bg-01.jpg');">
			<div class="wrap-login100 p-l-55 p-r-55 p-t-65 p-b-54">
				<form class="login100-form validate-form" action="Controller/validarsusuario.controller.php" method="post">
					<span class="login100-form-title p-b-49">
						<section style="width:100%">
							<img src='icono/iconstruye-1.png'>
						</section>
					</span>

					<div class="wrap-input100 validate-input m-b-23" data-validate = "El Usuario es Obligatorio">
						<span class="label-input100">Usuario</span>
						<input class="input100" type="text" name="id_usuario" placeholder="Usuario">
						<span class="focus-input100" data-symbol="&#xf206;"></span>
					</div>

					<div class="wrap-input100 validate-input" data-validate="La Contraseña es Obligatoria">
						<span class="label-input100">Clave</span>
						<input class="input100" type="password" name="clave" placeholder="Clave">
						<span class="focus-input100" data-symbol="&#xf190;"></span>
					</div><br>					
					<div class="container-login100-form-btn">
						<div class="wrap-login100-form-btn">
							<div class="login100-form-bgbtn"></div>
							<button class="login100-form-btn" name="acc" value="usu">
								INICIAR SESION
							</button>
						</div>
					</div><br>

					<!--<div class="flex-c-m">
						<a href="www.facebook.com" class="login100-social-item bg1">
							<i class="fa fa-facebook"></i>
						</a>

						<a href="https://twitter.com/" class="login100-social-item bg2">
							<i class="fa fa-twitter"></i>
						</a>

						<a href="www.gmail.com" class="login100-social-item bg3">
							<i class="fa fa-google"></i>
						</a>
					</div>	-->			
				</form>
			</div>
		</div>
	</div>
	

	<div id="dropDownSelect1"></div>
	
<!--===============================================================================================-->
	<script src="vendor/jquery/jquery-3.2.1.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/animsition/js/animsition.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/bootstrap/js/popper.js"></script>
	<script src="vendor/bootstrap/js/bootstrap.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/select2/select2.min.js"></script>
<!--===============================================================================================-->
	<script src="vendor/daterangepicker/moment.min.js"></script>
	<script src="vendor/daterangepicker/daterangepicker.js"></script>
<!--===============================================================================================-->
	<script src="vendor/countdowntime/countdowntime.js"></script>
<!--===============================================================================================-->
	<script src="js/main.js"></script>

</body>
</html>