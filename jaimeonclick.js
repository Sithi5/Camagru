function myAjax(id_image) {
    $.ajax({
        type: "POST",
        url: './setalike.php',
        data: { action: 'call_a_like', img_id: id_image },
        success: function(html) {
            alert(html);
        }
    });
}