<?php
/**
 * Created by IntelliJ IDEA.
 * User: colby
 * Date: 4/19/15
 * Time: 11:54 AM
 */
 
 /*
  * Ok, I originally sent the message in canvas, but my session seems to have expired. Whatever, I'll just
  * type everything directly into the source code ;)
  * 
  * So I refactored the class quite a bit, mostly to make it (hopefully) conceptually simpler,
  * and to conform to php style rules with this_convention. Anyhow, I was able to create a cookie
  * object, but I haven't tested actually setting/getting them. If you could do that after you fill this
  * class out that would be great. So, what you need to do is the following:
  * 
  * Finish the get methods
  * Finish get_cookie()
  * Refactor the verify_cookie() method to accept and verify a supplied cookie object
  * 
  * And whatever else you think the class needs. Anything cookie related, really.
  * 
  */

class Cookie {
    //Random 256-bit key
    private $SECRET_KEY = "C5B75BD864EBA5837F9727ED73894";
    
    // Cookie attributes
    private $cookie_name = "compsec";
    private $username = "";
    private $hashed_password = "";
    private $expiration = 0;
    private $cookie_directory = "/";
    private $hmac_hash = "";
    
    public function __construct($username, $hashed_password)
    {
        $this->set_username($username);
        $this->set_password($hashed_password);
        $this->set_expiration(172800); // 2 days
    }

    private function generate_cookie() 
    {
        // Generate hash
        $key = hash_hmac( 'md5', $this->username . $this->expiration, $this->SECRET_KEY );
        $this->hmac_hash = hash_hmac( 'md5', $this->username . $this->expiration, $key );
        
        $cookie = ($this->username . '|' . $this->hashed_password . '|' . $this->hmac_hash);

        return $cookie;
    }
    
    public function set_cookie() 
    {
        $cookie = $this->generate_cookie();

        if (!setcookie($this->cookie_name, $cookie, $this->expiration, $this->cookie_directory)) 
        {
            //echo("ERROR: Unable to create cookie");
            return false;
        }
        return true;
    }
    
    
    
    // Check if cookie exists
    public function exists($cookie_name)
    {
        if (empty($_COOKIE[$cookie_name]))
        {
            return false;
        }
        else
        {
            return true;
        }
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
    
    // The rest of the get methods go here

}
