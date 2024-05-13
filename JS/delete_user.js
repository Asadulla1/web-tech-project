document.addEventListener('DOMContentLoaded', function() {
    var deleteButtons = document.querySelectorAll('.delete-btn');
    deleteButtons.forEach(function(button) {
        button.addEventListener('click', function() {
            var userId = this.dataset.userId;
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../controllers/AdminController.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    var deletedRow = document.querySelector('button[data-user-id="' + userId + '"]').closest('tr');
                    deletedRow.parentNode.removeChild(deletedRow);
                    console.log('User deleted successfully.');
                } else {
                    console.error(xhr.responseText);
                }
            };
            xhr.onerror = function() {
                console.error('An error occurred.');
            };
            var params = 'action=delete_user&user_id=' + userId;
            xhr.send(params);
        });
    });
});