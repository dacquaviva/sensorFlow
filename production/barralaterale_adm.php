<?php
 session_start();
//controllo permessi
if($_SESSION[ 'permessi_admin' ] == 0){
header( "Location: http://sensorflow.altervista.org/production/visualizza.php" );}

if(isset($_SESSION['email']))
{
	$str = <<<HTML
<div class="col-md-3 left_col">
<div class="left_col scroll-view">
<div class="navbar nav_title" style="border: 0;">
<a href="index.php" class="site_title"><i class="fa fa-circle"></i> <span>Sensor  Flow</span></a>
</div>
<div class="clearfix"></div>
<div class="profile clearfix">
<div class="profile_pic">
<img src="images/img1.jpg" alt="..." class="img-circle profile_img">
</div>
<div class="profile_info">
<span>Benvenuto,</span>
<h2>{$_SESSION['nome']} {$_SESSION['cognome']}</h2>
</div>
</div>
<br />
<div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
<div class="menu_section">
<h3></h3>
 <ul class="nav side-menu">
<li><a><i class="fa fa-plus"></i> Aggiungi <span class="fa fa-chevron-down"></span></a>
<ul class="nav child_menu">
<li><a href="autente.php">Aggiungi Utente</a></li>
<li><a href="asensore.php">Aggiungi Sensore</a></li>
<li><a href="amodello.php">Aggiungi Modello</a></li>
</ul>
</li>
<li><a><i class="fa fa-search"></i> Cerca <span class="fa fa-chevron-down"></span></a>
<ul class="nav child_menu">
<li><a href="cercautente.php">Cerca Utente</a></li>
<li><a href="cercasensore.php">Cerca Sensore</a></li>
</ul>
</li>
<li><a><i class="fa fa-pencil"></i> Modifica <span class="fa fa-chevron-down"></span></a>
<ul class="nav child_menu">
<li><a href="modutente.php">Modifica Utente</a></li>
<li><a href="modsensore.php">Modifica Sensore</a></li>
</ul>
</li>
<li><a><i class="fa fa-trash"></i> Elimina <span class="fa fa-chevron-down"></span></a>
<ul class="nav child_menu">
<li><a href="esensore.php">Elimina Sensore</a></li>
<li><a href="eutente.php">Elimina Utente</a></li>
</ul>
</li>
<li><a href="alettura.php"><i class="fa fa-bug"></i> DEBUG_AggiungiLettura </a>
<li><a href="modcredenziali.php"><i class="fa fa-key"></i> Modifica credenziali </a>
<li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout </a>
</ul>
</div>
</div>
</div>
</div>
HTML;
	echo $str;
}else{
	     header("Location: http://sensorflow.altervista.org/production/login.php");
}
        ?>
