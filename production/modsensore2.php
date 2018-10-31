<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>Sensor Flow - Modifica Sensore</title>

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
			<?php require_once 'core/init.php'?>
          


			<!-- page content -->
			<div class="right_col" role="main">
				<div class="">
					<div class="page-title">
						<div class="title_left">
							<h3>Modifica sensore</h3>
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
								              <?php 
											   $id_sensore=$_POST["sensore"];
						                        $db = DB::getInstance();
									          $db->get("sensore",array("id_sensore","=",$id_sensore));
                                              
									
									?> 
									
									<form id="form-aggiunta" action="<?php '.$_SERVER[" PHP_SELF "].' ?>" method="post" data-parsley-validate>
								<label for="ID">Codice * :</label>
								<input type="text" id="id" class="form-control" value="<?php echo trim($db->first()->codice_sensore) ?>" name="id" required data-parsley-length="[8, 8]" data-parsley-trigger="change" placeholder="l'id univco di 8 caratteri" readonly/>
								<label for="nome">Nome * :</label>
								<input type="text" id="nome" class="form-control" value="<?php echo $db->first()->nome_sensore ?> " name="nome" required data-parsley-length="[2, 29]" data-parsley-trigger="change" placeholder="es... sensore 23"/>
								<label for="tag">Tag / Luogo * :</label>
								<input type="text" id="tag" class="form-control" value="<?php echo $db->first()->tag_sensore ?> " name="tag" required data-parsley-length="[2, 29]" data-parsley-trigger="change" placeholder="es... fabbrica di auto"/>
								<label for="tag">Id sensore selezionato *</label>
								<input id="utente" value="<?php echo $db->first()->id_sensore ?> " name="sensore" type="text" readonly class="form-control" data-required-message="" required></input>





								<label for="modello">Modello *:</label>
								<select size="5" id="modello" name="modello" class="form-control"  required data-parsley-trigger="change">
									<option value="">Scegli...</option>
								<?php 
	                            $db->query('SELECT nome_pattern FROM pattern');
					  		    $listaPattern = $db->results();
								foreach($listaPattern as $pattern){
									$stampa_nome_pattern = <<<HTML
						<option value='$pattern->nome_pattern'>$pattern->nome_pattern</option>
						
HTML;
									echo $stampa_nome_pattern;
									}?>
									

								</select>

						
							
           
							<br/>
							<input id="ok" name="ok" type="submit" value="Modifica sensore" class="btn btn-primary"></input>
	                        </form><br/>
									<?php 
	//Prende i dati dalla form
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
						$id_sensore = $_POST["sensore"];
						$id_sensore = stripslashes($id_sensore);
						$id_sensore = mysql_real_escape_string($id_sensore);
							
						$db->get("pattern",array("nome_pattern","=",$nome_modello));
						$id_modello = $db->first()->id_pattern;
		//0 se cliente, 1 se amministratore
	//aggiornamento nel DB
	
	try{ $db->update('sensore',$id_sensore,array(
                            'nome_sensore'=>$nome,
							'tag_sensore'=>$tag,
							'codice_sensore'=>$codice_sensore,
							'id_pattern_sensore'=>$id_modello,
						));
		
		echo 'Sensore modificato correttamente';
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
