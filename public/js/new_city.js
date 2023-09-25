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
            $("#result_insert_city").empty();
        },
        success: function (response) {
            result = $.parseJSON(response);
            if (result.flag == false) {
                $("#result_insert_city").append(result.message);
            } else {
                $('#result_insert_city').html('Результат : ' + result.message + ' ' + result.new_city + ' ' + result.travel_time);
                $("#cityButton").prop("disabled", false);
            }
        },
        error: function () {
            $('#result_insert_city').html('Ошибка. Данные не отправлены.');
        }
    });
}

const slideValue = document.querySelector("span");
const inputSlider = document.querySelector("#travel_time");
inputSlider.oninput = () => {
    let value = inputSlider.value;
    slideValue.textContent = value;
    slideValue.style.left = value / 2 + "%";
    slideValue.classList.add("show");
};
inputSlider.onblur = () => {
    slideValue.classList.remove("show");
};