document.addEventListener('DOMContentLoaded',()=>{
    iniciarApp();
});


function iniciarApp(){
   marcarProyectos();
   confirmPapelera();
}


function marcarProyectos() {
    let idProyecto;
    //Seleccionar los proyectos
    const proyectos = document.querySelectorAll('.proyecto');
    //Seleccionar la papelera(tempalte de php reutilizable)
    const papelera = document.querySelector('.papelera');

    //Comprobar proyectos
    if (!proyectos) return;

    //Recorrer proyectos
    proyectos.forEach(proyecto => {
        proyecto.addEventListener('click', () => {
            
            // Deseleccionar todos los proyectos
            deseleccionarProyectos(proyectos);

            // Marcar el proyecto actual
            proyecto.classList.add('marcar');

            // Mostrar la papelera solo si el proyecto está marcado
            papelera.classList.add('visibilidad');

             idProyecto = breakSpace(proyecto);
            papelera.href=`/eliminar?urlProyecto=${idProyecto}`;

        });
    });

}

   // Función para deseleccionar todos los proyectos
   const deseleccionarProyectos = (proyectos) => {
    proyectos.forEach(proyecto => {
        proyecto.classList.remove('marcar');
    });
};

function breakSpace(proyecto) {
    const idProyecto = proyecto.classList;
    return idProyecto[1];
}

//Funcion para preguntar si de verdad quiere borrar un proyecto
function confirmPapelera(){
    //Selecciono la papelera
    const papelera = document.querySelector('.papelera');
    //Evaluo si hay una papelera existente
    if(!papelera) return;

    //Cuando se clickee la papelera seleccionada, pregunta si se esta seguro de querer borrar el proyecto, en caso de que si, refirecciona al href de la papelera que ya posee la id del Proyecto
    papelera.addEventListener('click',()=>{
        if(confirm("¿Estas seguro que queres borrar el proyecto?")){
            window.location.href = papelera.href;
        }
    })
}
