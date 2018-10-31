<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<!-- Meta, title, CSS, favicons, etc. -->
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<title>SensorFlow - Login</title>

	<!-- Bootstrap -->
	<link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">
	<!-- Font Awesome -->
	<link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">
	<!-- NProgress -->
	<link href="../vendors/nprogress/nprogress.css" rel="stylesheet">
	<!-- Animate.css -->
	<link href="../vendors/animate.css/animate.min.css" rel="stylesheet">

	<!-- Custom Theme Style -->
	<link href="../build/css/custom.min.css" rel="stylesheet">
</head>

<body class="login">
	<div>
		<a class="hiddenanchor" id="signup"></a>
		<a class="hiddenanchor" id="signin"></a>

		<div class="login_wrapper">
			<div class="animate form login_form">
				<section class="login_content">
					<form ID="log" NAME="log" action="<?php '.$_SERVER[" PHP_SELF "].' ?>" METHOD="POST">

						<h1>Login</h1>
						<div>
							<input name="email" type="email" class="form-control" placeholder="Email" required>
						</div>
						<div>
							<input name="password" type="password" class="form-control" placeholder="Password" required>
						</div>
						<div>

							<input class="btn btn-default submit" id="submit05" name="submit05" type="submit" value="Accedi">
						</div>

						<div class="clearfix"></div>

						<div class="separator">
							<p class="change_link">
								<a href="#signup" class="to_register"> Recupera Password </a>
							</p>

							<div class="clearfix"></div>
							<br/>

							<div>
								<h1><i class="fa fa-circle"></i> Sensor Flow </h1>
								<p>©2018 Tutti i diritti riservati.</p>
							</div>
						</div>
					</form>
				</section>
			</div>
			<?php
			require_once 'core/init.php' ;
			if ( isset( $_POST[ "submit05" ] ) ) {
				$email = $_POST[ "email" ];
				$psw = $_POST[ "password" ];
				$email = stripslashes( $email );
				$psw = stripslashes( $psw );
				$email = mysql_real_escape_string( $email );
				$psw = mysql_real_escape_string( $psw );
				$pswmd5 = openssl_digest($psw, "sha224", false);
				$user = new User();
				$login = $user->login( $email, $pswmd5 );

				if ( $login ) {
					session_start();
					$db = DB::getInstance();
					$db->get( "utente", array( "email_utente", "=", $email ) );
					if ( $db->first()->is_admin_utente ) {
						$_SESSION[ 'permessi_admin' ] = 1;
						header( "Location: http://sensorflow.altervista.org/production/index.php" );
					} else {
						$_SESSION[ 'permessi_admin' ] = 0;
						header( "Location: http://sensorflow.altervista.org/production/visualizza.php" );
					}

				} else {
					echo 'Email o password non corretti';
				}
			}
			?>
			<div id="register" class="animate form registration_form">
				<section class="login_content">
					<form>
						<h1>Recupero Password</h1>

						<div>
							<input type="email" class="form-control" placeholder="Email" required=""/>
						</div>

						<div>
							<a class="btn btn-default submit" href="login.php">Recupera</a>
						</div>

						<div class="clearfix"></div>

						<div class="separator">
							<p class="change_link">Sei già registrato?
								<a href="#signin" class="to_register"> Login </a>
							</p>

							<div class="clearfix"></div>
							<br/>

							<div>
								<h1><i class="fa fa-circle"></i> Sensor Flow</h1>
								<p>©2018 Tutti i diritti riservati.</p>
							</div>
						</div>
					</form>
				</section>
			</div>
		</div>
	</div>
</body>

</html>
