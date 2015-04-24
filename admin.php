<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Admin Area</title>
		<link rel="stylesheet" type="text/css" href="styles.css" title="Default Styles" media="screen"/>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans" title="Font Styles"/>
		<?php include "CookieHandler.php";
              include "helper_functions.php"; ?>
	</head>
	
	<body link="#E2E2E2" vlink="#ADABAB">
		<center><div class="container">
            
            <?php 
            
                $cookie_handler = new CookieHandler();
                $cookie_name = $cookie_handler->get_cookie_name();
            
            ?>
		
			<header>
		
				<div class="logoContainer">
					<!-- <img src="logo-bar.png"> -->
				</div>
				
				<div class="button">
					<p><a href ="index.php">Index</a></p>
				</div>
				
				<div class="button">
					<?php 
                        
                        if($cookie_handler->cookie_exists($cookie_name))
                        {
                            $user_cookie = $cookie_handler->get_cookie($cookie_name);
                            if($cookie_handler->validate_cookie($user_cookie) == true)
                            {
                                print "<p><a href =\"logout.php\">Logout</a></p>";
                            }
                            else
                            {
                                $cookie_handler->delete_cookie($cookie_name);
                                print "<p><a href =\"login.php\">Login</a></p>";
                            }
                        }
                        else
                        {
                            print "<p><a href =\"login.php\">Login</a></p>";
                        }
                    ?>
				</div>
				
				<div class="button">
                    <?php
                        if($cookie_handler->cookie_exists($cookie_name))
                        {
                            $user_cookie = $cookie_handler->get_cookie($cookie_name);
                            if($cookie_handler->validate_cookie($user_cookie) == true)
                            {
                                
                            }
                            else
                            {
                                $cookie_handler->delete_cookie($cookie_name);
                                print "<p><a href =\"createuser.php\">Create an Account</a></p>";
                            }
                        }
                        else
                        {
                            print "<p><a href =\"createuser.php\">Create an Account</a></p>";
                        }
                    ?>
				</div>
                
                <div class="button">
                    <?php
                        if($cookie_handler->cookie_exists($cookie_name))
                        {
                            $user_cookie = $cookie_handler->get_cookie($cookie_name);
                            if($cookie_handler->validate_cookie($user_cookie) == true)
                            {
                                print "<p><a href =\"passwd.php\">Change Password</a></p>";
                            }
                            else
                            {
                                $cookie_handler->delete_cookie($cookie_name);
                            }
                        }
                        else
                        {
                            
                        }
                    ?>
				</div>
				
				<div class="button">
					<p><a href ="user.php">Member Area</a></p>
				</div>
                
                <div class="button">
					<p><a href ="admin.php">Admin Area</a></p>
				</div>
				
			</header>
            
            <?php 
                // Authenticate user
                authenticate_user(900);
            ?>
			
			<article style="color:#FFFFFF;">
				<p>
					<!-- <center><img src="logo_big.png"></center> Insert Main Logo here -->
					
					<hr/>
					<center><h1>Admin Lounge</h1></center>
					<hr/>
					<p>
						<div class="box">
							<p>
								Hello, admin! Welcome to the elite admin area of the site, where no user peasants may roam.
							</p>
						</div>

					</p>

				</p>
			
			
			</article>
			
			<div class="paddingBottom">
			</div>
			
			<footer>
				2015 David Puglisi, Colby Leclerc.
			</footer>
		</div>
	</body>
	
</html>
