document.addEventListener("DOMContentLoaded", function () {
  const priceFilterForm = document.getElementById("price-filter-form");
  const products = document.querySelectorAll(".product");

  priceFilterForm.addEventListener("submit", function (event) {
    event.preventDefault();

    const minPrice = isNaN(
      parseFloat(document.getElementById("min-price").value)
    )
      ? 0
      : parseFloat(document.getElementById("min-price").value);

    const maxPrice = isNaN(
      parseFloat(document.getElementById("max-price").value)
    )
      ? 0
      : parseFloat(document.getElementById("max-price").value);

    products.forEach(function (product) {
      const productPrice = parseFloat(
        product.querySelector(".price").textContent.replace("Price: $", "")
      );

      console.table({
        minPrice: minPrice,
        maxPrice: maxPrice,
        productPrice: productPrice,
      });

      product.style.display = "block";

      if (productPrice < minPrice || productPrice > maxPrice) {
        product.style.display = "none";
      }
    });
  });

  const searchForm = document.getElementById("search-form");
  const searchInput = document.getElementById("search-input");

  searchForm.addEventListener("submit", function (event) {
    event.preventDefault();

    const searchQuery = searchInput.value.toLowerCase();

    products.forEach(function (product) {
      const productName = product.querySelector("h2").textContent.toLowerCase();

      if (productName.includes(searchQuery)) {
        product.style.display = "block";
      } else {
        product.style.display = "none";
      }
    });
  });

  document
    .querySelectorAll('button[name="add_to_cart"]')
    .forEach(function (button) {
      button.addEventListener("click", function (event) {
        event.preventDefault();

        const productContainer = event.target.closest(".product");
        const productId = productContainer.querySelector(
          'input[name="product_id"]'
        ).value;
        const username = document.getElementById("username").value;

        const stockQuantityElement =
          productContainer.querySelector(".stock-quantity");

        if (stockQuantityElement) {
          let stockQuantity = parseInt(
            stockQuantityElement.textContent.replace("Stock Quantity: ", "")
          );
          if (!isNaN(stockQuantity) && stockQuantity > 0) {
            stockQuantity--;
            stockQuantityElement.textContent =
              "Stock Quantity: " + stockQuantity;
          }
        }

        const formData = new FormData();
        formData.append("product_id", productId);
        formData.append("username", username);
        formData.append("action", "add_to_cart");

        fetch("../controllers/CustomerController.php", {
          method: "POST",
          body: formData,
        })
          .then((response) => response.text())
          .then((data) => {
            console.log("Response:", data);
          })
          .catch((error) => {
            console.error("Error:", error);
          });
      });
    });
});
