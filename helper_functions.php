<?php
    
  function create_user($username, $password)
    {
        $salt = openssl_random_pseudo_bytes(8);
        $timestamp = time();
        $hashed_password = hash("sha512", $password . $salt);
        $authority_level = 100;
        
        // Establish connection to the database
        $con=mysqli_connect("127.0.0.1", "root", "mysql", "csc235_project1");
        
        if (mysqli_connect_errno()) 
        {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
        }
        
        $insert = "INSERT INTO `csc235_project1`.`users` (`username`, `hashed_password`, `salt`, `authority_level`, `timestamp`) 
        VALUES (\"" . $username . "\", \"" . $hashed_password . "\", \"" . $salt . "\", " . $authority_level . ", " . $timestamp . ")";
        
        // Execute insertion
        if (mysqli_query($con, $insert)) 
        {
            //echo "User successfully created";
            return true;
        } 
        else 
        {
            //echo "Error creaing user: " . mysqli_error($con);
            return false;
        }
    }
    
    function change_password($username, $new_password)
    {
        
    }
    
    function get_user_data($username)
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
	$hashed_passwords = array();
	$salts = array();
	$authority_levels = array();
	$timestamps = array();
	
	// Get an array of all values for each field
	for($i = 0; $i < $size_of_array_of_rows; $i++)
	{
		$usernames[$i] = $array_of_rows[$i]["username"];
		$hashed_passwords[$i] = $array_of_rows[$i]["hashed_password"];
		$salts[$i] = $array_of_rows[$i]["salt"];
		$authority_levels[$i] = $array_of_rows[$i]["authority_level"];
		$timestamps[$i] = $array_of_rows[$i]["timestamp"];
	}
	
	// Search for requested user using a linear search
    $result = -1;
    for($i = 0; $i < $size_of_array_of_rows; $i++)
    {
        if($usernames[$i] == $username)
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
    $user_package[1] = $hashed_passwords[$result];
    $user_package[2] = $salts[$result];
    $user_package[3] = $authority_levels[$result];
    $user_package[4] = $timestamps[$result];
	
	return $user_package;
}

function login()
{
    
}

?>
