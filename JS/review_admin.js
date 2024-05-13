document.addEventListener('DOMContentLoaded', function() {
    var feedbackTable = document.getElementById('feedback-table');
    
    feedbackTable.addEventListener('click', function(event) {
        var target = event.target;
        if (target.classList.contains('editable')) {
            target.contentEditable = 'true';
            target.focus();
        }
    });

    feedbackTable.addEventListener('click', function(event) {
        var target = event.target;
        if (target.classList.contains('save-btn')) {
            var row = target.closest('tr');
            var feedbackId = row.dataset.feedbackId;
            var updatedValues = {};
            row.querySelectorAll('.editable').forEach(function(cell) {
                var fieldName = cell.dataset.field;
                var editedValue = cell.textContent;
                updatedValues[fieldName] = editedValue;
            });

            var jsonData = JSON.stringify(updatedValues);
            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../controllers/AdminController.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log('Review updated successfully.');
                } else {
                    console.error('Error updating review:', xhr.statusText);
                }
            };
            xhr.onerror = function() {
                console.error('An error occurred.');
            };
            var params = 'action=update_review&feedback_id=' + feedbackId + '&updated_values=' + encodeURIComponent(jsonData);
            xhr.send(params);
        }
    });
});