<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Login</title>
		<link rel="stylesheet" type="text/css" href="styles.css" title="Default Styles" media="screen"/>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans" title="Font Styles"/>
		<?php include "Cookie.php"; 
              include "helper_functions.php"; ?>
	</head>
	
	<body link="#E2E2E2" vlink="#ADABAB">
		<center><div class="container">
	
		
			<header>
		
				<div class="logoContainer">
					<!-- <img src="logo-bar.png"> -->
				</div>
				
				<div class="button">
					<p><a href ="index.php">Index</a></p>
				</div>
				
				<div class="button">
					<?php 
                        $cookie = new Cookie("a", "a");
                        if($cookie->exists("compsec"))
                        {
                            $user_cookie = $cookie->get_cookie("compsec");
                            if($cookie->validate_cookie($user_cookie) == true)
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
                        $cookie = new Cookie("a", "a");
                        if($cookie->exists("compsec"))
                        {
                            $user_cookie = $cookie->get_cookie("compsec");
                            if($cookie->validate_cookie($user_cookie) == true)
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
                        $cookie = new Cookie("a", "a");
                        if($cookie->exists("compsec"))
                        {
                            $user_cookie = $cookie->get_cookie("compsec");
                            if($cookie->validate_cookie($user_cookie) == true)
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
					<center><h1>Login Error</h1></center>
					<hr/>
					<p>
						<div class="box">
							<p>
								<?php
                                    $username = trim(htmlspecialchars($_POST["username"]));
                                    $password = trim(htmlspecialchars($_POST["password"]));
                                    
                                    // Check to see if the user is already in the database.
                                    // The function will return an array if they are.
                                    $results = get_user_data($username);
                                    if(is_array($results))
                                    {
                                        $database_password = $results[1];
                                        $salt = $results[2];
                                        
                                        // Validate that the supplied password is correct
                                        $hashed_password = hash("sha512", $password . $salt);
                                        
                                        if($database_password == $hashed_password)
                                        {
                                            // Store cookie on client's computer
                                            $cookie = new Cookie($username, $hashed_password);
                                            if($cookie->set_cookie() == false)
                                            {
                                                print "An unexpected error has prevented you from logging in. Reason: Unable to create a login cookie.";
                                            }
                                            // Login successful
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
