$(document).ready(function() {

    $('input[type=checkbox],input[type=radio],input[type=file]').uniform();

    $('select').select2();

    // Form Validation
    $("#basic_validate").validate({
        rules: {
            required: {
                required: true
            },
            email: {
                required: true,
                email: true
            },
            date: {
                required: true,
                date: true
            },
            url: {
                required: true,
                url: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });



    $("#checkin").validate({
        rules: {
            required: {
                required: true
            },
            firstname: {
                required: true

            },
            lastname: {
                required: true,
            },
            datefrom2: {
                required: true,
                date: true
            },
            dateto2: {
                required: true,
                date: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    $("#reserve_room").validate({
        rules: {
            required: {
                required: true
            },
            datefrom: {
                required: true,
                date: true
            },
            dateto: {
                required: true,
                date: true
            },
            origin: {
                required: true

            },
            flight_no: {
                required: true

            },
            timedeparture: {
                required: true

            },
            c_address: {
                required: true

            },
            nationality: {
                required: true

            },
            contact_no: {
                required: true

            },
            address: {
                required: true

            },
            billarrangement: {
                required: true

            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    $("#occupy_room").validate({
        rules: {
            required: {
                required: true
            },
            occupyfirstname: {
                required: true,
            },
            occupylastname: {
                required: true,
            },
            occupydatefrom: {
                required: true,
                date: true
            },
            occupydateto: {
                required: true,
                date: true
            },
            origin1: {
                required: true

            },
            flight_no1: {
                required: true

            },
            timedeparture1: {
                required: true

            },
            c_address1: {
                required: true

            },
            nationality1: {
                required: true

            },
            contact_no1: {
                required: true

            },
            address1: {
                required: true

            },
            billarrangement1: {
                required: true

            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    $("#add_room").validate({
        rules: {
            required: {
                required: true
            },
            room_no: {
                required: true

            },
            room_rate: {
                required: true
            },
            room_type: {
                required: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    $("#edit_room").validate({
        rules: {
            required: {
                required: true
            },
            room_no: {
                required: true

            },
            room_rate: {
                required: true
            }

        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    $("#room_Type").validate({
        rules: {
            required: {
                required: true
            },
            room_type: {
                required: true

            },
            adults_capacity: {
                required: true,
            },
            child_capacity: {
                required: true,
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    $("#edit_roomType").validate({
        rules: {
            required: {
                required: true
            },
            room_type: {
                required: true

            },
            adults_capacity: {
                required: true,
            },
            child_capacity: {
                required: true,
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    $("#add_extraCategory").validate({
        rules: {
            required: {
                required: true
            },
            excat_name: {
                required: true

            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    $("#edit_exCat").validate({
        rules: {
            required: {
                required: true
            },
            excat_name: {
                required: true

            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    $("#add_extra").validate({
        rules: {
            required: {
                required: true
            },
            hotex_name: {
                required: true

            },
            hotex_price: {
                required: true

            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    $("#edit_hextra").validate({
        rules: {
            required: {
                required: true
            },
            hotex_name: {
                required: true

            },
            hotex_price: {
                required: true

            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    $("#number_validate").validate({
        rules: {
            min: {
                required: true,
                min: 10
            },
            max: {
                required: true,
                max: 24
            },
            number: {
                required: true,
                number: true
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });

    $("#password_validate").validate({
        rules: {
            current_pwd: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            new_pwd: {
                required: true,
                minlength: 6,
                maxlength: 20
            },
            confirm_pwd: {
                required: true,
                minlength: 6,
                maxlength: 20,
                equalTo: "#new_pwd"
            }
        },
        errorClass: "help-inline",
        errorElement: "span",
        highlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').addClass('error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).parents('.control-group').removeClass('error');
            $(element).parents('.control-group').addClass('success');
        }
    });




    // (function($) {
    $('.spinner .btn:first-of-type').on('click', function() {
        $('.spinner input').val(parseInt($('.spinner input').val(), 10) + 1);
    });

    $('.spinner .btn:last-of-type').on('click', function() {
        $('.spinner input').val(parseInt($('.spinner input').val(), 10) - 1);
    });
    // });


    $("input[name='adults_capacity']").TouchSpin();

    $("input[name='child_capacity']").TouchSpin();



    $('#cancel_reserve').on('click', function(e) {
        e.preventDefault();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
        $.ajax({
            type: 'POST',
            url: '/admin/cancel-reserve',
            data: { bookingroomid: bookingroomid },
            success: function(data) {
                alert(data.success);
            }
        });
    });

    var options = {
        // now: today.getHours() + ':' + today.getMinutes(),
        twentyFour: true,
        upArrow: 'wickedpicker__controls__control-up',
        downArrow: 'wickedpicker__controls__control-down',
        close: 'wickedpicker__close',
        hoverState: 'hover-state',
        title: 'Time',
        showSeconds: true,
        secondsInterval: 1,
        minutesInterval: 1,
        beforeShow: null,
        show: null,
        clearable: false,
    };
    $('.timepicker').wickedpicker(options);




});