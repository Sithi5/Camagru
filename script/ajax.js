function myAjaxChangeLike(id_image) {
    $.ajax({
        type: "POST",
        url: '../setalike.php',
        data: { action: 'call_a_like', img_id: id_image },
        success: function(html) {
            alert(html);
            location.reload();
        }
    });
}

function myAjaxSendMailForget(code, login, mail) {
    $.ajax({
        type: "POST",
        url: '../mail.php',
        data: { call: 'ft_sendmail_forget', code: code, login: login, mail: mail },
        success: function(html) {
            alert(html);
            location.reload();
        }
    });
}

function myAjaxSendToGalery() {
    $.ajax({
        type: "POST",
        url: '../phpfunctions/save_to_galery.php',
        data: { call: 'save_to_galery' },
        success: function(html) {
            alert(html);
            if (html === "vous etes bien connecter, upload du screenshot...")
                window.location.href = "./profil.php";
        }
    });
}