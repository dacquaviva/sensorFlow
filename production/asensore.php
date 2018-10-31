<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Sensor Flow - Aggiungi Sensore</title>

	<!-- Bootstrap -->
	<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- NProgress -->
	<link href="../vendors/nprogress/nprogress.css" rel="stylesheet">


	<!-- iCheck -->
	<link href="../vendors/iCheck/skins/flat/green.css" rel="stylesheet">
	<!-- Datatables -->
	<link href="../vendors/datatables.net-bs/css/dataTables.bootstrap.min.css" rel="stylesheet">
	<link href="../vendors/datatables.net-buttons-bs/css/buttons.bootstrap.min.css" rel="stylesheet">
	<link href="../vendors/datatables.net-fixedheader-bs/css/fixedHeader.bootstrap.min.css" rel="stylesheet">
	<link href="../vendors/datatables.net-responsive-bs/css/responsive.bootstrap.min.css" rel="stylesheet">
	<link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/css/bootstrap-select.min.css">

<!-- Latest compiled and minified JavaScript -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/bootstrap-select.min.js"></script>

<!-- (Optional) Latest compiled and minified JavaScript translation files -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-select/1.12.4/js/i18n/defaults-*.min.js"></script>

	<!-- Custom Theme Style -->
	<link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="nav-md">
	<div class="container body">
		<div class="main_container">
		<?php include 'barralaterale_adm.php' ?>
			<?php include 'top_menu.php'?>
			

			<!-- page content -->
			<div class="right_col" role="main">

				<div class="page-title">
					<div class="title_left">
						<h3>Aggiungi Sensore</h3>
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
							<?php require_once 'core/init.php'?>
							<?php 
								$db = DB::getInstance();
					  			$db->query('SELECT nome_pattern FROM pattern');
					  			$listaPattern = $db->results();
									?>


							<p>Riempi i campi con le informazioni sul sensore che vuoi inserire nel sistema</p>

							<form id="form-aggiunta" action="<?php '.$_SERVER[" PHP_SELF "].' ?>" method="post" data-parsley-validate>
								<label for="ID">Codice * :</label>
								<input type="text" id="id" class="form-control" name="id" required data-parsley-length="[8, 8]" data-parsley-trigger="change" placeholder="l'id univco di 8 caratteri"/>
								<label for="nome">Nome * :</label>
								<input type="text" id="nome" class="form-control" name="nome" required data-parsley-length="[2, 29]" data-parsley-trigger="change" placeholder="es... sensore 23"/>
								<label for="tag">Tag / Luogo * :</label>
								<input type="text" id="tag" class="form-control" name="tag" required data-parsley-length="[2, 29]" data-parsley-trigger="change" placeholder="es... fabbrica di auto"/>
								<label for="tag">Id utente selezionato *</label>
								<input id="utente" placeholder="Selezionare un cliente dalla tabella sottostante" name="utente" type="text" readonly class="form-control" data-required-message="" required></input>





								<label for="modello">Modello *:</label>
								<select size="5" id="modello" name="modello" class="form-control"  required data-parsley-trigger="change">
									<option value="">Scegli...</option>
								<?php foreach($listaPattern as $pattern){
	$stampa_nome_pattern = <<<HTML
			<option value='$pattern->nome_pattern'>$pattern->nome_pattern</option>
HTML;
	echo $stampa_nome_pattern;
									
									}
									
									?>
									

								</select>

						
							
           
							<br/>
							<input id="ok" name="ok" type="submit" value="Aggiungi sensore" class="btn btn-primary"></input>
	                        </form><br/>
					<?php
					if(isset($_POST["ok"])){
						$codice_sensore = $_POST["id"];
						$codice_sensore = stripslashes($codice_sensore);
						$codice_sensore = mysql_real_escape_string($codice_sensore);
						$nome = $_POST["nome"];
						$nome = stripslashes($nome);
						$nome = mysql_real_escape_string($nome);
						$tag = $_POST["tag"];
						$tag = stripslashes($tag);
						$tag = mysql_real_escape_string($tag);
						$nome_modello = $_POST["modello"];
						$nome_modello = stripslashes($nome_modello);
						$nome_modello = mysql_real_escape_string($nome_modello);
						$id_utente = $_POST["utente"];
						$id_utente = stripslashes($id_utente);
						$id_utente = mysql_real_escape_string($id_utente);
						
						$db->get("pattern",array("nome_pattern","=",$nome_modello));
						$id_modello = $db->first()->id_pattern;
						$db->insert('sensore',array(
												'nome_sensore'=>$nome,
							'tag_sensore'=>$tag,
							'codice_sensore'=>$codice_sensore,
							'id_pattern_sensore'=>$id_modello,
							'id_utente_sensore'=>$id_utente
						));
					}?>
					
					<?php include 'tabellaresp_cli.php'?>
						<script>
							function faiqualcosa(cntrl)
							{

								var req = cntrl.value;
							    document.getElementById("utente").value = req; 
location.href='#modello';
							}
                       </script>



	


							<!-- End SmartWizard Content -->
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
	<!-- Bootstrap -->
	<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- FastClick -->
	<script src="../vendors/fastclick/lib/fastclick.js"></script>
	<!-- NProgress -->
	<script src="../vendors/nprogress/nprogress.js"></script>
	<!-- Custom Theme Scripts -->
	<script src="../build/js/custom.min.js"></script>
	<!-- Parsley-->
	<script src="../vendors/parsleyjs/dist/i18n/it.js"></script>
	<script src="../vendors/parsleyjs/dist/parsley.min.js"></script>
	<!-- jQuery -->
	<script src="../vendors/jquery/dist/jquery.min.js"></script>
	<!-- Bootstrap -->
	<script src="../vendors/bootstrap/dist/js/bootstrap.min.js"></script>
	<!-- FastClick -->
	<script src="../vendors/fastclick/lib/fastclick.js"></script>
	<!-- NProgress -->
	<script src="../vendors/nprogress/nprogress.js"></script>
	<!-- iCheck -->
	<script src="../vendors/iCheck/icheck.min.js"></script>
	<!-- Datatables -->
	<script src="../vendors/datatables.net/js/jquery.dataTables.min.js"></script>
	<script src="../vendors/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
	<script src="../vendors/datatables.net-buttons/js/dataTables.buttons.min.js"></script>
	<script src="../vendors/datatables.net-buttons-bs/js/buttons.bootstrap.min.js"></script>
	<script src="../vendors/datatables.net-buttons/js/buttons.flash.min.js"></script>
	<script src="../vendors/datatables.net-buttons/js/buttons.html5.min.js"></script>
	<script src="../vendors/datatables.net-buttons/js/buttons.print.min.js"></script>
	<script src="../vendors/datatables.net-fixedheader/js/dataTables.fixedHeader.min.js"></script>
	<script src="../vendors/datatables.net-keytable/js/dataTables.keyTable.min.js"></script>
	<script src="../vendors/datatables.net-responsive/js/dataTables.responsive.min.js"></script>
	<script src="../vendors/datatables.net-responsive-bs/js/responsive.bootstrap.js"></script>
	<script src="../vendors/datatables.net-scroller/js/dataTables.scroller.min.js"></script>
	<script src="../vendors/jszip/dist/jszip.min.js"></script>
	<script src="../vendors/pdfmake/build/pdfmake.min.js"></script>
	<script src="../vendors/pdfmake/build/vfs_fonts.js"></script>

	<!-- Custom Theme Scripts -->
	<script src="../build/js/custom.min.js"></script>


</body>

</html>
