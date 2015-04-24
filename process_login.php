<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Login</title>
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
			
			<article style="color:#FFFFFF;">
				<p>
					<!-- <center><img src="logo_big.png"></center> Insert Main Logo here -->
					
					<hr/>
					<center><h1>Login Error</h1></center>
					<hr/>
					<p>
						<div class="box">
							<p>
								<?php
                                    $username = trim(htmlspecialchars($_POST["username"]));
                                    $password = trim(htmlspecialchars($_POST["password"]));
                                    
                                    $uuid = hash("sha256", $username);
                                    
                                    // Check to see if the user is already logged in
                                    if($cookie_handler->cookie_exists("compsec"))
                                    {
                                        print "Error: Cannot log in if user is already logged in!";
                                    }
                                    else
                                    {
                                        // Check to see if the user is already in the database.
                                        // The function will return an array if they are.
                                        $results = get_user_data($uuid);
                                        if(is_array($results))
                                        {
                                            $uuid = $results[1];
                                            $database_password = $results[2];
                                            $salt = $results[3];
                                            
                                            // Validate that the supplied password is correct
                                            $hashed_password = hash("sha512", $password . $salt);
                                            
                                            if($database_password == $hashed_password)
                                            {
                                                // Store cookie on client's computer
                                                $cookie = Cookie::create($uuid, $hashed_password);
                                                $result = $cookie_handler->set_cookie("compsec", $cookie);
                                                if($result == false)
                                                {
                                                    print "An unexpected error has prevented you from logging in. Reason: Unable to create a login cookie.";
                                                }
                                                // Login successful
                                                update_last_login($uuid);
                                                header("location:index.php");
                                            }
                                            else
                                            {
                                                print "Error: Invalid password. Press the back button to try again.";
                                            }
                                        }
                                        else
                                        {
                                            print "Error: User does not exist! Press the back button to try again.";
                                        }
                                    }
                                ?>
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
