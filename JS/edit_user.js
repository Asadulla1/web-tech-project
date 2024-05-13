document.addEventListener("DOMContentLoaded", function () {
  var userTable = document.getElementById("user-table");

  // Add event listener to make cells editable
  userTable.addEventListener("click", function (event) {
    var target = event.target;
    if (target.classList.contains("editable")) {
      target.contentEditable = "true";
      target.focus();
    }
  });

  // Add event listener to save changes
  userTable.addEventListener("click", function (event) {
    var target = event.target;
    if (target.classList.contains("save-btn")) {
      var row = target.closest("tr");
      //   console.log(row.dataset.userId);
      var userId = row.dataset.userId;
      var updatedValues = {};
      row.querySelectorAll(".editable").forEach(function (cell) {
        var fieldName = cell.dataset.field;
        var editedValue = cell.textContent;
        updatedValues[fieldName] = editedValue;
      });
      //   console.log(JSON.stringify(updatedValues));

      var jsonData = JSON.stringify(updatedValues);
      var xhr = new XMLHttpRequest();
      xhr.open("POST", "../controllers/AdminController.php");
      xhr.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
      xhr.onload = function () {
        if (xhr.status === 200) {
          console.log("User updated successfully.");
        } else {
          console.error("Error updating user:", xhr.statusText);
        }
      };
      xhr.onerror = function () {
        console.error("An error occurred.");
      };
      var params =
        "action=update_user&user_id=" +
        userId +
        "&updated_values=" +
        encodeURIComponent(jsonData);
      xhr.send(params);
    }
  });
});
