document.addEventListener('DOMContentLoaded', function() {
    var attendanceTable = document.getElementById('attendance-table');
    
    // Add event listener to save attendance status
    attendanceTable.addEventListener('click', function(event) {
        var target = event.target;
        if (target.classList.contains('save-btn')) {
            var row = target.closest('tr');
            var attendanceId = row.dataset.attendanceId;
            var newStatus = row.querySelector('select').value;

            var xhr = new XMLHttpRequest();
            xhr.open('POST', '../controllers/AdminController.php');
            xhr.setRequestHeader('Content-Type', 'application/x-www-form-urlencoded');
            xhr.onload = function() {
                if (xhr.status === 200) {
                    console.log('Attendance status updated successfully.');
                } else {
                    console.error('Error updating attendance status:', xhr.statusText);
                }
            };
            xhr.onerror = function() {
                console.error('An error occurred.');
            };
            var params = 'action=update_attendance_status&attendance_id=' + attendanceId + '&new_status=' + encodeURIComponent(newStatus);
            xhr.send(params);
        }
    });
});