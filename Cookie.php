<?php

class Cookie {
        
    // Cookie attributes
    private $username = "";
    private $hashed_password = "";
    private $expiration = 0;
    
    public function __construct($username, $hashed_password)
    {
        $this->set_username($username);
        $this->set_password($hashed_password);
        $this->set_expiration(172800); // 2 days
    }

    private function set_username($username)
    {
        $this->username = $username;
    }
    
    private function set_password($password)
    {
        $this->hashed_password = $password;
    }
    
    // Time to expire in seconds.
    private function set_expiration($time_to_expire)
    {
        $time = time();
        $this->expiration = $time + $time_to_expire;
    }
    
    public function get_username()
    {
        return $this->username;
    }
    
    public function get_password()
    {
        return $this->hashed_password;
    }
    
    private function get_expiration()
    {
        return $this->expiration;
    }
}
