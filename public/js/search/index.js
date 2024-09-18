/**
 * 価格検索
 */
// input要素
const priceRange = document.getElementById('priceRange');

// 埋め込む先の要素
const currentValue = document.getElementById('currentValue');

// 現在の値を埋め込む関数
const setCurrentValue = (val) => {
    currentValue.innerText = val;
}

// inputイベント時に値をセットする関数
const rangeOnChange = (event) =>{
    setCurrentValue(event.target.value);
}

window.onload = () => {
    priceRange.addEventListener('input', rangeOnChange); // スライダー変化時にイベントを発火
    setCurrentValue(priceRange.value); // ページ読み込み時に値をセット
}