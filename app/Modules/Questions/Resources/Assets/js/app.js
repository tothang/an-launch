if(questions_active){
    $(function(){

        $('body').on('click touchstart', '.ask-a-question-button', function(){
            $('.ask-a-question-wrap').show();
            $('.ask-a-question-wrap').animate({
                top: 0,
            }, 500);
        });

        $('body').on('click touchstart', '.ask-question-close', function(){
            $('.ask-a-question-wrap').animate({
                top: '100vh',
            }, 500, null, function(){
                $('.ask-a-question-wrap').hide();
            });
        });

        $('body').on('submit', '#questions-form', function(e){
            e.preventDefault();

            var data = objectifyForm($(this).serializeArray());
            data.api_token = window.Laravel.api_token;

            if(data.question == ''){
                $('.question-error').slideDown();
                $('#question-box-group').addClass('has-error');
            }else{
                $('.question-error').slideUp();
                $('#question-box-group').removeClass('has-error');
                $('.aaq-form-wrap').fadeOut(500, function () {
                    $('.aaq-submitting-wrap').fadeIn(500, function(){
                        $.ajax({
                            url: '/api/questions/create',
                            method: 'POST',
                            data: data,
                            success: function(response){
                                setTimeout(function(){
                                    $('.aaq-submitting-wrap').fadeOut(500, function(){
                                        $('.aaq-thank-you-wrap').fadeIn(500, function(){
                                            setTimeout(function(){
                                                $('.aaq-thank-you-wrap').fadeOut(500, function(){
                                                    $('#ask-a-question-form')[0].reset();
                                                    $('.aaq-form-wrap').fadeIn(500);
                                                })
                                            }, 2000);
                                        });
                                    });
                                }, 500);
                            },
                            error: function(response){
                                //TODO: handle http errors
                            }
                        });
                    });
                });
            }

        });

    });
}


function objectifyForm(formArray) {//serialize data function

    var returnArray = {};
    for (var i = 0; i < formArray.length; i++){
        returnArray[formArray[i]['name']] = formArray[i]['value'];
    }
    return returnArray;
}
