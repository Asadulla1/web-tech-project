document.addEventListener('DOMContentLoaded', function() {
    var tasksTable = document.getElementById('tasks-table');
    
    tasksTable.addEventListener('click', function(event) {
        var target = event.target;
        if (target.classList.contains('save-btn')) {
            var row = target.closest('tr');
            var taskId = row.dataset.taskId;
            var newStatus = row.querySelector('select').value;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../controllers/EmployeeController.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log('Task status updated successfully.');
                } else {
                    console.error('Error updating task status:', xhr.statusText);
                }
            };
            xhr.onerror = function() {
                console.error('An error occurred.');
            };
            var params = 'action=update_task_status&task_id=' + taskId + '&new_status=' + encodeURIComponent(newStatus);
            xhr.send(params);
        }
    });
});