let all_radio2 = document.querySelectorAll('.filter form label');
let forms2  = document.querySelectorAll('.filter form ');

forms2.forEach((element)=>{
  element.addEventListener('submit',(e)=>{
      
      e.preventDefault();
  })
  
})

all_radio2.forEach((element)=>{
  element.addEventListener('click',()=>{
      
      all_radio2.forEach((element2)=>{
            if((element2.children[0].className).includes('round_selected'))
            {
              element2.children[0].classList.remove('round_selected');
            }
      });
      element.children[0].classList.add('round_selected');
  })
  
})
