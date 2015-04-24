<?php

class Cookie
{
        
    // Cookie attributes
    private $uuid = "";
    private $hashed_password = "";
    private $expiration = 0;
    private $hmac_hash = "";
    
    public function __construct()
    {
        
    }
    
    // Constructor for creating new cookies
    public function create($uuid, $hashed_password)
    {
        $cookie = new Cookie();
        $cookie->set_uuid($uuid);
        $cookie->set_password($hashed_password);
        $cookie->set_expiration(172800); // 2 days
        return $cookie;
    }
    
    // Constructor for retrieving placed cookies
    public function retrieve($uuid, $hashed_password, $hmac_hash, $expiration)
    {
        $cookie = new Cookie();
        $cookie->set_uuid($uuid);
        $cookie->set_password($hashed_password);
        $cookie->set_hmac_hash($hmac_hash);
        $cookie->expiration = $expiration;
        return $cookie;
    }

    private function set_uuid($uuid)
    {
        $this->uuid = $uuid;
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
    
    public function get_uuid()
    {
        return $this->uuid;
    }
    
    public function get_password()
    {
        return $this->hashed_password;
    }
    
    public function get_expiration()
    {
        return $this->expiration;
    }
    
    public function get_hmac_hash()
    {
        return $this->hmac_hash;
    }
}
