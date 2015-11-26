<?php
/**
 * Created by PhpStorm.
 * User: developer
 * Date: 26/11/15
 * Time: 9:13
 */

namespace Jepi\Fw\Model;


class ModelExample extends MySqlModelAbstract
{
    /**
     * @return mixed
     */
    public function listUsers(){
        return $this->select("SELECT id, name FROM user");
    }

    /**
     * @param $id
     * @return mixed
     */
    public function getUser($id){
        $data = $this->select("SELECT id, name FROM user WHERE id = $id");
        return $data[0];
    }

    /**
     * @param $name
     * @return int
     */
    public function createUser($name){
        return parent::insert("INSERT INTO user (name) VALUES ('$name')");
    }

    /**
     * @param $id
     * @param $name
     * @return int
     */
    public function updateUser($id, $name){
        return parent::update("UPDATE user SET name = '$name' WHERE id = $id");
    }

    /**
     * @param $id
     * @return int
     */
    public function deleteUser($id){
        return parent::delete("DELETE FROM user WHERE id = $id");
    }
}