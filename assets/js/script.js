//BARRA DE NAVEGAÇÃO ACTIVE
const menuLi = document.querySelectorAll('.header-menu a');
function destacarMenu(e) {
    menuLi.forEach((item) => {
        item.classList.remove('active');
        console.log(item);
    });

    e.target.classList.add('active');
}

/*menuLi.forEach((item) => {
    item.addEventListener('click', destacarMenu);
});*/
