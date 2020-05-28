//// variabel

let btn_nxt = document.querySelector('.next');
let select= document.querySelector('.select');
let dest = document.querySelector('.output');
let form_argr = document.querySelector('.form_argr');
let form_office = document.querySelector('.form_office');

let f_header = document.querySelector('.f_header');

import  wilayas  from "./wilayas.js";


//////

///function to get the selected text

function getSelectedText(elt) {
    

  if (elt.selectedIndex == -1)
      return null;

  return elt.options[elt.selectedIndex].text;
}



if(  (localStorage.getItem('type')) === null) {


  btn_nxt.addEventListener('click',()=>{

      // remove previous error
      if(select.classList.contains('error'))
      {
           $('.select').removeClass('error b_error');
           $('.err').html(''); 
      }

       
      if((getSelectedText(select) == 'Agriculteur')){

            localStorage.setItem('type','Agriculteur')
            form_argr.classList.remove('hidden');

            show_form();

      }
      else if ((getSelectedText(select) == 'Office du blé'))
      {

                localStorage.setItem('type','Office du blé')
                form_office.classList.remove('hidden');

                show_form();

      }
      else
      {
                $('.select').addClass('error b_error');
                $('.err').html('il faut choisir un type de compte !');
      }
        

  });
}
else{
  if(localStorage.getItem('type') == 'Agriculteur')
      {

            form_argr.classList.remove('hidden');
      }
      else
      {
            form_office.classList.remove('hidden');
      }
          f_header.classList.add('hidden');
          let select_w = document.querySelectorAll('.select2')[0];
          let select_w_2 = document.querySelectorAll('.select2')[1];

            wilayas.forEach((Element)=>{

                select_w.innerHTML+=`<option value="${Element.id}">${Element.nom}</option>`;
                select_w_2.innerHTML+=`<option value="${Element.id}">${Element.nom}</option>`;
            });
}


function show_form()
{
        f_header.classList.add('hidden');

        let select_w = document.querySelectorAll('.select2')[0];
        let select_w_2 = document.querySelectorAll('.select2')[1];

        wilayas.forEach((Element)=>{

            select_w.innerHTML+=`<option value="${Element.id}">${Element.nom}</option>`;
            select_w_2.innerHTML+=`<option value="${Element.id}">${Element.nom}</option>`;

        });
}