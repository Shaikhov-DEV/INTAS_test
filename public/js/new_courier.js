/* Функция проверки нажатия кнопки на форме */
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
        },
        success: function (response) {
            result = $.parseJSON(response);
            $('#result_insert_courier').html('Результат : ' + result.message + ' ' + result.lastname + ' ' + result.firstname + ' ' + result.patronymic);
            $("#courierButton").prop("disabled", false);
        },
        error: function () {
            $('#result_insert_courier').html('Ошибка. Данные не отправлены.');
        }
    });
}