
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
 
  
   let Colorss = [ 
    "#4e99cf",
    "#8e5ea2",
    "#3cba9f",
    "#e8c3b9",
    "#c45850",
    "#F0B67F",
    "#C7EFCF",
    "#7E8D85",
    "AntiqueWhite",
    "tomato",
    "Azure",
    "Salamon",
    "Wheat",
    "#8bc34a",
    "#B3BFB8",
    "#fd966d",//alger
    "#777",
    "#e6e1ff",
    "",
    "#ff5722",
    "turquoise",
    "#e91e63",
    "#f1cf69",//annaba
    "#673ab7",
    "#cddc39",
    "#ffeb99",
    "#2196f3",
    "chocolate",
    "hotpink",
    "#cddc99",
    "lemonchiffon",
    "#ffeb3b",
    "#d6af7b",
    "",
    "",
    "#242526",
    "#2C5364",
    "#F37335",
    "#DAD299",
    "#D1913C",
    "#ec38bc",
    "#b6fbff",
    "#83a4d4",
    "#FFAFBD",
    "#C04899",
    "cyan",
    "#ED213A",
    "#727a17"
 ];

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
                        backgroundColor: Colorss,
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
