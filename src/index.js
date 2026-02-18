class Pizza {
    static types = {
    'Маргарита': { price: 500, calories: 300 },
    'Пепперони ': { price: 800, calories: 400 },
    'Баварская': { price: 700, calories: 450 }
};

    static sizes = {
    'Маленькая': { price: 100, calories: 100 },
    'Большая': { price: 200, calories: 200 }
    };

    static toppings = {
    'сливочная моцарелла': { price: 50, calories: 20 },
    'сырный борт': {
        Маленькая: { price: 150, calories: 50 },
        Большая: { price: 300, calories: 50 }
    },
    'чедер и пармезан': {
        Маленькая: { price: 150, calories: 50 },
        Большая: { price: 300, calories: 50 }
    }
    };

    constructor(type, size) {
    if (!Pizza.types[type]) throw new Error('Неверный тип пиццы');
    if (!Pizza.sizes[size]) throw new Error('Неверный размер пиццы');

    this.type = type;
    this.size = size;
    this.toppings = [];
    }

    addTopping(topping) {
    if (!Pizza.toppings[topping]) throw new Error('Неверная добавка');
    if (!this.toppings.includes(topping)) {
        this.toppings.push(topping);
    }
    }

    removeTopping(topping) {
    this.toppings = this.toppings.filter(t => t !== topping);
    }

    getToppings() {
    return this.toppings;
    }

    getSize() {
    return this.type;
    }

    getStuffing() {
    return this.size;
    }

    calculatePrice() {
    let price = Pizza.types[this.type].price + Pizza.sizes[this.size].price;

    for (let topping of this.toppings) {
        const toppingInfo = Pizza.toppings[topping];
        if (typeof toppingInfo.price !== 'undefined') {
        price += toppingInfo.price;
        } 
        else {
        price += toppingInfo[this.size].price;
        }
    }

    return price;
    }

    calculateCalories() {
    let calories = Pizza.types[this.type].calories + Pizza.sizes[this.size].calories;

    for (let topping of this.toppings) {
        const toppingInfo = Pizza.toppings[topping];
        if (typeof toppingInfo.calories !== 'undefined') {
        calories += toppingInfo.calories;
        } 
        else {
        calories += toppingInfo[this.size].calories;
        }
    }

    return calories;
    }
}

//Рассчет
const new_pizza = new Pizza('Маргарита', 'Большая');
new_pizza.addTopping('сливочная моцарелла');
console.log('Пицца:', new_pizza.getSize());
console.log('Размер:', new_pizza.getStuffing());
console.log('Добавки:', new_pizza.getToppings().join(', '));
console.log('Цена:', new_pizza.calculatePrice(), 'руб');
console.log('Калории:', new_pizza.calculateCalories(), 'ккал');
