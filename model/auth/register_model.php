<?php

class data
{
    public function __construct() { }

    private $prefix = 'database/users/';
    private $suffix = '.JSON';

    /** 
     * A function that checks if a username is valid
     * 
     * @param string   $username Username to check
     * @return boolean True if the username is valid, false otherwise
    */
    private function valid_username(string $username)
    {
        if ((file_exists($this->prefix . $username . $this->suffix)) || (strpos($username, ' ') !== false)) {
            return false;
        }

        return true;
    }

    /** 
     * A function that creates a user in the database
    */
    public function create_user()
    {
        $username = $_POST['username'];
        if ($this->valid_username($username)) {
            if ($_POST['passwd'] === $_POST['passwd_confirm']) {
                
                // Set all necessary variables :
                $this->username = htmlspecialchars($username);
                $this->mail     = htmlspecialchars($_POST['mail']);
                $this->passwd   = password_hash(htmlspecialchars($_POST['passwd']), PASSWORD_DEFAULT);
                $this->delivery_address = htmlspecialchars($_POST['delivery_address']);
                $this->delivery_city    = htmlspecialchars($_POST['delivery_city']);
                $this->delivery_code    = htmlspecialchars($_POST['delivery_code']);
                
                if (empty($_POST['billing_address'])) {
                    $this->billing_address = htmlspecialchars($_POST['delivery_address']);
                    $this->billing_city    = htmlspecialchars($_POST['delivery_city']);
                    $this->billing_code    = htmlspecialchars($_POST['delivery_code']);
                } else {
                    $this->billing_address = htmlspecialchars($_POST['billing_address']);
                    $this->billing_city    = htmlspecialchars($_POST['billing_city']);
                    $this->billing_code    = htmlspecialchars($_POST['billing_code']);
                }
                
                $this->role = 1;
                $this->age  = null;
                $this->job  = null;
                $this->first_name = null;
                $this->last_name  = null;

                // Set necessary session variables :
                session_start();
                $_SESSION['role']     = $this->role;
                $_SESSION['username'] = $this->username;
    
                // Write data to files :
                $file = fopen($this->prefix . $username . $this->suffix, 'w');
                fwrite($file, json_encode($this));
                fclose($file);
                
            }
        }
    }
}