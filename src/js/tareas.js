(()=>{

    obtenerTareas();
    
    // Boton para mostrar el modal de agregar tarea.
    const nuevaTareaBtn = document.querySelector('#agregar-tarea');
    nuevaTareaBtn.addEventListener('click', mostrarFormulario);


   async function obtenerTareas(){
        try {
            const id = obtenerProyecto()
            const url = `http://localhost:3000/api/tareas?urlProyecto=${id}`;
            const respuesta = await fetch(url);
            const resultado = await respuesta.json();
            const {tareas} = resultado;
          
            mostrarTareas(tareas);
          
        } catch (error) {
            console.log(error)
        }
    }

    function mostrarTareas(tareas){
    
        if(tareas.length == 0){
            const contenedorTareas = document.querySelector('#listado-tareas');
            const textoNoTareas = document.createElement('LI');
            textoNoTareas.textContent = "No hay tareas";
            textoNoTareas.classList.add('no-tareas');
            contenedorTareas.appendChild(textoNoTareas);
            return;
        }
        tareas.forEach(tarea=>{
            const contenedorTarea = document.createElement('LI');
            contenedorTarea.dataset.tareaId = tarea.id;
            contenedorTarea.classList.add('tarea');

            const nombreTarea = document.createElement('P');
            nombreTarea.textContent = tarea.nombre;

            console.log(contenedorTarea.nextElementSibling)

            
        })
    }
    function mostrarFormulario(){
        const modal = document.createElement('DIV');
        modal.classList.add("modal");
        modal.innerHTML = `
            <form class="formulario nueva-tarea">
                <legend>Añade una nueva tarea</legend>
                <div class="campo">
                    <label>Tarea</label>
                    <input type="tarea" name="tarea" placeholder="Añade una nueva tarea al proyecto actual" id="tarea"/>
                </div>
                <div class="opciones">
                    <input type="submit" class="submit-nueva-tarea" value="Añadir tarea"/>
                    <button type="button" class="cerrar-modal">Cancelar</button>
                </div>
            </form>
        `
        setTimeout(()=>{
            const formulario = document.querySelector('.formulario');
            formulario.classList.add('animar');
        },0);        

        modal.addEventListener('click',(e)=>{
            e.preventDefault();
            if(e.target.classList.contains('cerrar-modal') || e.target.classList.contains('modal')){
                const formulario = document.querySelector('.formulario');
                formulario.classList.add('cerrar');
                setTimeout(()=>{
                    //Elimina el nodo
                    modal.remove();
                },500)
            }
            if(e.target.classList.contains('submit-nueva-tarea')){
               submitFormularioNuevaTarea()
            }
        })

        document.querySelector('.dashboard').appendChild(modal);
    }



    function submitFormularioNuevaTarea(){
        const tarea = document.querySelector('#tarea').value.trim();
        if(tarea === ''){
            // Mostrar una alerta de error
            mostrarAlerta('El nombre de la tarea es obligatorio',"error",document.querySelector('.formulario legend'));

            return;
        }
        agregarTarea(tarea);

    }

    // Consultar el servidor para añadir una nueva tarea al proyecto actual
    async function agregarTarea(tarea){
        // Construir la peticion
        const datos = new FormData();
        datos.append('nombre',tarea);
        datos.append('idProyecto',obtenerProyecto());

        try {
            const url = "http://localhost:3000/api/tarea";
            const respuesta = await fetch(url,{
                method:"POST",
                body: datos
            });

            const resultado = await respuesta.json();
            mostrarAlerta(resultado.mensaje,resultado.tipo,document.querySelector('.formulario legend'));
            if(resultado.tipo === "exito"){
                const modal = document.querySelector('.modal');
                setTimeout(()=>{
                    modal.remove();
                },2000)
            }
            


        } catch (error) {
            console.log(error);
        }
        

    }

    // Muestra un mensaje en la interfaz
    function mostrarAlerta(mensaje, tipo, referencia){
        //Previene la creacion de nuevas alertas
        const alertaPrevia = document.querySelector('.alerta');
        if(alertaPrevia) alertaPrevia.remove();

        const alerta = document.createElement('DIV');
        alerta.classList.add('alerta',tipo);
        alerta.textContent = mensaje;
        //Inserta la alerta antes del div de campo y despues del legend
        referencia.parentElement.insertBefore(alerta,referencia.nextElementSibling);

        //Eliminar la alerta despues de 5s

        setTimeout(()=>{
            alerta.remove();
        },5000)
    }

    function obtenerProyecto(){

            // Obtener los datos de la URL, como la url del proyecto y mas
            const proyectosParams = new URLSearchParams(window.location.search);
            const proyecto = Object.fromEntries(proyectosParams.entries());

            return proyecto.urlProyecto;
    }

  

})();

