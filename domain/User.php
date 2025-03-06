<?php
class User{
    private $id;
    private $username;
    private $password;


    //al trabajar con constructor se debe de cargar si o si
    public function __construct($username, $password, $id=null){
        $this->id = $id;
        $this->username = $username;
        $this->password = $password;
    }

    //metodos Getters para extraer
    public function getId(){
        return $this->id;
    }

    public function getUsername(){
        return $this->username;
    }

    public function getPassword(){
        return $this->password;
    }

    //Setters para poner datos
    public function setId($id){
        $this->id = $id;
    }

    public function setUsername($username){
        $this->username = $username;
    }

    public function setPassword($password){
        $this->password = $password;
    }
};
?>