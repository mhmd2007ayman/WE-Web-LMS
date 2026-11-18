function changeTextDirection() {
    const inputField = document.querySelector('.inputText');
    const value = inputField.value;

    // Check if the input is Arabic
    if (/[\u0600-\u06FF]/.test(value)) {
        inputField.style.direction = "rtl"; // Right-to-left for Arabic
        inputField.style.textAlign = "right"; // Align text to the right for Arabic
    } else {
        inputField.style.direction = "ltr"; // Left-to-right for English (or other languages)
        inputField.style.textAlign = "left"; // Align text to the left for English
    }
}