<?php
session_start();
//controllo permessi
if($_SESSION[ 'permessi_admin' ] == 1){
header( "Location: http://sensorflow.altervista.org/production/index.php" );}
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

          <ul class="nav side-menu">
             <li><a href="visualizza.php"><i class="fa fa-th-list"></i> Visualizza Dati </a>
                </li>
            <li><a href="sintesi.php"><i class="fa fa-folder-open"></i> Visualizza Sintesi </a>
           </li>
<li><a href="visualizza_ecc.php"><i class="fa fa-exclamation-circle"></i> Visualizza Eccezioni </a>
            </li>
<li><a href="modcredenziali.php"><i class="fa fa-key"></i> Modifica credenziali </a>
<li><a href="logout.php"><i class="fa fa-sign-out"></i> Logout </a>
          </ul>
            </div>
           </div>
         </div>
       </div>
HTML;
echo $str;


?>
        
        
