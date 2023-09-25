$(document).ready(function () {
    $("#courierButton").click(
        function () {
            sendAjaxFormCourier('result', 'ajaxFormCourier', 'ajax/ajax_form_new_courier.php');
            return false;
        }
    );
});

function sendAjaxFormCourier(result, ajax_form, url) {
    $.ajax({
        url: url,
        type: "POST",
        dataType: "html",
        data: $("#" + ajax_form).serialize(),
        beforeSend: function () {
            $("#courierButton").prop("disabled", true);
            $("#result_insert_courier").empty();
        },
        success: function (response) {
            console.log(response);
            result = $.parseJSON(response);
            console.log(result);

            if (result.flag == false) {
                $("#result_insert_courier").append(result.message);
            } else {
                $('#result_insert_courier').append(result.message + ' ' + result.lastname + ' ' + result.firstname + ' ' + result.patronymic);
                $("#courierButton").prop("disabled", false);
            }
        },
        error: function () {
            $('#result_insert_courier').html('Ошибка. Данные не отправлены.');
        }
    });
}