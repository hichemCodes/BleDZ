$(document).ready(function()
{
    //onload     
    chart_recoltes(2020);  
    chart_money(2020);    

    // call chart generator when changing the current year 
    $('.chart_year').on('change',function(){

        chart_recoltes($('.chart_year').val());
    });

    $('.chart_year_money').on('change',function(){

        chart_money($('.chart_year_money').val());
    });
    


});


 
/////// fetch all recolte data by months

function chart_recoltes(year)
         {
        
         $.ajax({
                  url : 'action/chart_line_all_year.php',
                  type : 'POST',
                  dataType : 'JSON',
                  data : { year : year , action : 'recoltes' },
                  beforeSend : function()
                  {
                      $('.my_chart_container').append('<div class="lds-ripple l-1"><div></div><div></div></div>');
                  },
                  success : function(data)
                  {
                      let filter_data = data.result; //replace all null with 0 before using chart js 

                      filter_data.forEach((element,index,theArray) =>{
                              if(element == null) theArray[index] = 0;
                      }); 
                       // remove loading 
                       $('.l-1').remove();
                      generate_chart(filter_data,'myChart','Quantité en tonne');
                     

                     
                  }
         });
      }

/////
/////// fetch all money data by months

function chart_money(year)
         {
        
         $.ajax({
                  url : 'action/chart_line_all_year.php',
                  type : 'POST',
                  dataType : 'JSON',
                  data : { year : year ,action : 'money'},
                  beforeSend : function()
                  {
                      $('.my_chart_money_container').append('<div class="lds-ripple l-2"><div></div><div></div></div>');
                  },
                  success : function(data)
                  {
                    
                      let filter_data = data.result; //replace all null with 0 before using chart js 

                      filter_data.forEach((element,index,theArray) =>{
                              if(element == null) theArray[index] = 0;
                      }); 
                      // remove loading 
                      $('.l-2').remove();
                      generate_chart(filter_data,'myChart_money','Montant en DA');
                     

                     
                  }
         });
      }

/////
function generate_chart(data_array,element_id,label_s)
{

let recoltes_chart = document.querySelector('#'+element_id).getContext('2d');

// Flobas Options 
Chart.defaults.global.defaultFontSize = 15;
Chart.defaults.global.defaultFontColor = '#5d5d5d';


let chart_output = new Chart(recoltes_chart,{

      type : 'line',
      data:{
              labels : ["Janvier", "février", "mars", "avril", "mai", "juin", "juillet", "août", "septembre", "octobre", "novembre", "décembre"],
              datasets:[{
                      label : label_s,
                      data : data_array,
                      backgroundColor : 'transparent',
                     
                      borderColor : '#f1cf69',
                      borderWidth : 3,
                      pointBorderWidth : 3,
                      hoverBorderWidth : 7,                   
                       },
                       
                     ]
              
      },
      options:{},
});

}



