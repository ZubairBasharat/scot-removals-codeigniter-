$(document).ready(function() {
    var validate_input = $('#validation_input1');
    var validate_input2 = $('#validation_input2');
    $('#complete_quote').click(function() {
        var location1 = $(validate_input).val();
        var location2 = $(validate_input2).val();

        if ($(validate_input).val() == "") {
            $(validate_input).css('border-color', 'red');

            if ($(validate_input2).val() == "") {
                $(validate_input2).css('border-color', 'red');
            }
            return false;
        } else {
            if ($(validate_input2).val() == "") {
                $(validate_input2).css('border-color', 'red');

                return false;
            }


            window.location.href = "listing-inventory.html";
            return false;
        }

    });

    $('#complete_quote2').click(function() {
        var location1 = $(validate_input).val();
        var location2 = $(validate_input2).val();

        if ($(validate_input).val() == "") {
            $(validate_input).css('border-color', 'red');

            if ($(validate_input2).val() == "") {
                $(validate_input2).css('border-color', 'red');
            }
            return false;
        } else {
            if ($(validate_input2).val() == "") {
                $(validate_input2).css('border-color', 'red');

                return false;
            }


            window.location.href = "furniture_catagory.html";
            return false;
        }

    });

});