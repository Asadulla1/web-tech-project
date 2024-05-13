document.addEventListener('DOMContentLoaded', function() {
    document.addEventListener('click', function(event) {
        if (event.target && event.target.classList.contains('delete-btn')) {
            var productId = event.target.getAttribute('data-product-id');

            var formData = new FormData();
            formData.append('action', 'delete_product');
            formData.append('product_id', productId); 

            fetch('../controllers/AdminController.php', { //async-await promise behaviour
                method: 'POST',
                body: formData
            })
            .then(function(response) {
                if (response.ok) {
                    event.target.closest('tr').remove();
                    console.log('Product deleted successfully.');
                } else {
                    console.error('Error deleting product:', response.statusText);
                }
            })
            .catch(function(error) {
                console.error('Error deleting product:', error);
            });
        }
    });
});