let back = document.querySelectorAll('.back');


back.forEach((element)=>{


    element.addEventListener('click', () => {   
        localStorage.clear();
        document.location.reload();
    
                });

})
