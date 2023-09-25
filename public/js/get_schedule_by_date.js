
$( document ).ready(function() {
    document.getElementById('from_date').valueAsDate = new Date();
    document.getElementById('to_date').valueAsDate = new Date();


    $("#selectDate").click(
        function(){    
            sendAjaxFormSelect('result', 'ajaxFormSelect', 'ajax/ajax_form_schedule_by_date.php');
            return false; 
        }
    );
});

function sendAjaxFormSelect(result, ajax_form, url) {

    $.ajax({
        url:      url, //url страницы (action_ajax_form.php)
        type:     "POST", //метод отправки
        dataType: "html", //формат данных
        data: $("#"+ajax_form).serialize(),  // Сеарилизуем объект
        beforeSend: function(){
	 		$("#selectDate").prop("disabled", true);
            $("#result_schedule_by_date").empty();
        },
        success: function(response) {
            result = $.parseJSON(response);
            if (result.flag==false) {
                $("#result_schedule_by_date").append(result.message);
            }else{
                for (var i = 0; i < result.length; i++) {
                    $("#result_schedule_by_date").append("<p>Город : " + result[i].city + "<br/>Дата отправки : " + result[i].departure +
                        "<br/> ФИО курьера : " + result[i].courier + "<br/> Дата прибытия : " + result[i].arrival + "</p><hr>")
                }
            }
            $("#selectDate").prop("disabled", false);
        },
        error: function(response) {
            $("#result_schedule_by_date").html('Ошибка. Данные не отправлены.');
        }
    });
}
