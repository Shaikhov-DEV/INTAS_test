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
        success: function (response) {
            result = $.parseJSON(response);
        }
    });
}
function sendAjaxInsertSchedule(result, url) {
    $.ajax({
        url: url,
        method: 'post',
        dataType: 'html',
        success: function (response) {
            console.log(response);
            result = $.parseJSON(response);
            console.log(result);

        }
    });
}
 


   