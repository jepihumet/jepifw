$(document).ready(function () {
    $('#addList').click(function () {
        var name = $('#listName').val();
        $.post("/lists/add", {name: name}).done(function (msg) {
            location.reload();
        });
    });
    $('#addTask').click(function () {
        var name = $('#taskName').val();
        var listId = $('#taskListId').val();
        $.post('/tasks/add', {id_list: listId, name: name}).done(function (data) {
            location.reload();
        });
    });
    $('#deleteList').click(function () {
        var id = $('#deleteList').data('id');
        $.get('/lists/delete', {id_list: id}).done(function (data) {
            location.reload();
        });
    });
    $('.task').click(function(event){
        var done = $(event.target).data('done');
        var id = $(event.target).data('id-task');
        console.log(done);
        $.get('/tasks/taskdone',{id_task: id}).done(function(data){
            location.reload();
        });
    });
});
