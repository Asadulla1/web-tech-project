document.addEventListener('DOMContentLoaded', function() {
    var saveButtons = document.querySelectorAll('#tasks-table .save-btn');

    saveButtons.forEach(function(saveButton) {
        saveButton.addEventListener('click', function() {
            var row = this.closest('tr');
            var taskId = row.getAttribute('data-task-id');
            var newStatus = row.querySelector('select').value;

            var formData = new FormData();
            formData.append('action', 'update_task_status');
            formData.append('task_id', taskId);
            formData.append('new_status', newStatus);

            fetch('../controllers/AdminController.php', {
                method: 'POST',
                body: formData
            })
            .then(function(response) {
                if (response.ok) {
                    console.log('Task status updated successfully.');
                } else {
                    console.error('Error updating task status:', response.statusText);
                }
            })
            .catch(function(error) {
                console.error('Error updating task status:', error);
            });
        });
    });
});

 document.getElementById('task-form').addEventListener('submit', function(event) {
    var description = document.getElementById('task-description').value.trim();
    var assignedTo = document.getElementById('assigned-to').value.trim();
    var descriptionError = document.getElementById('description-error');
    var assignedToError = document.getElementById('assigned-to-error');
    var isValid = true;

    // Reset error messages
    descriptionError.textContent = '';
    assignedToError.textContent = '';

    if (description === '') {
        descriptionError.textContent = 'Task Description cannot be empty.';
        isValid = false;
    }

    if (assignedTo === '') {
        assignedToError.textContent = 'Please select an employee to assign the task.';
        isValid = false;
    }

    if (!isValid) {
        event.preventDefault();
    }
});

document.getElementById('delivery-form').addEventListener('submit', function(event) {
    var order = document.getElementById('order-id').value.trim();
    var deliveryMan = document.getElementById('delivery-man').value.trim();
    var orderError = document.getElementById('order-id-error');
    var deliveryManError = document.getElementById('delivery-man-error');
    var isValid = true;

    // Reset error messages
    orderError.textContent = '';
    deliveryManError.textContent = '';

    if (order === '') {
        orderError.textContent = 'Please select an order.';
        isValid = false;
    }

    if (deliveryMan === '') {
        deliveryManError.textContent = 'Please select a delivery man.';
        isValid = false;
    }

    if (!isValid) {
        event.preventDefault();
    }
});