const products = [
    { model: '1', cat: '1', price: 349.95, stock: '5' },
    { model: '2', cat: '1', price: 229.95, stock: '2' },
    { model: '3', cat: '1', price: 49.99, stock: '3' },
    { model: '4', cat: '1', price: 99.99, stock: '3' },
    { model: '5', cat: '2', price: 269.99, stock: '2' },
    { model: '1', cat: '2', price: 129.99, stock: '3' },
    { model: '2', cat: '2', price: 129.99, stock: '4' },
    { model: '3', cat: '2', price: 69.99, stock: '2' },
    { model: '4', cat: '2', price: 29.99, stock: '3' }
  ];
  
  const allStockPrice = products
    .map(p => p.price)
    .reduce((sum,price,stock) => sum + price*stock,0);

  console.log("Sum of the total stock : ",allStockPrice); //4339,45

  const cat1price = products
    .filter(p => p.cat === "1")
    .map(p => p.price)
    .reduce((sum,price) => sum + price, 0);
  console.log("Sum of the prices of products of cat 1 :",cat1price);
    
function isLeap(year){
  return(year % 400 == 0) || (year % 4 == 0 && year % 400 != 0 );
}

function numberOfDays(month,year) {
  switch(month) {
    case 1 || 3 || 5 || 7 || 8 || 10 :
      return 31;
      break;
    case 4 || 6 || 9 || 11:
      return 30;
      break;
    case 2 :
      if(isLeap(year)) {
        return 29;
      } else {
        return 28;
      }
    default:
      return 0;
  } 
}

function factorial(n){
  if(n == 1 || n == 0) {
    return n;
  } else {
    return n * factorial(n - 1);
  }
}

console.log("Factorial of 5 : ",factorial(5));

console.log("Numbers of day in january 2022 : ",numberOfDays(1,2022)); //31
console.log("Numbers of day in feburary 2020 : ",numberOfDays(2,2020)); //29
console.log("Numbers of day in feburary 2021 : ",numberOfDays(2,2021)); //28