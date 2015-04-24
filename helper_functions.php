<?php

// Returns boolean
function create_user($username, $password)
{
    
    // Normally we would store the database password outside the web directory so 
    // if there was a mistake and the webserver served our PHP source code, 
    // the password would not be leaked. Also, it would make it easy to change credentials across all
    // functions.
    $mysql_host = "127.0.0.1";
    $mysql_user = "root";
    $mysql_pass = "mysql";
    $mysql_database = "csc235_project1";
    
    // Creates a random string for our salt
    $salt = openssl_random_pseudo_bytes(8);
    $creation_time = time();
    $uuid = hash("sha256", $username);
    $hashed_password = hash("sha512", $password . $salt);
    $authority_level = 100;
    
    $insert = "INSERT INTO `csc235_project1`.`users` (`username`, `uuid`, `hashed_password`, `salt`, `authority_level`, `creation_time`, `last_login`) 
    VALUES (\"" . $username . "\", \"" . $uuid . "\", \"" . $hashed_password . "\", \"" . $salt . "\", " . $authority_level . ", " . $creation_time . ", 0)";
    
    // Add user to the database
    $result = execute_mysql_query($mysql_host, $mysql_user, $mysql_pass, $mysql_database, $insert);
    
    return $result;
}

// Returns array
function get_user_data($uuid)
{    
	// Establish connection to the database
	$con=mysqli_connect("127.0.0.1", "root", "mysql", "csc235_project1");
	
	if (mysqli_connect_errno()) 
	{
		echo "Failed to connect to MySQL: " . mysqli_connect_error();
	}
	
	$result = mysqli_query($con, "SELECT * FROM `users`");
	
	// Obtain the number of rows from the result of the query
	$num_rows = mysqli_num_rows($result);
			
	// Will be storing all the rows in here
	$array_of_rows = array();
							
	// Get all the rows
	for($i = 0; $i < $num_rows; $i++)
	{
		$array_of_rows[$i] = mysqli_fetch_array($result);
	}
	$size_of_array_of_rows = $num_rows;
							
	$usernames = array();
    $uuids = array();
	$hashed_passwords = array();
	$salts = array();
	$authority_levels = array();
	$creation_times = array();
    $last_logins = array();
	
	// Get an array of all values for each field
	for($i = 0; $i < $size_of_array_of_rows; $i++)
	{
		$usernames[$i] = $array_of_rows[$i]["username"];
        $uuids[$i] = $array_of_rows[$i]["uuid"];
		$hashed_passwords[$i] = $array_of_rows[$i]["hashed_password"];
		$salts[$i] = $array_of_rows[$i]["salt"];
		$authority_levels[$i] = $array_of_rows[$i]["authority_level"];
		$creation_times[$i] = $array_of_rows[$i]["creation_time"];
        $last_logins[$i] = $array_of_rows[$i]["last_login"];
	}
	
	// Search for requested user using a linear search
    $result = -1;
    for($i = 0; $i < $size_of_array_of_rows; $i++)
    {
        if($uuids[$i] == $uuid)
        {
            $result = $i;
        }
    }
    
    if($result == -1)
    {
        return -1;
    }
    
    // Package the user's data and return as an array
    $user_package = array();
    $user_package[0] = $usernames[$result];
    $user_package[1] = $uuids[$result];
    $user_package[2] = $hashed_passwords[$result];
    $user_package[3] = $salts[$result];
    $user_package[4] = $authority_levels[$result];
    $user_package[5] = $creation_times[$result];
    $user_package[6] = $last_logins[$result];
	
    return $user_package;
}

// Returns nothing. Halts page execution if user lacks appropriate permissions
function authenticate_user($required_authority_level)
{    
    $cookie_handler = new CookieHandler();
    
    $color = "hsla(360, 100%, 50%, 0.9)";
    
    if($cookie_handler->cookie_exists("compsec") == true)
    {
        $user_cookie = $cookie_handler->get_cookie("compsec");
        if($cookie_handler->validate_cookie($user_cookie) == true)
        {
            // Fetch user data
            $results = get_user_data($user_cookie->get_uuid());
            $user_authority_level = $results[4];
            
            // Check authentication level
            if($user_authority_level < $required_authority_level)
            {
                print "<div class=\"box\" style=\"background-color:" . $color . ";margin-top:25px;\">You are not authorized to view this page.</div>";
                exit;
            }
        }
        else
        {
            print "<div class=\"box\" style=\"background-color:" . $color . ";margin-top:25px;\">Invalid cookie. You need a valid login with the appropriate permissions in order to access this page.</div>";
            exit;
        }
    }
    else
    {
        print "<div class=\"box\" style=\"background-color:" . $color . ";margin-top:25px;\">You need to be logged in to access this resource.</div>";
        exit;
    }
}

// Returns boolean
function update_user_password($uuid, $hashed_new_password)
{
    
    $mysql_host = "127.0.0.1";
    $mysql_user = "root";
    $mysql_pass = "mysql";
    $mysql_database = "csc235_project1";
    
    $update = "UPDATE  `csc235_project1`.`users` SET  `hashed_password` =  '" . $hashed_new_password . "' WHERE `users`.`uuid` = '" . $uuid . "' LIMIT 1 ;";
    
    // Execute password update
    $result = execute_mysql_query($mysql_host, $mysql_user, $mysql_pass, $mysql_database, $update);
    
    return $result;
    
}

// Returns boolean
function update_last_login($uuid)
{
    
    $mysql_host = "127.0.0.1";
    $mysql_user = "root";
    $mysql_pass = "mysql";
    $mysql_database = "csc235_project1";
    
    $time = time();
    
    $update = "UPDATE  `csc235_project1`.`users` SET  `last_login` =  '" . $time . "' WHERE `users`.`uuid` = '" . $uuid . "' LIMIT 1 ;";
    
    // Execute last login update
    $result = execute_mysql_query($mysql_host, $mysql_user, $mysql_pass, $mysql_database, $update);
    
    return $result;
}

// Returns boolean
function execute_mysql_query($host, $user, $pass, $database, $command)
{
    // Establish connection to the database
    $con=mysqli_connect($host, $user, $pass, $database);
    
    if (mysqli_connect_errno()) 
    {
        echo "Failed to connect to MySQL: " . mysqli_connect_error();
        return false;
    }
    
    // Execute command
    if (mysqli_query($con, $command)) 
    {
        //echo "Command successfully executed";
        return true;
    } 
    else 
    {
        //echo "Error executing command: " . mysqli_error($con);
        return false;
   }
}

?>
