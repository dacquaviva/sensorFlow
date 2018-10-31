<?php	
require_once 'core/init.php';
session_start();
if(isset($_SESSION['email']))
{
                          
                          $db = DB::getInstance();
		   				  $db->get("utente",array("email_utente","=",$_SESSION['email']));
						  if($db->first()->is_admin_utente){
							 include 'barralaterale_adm.php';
						  }else{
							  include 'barralaterale_cli.php';
							  echo 'ciao';

						  }
}else{
	     header("Location: http://sensorflow.altervista.org/production/login.php");
}
  ?>