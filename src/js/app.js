document.addEventListener('DOMContentLoaded',()=>{
    iniciarApp();
});


function iniciarApp(){
    marcarProyectos();
}


function marcarProyectos() {
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

            const idProyecto = breakSpace(proyecto);
            papelera.href = `/eliminar?urlProyecto=${idProyecto}`;
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
