<?php

use Phalcon\Mvc\Model;

class main_menu extends Model
{
    public function getMenu()
    {
        $sql = "SELECT id, text, href FROM main_menu WHERE active = :active:";
        $query = $this->modelsManager->createQuery($sql);
        return $query->execute(['active' => 1]);
    }
}