<?php

namespace App\Controllers;

/**
 * Todo.php
 *
 * @package     JepiFW
 * @author      Jepi Humet Alsius <jepihumet@gmail.com>
 * @link        http://jepihumet.com
 */
class Todo extends \Jepi\Fw\Controller\Controller {

    /**
     * @Inject
     * @var \App\Models\ListModel
     */
    private $lists;

    /**
     * @Inject
     * @var \App\Models\TaskModel
     */
    private $tasks;

    public function tasks($id = 0) {
        $lists = $this->lists->allLists();

        if (count($lists) > 0) {
            $selectedListIndex = 0;
            for ($i = 0; $i < count($lists); $i++) {
                if ($lists[$i]['id_list'] == $id) {
                    $lists[$i]['active'] = true;
                    $selectedListIndex = $i;
                    break;
                }
            }
            $lists[$selectedListIndex]['active'] = true;
            $currentList = $lists[$selectedListIndex];
            $tasks = $this->tasks->getListTasks($currentList['id_list']);
        } else {
            $tasks = array();
            $currentList  = false;
        }

        $this->view->addVar('lists', $lists);
        $this->view->addVar('currentList', $currentList);
        $listsView = $this->view->get('lists.php');

        $this->view->addVar('tasks', $tasks);
        $tasksList = $this->view->get('tasks-list.php');

        $this->view->addVar('title', 'ToDo manager');
        $this->view->addVar('listsView', $listsView);
        $this->view->addVar('tasksView', $tasksList);
        return $this->view->get('bootstrap-template.php');
    }

    /**
     * @return string
     */
    public function index() {
        return $this->tasks();
    }

}
