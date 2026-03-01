const pizzaData = {
  'Маргарита': { price: 500, cal: 300 },
  'Пепперони': { price: 800, cal: 400 },
  'Баварская': { price: 700, cal: 450 }
};

const sizeData = {
  'Маленькая': { price: 100, cal: 100 },
  'Большая': { price: 200, cal: 200 }
};

let selectedPizza = null;
let selectedSize = 'Маленькая';
let selectedAddons = [];

const updateCart = () => {
  if (!selectedPizza) {
    document.getElementById('cartButton').textContent = 'Выберите пиццу';
    return;
  }
  const base = pizzaData[selectedPizza];
  const size = sizeData[selectedSize];
  let price = base.price + size.price;
  let cal = base.cal + size.cal;
  selectedAddons.forEach(addon => {
    price += parseInt(addon.dataset.price);
    cal += parseInt(addon.dataset.cal);
  });
  document.getElementById('cartButton').textContent = `Добавить в корзину за ${price}₽ (${cal} Ккал)`;
};

document.querySelectorAll('.pizza_option').forEach(option => {
  option.addEventListener('click', () => {
    document.querySelectorAll('.pizza_option').forEach(o => o.classList.remove('selected'));
    option.classList.add('selected');
    selectedPizza = option.dataset.type;
    updateCart();
  });
});

document.querySelectorAll('input[name="size"]').forEach(input => {
  input.addEventListener('change', () => {
    selectedSize = input.value;
    updateCart();
  });
});

document.querySelectorAll('.addon').forEach(addon => {
  addon.addEventListener('click', () => {
    addon.classList.toggle('selected');
    if (selectedAddons.includes(addon)) {
      selectedAddons = selectedAddons.filter(a => a !== addon);
    } else {
      selectedAddons.push(addon);
    }
    updateCart();
  });
});
