<?php

use Phalcon\Mvc\Model;

class Type_dishes extends Model
{
    private function _getIdType($type)
    {
        $res = "";
        $sql = "SELECT id FROM Type_dishes WHERE name = :name:";
        $query = $this->modelsManager->createQuery($sql);
        $result = $query->execute(['name' => $type]);
        foreach($result as $item){
            $res = $item->id;
        }
        return $res;
    }

    public function getMenu()
    {
        $sql = "SELECT id, name, href, image FROM Type_dishes WHERE active = :active:";
        $query = $this->modelsManager->createQuery($sql);
        return $query->execute(['active' => 1]);
    }

    public function getDishList($type)
    {
        $sql = "SELECT id, type_dish, name_dish, description_dish, price_dish, weight_dish, type_weight_dish, image_dish
                FROM Dishes
                WHERE type_dish = :type_dish:";
        $query = $this->modelsManager->createQuery($sql);
        return $query->execute(['type_dish' => $this->_getIdType($type)]);
    }

    public function getDish($id)
    {
        $sql = "SELECT id, type_dish, name_dish, description_dish, price_dish, weight_dish, type_weight_dish, image_dish
                FROM Dishes
                WHERE id = :id:";
        $query = $this->modelsManager->createQuery($sql);
        return $query->execute(['id' => $id]);
    }


}