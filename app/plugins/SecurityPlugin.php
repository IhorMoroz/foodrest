<?php

use Phalcon\Mvc\User\Plugin;
use Phalcon\Events\Event;
use Phalcon\Mvc\Dispatcher;
use Phalcon\Acl;
use Phalcon\Acl\Role;
use Phalcon\Acl\Adapter\Memory as AclList;
use Phalcon\Acl\Resource;

class SecurityPlugin extends Plugin
{

    public function getAcl()
    {
        if(!isset($this->persistent->acl)){
            // Создаем ACL
            $acl = new AclList();

            // Действием по умолчанию будет запрет
            $acl->setDefaultAction(Acl::DENY);

            // Регистрируем две роли. Users - это зарегистрированные пользователи,
            // а Guests - неидентифицированные посетители.
            $roles = [
                'users'  => new Role('Users'),
                'guests' => new Role('Guests')
            ];

            foreach ($roles as $role) {
                $acl->addRole($role);
            }

            // Приватные ресурсы (бэкенд)
            $privateResources = [
                'table' => ['index']
            ];
            foreach ($privateResources as $resource => $actions) {
                $acl->addResource(new Resource($resource), $actions);
            }

            // Публичные ресурсы (фронтенд)
            $publicResources = [
                'index' => ['index'],
                'menu' => ['index'],
                'news' => ['index']
            ];
            foreach ($publicResources as $resource => $actions) {
                $acl->addResource(new Resource($resource), $actions);
            }

            // Предоставляем пользователям и гостям доступ к публичным ресурсам
            foreach ($roles as $role) {
                foreach ($publicResources as $resource => $actions) {
                    $acl->allow($role->getName(), $resource, '*');
                }
            }

            // Доступ к приватным ресурсам предоставляем только пользователям
            foreach ($privateResources as $resource => $actions) {
                foreach ($actions as $action) {
                    $acl->allow('Users', $resource, $action);
                }
            }

            $this->persistent->acl = $acl;
        }

        return $this->persistent->acl;
    }

    public function beforeExecuteRoute(Event $event, Dispatcher $dispatcher)
    {
        // Проверяем, установлена ли в сессии переменная "auth" для определения активной роли.
        $auth = $this->session->get('auth');
        if (!$auth) {
            $role = 'Guests';
        } else {
            $role = 'Users';
        }
        // Получаем активный контроллер/действие от диспетчера
        $controller = $dispatcher->getControllerName();
        $action = $dispatcher->getActionName();
        // Получаем список ACL
        $acl = $this->getAcl();
        // Проверяем, имеет ли данная роль доступ к контроллеру (ресурсу)
        $allowed = $acl->isAllowed($role, $controller, $action);
        if ($allowed != Acl::ALLOW) {
            // Если доступа нет, перенаправляем его на контроллер "index".
            $this->flash->error("У вас нет доступа к данному модулю");
            $dispatcher->forward(
                array(
                    'controller' => 'index',
                    'action'     => 'index'
                )
            );
            // Возвращая "false" мы приказываем диспетчеру прервать текущую операцию
            return false;
        }
    }
}