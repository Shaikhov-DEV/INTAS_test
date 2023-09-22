$(document).ready(function () {
    $("#date_departure").on("change",
        function () {
            sendAjaxFreeCourier('result', 'ajax/ajax_free_courier.php');
            sendAjaxCalcArrival('result', 'ajax/ajax_calc_arrival.php');
            return false;
        }
    );
});
$(document).ready(function () {
    $("#city").on("change",
        function () {
            sendAjaxCalcArrival('result', 'ajax/ajax_calc_arrival.php');
            return false;
        }
    );
});

function sendAjaxCalcArrival(result, url) {
    let city = $('#city').val();
    let date_departure = new Date($('#date_departure').val());
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'html',
        data: {city: city},
        success: function (response) {
            result = $.parseJSON(response);
            let travel_time = 2 * (parseInt(result.arrival[0]));
            date_departure.setDate(date_departure.getDate() + travel_time);
            $('#date_arrival').val(date_departure.toLocaleDateString("en-CA"));
        }
    });

}