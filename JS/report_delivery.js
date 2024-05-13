document.addEventListener('DOMContentLoaded', (e) => {
    let selectElements = document.querySelectorAll('td.editable select');
    selectElements.forEach(selectElement => {
        selectElement.addEventListener('change', () => {
            let status = selectElement.value;
            // console.log(status);
            // return;
            let deliveryId = selectElement.closest('tr').querySelector('td:first-child').textContent;

            let formData = new FormData();
            formData.append('delivery_id', deliveryId);
            formData.append('status', status);

            fetch('../controllers/report_delivery_controller.php', {
                    method: 'POST',
                    body: formData
                })
                .then(response => {
                    if (response.ok) {
                        console.log('status changed hopefully');
                    }
                })
                .catch(() => console.log('something went wrong in the server'))
        });
    });
});