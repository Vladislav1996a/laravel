function deleteProduct(el){
    let orderId = el.dataset.id;
    let token = el.nextElementSibling.value;
    let tableRow = document.querySelector('.table-row');
    
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
           console.log(data)
        },
        error: function (data) {
            console.log('ошибка');
            tableRow.remove();
        }
    })
}