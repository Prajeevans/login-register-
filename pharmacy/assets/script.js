document.addEventListener("DOMContentLoaded", () => {
  const addButton = document.querySelector(".add-button");
  const orderItemsBody = document.getElementById("orderItemsBody");
  const totalAmountElem = document.getElementById("totalAmount");

  function updateTotal() {
    let total = 0;
    const rows = orderItemsBody.querySelectorAll("tr");
    rows.forEach((row) => {
      const amountCell = row.cells[2];
      if (amountCell) {
        total += parseFloat(amountCell.textContent) || 0;
      }
    });
    totalAmountElem.textContent = total.toFixed(2);
  }

  addButton.addEventListener("click", () => {
    const drugNameInput = document.getElementById("drugName");
    const quantityInput = document.getElementById("quantity");
    const rateInput = document.getElementById("rate");

    const drugName = drugNameInput.value.trim();
    const quantityText = quantityInput.value.trim();
    const rateText = rateInput.value.trim();

    if (!drugName || !quantityText || !rateText) {
      alert("Please fill all fields.");
      return;
    }

    // Parse quantity like "10 x 5"
    let amount = 0;
    const qtyParts = quantityText
      .toLowerCase()
      .split("x")
      .map((s) => s.trim());
    let quantityVal = 0;
    let multiplier = 1;

    if (qtyParts.length === 2) {
      quantityVal = parseFloat(qtyParts[0]);
      multiplier = parseFloat(qtyParts[1]);
    } else {
      quantityVal = parseFloat(quantityText);
    }

    const rateVal = parseFloat(rateText);

    if (isNaN(quantityVal) || isNaN(multiplier) || isNaN(rateVal)) {
      alert("Please enter valid numbers for quantity and rate.");
      return;
    }

    amount = quantityVal * multiplier * rateVal;

    // Create table row
    const tr = document.createElement("tr");

    // Drug name
    const tdDrug = document.createElement("td");
    tdDrug.textContent = drugName;
    tr.appendChild(tdDrug);

    // Quantity text (e.g. "10 x 5")
    const tdQuantity = document.createElement("td");
    tdQuantity.textContent = quantityText;
    tr.appendChild(tdQuantity);

    // Amount calculated
    const tdAmount = document.createElement("td");
    tdAmount.textContent = amount.toFixed(2);
    tr.appendChild(tdAmount);

    orderItemsBody.appendChild(tr);

    // Clear inputs
    drugNameInput.value = "";
    quantityInput.value = "";
    rateInput.value = "";

    updateTotal();
  });
});
