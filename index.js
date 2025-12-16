//Задание 1.

const students = [
   { name: 'Павел', age: 20 },
   { name: 'Иван', age: 20 },
   { name: 'Эдем', age: 20 },
   { name: 'Денис', age: 20 },
   { name: 'Виктория', age: 20 },
   { age: 40 },
]

console.log('\nЗадание 1')

const result = pickPropArray(students, 'name')

console.log(result)
// [ 'Павел', 'Иван', 'Эдем', 'Денис', 'Виктория' ]

function pickPropArray(array, property) {
    return array.map(obj => obj[property])
              .filter(Boolean); 
}

//Задание 2
  
function createCounter() {
    let count = 0;

    return function () {
      count++;
      console.log(count);
    };
  }

console.log('\nЗадание 2')

const counter1 = createCounter()
counter1() // 1
counter1() // 2
  
const counter2 = createCounter()
counter2() // 1
counter2() // 2

//Задание 3
  
console.log('\nЗадание 3')

const result1 = spinWords("Привет от Legacy")
console.log(result1) // тевирП от ycageL
  
const result2 = spinWords("This is a test")
console.log(result2) // This is a test

function spinWords(str) {
    const words = str.split(' ');
    
    const result = [];
    for (let word of words) {

        if (word.length >= 5) {
            word = word.split('').reverse().join('');
        }

        result.push(word);
    }
    
    return result.join(' ');
}

//Задание 4*

console.log('\nЗадание 4')

const nums = [2,7,11,15];
const target = 9;

console.log(getTarget(nums, target))

function getTarget(nums, target) {
    const set = new Set();

    for (let i = 0; i < nums.length; i++) {

        const num = nums[i];
        const target_num = target - num;

        if (set.has(target_num)) {
            return [nums.indexOf(target_num), i];
        }

        set.add(num);
    }

    return [];
}