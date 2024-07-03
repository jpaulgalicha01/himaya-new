const menuCustom = document.querySelector ('.menu-custom');
const menu = document.querySelector ('.menu');
const dropdownCustom = document.querySelector ('.dropDownContent');
let menuOpen = false;
menuCustom.addEventListener('click', () =>{
    if(!menuOpen) {
        menuCustom.classList.add('open');
        menu.classList.add('active');
        dropdownCustom.classList.add('active'); 
        menuOpen = true;    
    }
    else {
        menu.classList.remove('active');
        menuCustom.classList.remove('open');
        menuOpen = false;
        dropdownCustom.classList.remove('active');
        
    }
});

function categories() {
   
     const link2Btn = document.querySelector ('.link-2');
     const link1Btn = document.querySelector ('.link-1');
     let menuOpen = false;

     if(!menuOpen) {
         link2Btn.classList.add('open');
         link1Btn.classList.add('change');
         menuOpen = true;
     }
}
function categoriesBack() {
   
    const link2Btn = document.querySelector ('.link-2');
    const link1Btn = document.querySelector ('.link-1');
    let menuOpen = false;

    if(!menuOpen) {
        link2Btn.classList.remove('open');
        link1Btn.classList.remove('change');
        menuOpen = true;
    }
}