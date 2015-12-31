<div class="row">
    <form class="form-inline">
        <h1><small>New list</small></h1>
        <div class="form-group">
            <form role="form">
                <input type="text" class="form-control" placeholder="Your List" id="listName" name="task">
            </form>
            <button type="button" class="btn btn-primary" id="addList">Add</button>
        </div>
    </form>
    <hr />
</div>
<div class="row">
    <ul class="nav nav-pills">
        <?php
        foreach ($lists as $list) {
            if (isset($list['active']) && $list['active']) {
                ?>
                <li role="presentation" class="active"><a href="#"><?= $list['name'] ?></a></li>
                <?php
            } else {
                ?>
                <li role="presentation" class=""><a href="<?= '/todo/tasks?id=' . $list['id_list']; ?>"><?= $list['name'] ?></a></li>
                <?php
            }
        }
        ?>
        <li class="pull-right"><button type="button" class="btn btn-danger" id="deleteList" data-id="<?=$currentList['id_list']?>">Delete</button></li>
    </ul>
</div>