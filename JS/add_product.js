document
  .getElementById("product-form")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    clearErrors();

    let isValid = true;

    const name = document.getElementById("name").value.trim();
    if (name === "") {
      isValid = false;
      document.getElementById("name-error").textContent = "Name is required";
    }

    const description = document.getElementById("description").value.trim();
    if (description === "") {
      isValid = false;
      document.getElementById("description-error").textContent =
        "Description is required";
    }

    const price = document.getElementById("price").value.trim();
    if (price === "" || isNaN(price) || parseFloat(price) <= 0) {
      isValid = false;
      document.getElementById("price-error").textContent =
        "Price must be a positive number";
    }

    const category = document.getElementById("category").value.trim();
    if (category === "") {
      isValid = false;
      document.getElementById("category-error").textContent =
        "Category is required";
    }

    const stockQuantity = document
      .getElementById("stock_quantity")
      .value.trim();
    if (
      stockQuantity === "" ||
      isNaN(stockQuantity) ||
      parseInt(stockQuantity) < 0
    ) {
      isValid = false;
      document.getElementById("stock_quantity-error").textContent =
        "Stock Quantity must be a non-negative integer";
    }

    if (isValid) {
      event.target.submit();
    }
  });

function clearErrors() {
  const errorElements = document.querySelectorAll(".error");
  errorElements.forEach(function (element) {
    element.textContent = "";
  });
}
