<?php

namespace App\Models;

/**
 * ListModel.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */
class ListModel extends \Jepi\Fw\Model\MySqlModel {

    protected $dbConnection = 'todo';

    public function allLists() {
        $sql = "SELECT id_list, name, description FROM lists";
        return $this->select($sql);
    }

    public function getList($idList) {
        $sql = "SELECT id_list, name, description FROM lists WHERE id_list = '$idList' LIMIT 1";
        $data = $this->select($sql);
        if (count($data) > 0){
            return $data[0];
        }else{
            return false;
        }
    }

    public function createList($name, $description) {
        $sql = "INSERT INTO lists (name, description) VALUES ('$name', '$description')";
        return $this->insert($sql);
    }

    public function updateList($idList, $name, $description) {
        $sql = "UPDATE lists SET name = '$name', description = '$description' WHERE id_list = '$idList' LIMIT 1";
        return $this->update($sql);
    }

    public function deleteList($idList) {
        $sql = "DELETE FROM lists WHERE id_list = '$idList' LIMIT 1";
        return $this->delete($sql);
    }

}
