function dataCard(btn){
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
            swal( "added to cart !", "success");
        },
        error: function (data) {
            swal( "not added to cart !", "error");
        }
    })
}
