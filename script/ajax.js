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



function myAjaxIncrementGalery() {
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
            if (html === "Upload du screenshot...")
                window.location.href = "./profil.php";
        }
    });
}

function myAjaxSendToGalerylocal() {
    let src_img = document.getElementById("img_upload");
    let filtre_img = document.getElementById("img-preview-in-upload");
    $.ajax({
        type: "POST",
        url: '../phpfunctions/save_to_galery.php',
        data: { call: 'upload_to_galery', filtre: filtre_img.src, src: src_img.src },
        success: function(html) {
            alert(html);
            if (html === "Upload du screenshot...")
                window.location.href = "./profil.php";
        }
    });
}