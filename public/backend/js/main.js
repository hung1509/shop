
$.ajaxSetup({
    headers: {
        'X-CSRF-TOKEN':$('meta[name="csrf-token"]').attr('content')
    }
})

function destroyModel(model, id) {
    var result = confirm("Bạn có chắc chắn muốn xóa ?");
    console.log(id);
    console.log(model);
    if (result) { // neu nhấn == ok , sẽ send request ajax
        $.ajax({
            url: base_url + '/admin/'+model+'/'+id, // base_url được khai báo ở đầu page == http://viettel.com

            type: 'DELETE',
            data: {}, // dữ liệu truyền sang nếu có
            dataType: "json", // kiểu dữ liệu trả về
            success: function (response) { // success : kết quả trả về sau khi gửi request ajax
                if (response.status != 'undefined' && response.status == true) {
                    // xóa dòng vừa được click delete
                    $('.item-'+id).closest('tr').remove(); // class .item- ở trong class của thẻ td đã khai báo trong file index
                }
            },
            error: function (e) { // lỗi nếu có
                console.log(e.message);
            }
        });
    }
}
// image product
function preview(image, num){
    var img = image.files[0];
    var reader = new FileReader();
    reader.onloadend = function()
    {
    if(num){
        var x = '.preview-'+num;
        $(x).css('width', '100%');
        $(x).css('height', '100%');
        $(x).attr("src",reader.result);
        console.log(x);
    }
    else{
        $(".preview").css('width', '100%');
        $(".preview").css('height', '100%');
        $(".preview").attr("src",reader.result);
    }
    }
    reader.readAsDataURL(img);
}

// role
    //check all 
    $('.checkbox_all').on('click',function(){
        $(this).parents('.card-body').find('.form-check-input').prop('checked',$(this).prop('checked'));
    })
    //check parent
    $('.checkbox_parent').on('click',function(){
        $(this).parents('.card-parent').find('.checkbox_children').prop('checked',$(this).prop('checked'));
    })