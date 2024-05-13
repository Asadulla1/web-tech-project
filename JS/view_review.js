document
  .getElementById("review-form")
  .addEventListener("submit", function (event) {
    event.preventDefault();

    const reviewText = document.getElementById("review-text").value.trim();
    const productId = document.getElementById("product-id").value;
    const rating = document.getElementById("rating").value;
    const user_id = document.getElementById("user_id").value;
    if (reviewText !== "") {
      removeErrorMessage();
      const formData = new FormData();
      formData.append("product_id", productId);
      formData.append("comment", reviewText);
      formData.append("action", "add_to_review");
      formData.append("rating", rating);
      formData.append("user_id", user_id);

      fetch("../controllers/CustomerController.php", {
        method: "POST",
        body: formData,
      })
        .then((response) => response.json())
        .then((data) => {
          const reviewElement = document.createElement("div");
          reviewElement.classList.add("review");
          reviewElement.textContent = data.comment;

          document
            .getElementById("reviews-container")
            .appendChild(reviewElement);

          document.getElementById("review-text").value = "";
          document.getElementById("rating").value = "";
          console.log(data);
        })
        .catch((error) => {
          console.error("Error:", error);
        });
    } else {
      displayErrorMessage();
    }
  });

function removeErrorMessage() {
  document.getElementById("error").textContent = "";
}

function displayErrorMessage() {
  document.getElementById("error").textContent = "review message is missing";
}
