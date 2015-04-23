<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Account Creation Results</title>
		<link rel="stylesheet" type="text/css" href="styles.css" title="Default Styles" media="screen"/>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans" title="Font Styles"/>
		<?php include "CookieHandler.php"; 
              include "helper_functions.php"; ?>
	</head>
	
	<body link="#E2E2E2" vlink="#ADABAB">
		<center><div class="container">
	
		<?php $cookie_handler = new CookieHandler(); ?>
		
			<header>
		
				<div class="logoContainer">
					<!-- <img src="logo-bar.png"> -->
				</div>
				
				<div class="button">
					<p><a href ="index.php">Index</a></p>
				</div>
				
				<div class="button">
					<?php 
                        
                        if($cookie_handler->cookie_exists("compsec"))
                        {
                            $user_cookie = $cookie_handler->get_cookie("compsec");
                            if($cookie_handler->validate_cookie($user_cookie) == true)
                            {
                                print "<p><a href =\"logout.php\">Logout</a></p>";
                            }
                            else
                            {
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
                        if($cookie_handler->cookie_exists("compsec"))
                        {
                            $user_cookie = $cookie_handler->get_cookie("compsec");
                            if($cookie_handler->validate_cookie($user_cookie) == true)
                            {
                                
                            }
                            else
                            {
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
                        if($cookie_handler->cookie_exists("compsec"))
                        {
                            $user_cookie = $cookie_handler->get_cookie("compsec");
                            if($cookie_handler->validate_cookie($user_cookie) == true)
                            {
                                print "<p><a href =\"passwd.php\">Change Password</a></p>";
                            }
                            else
                            {
                                
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
			
			<article style="color:#FFFFFF;">
				<p>
					<!-- <center><img src="logo_big.png"></center> Insert Main Logo here -->
					
					<hr/>
					<center><h1>Account Creation Results</h1></center>
					<hr/>
					<p>
						<div class="box">
							<p>
								<?php
                                    $username = trim(htmlspecialchars($_POST["username"]));
                                    $password = trim(htmlspecialchars($_POST["password"]));
                                    
                                    // Check to see if the user is already in the database.
                                    // The function will return an array if they are.
                                    if(is_array(get_user_data($username)))
                                    {
                                        print "Username already exists! Please press the back button to try another username.";
                                    }
                                    else
                                    {
                                        $result = create_user($username, $password);
                                        if($result = false)
                                        {
                                            print "Error creating account!";
                                        }
                                        else
                                        {
                                            print "Account created successfully!";
                                            print "<br/><br/>";
                                            print "You can now <a href =\"login.php\">log in</a>.";                                       }
                                    }
                                    
                                    
                                ?>
							</p>
						</div>

					</p>

				</p>
			
			
			</article>
			
			<div class="paddingBottom">
			</div>
			
			<footer style="position:absolute; bottom:0;">
				2015 David Puglisi, Colby Leclerc.
			</footer>
		</div>
	</body>
	
</html>
