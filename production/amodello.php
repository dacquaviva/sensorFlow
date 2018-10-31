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

			<?php include 'barralaterale_adm.php'?>
			<?php include 'top_menu.php'?>
			<?php require_once 'core/init.php'?>


			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Aggiungi Modello</h3>
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

									<p>Riempi i campi con le informazioni sul modello che vuoi inserire nel sistema</p>

									<form class="form-horizontal form-label-left" name="form1" action="<?php '.$_SERVER[" PHP_SELF "].' ?>" method="post" data-parsley-validate>

										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome_modello">Nome modello *</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type="text" name="nome_modello" id="nome_modello" required data-parsley-trigger="change" class="form-control col-md-7 col-xs-12" data-parsley-length="[2,19]">
											</div>
										</div>
										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome_modello">Quante misure contiene la stringa ? *</label>
											<div class="col-md-6 col-sm-6 col-xs-12">
												<input type='number' name="numero_misure" min='1' max='10' style='width: 50px' required onkeyup="AggiungiRiga(this)"/>
											</div>
										</div>

										<div class="form-group">
											<label class="control-label col-md-3 col-sm-3 col-xs-12" for="nome_modello"></label>
											<div class="col-md-12 col-sm-6 col-xs-1">
												<span id='box_righe'>
													<!-- Box che conterrà le righe aggiunte. Inizialmente vuoto! -->
												</span>
											</div>
											</br>




											<input id="ok" name="ok" type="submit" class="btn btn-primary"></input>
									</form>
									<?php if(isset($_POST["ok"])){

							$db = DB::getInstance();

							define("MAX_NUM_MISURE",10);

							$numero_misure = $_POST["numero_misure"];
							$numero_misure = stripslashes($numero_misure);
							$numero_misure = mysql_real_escape_string($numero_misure);
							$nome_modello = $_POST["nome_modello"];
							$nome_modello = stripslashes($nome_modello);
							$nome_modello = mysql_real_escape_string($nome_modello);
							$i=$numero_misure+1;
							if($db->insert('pattern',array('nome_pattern'=>$nome_modello))){
							$db->get("pattern",array("nome_pattern","=",$nome_modello));
							$id_modello = $db->first()->id_pattern;
							$i=1;
							}
							if($numero_misure<=MAX_NUM_MISURE){
								for($i;$i<=$numero_misure;$i++){
									$pos_iniziale = $_POST["pos_iniziale".$i];
									$pos_iniziale = stripslashes($pos_iniziale);
									$pos_iniziale = mysql_real_escape_string($pos_iniziale);
									$pos_finale = $_POST["pos_finale".$i];
									$pos_finale = stripslashes($pos_finale);
									$pos_finale = mysql_real_escape_string($pos_finale);
									$misura = $_POST["misura".$i];
									$misura = stripslashes($misura);
									$misura = mysql_real_escape_string($misura);
									$sintetizzabile = $_POST["sint".$i];
									$sintetizzabile = stripslashes($sintetizzabile);
									$sintetizzabile = mysql_real_escape_string($sintetizzabile);
									if($sintetizzabile != 1){
										$sintetizzabile = 0;
									}
									$db->insert('misura',array('iniziale_cifre_misura'=>$pos_iniziale,
															  'finale_cifre_misura'=>$pos_finale,
															   'unita_misura'=>$misura,
															   'id_pattern_misura'=>$id_modello,
																  'sintetizzabile'=> $sintetizzabile
															  ));

								}
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

		<script type="text/javascript">
			// Funzione che permette di aggiungere elementi al form (ESEMPIO 1)
			function AggiungiRiga( n_righe ) {
				var numero_righe = n_righe.value;
				var box = document.getElementById( 'box_righe' );
				if ( isNaN( numero_righe ) == true ) {
					box.innerHTML = '';
				} else {
					var righe = "";
					// Inserisco una riga ad ogni ciclo
					for ( i = 1; i <= numero_righe; i++ ) {
						righe = righe + "" + i + ") Posizione iniziale : <input  required type='number' name='pos_iniziale" + i + "' min='1' max='49' style='width: 35px' />   Posizione finale : <input  data-parsley-gte='#pos_iniziale" + i + "' required type='number' name='pos_finale" + i + "' min='1' max='49' style='width: 35px' />   Unita di misura : <input type='text' name='misura" + i + "' required style='width:100px' />  Sintetizzabile : <input type='checkbox' id='sint' name='sint" + i + "' value='1'><br/>";
					}

					// Aggiorno il contenuto del box che conterrà gli elementi aggiunti
					box.innerHTML = righe;
				}
			}
		</script>
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
