<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Password Change Results</title>
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
					<center><h1>Password Change Results</h1></center>
					<hr/>
					<p>
						<div class="box">
							<p>
                                <?php
                                    // TODO Process password change
                                    
                                    $old_password = trim(htmlspecialchars($_POST["old_password"]));
                                    $new_password = trim(htmlspecialchars($_POST["new_password"]));
                                    $new_password_repeat = trim(htmlspecialchars($_POST["new_password_repeat"]));
                                    
                                    // Check cookie, grab username
                                    $user_cookie = get_cookie("compsec");
                                    if(validate_cookie($user_cookie) == false)
                                    {
                                        print "Error: Invalid cookie. Please fix or delete your cookie and try again.";
                                    }
                                    else if($new_password != $new_password_repeat)
                                    {
                                        print "Error: New passwords do not match. Press the back button to try again.";
                                    }
                                    else
                                    {
                                        $username = $user_cookie->get_username();
                                        
                                        $results = get_user_data($username);
                                        $database_password = $results[1];
                                        $salt = $results[2];
                                        
                                        // Validate that the supplied password is correct
                                        $hashed_password = hash("sha512", $old_password . $salt);
                                        
                                        if($database_password == $hashed_password)
                                        {
                                            // Replace password
                                            $hashed_new_password = hash("sha512", $new_password . $salt);
                                            
                                            
                                            delete_cookie("compsec");
                                            
                                            // Set header to a new page with success message
                                            print "Password successfully changed! Please log in with your new password.";
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
			
			<footer style="position:absolute; bottom:0;">
				2015 David Puglisi, Colby Leclerc.
			</footer>
		</div>
	</body>
	
</html>
