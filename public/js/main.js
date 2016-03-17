$(document).ready(function(){

    function writeInfoDish(arr){
        $(".boxInfoDish .img img").attr('src', '/public/img/back/'+arr[0]['image_dish']);
        $(".boxInfoDish .info h3").text(arr[0]['name_dish']);
        $(".boxInfoDish .info p").text(arr[0]['description_dish']);
    }

    function AjaxSend(id){
        $.ajax({
            url : "/menu",
            type : 'POST',
            data : "data="+id,
            success: function (response) {
                writeInfoDish(JSON.parse(response));
            }
        });
    }

    $(".showDish").click(function(){
        AjaxSend($(this).attr("data-show"));
    });
});