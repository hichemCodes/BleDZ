
$(document).ready(function()
{
    all_harvest_wilayas(2020);

    // add on change event to select to change the year
    $('.s_years_wilayas').on('change',function()
        {
           all_harvest_wilayas($('.s_years_wilayas').val());
        });
});

function all_harvest_wilayas(year)
{
    $.ajax({
        url : 'action/harvest_wilayas.php',
        method : 'POST',
        dataType : 'JSON',
        data : { year : year},
        success : function(data)
        {

            if(data.result == 'empty')
            {
              
                $('.r_wilayas_t').html(data.err)
            }
            else
            {
                $('.r_wilayas_t').html(data.result);
            }
             
          
        }
   })
}

function recolte_wilaya_detail_year(wilaya_id)
{
    $('.cover_all').show(); 
    $('.profile_container').css("display","flex");
    $('.profile').addClass('custum_profile');
    var year = $('.s_years_wilayas').val();
    
    $.ajax({
        url : 'action/harvest_wilaya_detail_year.php',
        method : 'POST',
      //  dataType : 'JSON',
        data : { 
                 year : year,
                 wilaya_id : wilaya_id

               },
        beforeSend : function()
        {
            $('.profile').html('<div class="lds-ripple"><div></div><div></div></div>');
        },
        success : function(data)
        {
             $('.profile').html(data);
             console.log(data);
        }
   })
}