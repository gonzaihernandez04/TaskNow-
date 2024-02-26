<aside class="sidebar">
    <div class="contenedor-sidebar">
        <h2>UpTask</h2>
        <div class="cerrar-menu">
            <img src="build/img/cerrar.svg" id="cerrar-menu" alt="imagen menu">
        </div>
    </div>

    <nav class="sidebar-nav">
        <a class="<?php echo ($titulo === 'Proyectos') ? 'activo' : ''; ?>" href="/dashboard">Proyectos</a>
        <a class="<?php echo ($titulo === 'Nuevo proyecto') ? 'activo' : ''; ?>" href="/crear-proyecto">Crear Proyecto</a>
        <a class="<?php echo ($titulo === 'Mi Perfil') ? 'activo' : ''; ?>" href="/perfil">Mi Perfil</a>
    </nav>

    <div class="cerrar-sesion-mobile">
        <a class="cerrar-sesion" href="/logout">Cerrar sesion</a>
    </div>
</aside>