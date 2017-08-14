/**"
 * Created by Sirolad on 17/04/2017.
 */
$(".alert").fadeOut(300);

$(".verify").click(function () {
    "use strict";
    var id = $(this).attr('data-id');
    var token = $(this).attr('data-token');

    $.post({
        type: "POST",
        url: "/admin/verify-transaction/" + id,
        data: {
            _token: token,
            id: id
        },
        success: function (msg) {
            if(msg.status_code === 200) {
                $("#row" + id).remove();
            }
        }
    });
});

$(".decline").click(function () {
    "use strict";
    var id = $(this).attr('data-id');
    var token = $(this).attr('data-token');

    $.post({
        type: "POST",
        url: "/admin/decline-transaction/" + id,
        data: {
            _token: token,
            id: id
        },
        success: function (msg) {
            if(msg.status_code === 200) {
                $("#row" + id).remove();
            }
        }
    });
});

$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();
});

$('div.alert').delay(9000);