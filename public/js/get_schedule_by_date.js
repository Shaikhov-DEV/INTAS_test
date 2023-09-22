/* Функция проверки нажатия кнопки на форме */
$( document ).ready(function() {
    $("#selectDate").click(
        function(){    
            sendAjaxFormSelect('result', 'ajaxFormSelect', 'ajax/ajax_form_schedule_by_date.php');
            return false; 
        }
    );
});

/* Фунция отправки Ajax запроса на сиполненеи */
function sendAjaxFormSelect(result, ajax_form, url) {

    $.ajax({
        url:      url, //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
        beforeSend: function(){
	 		$("#selectDate").prop("disabled", true);
            $("#result_schedule_by_date").find('p').remove();
            $("#result_schedule_by_date").find('br').remove();
            $("#result_schedule_by_date").find('hr').remove();
        },
        success: function(response) { //Данные отправлены успешно
            result = $.parseJSON(response);
            if (result[0]==undefined) {
                $("#result_schedule_by_date").append("Записей удовлетворяюших диапазону - нет");
            }else {
                for (var i = 0; i < result.length; i++) {
                    $("#result_schedule_by_date").append("<p>Город : " + result[i].city + "<br/>Дата отправки : " + result[i].departure +
                        "<br/> ФИО курьера : " + result[i].courier + "<br/> Дата прибытия : " + result[i].arrival + "</p><hr>")
                }
                $("#selectDate").prop("disabled", false);
            }
        },
        error: function(response) { // Данные не отправлены
            $("#result_schedule_by_date").html('Ошибка. Данные не отправлены.');
        }
    });
}
