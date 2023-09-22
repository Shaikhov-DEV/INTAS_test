/* Функция проверки нажатия кнопки на форме */
$(document).ready(function () {
    $("#cityButton").click(
        function () {
            sendAjaxFormCity('result', 'ajaxFormCity', 'ajax/ajax_form_new_city.php');
            return false;
        }
    );
});

function sendAjaxFormCity(result, ajax_form, url) {
    $.ajax({
        url: url,
        type: "POST",
        dataType: "html",
        data: $("#" + ajax_form).serialize(),
        beforeSend: function () {
            $("#cityButton").prop("disabled", true);
        },
        success: function (response) {
            result = $.parseJSON(response);
            $('#result_insert_city').html('Результат : ' + result.message+ ' ' + result.new_city + ' ' + result.travel_time);
            $("#cityButton").prop("disabled", false);
        },
        error: function () {
            $('#result_insert_city').html('Ошибка. Данные не отправлены.');
        }
    });
}