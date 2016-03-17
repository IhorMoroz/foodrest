<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    const HOME = "index/";

    public function onConstruct()
    {
        $mMenu = new main_menu();
        $this->view->setVar('menu', $mMenu->getMenu());

        $sesUser = $this->session->get('auth');
        if(!empty($sesUser)) $this->_showUser($sesUser);

        if($this->request->isPost())
        {
            if(!empty($this->request->getPost('login')) && !empty($this->request->getPost('pass'))) $this->startAction();
            if(!empty($this->request->getPost('exit'))) $this->finishAction();
            if(!empty($this->request->getPost('Crname')) &&
               !empty($this->request->getPost('Crsurname')) &&
               !empty($this->request->getPost('Crpass')) &&
               !empty($this->request->getPost('Crpasstwo')) &&
               !empty($this->request->getPost('Crlogin'))) $this->registrationAction();
        }
    }

    /**
     * show user name
     */
    private function _showUser($sesUser)
    {
        $this->view->setVar('fullName',$sesUser['name']);
    }

    /**
     * make full name
     */
    private function _fullName($data)
    {
        $result = "";
        foreach($data as $item) {
            $result = $item->name.' '.$item->surname;
        }
        return $result;
    }

    /**
     * register session
     */
    private function _registerSession($user)
    {
        $this->session->set(
            "auth",
            [
                'id' => $user->id,
                'name' => $this->_fullName($user)
            ]
        );
    }

    private function _isLoginResult($data)
    {
        $res = "";
        foreach($data as $item){
            $res = $item->login;
        }
        return $res;
    }

    /**
     * login user
     */
    public function startAction(){
        $Users = new Users();
        $login = strip_tags($this->request->getPost('login'));
        $pass = strip_tags($this->request->getPost('pass'));
        $user = $Users->getUser($login, $pass);
        $this->_registerSession($user);
        $sesUser = $this->session->get('auth');
        $this->_showUser($sesUser);
    }

    /**
     * logout user
     */
    public function finishAction()
    {
        header('Location: '.self::HOME);
        $this->session->destroy();

    }

    /**
     * register user
     */
    public function registrationAction()
    {
        $name = strip_tags($this->request->getPost('Crname'));
        $surname = strip_tags($this->request->getPost('Crsurname'));
        $login = strip_tags($this->request->getPost('Crlogin'));
        $email = strip_tags($this->request->getPost('Cremail'));
        $phone = strip_tags($this->request->getPost('Crphone'));
        $pass = strip_tags($this->request->getPost('Crpass'));
        $passtwo = strip_tags($this->request->getPost('Crpasstwo'));

        if($pass !== $passtwo) return "error password";
        $Users = new Users();
        if(!$this->_isLoginResult($Users->isLogin($login))) $Users->registrationUser($name,$surname,$login,$email,password_hash($pass,PASSWORD_DEFAULT));
    }
}
