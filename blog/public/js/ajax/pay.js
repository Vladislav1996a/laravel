function pay(){
  let  price = document.querySelectorAll('.price');
  let token = document.querySelector('#csrf').childNodes[1].value
  let sum = 0;
  for(let i = 0; i<price.length; i++){
    sum += +price[i].innerHTML.slice(1)
  } 
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token,
        }
    });

    $.ajax({
        type: "POST",
        url: '/cart/pay',
        data: {
            'sum': sum
        },
        success: function (data) {
        },
        error: function (data) {
            console.log('ошибка');
        }
    })
}