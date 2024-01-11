<?php
 namespace Model;

class userModel{
    private $username;
    private $email;
    private $localidade = array(); 
    private $password;

 
    public function getUsername() {
        return $this->username;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getLocalidade() {
        return $this->localidade;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setUsername($username) {
        $this->username = $username;
    }

    public function setEmail($email) {
        $this->email = $email;
    }

    public function setLocalidade($localidade) {
        if (is_array($localidade) && array_key_exists('city', $localidade) && array_key_exists('state', $localidade)) {
            $this->localidade = $localidade;
        } else {
            die("Formato inválido para localidade.");
        }
    }
    public function setPassword($password) {
        $this->password = $password;
    }
}

//$user = new UserClass("JohnDoe", "john.doe@example.com", ["city" => "New York", "state" => "NY"], "secretpassword");

?>
