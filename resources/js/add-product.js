const handlePriceInputChange = (event) => {
    const priceInputElement = event.target;

    if (priceInputElement.value < 0.5) {
        priceInputElement.value = 0;
        return;
    }

    while (priceInputElement.value[0] == '0' && priceInputElement.value[1] !== '.') {
        priceInputElement.value = priceInputElement.value.slice(1);
    }

    let [charsBeforeDot, charsAfterDot] = [...priceInputElement.value.split('.')];



    if (!charsAfterDot) {
        charsAfterDot = '00';
    } else if (charsAfterDot.length < 2) {
        charsAfterDot += '0'
    } else if (charsAfterDot.length > 2) {
        charsAfterDot = charsAfterDot.slice(0, 2);
    }

    if (charsBeforeDot > 5) {
        priceInputElement.value = [charsBeforeDot.slice(0, 6), charsAfterDot].join('.');
    }

}

document.querySelector('#priceInput').addEventListener('change', handlePriceInputChange);