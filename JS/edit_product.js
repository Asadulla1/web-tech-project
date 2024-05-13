document.addEventListener("DOMContentLoaded", function () {
  var editButtons = document.querySelectorAll(" .editable");
  editButtons.forEach(function (editButton) {
    editButton.addEventListener("click", function () {
      this.setAttribute("contenteditable", "true");
      this.focus();
    });
  });

  var saveButtons = document.querySelectorAll(" .save-btn");
  saveButtons.forEach(function (saveButton) {
    saveButton.addEventListener("click", function (event) {
      var row = this.closest("tr");
      var productId = event.target.getAttribute("data-product-id");
      var updatedValues = {};
      var isValid = true;

      row.querySelectorAll(".editable").forEach(function (editable) {
        var fieldName = editable.getAttribute("data-field");
        var editedValue = editable.textContent.trim();

        if (
          fieldName === "name" ||
          fieldName === "description" ||
          fieldName === "category"
        ) {
          if (editedValue === "") {
            isValid = false;
            console.log(
              fieldName.charAt(0).toUpperCase() +
                fieldName.slice(1) +
                " cannot be empty."
            );
            displayErrorMessage(
              fieldName.charAt(0).toUpperCase() +
                fieldName.slice(1) +
                " cannot be empty."
            );
            return;
          }
        } else if (fieldName === "price" || fieldName === "stock_quantity") {
          if (isNaN(editedValue) || parseFloat(editedValue) <= 0) {
            isValid = false;
            displayErrorMessage(
              fieldName.charAt(0).toUpperCase() +
                fieldName.slice(1) +
                " must be a number greater than 0."
            );
            return;
          }
        } else {
          removeErrorMessage();
        }

        updatedValues[fieldName] = editedValue;
      });

      function displayErrorMessage(message) {
        document.getElementById("error").innerHTML = "";

        var errorMessage = document.createElement("p");
        errorMessage.classList.add("error-message");
        errorMessage.textContent = message;

        document.getElementById("error").appendChild(errorMessage);
      }

      function removeErrorMessage() {
        document.getElementById("error").innerHTML = "";
      }

      if (isValid) {
        document.addEventListener("click", function (event) {
          if (event.target && event.target.classList.contains("save-btn")) {
            var productId = event.target.getAttribute("data-product-id");
            console.log(productId);
            const formData = new FormData();

            formData.append("action", "update_product");
            formData.append("product_id", productId);
            formData.append("name", updatedValues["name"]);
            formData.append("description", updatedValues["description"]);
            formData.append("category", updatedValues["category"]);
            formData.append("price", updatedValues["price"]);
            formData.append("stock_quantity", updatedValues["stock_quantity"]);

            console.table(updatedValues);
            fetch("../controllers/AdminController.php", {
              method: "POST",
              body: formData,
            })
              .then(function (response) {
                if (response.ok) {
                  console.log("Product updated successfully.");
                } else {
                  console.error("Error updating product:", response.statusText);
                }
              })
              .catch(function (error) {
                console.error("Error updating product:", error);
              });
          }
        });
      }
    });
  });
});
