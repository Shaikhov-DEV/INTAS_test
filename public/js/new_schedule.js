/* Функция проверки нажатия кнопки на форме */
$(document).ready(function () {
    $("#scheduleButton").click(
        function () {
            sendAjaxFormNewSchedule('result', 'ajaxFormNewSchedule', 'ajax/ajax_form_new_schedule.php');
            return false;
        }
    );
});
$(document).ready(function () {
    sendAjaxCalcArrival('result', 'ajax/ajax_calc_arrival.php');
    sendAjaxFreeCourier('result', 'ajax/ajax_free_courier.php');
    $("#courier").click(
        function () {
            sendAjaxFreeCourier('result', 'ajax/ajax_free_courier.php');
            return false;
        }
    );
});

function sendAjaxFreeCourier(result, url) {
    let date_departure = $('#date_departure').val();
    let date_arrival = $('#date_arrival').val();
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'html',
        data: {
            date_departure: date_departure,
            date_arrival: date_arrival
        },
        beforeSend: function () {
            $('#courier').find('option').remove();
        },
        success: function (response) {
            result = $.parseJSON(response);
            for (var i = 0; i < result.length; i++) {
                var option = document.createElement("option");
                option.setAttribute("value", result[i].toString());
                option.innerHTML = result[i].toString();
                $('#courier').append(option);
            }
        }
    });

}

/* Фунция отправки Ajax запроса на сиполнение */
function sendAjaxFormNewSchedule(result, ajax_form, url) {

    $.ajax({
        url: url, //url страницы (action_ajax_form.php)
        type: "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#" + ajax_form).serialize(),  // Сеарилизуем объект
        beforeSend: function () {
            $("#scheduleButton").prop("disabled", true);
        },
        success: function (response) { //Данные отправлены успешно
            result = $.parseJSON(response);
            $('#result_insert_schedule').html(result.message + '<br>Город: ' + result.city + '<br>ФИО курьера: ' + result.courier +
                '<br>Дата выезда: ' + result.date_departure + '<br>Дата прибытия: ' + result.date_arrival);
            $("#scheduleButton").prop("disabled", false);
        },
        error: function () { // Данные не отправлены
            $('#result_insert_schedule').html('Ошибка. Данные не отправлены.');
        }
    });

}
 


   