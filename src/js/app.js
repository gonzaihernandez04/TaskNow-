document.addEventListener('DOMContentLoaded',()=>{
    iniciarApp();
});


function iniciarApp(){
    //Marca en rojo los proyectos a eliminar y muestra la papelera
   marcarProyectos();

   //Funcion para mensaje de confirmar al eliminar un proyecto
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
            papelera.dataset.urlEliminar = `${idProyecto}`;

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

            dispararSwal("success","Exito","Proyecto borrado correctamente",`/eliminar?urlProyecto=${papelera.dataset.urlEliminar}`);
           
        }
    })
}

function dispararSwal(icono,titulo,texto,url){

    Swal.fire({
        icon: icono,
        title: titulo,
        text: texto,
        button: "OK",
      }).then(() => {
        //Actualizo la pagina
            window.location = url;

      },3000);
}

