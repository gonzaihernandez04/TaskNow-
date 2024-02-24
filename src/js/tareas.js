(() => {
  obtenerTareas();
  clickBotonFiltros();
  let filtradas = [];

  let tareas = [];
  // Boton para mostrar el modal de agregar tarea.
  const nuevaTareaBtn = document.querySelector("#agregar-tarea");
  nuevaTareaBtn.addEventListener("click", () => {
    mostrarFormulario();
  });

  async function obtenerTareas() {
    try {
      const id = obtenerProyecto();
      const url = `http://localhost:3000/api/tareas?urlProyecto=${id}`;
      const respuesta = await fetch(url);
      const resultado = await respuesta.json();
      tareas = resultado.tareas;

      mostrarTareas(tareas);
    } catch (error) {
      console.log(error);
    }
  }

  function mostrarTareas(tareas) {
    limpiarTareas();
    const contenedorTareas = document.querySelector("#listado-tareas");

    if (tareas.length == 0) {
      const textoNoTareas = document.createElement("LI");
      textoNoTareas.textContent = "No hay tareas";
      textoNoTareas.classList.add("alerta", "aviso");
      textoNoTareas.style.textAlign = "center";
      contenedorTareas.appendChild(textoNoTareas);
      return;
    }
    const estados = {
      0: "Pendiente",
      1: "Completada",
    };

    tareas.forEach((tarea) => {
      const contenedorTarea = document.createElement("LI");
      contenedorTarea.dataset.tareaId = tarea.id;
      contenedorTarea.classList.add("tarea");

      const nombreTarea = document.createElement("P");
      nombreTarea.textContent = tarea.nombre;
      nombreTarea.ondblclick = () => {
        mostrarFormulario(true, { ...tarea });
      };

      const opcionesDiv = document.createElement("DIV");
      opcionesDiv.classList.add("opciones");

      // Botones

      const btnEstadoTarea = document.createElement("BUTTON");
      btnEstadoTarea.classList.add("estado-tarea");
      btnEstadoTarea.classList.add(`${estados[tarea.estado].toLowerCase()}`);
      btnEstadoTarea.textContent = estados[tarea.estado];
      btnEstadoTarea.dataset.estadoTarea = tarea.estado;

      const btnEliminarTarea = document.createElement("BUTTON");
      btnEliminarTarea.classList.add("eliminar-tarea");
      btnEliminarTarea.textContent = "Eliminar tarea";
      btnEliminarTarea.dataset.idTarea = tarea.id;

      opcionesDiv.appendChild(btnEstadoTarea);
      opcionesDiv.appendChild(btnEliminarTarea);

      contenedorTarea.appendChild(nombreTarea);
      contenedorTarea.appendChild(opcionesDiv);

      contenedorTareas.appendChild(contenedorTarea);

      // Cambiar estado tarea
      btnEstadoTarea.onclick = () => {
        cambiarEstadoTarea(tarea);
      };

      // Eliminar la tarea
      btnEliminarTarea.onclick = () => {
        confirmarEliminarTarea(tarea);
      };
    });
  }

  // Funcion que crea modal, componentes del formulario y animaciones.
  function mostrarFormulario(editar = false, tarea) {
    const modal = document.createElement("DIV");
    modal.classList.add("modal");
    modal.innerHTML = `
            <form class="formulario nueva-tarea">
                <legend>${
                  editar ? "Editar tarea" : "Añade una nueva tarea"
                }</legend>
                <div class="campo">
                    <label>Tarea</label>
                    <input type="tarea" name="tarea" placeholder="${
                      editar
                        ? "Editar tarea"
                        : "Añade una nueva tarea al proyecto actual"
                    }" id="tarea" value="${tarea ? tarea.nombre : ""}"/>
                </div>
                <div class="opciones">
                    <input type="submit" class="submit-nueva-tarea" value="${
                      editar ? "Guardar los cambios" : "Añade una nueva tarea"
                    }"/>
                    <button type="button" class="cerrar-modal">Cancelar</button>
                </div>
            </form>
        `;
    setTimeout(() => {
      const formulario = document.querySelector(".formulario");
      formulario.classList.add("animar");
    }, 0);

    modal.addEventListener("click", (e) => {
      e.preventDefault();
      if (
        e.target.classList.contains("cerrar-modal") ||
        e.target.classList.contains("modal")
      ) {
        const formulario = document.querySelector(".formulario");
        formulario.classList.add("cerrar");
        setTimeout(() => {
          //Elimina el nodo
          modal.remove();
        }, 500);
      }
      if (e.target.classList.contains("submit-nueva-tarea")) {
        const nombreTarea = document.querySelector("#tarea").value.trim();
        if (tarea === "") {
          // Mostrar una alerta de error
          mostrarAlerta(
            "El nombre de la tarea es obligatorio",
            "error",
            document.querySelector(".formulario legend")
          );

          return;
        }

        if (!editar) {
          agregarTarea(nombreTarea);
          return;
        }
        tarea.nombre = nombreTarea;
        actualizarTarea(tarea);
      }
    });

    document.querySelector(".dashboard").appendChild(modal);
  }

  function clickBotonFiltros() {
    const inputFiltros = document.querySelectorAll("#filtro");
    if (inputFiltros) {
      inputFiltros.forEach((input) => {
        input.onclick = () => {
          filtrarTareas(input);
        };
      });
    }
  }

  function filtrarTareas(filtro) {
      if (filtro.value == "") {
        mostrarTareas(tareas);
        return;
      }
      filtradas = tareas.filter((tarea) => tarea.estado == filtro.value);
      mostrarTareas(filtradas);
    
  }

  // Consultar el servidor para añadir una nueva tarea al proyecto actual
  async function agregarTarea(nombreTarea) {
    // Construir la peticion
    const datos = new FormData();
    datos.append("nombre", nombreTarea);
    datos.append("idProyecto", obtenerProyecto());

    try {
      const url = "http://localhost:3000/api/tarea";
      const respuesta = await fetch(url, {
        method: "POST",
        body: datos,
      });

      const resultado = await respuesta.json();
      dispararSwal("success", "Exito", "Tarea creada correctamente");
      if (resultado.tipo === "exito") {
        // Agregar el objeto de tarea al global de tareas

        const tareaObj = {
          id: resultado.id.toString(),
          nombre: nombreTarea,
          estado: "0",
          idProyecto: resultado.idProyecto,
        };

        tareas = [...tareas, tareaObj];
        mostrarTareas(tareas);
        const modal = document.querySelector(".modal");
        if (modal) {
          modal.remove();
        }
      }
    } catch (error) {
      console.log(error);
    }
  }

  function cambiarEstadoTarea({ ...tarea }) {
    const nuevoEstado = tarea.estado === "0" ? "1" : "0";
    tarea.estado = nuevoEstado;
    actualizarTarea(tarea);
  }

  // Funcion que actualiza el proyecto, tanto en el servidor como en el front y lo sincroniza para que se muestren los resultados al instante
  async function actualizarTarea(tarea) {
    const { id, estado, nombre } = tarea;

    const datos = new FormData();
    datos.append("id", id);
    datos.append("nombre", nombre);
    datos.append("estado", estado);
    datos.append("urlProyecto", obtenerProyecto());

    try {
      const url = "http://localhost:3000/api/tarea/actualizar";

      const respuesta = await fetch(url, { method: "POST", body: datos });
      const resultado = await respuesta.json();
      if (resultado.tipo === "exito") {
        dispararSwal("success", "Exito", "Tarea actualizada correctamente");
        tareas = tareas.map((tareaMemoria) => {
          if (tareaMemoria.id === id) {
            console.log(tareaMemoria.estado);
            tareaMemoria.estado = estado;
            tareaMemoria.nombre = nombre;
            console.log((tareaMemoria.estado = estado));
          }
          return tareaMemoria;
        });

        const modal = document.querySelector(".modal");

        if (modal) modal.remove();

        mostrarTareas(tareas);
      }
    } catch (error) {
      console.log(error);
    }
  }

  async function eliminarTarea(tarea) {
    const { id, estado, nombre, idProyecto } = tarea;
    const url = "http://localhost:3000/api/tarea/eliminar";
    const datos = new FormData();
    datos.append("id", id);
    datos.append("idProyecto", idProyecto);
    datos.append("nombre", nombre);
    datos.append("estado", estado);

    const respuesta = await fetch(url, { method: "POST", body: datos });
    const resultado = await respuesta.json();

    if (resultado.tipo === "exito") {
      dispararSwal("success", "Exito", "Tarea borrada correctamente");

      tareas = tareas.filter((tareaMemoria) => tareaMemoria.id != id);
      mostrarTareas(tareas);
    } else {
      dispararSwal("error", "Oops..", "La tarea no se pudo borrar");
    }
  }

  // Muestra un mensaje en la interfaz
  function mostrarAlerta(mensaje, tipo, referencia) {
    //Previene la creacion de nuevas alertas
    const alertaPrevia = document.querySelector(".alerta");
    if (alertaPrevia) alertaPrevia.remove();

    const alerta = document.createElement("DIV");
    alerta.classList.add("alerta", tipo);
    alerta.textContent = mensaje;
    //Inserta la alerta antes del div de campo y despues del legend
    referencia.parentElement.insertBefore(
      alerta,
      referencia.nextElementSibling
    );

    //Eliminar la alerta despues de 5s

    setTimeout(() => {
      alerta.remove();
    }, 6000);
  }

  // Obtiene la URL del proyecto a traves de la URL
  function obtenerProyecto() {
    // Obtener los datos de la URL, como la url del proyecto y mas
    const proyectosParams = new URLSearchParams(window.location.search);
    const proyecto = Object.fromEntries(proyectosParams.entries());

    return proyecto.urlProyecto;
  }

  // Limpia el HTML de tareas
  function limpiarTareas() {
    const listadoTareas = document.querySelector("#listado-tareas");

    listadoTareas.innerHTML = "";
  }

  // Pregunta si se quiere borrar la tarea
  function confirmarEliminarTarea(tarea) {
    Swal.fire({
      title: "¿Estas seguro que queres eliminar la tarea?",
      showDenyButton: true,
      confirmButtonText: "Si, estoy seguro",
      cancelButtonText: "No",
    }).then((result) => {
      /* Read more about isConfirmed, isDenied below */
      if (result.isConfirmed) {
        eliminarTarea(tarea);
      }
    });
  }

  function dispararSwal(icono, titulo, texto) {
    Swal.fire({
      icon: icono,
      title: titulo,
      text: texto,
      button: "OK",
    });
  }
})();
