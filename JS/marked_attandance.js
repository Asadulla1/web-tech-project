document.addEventListener('DOMContentLoaded', () => {
    const markButton = document.querySelector('#mark');
    console.log(markButton.textContent)
    markButton.addEventListener('click', (e) => {
        if (markButton.textContent !== 'Marked') {
            markButton.textContent = 'Marked';
            const formData = new FormData();
            formData.append('action', 'mark_attendance');

            fetch('../controllers/AttendanceController.php', {
                method: 'POST',
                body: formData,
            })
            .then(res => res.text())
            .then(data => console.log(data))
        }
    })
})