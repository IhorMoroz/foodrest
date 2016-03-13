<?php

use Phalcon\Mvc\Controller;

class ControllerBase extends Controller
{
    public function onConstruct()
    {
        $sesDefault['name'] = "Login";
        $sesUser = $this->session->get('auth');
        if(!empty($sesUser)) $this->_showUser($sesUser);
        else $this->_showUser($sesDefault);

        if($this->request->isPost())
        {
            if(!empty($this->request->getPost('login')) && !empty($this->request->getPost('pass'))) $this->startAction();
        }
    }

    private function _showUser($sesUser)
    {
        $this->view->setVar('fullName',$sesUser['name']);
    }

    private function _fullName($data)
    {
        $result = "";
        foreach($data as $item) {
            $result = $item->name.' '.$item->surname;
        }
        return $result;
    }

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

    public function startAction(){
        $login = $this->request->getPost('login');
        $pass = $this->request->getPost('pass');

        $Users = new Users();
        $user = $Users->getUser($login, $pass);
        $this->_registerSession($user);
        $sesUser = $this->session->get('auth');
        $this->_showUser($sesUser);
    }
}
