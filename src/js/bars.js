const mobileMenuBtn = document.querySelector('#mobile-menu');
const closeMenuBtn = document.querySelector('#cerrar-menu');
const sidebar = document.querySelector('.sidebar');
if(mobileMenuBtn){
    mobileMenuBtn.addEventListener('click',()=>{
        sidebar.classList.toggle('mostrar');
    })
}
if(closeMenuBtn){
    closeMenuBtn.addEventListener('click',()=>{
        sidebar.classList.remove('mostrar');
    })
}