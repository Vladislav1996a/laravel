function dataCard(btn){
    console.log(btn.dataset.id)
    let formData = btn.dataset.id
    let token = btn.nextElementSibling.value

   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': token
        }
    });

    $.ajax({
        type: "POST",
        url: '/cart/add',
        data: {
            'productId': formData
        },
        success: function (data) {
        //    console.log(data)
        },
        error: function (data) {
            console.log('ошибка');
        }
    })
}