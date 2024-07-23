function limitInputToNumbers(input,amount) {
    input.value = input.value.replace(/\D/g, '');
    if (input.value.length > amount) {
      input.value = input.value.slice(0, amount);
    }
  }
  

function maskNumbersPlusLatin(input, amount) {
  // Видаляємо неалфавітно-цифрові символи зі значення поля вводу
  var sanitizedValue = input.value.replace(/[^a-zA-Z0-9]/g, '');

  // Розділяємо очищене значення на дві частини
  var firstPart = sanitizedValue.slice(0, 2);
  var secondPart = sanitizedValue.slice(2, amount);

  // Перевіряємо перші два символи на відповідність латинському шаблону
  var validFirstPart = /^[a-zA-Z]{0,2}$/g.test(firstPart);

  // Перевіряємо залишок символів на цифри
  var validSecondPart = /^\d{0,27}$/g.test(secondPart);

  // Складаємо відфільтроване значення
  var maskedValue = '';
  if (validFirstPart) {
    maskedValue += firstPart;
  }
  if (validSecondPart) {
    maskedValue += secondPart;
  } else{
    maskedValue=  maskedValue + secondPart.slice(0,secondPart.length-1)
  }

  // Перетворюємо великі літери та встановлюємо значення поля вводу
  input.value = maskedValue.toUpperCase();

  // Обрізаємо значення до вказаної кількості символів, якщо потрібно
  if (input.value.length > amount) {
    input.value = input.value.slice(0, amount).toUpperCase();
  }
}

  
  function maskFractionalNumbers(input, amount) {
    let inputValue = input.value;
  
    // Залишаємо лише цифри, кому та крапку
    let sanitizedValue = inputValue.replace(/[^0-9,.]/g, '');
  
    let decimalIndex = sanitizedValue.indexOf('.'); // Знаходимо індекс першої крапки
  
    if (decimalIndex !== -1) {
      // Обмежуємо кількість цифр перед крапкою до заданого значення (amount)
      let integerPart = sanitizedValue.slice(0, decimalIndex);
      if (integerPart.length > amount) {
        integerPart = integerPart.slice(0, amount);
      }
  
      // Обмежуємо кількість цифр після крапки до 1
      let fractionalPart = sanitizedValue.slice(decimalIndex + 1, decimalIndex + 2);
      sanitizedValue = integerPart + '.' + fractionalPart;
    } else {
      // Якщо немає крапки, то обмежуємо кількість цифр до заданого значення (amount) і додаємо "0" у кінці
      if (sanitizedValue.length > amount) {
        sanitizedValue = sanitizedValue.slice(0, amount - 1) + '.' + sanitizedValue.slice(amount - 1);
      } else if (sanitizedValue.length === amount) {
        sanitizedValue = sanitizedValue.slice(0, amount - 1) + '.' + sanitizedValue.slice(amount - 1);
      }
    }
  
    // Замінюємо кому на крапку
    sanitizedValue = sanitizedValue.replace(',', '.');
  
    // Змінюємо дві крапки ".." на одну "."
    while (sanitizedValue.includes('..')) {
      sanitizedValue = sanitizedValue.replace('..', '.');
    }
  
    input.value = sanitizedValue;
  }

  function maskFractionalNumbersMinus(input, amount) {
    let newAmount = amount ;
  let inputValue = input.value;
  if(inputValue[0] === '-'){
    newAmount ++
  }

  // Залишаємо лише цифри, кому та крапку, а також мінус
  let sanitizedValue = inputValue.replace(/[^0-9,.-]/g, '');

  let decimalIndex = sanitizedValue.indexOf('.'); // Знаходимо індекс першої крапки
  let minusIndex = sanitizedValue.indexOf('-'); // Знаходимо індекс мінуса

  // Перевірка на правильне розташування мінуса
  if (minusIndex > 0) {
    sanitizedValue = sanitizedValue.slice(0, minusIndex);
  }

  if (decimalIndex !== -1) {
    // Обмежуємо кількість цифр перед крапкою до заданого значення (newAmount)
    let integerPart = sanitizedValue.slice(0, decimalIndex);
    if (integerPart.length > newAmount) {
      integerPart = integerPart.slice(0, newAmount);
    }

    // Обмежуємо кількість цифр після крапки до 1
    let fractionalPart = sanitizedValue.slice(decimalIndex + 1, decimalIndex + 2);
    sanitizedValue = integerPart + '.' + fractionalPart;
  } else {
    // Якщо немає крапки, то обмежуємо кількість цифр до заданого значення (newAmount) і додаємо "0" у кінці
    if (sanitizedValue.length > newAmount) {
      sanitizedValue = sanitizedValue.slice(0, newAmount - 1) + '.' + sanitizedValue.slice(newAmount - 1);
    } else if (sanitizedValue.length === newAmount) {
      sanitizedValue = sanitizedValue.slice(0, newAmount - 1) + '.' + sanitizedValue.slice(newAmount - 1);
    }
  }

  // Замінюємо кому на крапку
  sanitizedValue = sanitizedValue.replace(',', '.');

  // Змінюємо дві крапки ".." на одну "."
  while (sanitizedValue.includes('..')) {
    sanitizedValue = sanitizedValue.replace('..', '.');
  }

  // Змінюємо місцями мінус і дробову частину
  if (minusIndex > decimalIndex) {
    sanitizedValue = '-' + sanitizedValue.replace('-', '');
  }

  input.value = sanitizedValue;
}


  
  function limitInputToNumbersWithPlus(input, amount) {
    // Check if the input starts with a plus sign
    let startsWithPlus = input.value.startsWith("+");
    // Remove all non-numeric characters from the input
    input.value = input.value.replace(/\D/g, '');
    // If the input started with a plus sign, add it back
    if (startsWithPlus) {
      input.value = '+' + input.value;
    }
    // Limit the input length to the specified amount
    if (input.value.length > amount) {
      input.value = input.value.slice(0, amount);
    }
  }

    function validateUkrainianDNZ(input,amount) {
      var sanitizedValue = input.value.replace(/[^a-zA-Z0-9а-яА-Я]/g, '');
      
      var firstPart = sanitizedValue.slice(0, 2);
      var secondPart = sanitizedValue.slice(2, 6);
      var lastPart = sanitizedValue.slice(6, amount);
  
      // Валідація перших двох символів за вашим патерном
      var validFirstPart = /^[a-zA-Zа-яА-Я]{0,2}$/g.test(firstPart);
  
      // Валідація наступних чотирьох символів за патерном цифр
      var validSecondPart = /^\d{0,4}$/g.test(secondPart);
  
      // Валідація останніх двох символів за вашим патерном
      var validLastPart = /^[a-zA-Zа-яА-Я]{0,2}$/g.test(lastPart);
  
      // Зібираємо дозволену частину рядка
      var maskedValue = '';
      if (validFirstPart) {maskedValue += firstPart;}else{maskedValue=  maskedValue + firstPart.slice(0,firstPart.length-1)}
      if (validSecondPart){ maskedValue += secondPart;}else{maskedValue=  maskedValue + secondPart.slice(0,secondPart.length-1)}
      if (validLastPart){ maskedValue += lastPart;}else{maskedValue=  maskedValue + lastPart.slice(0,lastPart.length-1)}
  
      input.value = maskedValue.toUpperCase();
  
      if (input.value.length > amount) {
          input.value = input.value.slice(0, amount).toUpperCase();
      }
  }
  
  
  
    
  function validateDate(input, minAge) {
    const currentDate = new Date();
    const maxDate = new Date(currentDate.getFullYear() - minAge, currentDate.getMonth(), currentDate.getDate());
    
    flatpickr(input, {
        altInput: true,
        altFormat: "Y-m-d", 
        dateFormat: "Y-m-d",
        maxDate: maxDate,
    });
}



function validateDriverLicense(input,amount) {
  var sanitizedValue = input.value.replace(/[^a-zA-Z0-9а-яА-Я]/g, '');
  var firstPart = sanitizedValue.slice(0, 3);
  var secondPart = sanitizedValue.slice(3, amount);
  var validFirstPart = /^[a-zA-Zа-яА-Я]{0,3}$/g.test(firstPart);
  var validSecondPart = /^\d{0,6}$/g.test(secondPart);
  var maskedValue = '';
  if (validFirstPart) {maskedValue += firstPart;}else{maskedValue=  maskedValue + firstPart.slice(0,firstPart.length-1)}
  if (validSecondPart){ maskedValue += secondPart;}else{maskedValue=  maskedValue + secondPart.slice(0,secondPart.length-1)}
  input.value = maskedValue.toUpperCase();

  if (input.value.length > amount) {
      input.value = input.value.slice(0, amount).toUpperCase();
  }
}
