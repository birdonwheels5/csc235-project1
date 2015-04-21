<!DOCTYPE html>
<html>
	<head>
		<meta charset="ISO-8859-1">
		<title>Logout</title>
		<link rel="stylesheet" type="text/css" href="styles.css" title="Default Styles" media="screen"/>
		<link rel="stylesheet" type="text/css" href="http://fonts.googleapis.com/css?family=Open+Sans" title="Font Styles"/>
        <?php include "Cookie.php"; ?>
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
					<center><h1>Logout Error</h1></center>
					<hr/>
					<p>
						<div class="box">
							<p>
                                <?php
                                    
                                    // Perform logout here
                                    $cookie = new Cookie("a", "a");
                                    if($cookie->exists("compsec") == true)
                                    {
                                        $cookie->delete_cookie("compsec");
                                        header("location:index.php");
                                    }
                                    else
                                    {
                                        print "Unable to log out because user is not logged in!";
                                    }
                                ?>
							</p>
						</div>
								
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

