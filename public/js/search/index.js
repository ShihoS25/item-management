/**
 * 検索価格表示
 */
const priceRange = document.getElementById('priceRange');
const currentValue = document.getElementById('currentValue');

const setCurrentValue = () => {
    currentValue.innerText = priceRange.value;
};

priceRange.addEventListener('input', setCurrentValue);
setCurrentValue();