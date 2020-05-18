$(document).ready(function(){
                          
    all_agriculteurs_count();
    all_offices_count();
    all_recolte_count();
     top_agr();
});



/// function 
function all_agriculteurs_count()
{
   $.ajax({
        'url':'action/all_agr_count_home.php',
         'type':'POST',
         success:function(data)
         {
              $('.all_agr').html(data);
         }
   });
};
function all_offices_count()
{
   $.ajax({
        'url':'action/all_offices_count_home.php',
         'type':'POST',
         success:function(data)
         {
              $('.all_offices').html(data);
         }
   });
};
function all_recolte_count()
{
   $.ajax({
        'url':'action/all_recolte_count_home.php',
         'type':'POST',
         success:function(data)
         {
              $('.all_recolte').html(data);
         }
   });
};
function top_agr()
{
       $.ajax({
            'url' : 'action/top_agriculteurs.php',
            'type' : 'POST',
             success:function(data)
             {
                 $('.agr_list').html(data);
                 $.ajax({
                 url: '../js/slide_animation.js',
                 dataType: "script",
                 });
             }
       });
}