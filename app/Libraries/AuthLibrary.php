<?php 

namespace App\Libraries;
class AuthLibrary
{
    private $session;
    public function __construct(){
       $this->session = \Config\Services::session(); 
    
       // for information, i config App.php for session storage in files (WRITEPATH.'sessions_cache', with directory named "sessions_cache" and no problem at this level
    }

    public function isLoggedIn(){
        return ($this->session->get('key')!== null)?TRUE:FALSE;
    }
} 

?>