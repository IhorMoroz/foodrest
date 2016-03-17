<?php

use Phalcon\Http\Request;

class MenuController extends ControllerBase
{
    private $_TypeMenu;
    private static $_DishList = [];

    public function onConstruct()
    {
        parent::onConstruct();
        $this->_TypeMenu = new Type_dishes();
        if($this->request->isAjax()) {
            $this->_feedbackAjax();
            $this->view->disable();
            return false;
        }
    }

    public function IndexAction($type)
    {
        //$this->view->setRenderLevel(\Phalcon\Mvc\View::LEVEL_NO_RENDER);
        if(!$type) $type = "special";
        $this->view->setVars([
            'typeMenu' => $this->_TypeMenu->getMenu(),
            'dishList' => $this->_TypeMenu->getDishList(strip_tags($type)),
            'titleList' => $type
        ]);
    }

    private function _feedbackAjax()
    {
        if(!empty($this->request->getPost("data"))){
            $res = $this->_TypeMenu->getDish($this->request->getPost("data"));
            print json_encode($res);
        }
    }
}