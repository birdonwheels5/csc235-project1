<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Password Change Results</title>
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
					<center><h1>Password Change Results</h1></center>
					<hr/>
					<p>
						<div class="box">
							<p>
                                <?php
                                    
                                    $old_password = trim(htmlspecialchars($_POST["old_password"]));
                                    $new_password = trim(htmlspecialchars($_POST["new_password"]));
                                    $new_password_repeat = trim(htmlspecialchars($_POST["new_password_repeat"]));
                                    
                                    // Check cookie, grab username
                                    $user_cookie = $cookie_handler->get_cookie("compsec");
                                    
                                    // This case should never happen because the cookie is checked
                                    // on page load, and is deleted if it has been tampered with
                                    if($cookie_handler->validate_cookie($user_cookie) == false)
                                    {
                                        print "Error: Invalid cookie. The offending cookie has been deleted. Please log in again.";
                                        $cookie_handler->delete_cookie("compsec");
                                    }
                                    else if($new_password != $new_password_repeat)
                                    {
                                        print "Error: New passwords do not match. Press the back button to try again.";
                                    }
                                    else
                                    {
                                        $uuid = $user_cookie->get_uuid();
                                        
                                        $results = get_user_data($uuid);
                                        $database_password = $results[2];
                                        $salt = $results[3];
                                        
                                        // Validate that the supplied password is correct
                                        $hashed_password = hash("sha512", $old_password . $salt);
                                        
                                        if($database_password == $hashed_password)
                                        {
                                            // Replace password
                                            $hashed_new_password = hash("sha512", $new_password . $salt);
                                            
                                            update_user_password($uuid, $hashed_new_password);
                                            
                                            $cookie_handler->delete_cookie("compsec");
                                            
                                            print "Password successfully changed! Please <a href =\"login.php\">log in</a> with your new password.";
                                        }
                                        else
                                        {
                                            print "Error: Invalid password. Press the back button to try again.";
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
