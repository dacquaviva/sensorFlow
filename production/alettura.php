<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Sensor Flow - Aggiungi Lettura</title>

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
			<?php include 'barralaterale_adm.php' ?>
			<?php include 'top_menu.php'?>
			<?php include 'psw.php' ?>
			<?php require_once 'core/init.php'?>



			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Aggiungi Lettura (debug)</h3>
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
									ATTENZIONE! Inserire un dato consistente con il funzionamento del sensore, non c'è la verifica che un determinato sensore possa effettivamente aver letto la stringa inserita! es. un dato funzionante di test potrebbe essere "4485024301011825TEST"
									<form id="form-aggiunta" action="<?php '.$_SERVER[" PHP_SELF "].' ?>" method="post" data-parsley-validate>
										<label for="lettura">Lettura * :</label>
										<input type="text" id="lettura" class="form-control" name="lettura" required data-parsley-length="[8, 200]"/>

										<input id="ok" name="ok" type="submit" class="btn btn-primary"></input>

									</form>
									<?php 
	//Prende i dati dalla form
	if(isset($_POST["ok"])){
		define("LUNGHEZZA_CODICE",8);
		define("LUNGHEZZA_ECCEZIONE",3);
		$stringa_eccezione = 'ERR';
		
		$lettura = $_POST["lettura"];
		$lettura = stripslashes($lettura);
		$lettura = mysql_real_escape_string($lettura);

		$codice_sensore = substr($lettura,0,LUNGHEZZA_CODICE);

		//trovo il pattern dato il codice del sensore
		$db = DB::getInstance();
		$query = 'SELECT id_pattern_sensore FROM sensore WHERE codice_sensore = '.$codice_sensore;
		$db->query($query);
		$id_pattern_array = $db->results();
		$id_pattern = $id_pattern_array[0]->id_pattern_sensore;
		
		
		//trovo l'id del sensore
		$query = 'SELECT id_sensore FROM sensore WHERE codice_sensore = '.$codice_sensore;
		$db->query($query);
		$id_sensore_array = $db->results();
		$id_sensore = $id_sensore_array[0]->id_sensore;
		
		
		//estraggo le cifre decimali
		$query = 'SELECT finale_cifre_misura FROM misura WHERE id_pattern_misura = '.$id_pattern;
		$db->query($query);
		$finale_cifre_array = $db->results();

		$max_finale_cifre = $finale_cifre_array[0]->finale_cifre_misura;
		foreach($finale_cifre_array as $finale_cifre){		
			if($finale_cifre->finale_cifre_misura>$max_finale_cifre){
				$max_finale_cifre = $finale_cifre->finale_cifre_misura;
			}	
		}
		
		$stringa_controllo_errore = substr($lettura,LUNGHEZZA_CODICE,LUNGHEZZA_ECCEZIONE);
		if(strcmp($stringa_controllo_errore,$stringa_eccezione)==0){
			$max_finale_cifre = LUNGHEZZA_ECCEZIONE;
		}
		
		//salvo le stringa di cifre decimali
		$stringa_cifre_decimali = substr($lettura,LUNGHEZZA_CODICE,$max_finale_cifre);
		
		
		$start_commento = LUNGHEZZA_CODICE + $max_finale_cifre;
		$commento = substr($lettura,$start_commento);
		
		if(strlen($stringa_cifre_decimali)==$max_finale_cifre){
			try{$db->insert('dato',array('commento_dato'=>$commento,
									   'stringa_decimale_dato'=>$stringa_cifre_decimali,
									   'id_sensore_dato'=>$id_sensore ));
				echo 'Lettura inserita correttamente';
			}catch (Exception $e) {
				echo 'Caught exception: ',  $e->getMessage(), "\n";
			}
		}else{
			echo 'Lettura errata - controlla che la lettura inserita sia corretta';
		}
	}?>
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