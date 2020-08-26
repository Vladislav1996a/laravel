function deleteProduct(el){
    let orderId = el.dataset.id;
    let token = el.nextElementSibling.value;
    
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });

    $.ajax({
        type: "POST",
        url: '/cart/delete',
        data: {
            'orderId': orderId
        },
        success: function (data) {
           el.parentNode.parentNode.remove();
        },
        error: function (data) {
            console.log('ошибка');
        }
    })
}