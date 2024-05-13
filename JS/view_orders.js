document.addEventListener("DOMContentLoaded", function () {
  document
    .getElementById("product-table")
    .addEventListener("input", function (event) {
      if (
        event.target &&
        event.target.dataset.field === "discount_percentage"
      ) {
        var row = event.target.closest("tr");
        var totalAmount = parseFloat(
          row.querySelector('td[data-field="total_amount"]').textContent
        );
        var discountPercentage = isNaN(parseFloat(event.target.textContent))
          ? 0
          : parseFloat(event.target.textContent);
        var discountedAmount =
          totalAmount - totalAmount * (discountPercentage / 100);
        // console.table({ totalAmount, discountPercentage, discountedAmount });
        row.querySelector('td[data-field="total_amount"]').textContent =
          discountedAmount.toFixed(2);
      }
    });

  document
    .getElementById("product-table")
    .addEventListener("click", function (event) {
      if (event.target && event.target.classList.contains("save-btn")) {
        var row = event.target.closest("tr");
        var productId = row.dataset.productId;
        var updatedValues = {};
        row.querySelectorAll(".editable").forEach(function (element) {
          var fieldName = element.dataset.field;
          var editedValue = element.textContent;
          updatedValues[fieldName] = editedValue;
        });

        var jsonData = JSON.stringify(updatedValues);
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "../controllers/AdminController.php");
        xhr.setRequestHeader(
          "Content-Type",
          "application/x-www-form-urlencoded"
        );
        xhr.onload = function () {
          if (xhr.status === 200) {
            console.log("Product updated successfully.");
          } else {
            console.error("Error updating product:", xhr.statusText);
          }
        };
        xhr.onerror = function () {
          console.error("Error updating product:", xhr.statusText);
        };
        xhr.send(
          "action=update_order&product_id=" +
            encodeURIComponent(productId) +
            "&updated_values=" +
            encodeURIComponent(jsonData)
        );
      }
    });
});
