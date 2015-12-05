<?php

namespace Jepi\Fw\Model;


class ModelExample extends MySqlModel
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
        return $this->insert("INSERT INTO user (name) VALUES ('$name')");
    }

    /**
     * @param $id
     * @param $name
     * @return int
     */
    public function updateUser($id, $name){
        return $this->update("UPDATE user SET name = '$name' WHERE id = $id");
    }

    /**
     * @param $id
     * @return int
     */
    public function deleteUser($id){
        return $this->delete("DELETE FROM user WHERE id = $id");
    }
}