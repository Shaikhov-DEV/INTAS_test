$(document).ready(function () {
    $("#insertButton").click(
        function () {
            sendAjaxInsertSchedule('result', 'ajax/ajax_insert_script_schedule.php');
            return false;
        }
    );
});

$(document).ready(function () {
    $("#clearButton").click(
        function () {
            sendAjaxClean('result', 'ajax/ajax_clean.php');
            return false;
        }
    );
});

function sendAjaxClean(result, url) {
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'html',
        beforeSend: function(){
            $("#result_insert_schedule").empty();
            $("#clearButton").prop("disabled", true);
        },
        success: function (response) {
            result = $.parseJSON(response);
            $('#result_insert_schedule').html(result.message);
        }
    });
}

function sendAjaxInsertSchedule(result, url) {
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'html',
        beforeSend: function(){
            $("#result_insert_schedule").empty();
        },
        success: function (response) {
            result = $.parseJSON(response);
            $('#result_insert_schedule').html(result.message);
            $("#clearButton").prop("disabled", false);
        }
    });
}
 


   