

function show_success_msg(success_msg,loading = false)
{
    $('.s_updated').removeClass('hidden');
    $('.s_updated').removeClass('error_u');

    $('.s_updated').html(success_msg);

    if(!loading)
    {
        setTimeout(function () { 

            $('.s_updated').html('');
            $('.s_updated').addClass('hidden');

        }, 4000);
    }
   
   

}

function show_fail_msg(error)
{
    $('.s_updated').removeClass('hidden');
    $('.s_updated').addClass('error_u');
    $('.s_updated').html(error);
}

