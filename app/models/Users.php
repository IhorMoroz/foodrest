<?php

use Phalcon\Mvc\Model;
use Phalcon\Mvc\Model\Query;

class Users extends Model
{
    public function getUser($login, $pass)
    {
        $sql = "SELECT id, name, surname, login FROM Users WHERE login = :login: AND password = :password:";
        $query = $this->modelsManager->createQuery($sql);
        $user  = $query->execute(
            [
                'login' => $login,
                'password' => $pass
            ]
        );
        return $user;
    }
}