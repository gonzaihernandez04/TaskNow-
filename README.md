# TaskNow!

Lenguajes utilizados: PHP, SASS, JavaScript, MYSQL
Librerias: PHPMailer, PHPdotenv, SweetAlert2, PSR-4
Manejador de paquetes: Composer, NPM
Toolkits: GulpJS para compresion de imagenes, minificacion de CSS y JS. Se utiliza Sourcemaps para identificar a traves del navegador donde se establecio un estilo o un Script de JS.
Arquitecturas: MVC, ActiveRecord
Implementaciones necesarias para mejor UX: Virtual DOM, DarkMode a traves de nueva funcionalidad de CSS compatible con la mayoria de los navegadores modernos(@media(prefers-color-scheme)).
Meta data: Se establecieron los metadatos necesarios para mejorar el SEO.
Host gratuito: DOMCloud.
Tipo de dispositivos: Responsive para todos los dispositivos.
Tipo imagenes: Solo se utilizaron imagenes SVG para el menu de navegacion.
Consumir API: Fetch API. Creacion y solicitud.

Usuario para comenzar a crear: correo4@correo4.com

Contraseña: 1234567


Funciones de la pagina:
Crear cuenta, Iniciar sesion, Olvide contraseña(se genera un TOKEN de uso unico), confirmar cuenta(Token de uso unico es generado). Se utiliza MAIL TRAP que envia un MAIL para confirmar la cuenta. Crear, eliminar, actualizar, y visualizar proyectos y tareas. Ver perfil del usuario, cambiar mail, nombre y contraseña del mismo.

Este proyecto fue desarrollado con PHP, con el patron de diseño de MVC(Modelo vista controlador). Para la estilizacion de la aplicacion, se utilizo SASS, funciones mixins. se aprovecho la definicion de variables para elementos necesarios con el fin de no cometer ningun error a la hora de establecer un tamaño, una tipografia, un color, etc.
Asimismo, cada parte de estilos reutilizable, se creo un componente para no ser reduntante.

Se deja de lado el codigo SPAGHETTI, patron fuertemente criticado a PHP:

La arquitectura ActiveRecord consiste en tener un objeto por cada ALTA, BAJA, o UPDATE de la base de datos, sincronizando los cambios al instante. Esto explota la funcionalidad de POO en PHP. Junto a la arquitectura MVC, forman un framework muy parecido a LARAVEL.
Ver archivo -> ActiveRecord.php

El uso de namespaces fue importante debido al modelo establecido para este proyecto.

Para la sincronizacion CLIENTE SERVIDOR, se implemento VIRTUAL DOM, es decir, tal como utilizan librerias como REACT, Vue, SVELTE. Se crea una copia de los elementos originales como las tareas y nunca se mutan los datos originales al haber cambios. Una vez hecho los cambios, se renderiza la vista con este array, u objeto no mutado.


API: Se creo una API para que se puedan consumir las tareas de los proyectos, actualizarlas, eliminarlas y crearlas.


Funcionalidades agregadas al proyecto original:
Se agrego un nuevo dato: la descripcion del proyecto. Para que el usuario se ubique en que tenia planeado en cuanto al mismo.
Contar caracteres para el limite de la descripcion de una tarea. Segun la cantidad de caracteres el color cambia -> Ver proyecto.
Eliminar proyecto -> En la pestaña de proyectos, el usuario podra seleccionar 1 y borrarlo a traves de un boton que tiene como imagen una papelera de reciclaje.






