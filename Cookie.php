<?php

class Cookie {
        
    // Cookie attributes
    private $username = "";
    private $hashed_password = "";
    private $expiration = 0;
    private $hmac_hash = "";
    
    public function __construct()
    {
        
    }
    
    // Constructor for creating new cookies
    public function create($username, $hashed_password)
    {
        $cookie = new Cookie();
        $cookie->set_username($username);
        $cookie->set_password($hashed_password);
        $cookie->set_expiration(172800); // 2 days
        return $cookie;
    }
    
    // Constructor for retrieving placed cookies
    public function retrieve($username, $hashed_password, $hmac_hash)
    {
        $cookie = new Cookie();
        $cookie->set_username($username);
        $cookie->set_password($hashed_password);
        $cookie->set_hmac_hash($hmac_hash);
        return $cookie;
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
    
    private function set_hmac_hash($hmac_hash)
    {
        $this->hmac_hash = $hmac_hash;
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
    
    private function get_hmac_hash()
    {
        return $this->hmac_hash;
    }
}
