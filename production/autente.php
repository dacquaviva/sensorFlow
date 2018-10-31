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
			<?php include 'barralaterale_adm.php'?>
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

								<div class="x_content">

									<form id="form-aggiunta" action="<?php '.$_SERVER[" PHP_SELF "].' ?>" method="post" data-parsley-validate>
										<label for="nome">Nome * :</label>
										<input type="text" id="nome" class="form-control" name="nome" required data-parsley-length="[2, 29]"/>
										<label for="cognome">Cognome * :</label>
										<input type="text" id="cognome" class="form-control" name="cognome" required data-parsley-length="[2, 29]"/>
										<label for="azienda">Azienda * :</label>
										<input type="text" id="azienda" class="form-control" name="azienda" required data-parsley-length="[2, 29]"/>
										<label for="email">Email * :</label>
										<input type="email" id="email" class="form-control" name="email" data-parsley-trigger="change" required data-parsley-length="[2, 29]"/>
										<label for="remail">Ripeti Email * :</label>
										<input type="email" id="remail" class="form-control" name="remail" data-parsley-trigger="change" required data-parsley-equalto="#email"/>


										<label for="tipologia">Tipologia *:</label>
										<select id="tipologia" name="tipologia" class="form-control" required>
											<option value="">Scegli...</option>
											<option value="cliente">Cliente</option>
											<option value="amministratore">Amministratore</option>
										</select>

										<br/>
										<input id="ok" name="ok" type="submit" class="btn btn-primary"></input>

									</form>
									<?php 
	//Prende i dati dalla form
	if(isset($_POST["ok"])){
		
		define("LUNGHEZZA_PWD",10);
	$nome = $_POST["nome"];
	$nome = stripslashes($nome);
	$nome = mysql_real_escape_string($nome);
	$nome = htmlspecialchars($nome);
	$nome = stripslashes($nome);
	$cognome = $_POST["cognome"];
	$cognome = stripslashes($cognome);
	$cognome = mysql_real_escape_string($cognome);
	$azienda = $_POST["azienda"];
	$azienda = stripslashes($azienda);
	$azienda = mysql_real_escape_string($azienda);
	$email = $_POST["email"];
	$email = stripslashes($email);
	$email = mysql_real_escape_string($email);
	$email = htmlspecialchars($email);
	$email = stripslashes($email);
		//0 se cliente, 1 se amministratore
	$tipologia = 0;
	if ($_POST["tipologia"]==="amministratore"){
	  $tipologia = 1;
	}
	//password casuale, poi calcola l'hash
	$password = random_string(LUNGHEZZA_PWD);
	$pwdmd5 = openssl_digest($password, "sha224", false);
		
		//inserimento nel DB
	$user = new User();
	try{ $user->create(array(
		'nome_utente'=>$nome,
		'cognome_utente'=>$cognome,
		'email_utente'=>$email,
		'azienda_utente'=>$azienda,
		'password_utente'=>$pwdmd5,
		'is_admin_utente'=>$tipologia
		));
	   //invio email con la password
	$subject = "$nome, benvenuto su SensorFlow";
	$txt = "Ciao $nome, benvenuto nel sistema SensorFlow.\n Ecco le tue credenziali:\n\n $email\n $password \n\n Cordiali Saluti, il team SensorFlow";
	mail($email,$subject,$txt);
		
		echo 'Utente creato correttamente';
	   }catch(Exception $e){
		echo 'Errore ',  $e->getMessage(), "\n";
	}
	/*	if($user->_db->getError()) {
					     echo 'inserimento corretto';
				         } else {
					    echo 'Inserimento errato';
				       }*/
	
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
