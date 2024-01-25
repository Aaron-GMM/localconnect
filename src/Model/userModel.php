<?php
class userModel
{
    private $username;
    private $email;
    private $cidade;
    private $estado;

    private $password;


    public function getUsername()
    {
        return $this->username;
    }

    public function getEmail()
    {
        return $this->email;
    }

    public function getcidade()
    {
        return $this->cidade;
    }
    public function getestado()
    {
        return $this->estado;
    }
    public function getPassword()
    {
        return $this->password;
    }

    public function setUsername($username)
    {
        $this->username = $username;
    }

    public function setEmail($email)
    {
        $this->email = $email;
    }

    public function setcidade($cidade)
    {
        $this->cidade = $cidade;
    }
    public function setestado($estado)
    {
        $this->estado = $estado;
    }
    public function setPassword($password)
    {
        $this->password = $password;
    }
}

