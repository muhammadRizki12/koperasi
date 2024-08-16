// require('./bootstrap');
import "bootstrap";

const transactionTypeSelect = document.getElementById("transactionType");
const amountInput = document.getElementById("amount");

transactionTypeSelect.addEventListener("change", () => {
    updateAmountInput();
});

function updateAmountInput() {
    const selectedOption = transactionTypeSelect.value;

    if (selectedOption === "simpanan wajib") {
        amountInput.value = 200000;
        // amountInput.disabled = true;
    } else {
        amountInput.value = "";
        // amountInput.disabled = false;
    }
}
