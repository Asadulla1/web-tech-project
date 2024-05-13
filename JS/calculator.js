document.getElementById("calculate-btn").addEventListener("click", function() {
    var expense1 = parseFloat(document.getElementById("salary").value) || 0;
    var expense2 = parseFloat(document.getElementById("bonus").value) || 0;
    var expense3 = parseFloat(document.getElementById("maintainance").value) || 0;
    var expense4 = parseFloat(document.getElementById("tax").value) || 0;
  
    var totalExpense = expense1 + expense2 + expense3 + expense4;
  
    document.getElementById("total-amount").textContent = totalExpense.toFixed(2);
  });