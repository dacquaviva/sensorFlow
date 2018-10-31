<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Sensor Flow - Aggiungi Utente</title>

	<!-- Bootstrap -->
	<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- NProgress -->
	<link href="../vendors/nprogress/nprogress.css" rel="stylesheet">

	<!-- Custom Theme Style -->
	<link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
			<a class="hiddenanchor" id="dati"></a>
      		<a class="hiddenanchor" id="modello"></a>
			<a class="hiddenanchor" id="cliente"></a>
			<?php include 'barra.php'?>
			<?php include 'top_menu.php'?>
			<?php include 'psw.php'?>
			<?php require_once 'core/init.php'?>



			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Aggiungi Utente</h3>
						</div>

						<div class="title_right">
							<div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">

							</div>
						</div>
					</div>
					<div class="clearfix"></div>

					<div class="row">

						<div class="col-md-12 col-sm-12 col-xs-12">
							<div class="x_panel">

								 <?php 
											   $email_utente=$_SESSION['email'];
						                       $db = DB::getInstance();
									          $db->get("utente",array("email_utente","=",$email_utente));
									
									?> 
								<div class="x_content">

									<form id="form-aggiunta" action="<?php '.$_SERVER[" PHP_SELF "].' ?>" method="post" data-parsley-validate>
										<label for="email">Email * :</label>
										<input type="email" id="email" class="form-control" name="email" value="<?php echo $_SESSION['email'] ?> " data-parsley-trigger="change" required data-parsley-length="[2, 29]"/>
										<label for="remail">Ripeti Email * :</label>
										<input type="email" id="remail" class="form-control" value="<?php echo $_SESSION['email']?> " name="remail" data-parsley-trigger="change" required data-parsley-equalto="#email"/>
                                        <label for="password">Password * :</label>
                                        <input name="password" id="password" type="password" class="form-control" data-parsley-trigger="change" placeholder="Password" required>
										<label for="repassword">Ripeti password * :</label>
										<input name="repassword" id="repassword" type="password" class="form-control" data-parsley-trigger="change" placeholder="Password" required required data-parsley-equalto="#password">
										<input id="ok" name="ok" type="submit" class="btn btn-primary"></input>
									</form>
									<?php 
	//Prende i dati dalla form
	if(isset($_POST["ok"])){
	 $email_utente=$_SESSION['email'];
	 $db = DB::getInstance();
	 $db->get("utente",array("email_utente","=",$email_utente));
	 $id_utente=$db->first()->id_utente;
	 $email=$_POST["email"];
     $psw=$_POST["password"];
	 $email=stripslashes($email);
	 $psw=stripslashes($psw);
	 $email=mysql_real_escape_string($email);
	 $psw=mysql_real_escape_string($psw);
	 $pswmd5=openssl_digest($psw, "sha224", false);
	 $user = new User();
	 try{$user->update(array(
		'email_utente'=>$email,
		'password_utente'=>$pswmd5,
		),$id_utente);
		
		echo 'Utente modificato correttamente';
	   }catch(Exception $e){
		echo 'Errore ',  $e->getMessage(), "\n";
	}
	
}
?>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- /page content -->

			<!-- footer content -->
			<footer>

				<div class="clearfix"></div>
			</footer>
			<!-- /footer content -->
		</div>
	</div>

	<!-- jQuery -->
	<script src="../vendors/jquery/dist/jquery.min.js"></script>
	<!-- Parsley -->
	<script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
	<!-- Bootstrap -->
	<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- FastClick -->
	<script src="../vendors/fastclick/lib/fastclick.js"></script>
	<!-- NProgress -->
	<script src="../vendors/nprogress/nprogress.js"></script>
	<!-- jQuery Smart Wizard -->
	<script src="../vendors/jQuery-Smart-Wizard/js/jquery.smartWizard.js"></script>
	<!-- Custom Theme Scripts -->
	<script src="../build/js/custom.min.js"></script>
	<script src="../vendors/parsleyjs/dist/parsley.min.js"></script>


</body>

</html>
