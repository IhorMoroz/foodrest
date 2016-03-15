<?php

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;

class Users extends Model
{
    private function _getHash($login)
    {
        $res = "";
        $sql = "SELECT password FROM Users WHERE login = :login:";
        $query = $this->modelsManager->createQuery($sql);
        $query->execute(['login' => $login]);
        foreach($query->execute(['login' => $login]) as $item){
           $res = $item->password;
        }
        return $res;
    }

    public function getUser($login, $pass)
    {
        if(password_verify($pass,$this->_getHash($login))){
            $sql = "SELECT id, name, surname, login FROM Users WHERE login = :login:";
            $query = $this->modelsManager->createQuery($sql);
            $user  = $query->execute(['login' => $login]);
        }
        return $user;
    }

    public function isLogin($login)
    {
        $sql = "SELECT login FROM Users WHERE login = :login:";
        $query = $this->modelsManager->createQuery($sql);
        return $query->execute(['login' => $login]);
    }

    public function registrationUser($name,$surname,$login,$email,$pass)
    {
        $sql = "INSERT INTO Users (name,surname,login,email,password)"
                      . "VALUES (:name:,:surname:,:login:,:email:,:password:)";
        $query = $this->modelsManager->createQuery($sql);
        return $query->execute([
            "name" => $name,
            "surname" => $surname,
            "login" => $login,
            "email" => $email,
            "password" => $pass
        ]);
    }
}