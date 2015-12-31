<br class="clearfix"/>
<div class="container-fluid">
    <div class="row">
        <div class="todos-col">
            <div class="container-fluid well">
                <div class="form-group">
                    <form role="form">
                        <input type="text" class="form-control" placeholder="Your Task" name="task" id="taskName">
                        <input type="hidden" value="<?= $currentList['id_list'] ?>" id="taskListId">
                    </form>
                    <button type="button" class="btn btn btn-primary" id="addTask">Add</button>
                </div>
                <div></div>

                <ul class="list-unstyled" id="todo">
                    <?php
                    foreach ($tasks as $task) {
                        $className = 'task';
                        switch ($task['status']) {
                            case 0:
                                $done = 'no';
                                $className.= ' todo-task';
                                break;
                            case 1:
                                $done = 'yes';
                                $className.= ' done-task';
                                break;
                        }
                        ?>
                        <li class="<?= $className ?>" data-done="<?= $done ?>" data-id-task="<?= $task['id_task'] ?>"><?= $task['name'] ?></li>
                    <?php } ?>
                </ul>
            </div>
        </div>
    </div>
</div>