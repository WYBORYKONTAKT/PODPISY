function toggleVisibility(selector) {
    const element = document.querySelector(selector);
    const button = document.querySelector(`button[onclick="toggleVisibility('${selector}')"]`);

    if (element.style.display === 'none' || element.style.display === '') {
        element.style.display = 'block';
        button.textContent = button.textContent.replace('POKAŻ', 'UKRYJ');
    } else {
        element.style.display = 'none';
        button.textContent = button.textContent.replace('UKRYJ', 'POKAŻ');
    }
}
