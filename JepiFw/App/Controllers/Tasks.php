<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

/**
 * Description of Tasks
 *
 * @author jepi
 */
class Tasks {

    /**
     * @Inject
     * @var \App\Models\TaskModel
     */
    private $model;

    public function add($id_list, $name, $description = "") {
        $id_task = $this->model->createTask($id_list, $name, $description, 0);
        return $this->model->getTask($id_task);
    }

    public function listTasks($id_list) {
        return $this->model->getListTasks($id_list);
    }

    public function taskdone($id_task) {
        $task = $this->model->getTask($id_task);
        $this->model->updateTask($task['id_task'], $task['name'], $task['description'], 1);
    }

    public function update($id_task, $name, $description = "") {
        $task = $this->model->getTask($id_task);
        $this->model->updateTask($id_task, $name, $description, $task['status']);
    }

}
