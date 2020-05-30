
let all_link = document.querySelectorAll('.section');

all_link.forEach( (element)=>{
     
    element.addEventListener('click',()=>{
            
            document.title = '  BléDZ | '+element.children[1].innerText;



    });
});

// dashboard click click event handler
all_link[0].addEventListener('click',()=>{

    location.reload();

});
// all acount valid click event handler
all_link[1].addEventListener('click',()=>{
    all_account();
    show_all_offices();

    
});
/// valid account click event handler
all_link[2].addEventListener('click',()=>{

    all_invalid_accounts();
    show_invalid_offices();
});
// rendez-vous click event handler
all_link[3].addEventListener('click',()=>{
    rendez_vous_prise();
    rendez_vous_non_prise();
});
// recoltes click event handler
all_link[4].addEventListener('click',()=>
{

    show_all_recolte_office('date');  // classer la récolte par date la premiere fois 
    show_all_recolte_office_année(); 

});
// account setting
all_link[7].addEventListener('click',()=>
{
    show_update_profile_form();
});
// logout click event handler
document.querySelector('.log_out_link').addEventListener('click',()=>
{
    localStorage.setItem('active','Dashboard');
});


