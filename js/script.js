/**
 * Created by Jyoti on 13-10-2018.
 */
function showError(selector,msg){

    if($(selector).siblings('.validation-error').length){
        $(selector).siblings('.validation-error').html(msg);
    }else{
        $(selector).parent().append('<span class="validation-error">'+msg+'</span>');
    }
    $(selector).siblings('.validation-error').show();
}
function hideValidationError(){
    $('.validation-error').hide();
}

$('.form-control').focus(function(){
    $(this).parent().find('.validation-error').hide();
})