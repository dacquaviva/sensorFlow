<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <!-- Meta, title, CSS, favicons, etc. -->
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php require_once 'core/init.php'?>
    <?php
          $db = DB::getInstance();
          $db->query('SELECT nome_sensore FROM sensore WHERE id_sensore = '.$_POST['sensore']);
          $nome_sensore = $db->first();
          $nome_sensore = $nome_sensore->nome_sensore;
          // Recupero tutti i record dei dati
          $db->query('SELECT * FROM dato WHERE id_sensore_dato = '.$_POST['sensore']);
          $listaDati = $db->results();
          //Recupero id del pattern in modo da sapere come scomporre la parte decimale del dato
          $db->query('SELECT id_pattern_sensore FROM sensore WHERE id_sensore = '.$_POST['sensore']);
          $id_pattern = $db->first();
          $id_pattern = $id_pattern->id_pattern_sensore;

          // Recupero tutti i dati strutturati all interno della cifra decimale (unita di misura) con le loro posizioni iniziali e finali
          $db->query('SELECT * FROM misura WHERE id_pattern_misura = '.$id_pattern);
          $listaMisure = $db->results();
          ?>
    <title>Lista dati sensore  <?php echo $nome_sensore;  ?> </title>

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
    <link href="../vendors/datatables.net-scroller-bs/css/scroller.bootstrap.min.css" rel="stylesheet">

    <!-- Custom Theme Style -->
    <link href="../build/css/custom.min.css" rel="stylesheet">
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <?php include 'barralaterale_cli.php'?>
  			<?php include 'top_menu.php'?>

        <!-- top navigation -->

        <!-- /top navigation -->

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Dati Sensore</h3>
              </div>


            </div>

            <div class="clearfix"></div>

            <div class="row">

              <div class="col-md-12 col-sm-12 col-xs-12">
                <div class="x_panel">
                  <div class="x_title">
                    <div class="clearfix"></div>
                  </div>
                  <div class="x_content">
                    <p class="text-muted font-13 m-b-30">
                    Sintesi(min,max,media) dati letti dal sensore: <?php
	$stampa_nome_sensore = <<<HTML
	<h2>$nome_sensore</h2>
HTML;
		  echo $stampa_nome_sensore;
						
						?>.
                    </p>
                    <table id="datatable-buttons" class="table table-striped table-bordered">

  <!-- <caption>Delivery slots:</caption> -->
  <tr>
    <td></td>
    <th scope="col">Minimo</th>
    <th scope="col">Medio</th>
    <th scope="col">Massimo</th>
  </tr>
<?php
	if(count($listaDati)!=0){
    foreach($listaMisure as $misura){
      $i=0;
      foreach ($listaDati as $dato) {
            if($misura->sintetizzabile){
				$inizio = $misura->iniziale_cifre_misura -1;
				$fine = (($misura->finale_cifre_misura) - ($misura->iniziale_cifre_misura ) ) +1;
				$val = substr($dato->stringa_decimale_dato, $inizio ,$fine);
				
				if(strcmp($dato->stringa_decimale_dato[0],'E')!=0){
					$sint[$i] = $val;
					$i++;
				}
				
            }
        }
      if($misura->sintetizzabile){
		  $misura_tab=$misura->unita_misura;
		  $min_tab = (int)min($sint);
		  $max_tab = (int)max($sint);
		  $avg_tab = array_sum($sint)/count($sint);
			$stampa_tabella = <<<HTML
			<tr>
			  <th scope="row">$misura_tab</th>
			  <td>$min_tab</td>
			  <td>$avg_tab</td>
			  <td>$max_tab</td>
			</tr>
HTML;
		  echo $stampa_tabella;
     }
   }
}
?>

                    </table>
                  </div>
                </div>
              </div>






            </div>
          </div>
        </div>
        <!-- /page content -->

        <!-- footer content -->
        <footer>
          <div class="pull-right">
            SensorFlow
          </div>
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
