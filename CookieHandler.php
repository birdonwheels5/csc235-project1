<?php
/**
 * Created by IntelliJ IDEA.
 * User: colby
 * Date: 4/19/15
 * Time: 11:54 AM
 */
 
 /*
  * So, what you need to do is the following:
  * 
  * Finish the get methods
  * Finish get_cookie()
  * Refactor the verify_cookie() method to accept and verify a supplied cookie object
  * delete_cookie() method
  * 
  * And whatever else you think the class needs. Anything cookie related, really.
  * 
  * Note: I renamed the class to CookieHandler, because that's basically what it is.
  * Maybe we should make another class for cookies? (I'm not that great with OOP yet)
  * 
  * PS: Already made the cookie class
  * 
  */

class CookieHandler {
    //Random 256-bit key
    private $SECRET_KEY = "C5B75BD864EBA5837F9727ED73894";
    
    // Cookie attributes
    private $cookie_directory = "/";
    private $hmac_hash = "";
    
    public function __construct()
    {
        
    }

    private function generate_cookie($cookie) 
    {
        // Generate hash
        $key = hash_hmac( 'md5', $cookie->username . $cookie->expiration, $this->SECRET_KEY );
        $this->hmac_hash = hash_hmac( 'md5', $cookie->username . $cookie->expiration, $key );
        
        $cookie_plaintext = ($cookie->username . '|' . $cookie->hashed_password . '|' . $this->hmac_hash);

        return $cookie_plaintext;
    }
    
    public function set_cookie($cookie_name) 
    {
        $cookie_plaintext = $this->generate_cookie();

        if (!setcookie($this->cookie_name, $cookie_plaintext, $this->expiration, $this->cookie_directory)) 
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
    
    // This function will create a new cookie object with values found
    // from the global cookie variable
    // It will return the cookie to the caller
    public function get_cookie($cookie_name)
    {
        $cookie_plaintext = $_COOKIE[$cookie_name];
        
        // $cookie = new Cookie();
        
        // Fill out the cookie's attributes
        
        return $cookie;
    }
    
    // Verifies that a cookie hash not been tampered with and is valid
    public function verify_cookie($cookie)
    {
        $cookie_name = ("cookie_" . $this->username);
            
        // Check if cookie exists
        if ($this->exists($this->cookie_name) == false)
        {
            return false;
        }
                    
        $cookie = $_COOKIE[$this->cookie_name];

        $expired = $expiration;
        
        if ($expired < time())
            return false;

        $key = hash_hmac('md5', $id . $expiration, $this->SECRET_KEY);
        $hash = hash_hmac('md5', $id . $expiration, $key);

        if ($hmac != $hash)
            return false;

        return true;
    }
    
    // Get methods go here

}
