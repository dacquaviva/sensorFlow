<html>
<?php
           echo'<FORM ID="log" NAME="log" ACTION="'. $_SERVER["PHP_SELF"].'"METHOD="POST">
			
              <h1>Login</h1>
              <div>
                <input name="email" type="email" class="form-control" placeholder="Email" required>
              </div>
              <div>
                <input name="password" type="password" class="form-control" placeholder="Password" required>
              </div>
              <div>
              
				  <input id="submit05" name="submit05" type="submit" value="ACCEDI">
              </div>

              <div class="clearfix"></div>

              <div class="separator">
                <p class="change_link">
                  <a href="#signup" class="to_register"> Recupera Password </a>
                </p>

                <div class="clearfix"></div>
                <br />

                <div>
                  <h1><i class="fa fa-circle"></i> Sensor Flow </h1>
                  <p>©2018 Tutti i diritti riservati.</p>
                </div>
              </div>
            </form>
          </section>
        </div>';
		  if(isset($_POST["submit05"]))
		  		{
			             echo'ooooooooooooooooooooooooooooooooooooooooooooooo';
						 $email=$_POST["email"];
						 $psw=$_POST["password"];
						 $email=stripslashes($email);
						 $psw=stripslashes($psw);
						 $email=mysql_real_escape_string($email);
						 $psw=mysql_real_escape_string($psw);
						 $pswmd5=md5($psw);
						 $user = new User();
						 $login = $user->login($email, $psw);
					  if($login) {
					     header("Location: http://sensorflow.altervista.org/production/index.php");
				         } else {
					    echo '<p>Incorrect username or password</p>';
				       }
		 }
         ?>
</html>