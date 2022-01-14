$(document).ready(function() {
    // order form validation start
    // $('.order_validation').focusout(function(){
    //     if($(this).val().length > 0){
    //     $(this).parent().find('.val_message').remove();
    //   }
    //   else{
    //     $(this).parent().find('.val_message').remove();
    //     $(this).parent().append('<span class="text-danger val_message  mt-2 d-block w-100">Field should not be empty</span>');
    //   }
    // });
    $('.focus_val_input').on('keypress' , function (e) {
        if (e.which === 13) {
            if($(this).val()=="" && $(this).val()==""){
                return false;
            }
            else{
                var f_target = $(this).attr('data-id');
                $('.'+f_target).focus();
            }
        }
    });   
    $('.sys_val').on('keypress', function (e) {
        if (e.which === 13) {
            if($(this).val()=="" && $(this).val()==""){
                return false;
            }
            else{
                var f_target = $(this).attr('data-id');
                $('.'+f_target).focus();
            }
        }
        if ($(this).val() == "") {
            if (event.which === 32)
            { return false; }
            else {
                var regex = new RegExp("^[a-zA-Z \b]+$");
                var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
                if (!regex.test(key)) {
                    event.preventDefault();
                    return false;
                }
            }
        }
        else {
            var regex = new RegExp("^[a-zA-Z \b]+$");
            var key = String.fromCharCode(!event.charCode ? event.which : event.charCode);
            if (!regex.test(key)) {
                event.preventDefault();
                return false;
            }
        }
        return true;
    });
    $("input[type=number]").keypress(function (e) {
        if (e.which != 8 && e.which != 0 && (e.which < 48 || e.which > 57)) {
            return false;
        }
    });
    // var validate_postcode = new RegExp("^(([A-Z]{1,2}\d[A-Z\d]?|ASCN|STHL|TDCU|BBND|[BFS]IQQ|PCRN|TKCA) ?\d[A-Z]{2}|BFPO ?\d{1,4}|(KY\d|MSR|VG|AI)[ -]?\d{4}|[A-Z]{2} ?\d{2}|GE ?CX|GIR ?0A{2}|SAN ?TA1)$");
    $('.sys_val_post').on('keyup', function() {
        if($(this).val().length >=3 && $(this).val().length<=10){
            $(this).parent().find('.val_message_num').remove();
            $(this).parent().find('.val_message').remove();
        }
        else{
            if($(this).val().length==0){
                $(this).parent().find('.val_message_num').remove();
                $(this).parent().find('.val_message').remove();
            }
            else{
                $(this).parent().find('.val_message_num').remove();
                $(this).parent().find('.val_message').remove();
                $(this).parent().append('<span class="text-danger val_message_num  mt-2 d-block w-100">Post Code length not valid</span>');
            }
        }   
    });

 
    $('.order_validation').on('keyup', function(){
        $(this).parent().find('.val_message').remove();
    //     if($(this).val().length > 0){
    //     $(this).parent().find('.val_message').remove();
    //   }
    //   else{
    //     $(this).parent().find('.val_message').remove();
    //     $(this).parent().append('<span class="text-danger val_message  mt-2 d-block w-100">Field should not be empty</span>');
    //   }
    });
    $('input[type=number]').on('keyup', function () {
        var length_num = $(this).val().length;
        if(length_num <=11 && length_num >= 7){
            $(this).parent().find('.val_message_num').remove();
        } 
        else{
            if(length_num==0){
                $(this).parent().find('.val_message_num').remove();
            }
            else{
                $(this).parent().find('.val_message_num').remove();
                $(this).parent().append('<span class="text-danger val_message_num  mt-2 d-block w-100">Phone Number should be greater than 6 and <br> less than 11</span>');
                return false;
            }
        }
       
    });
});