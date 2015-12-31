<?php

namespace App\Models;

/**
 * TaskModel.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */
class TaskModel extends \Jepi\Fw\Model\MySqlModel {

    public function allTasks() {
        $sql = "SELECT id_task, id_list, name, description, status FROM tasks";
        return $this->select($sql);
    }

    public function getTask($idTask) {
        $sql = "SELECT id_task, name, description, status FROM tasks WHERE id_task = '$idTask' LIMIT 1";
        $data = $this->select($sql);
        if (count($data) > 0) {
            return $data[0];
        } else {
            return false;
        }
    }

    public function getListTasks($idList) {
        $sql = "SELECT id_task, name, description, status FROM tasks WHERE id_list = '$idList'";
        return $this->select($sql);
    }

    public function createTask($idList, $name, $description, $status) {
        $sql = "INSERT INTO tasks (id_list, name, description, status) VALUES ('$idList', '$name', '$description', '$status')";
        return $this->insert($sql);
    }

    public function updateTask($idTask, $name, $description, $status) {
        $sql = "UPDATE tasks SET name = '$name', description = '$description', status = '$status' WHERE id_task = '$idTask' LIMIT 1";
        return $this->update($sql);
    }

    public function deleteTask($idTask) {
        $sql = "DELETE FROM tasks WHERE id_task = '$idTask' LIMIT 1";
        return $this->delete($sql);
    }

}
