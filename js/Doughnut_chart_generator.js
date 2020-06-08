
// import wilayas 
import  wilayas  from "./wilayas.js";
import  Colors  from "./colors_chart.js";


$(document).ready(function(){
    
    fetch_data(2020);

    $('.chart_year_wilayas').on('change',function()
    {
         fetch_data($('.chart_year_wilayas').val());
    })
    
});

// fetch data from db  

function fetch_data(year)
{
    $.ajax({
           url : 'action/Doughnut_chart.php',
           method : 'POST',
           dataType : 'JSON',
           data : { year : year},
           beforeSend : function()
           {
               $('.my_chart_doughnut_container').append('<div class="lds-ripple l-3"><div></div><div></div></div>');
           },
           success:function(data)
           {
              //remove loader animation
              $('.l-3').remove();
              Doughnut_chart(data.result);
              
           }
    })
}

/// create a array contain only wilayas name from wilayas object
   let wilayas_name = [];

   wilayas.forEach( (wilaya) =>{
         
            wilayas_name.push(wilaya.nom);

   });
 
  
   

/// generate a Doughnut chart using chart js 

function Doughnut_chart(result)
{
      let element = document.querySelector('#myChart_wilayas').getContext('2d');
      let chart_output = new Chart(element,{
          type : 'doughnut',//'doughnut',
          data : {
               labels : wilayas_name,
               datasets : [
                   {
                        label : 'Quantité en tonne',
                        backgroundColor: Colors,
                        data : result,

                   }
               ]
          },
          options: {
           legend: {
                position: 'left',
                
            },
          
        }
        
      });
}
