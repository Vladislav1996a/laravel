function price(){
    let  price = document.querySelectorAll('.price');
    
    let sum = 0;
    for(let i = 0; i<price.length; i++){
      sum += +price[i].innerHTML.slice(1)
    } 
    if(sum == null || sum == undefined){
        sum = 0;
    }
    document.querySelector('#pay').innerHTML = 'Total: $' + sum;
  } 
  price()