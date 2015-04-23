<?php

    // This file is for testing whatever. To be deleted when the 
    // project is finished.
    
    include "CookieHandler.php";
    
    $cookie_handler = new CookieHandler();
    
    $cookie = Cookie::create("bird", "pass");
    
    var_dump($cookie);
    
?>
