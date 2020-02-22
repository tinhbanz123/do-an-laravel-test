function confirmDelete(that) {
    var r = confirm("do you want to delete?");
    if (r == true) {
        // $(that).closest('form').submit();
        let ROOM_URL = $(that).closest('form').attr('action');
        //lấy địa chỉ đường dẫn khi bấm delete : http://blog.local/category/delete/3
        // alert(ROOM_URL);
        let data = $(that).closest('form').serialize();
        // alert(data);
        //lấy các thành phần có trong form (ở đây là hàm token do @csrf tạo ra )

        $.ajax({
            url: ROOM_URL,
            type: 'POST',
            data: data,
            success: function (dataResponse) {
                console.log(dataResponse);
                // window.location.reload();
                alert(dataResponse.success);
                $(that).closest('tr').remove();
                //xóa tất cả các thành phần trong thẻ "tr"
            },
            error: function (err) {
                console.log(err);
                // window.location.reload();
                alert(dataResponse.error);
            },
            dataType: 'json'
        });
    }

}

