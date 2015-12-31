<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\Controllers;

/**
 * Description of Lists
 *
 * @author jepi
 */
class Lists {

    /**
     * @Inject
     * @var \App\Models\ListModel
     */
    private $model;

    public function add($name, $description = "") {
        $id_list = $this->model->createList($name, $description);
        $list = $this->model->getList($id_list);
        return json_encode($list);
    }

    public function all() {
        $all = $this->model->allLists();
        return json_encode($all);
    }

    public function update($id_list, $name, $description = "") {
        $this->model->updateList($id_list, $name, $description);
        $list = $this->model->getList($id_list);
        return json_encode($list);
    }
    
    public function delete($id_list){
        $this->model->deleteList($id_list);
    }

}
