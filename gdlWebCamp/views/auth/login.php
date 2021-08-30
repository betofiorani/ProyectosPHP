<main class="contenedor seccion contenido-centrado">
    <h1 data-cy="titulo-login">Iniciar Sesión</h1>
    <?php 
        foreach($errores as $error):
    ?>
    <div data-cy="alerta-login" class="alerta error"><?php echo $error; ?></div>
    <?php 
        endforeach;
    ?>
    <form data-cy="formulario-login" class="formulario" method="POST" action="/login" novalidate>
        <fieldset>
            <legend>Usuario y Password</legend>
            <label for="usuario">Usuario</label>
            <input data-cy="login-usuario" type="text" name="login[usuario]" id="usuario" placeholder="Ingresa tu Usuario" required>
            <label for="password">Password</label>
            <input data-cy="login-password" type="password" name="login[password]" id="password" placeholder="Ingresa tu contraseña" required>
        </fieldset>
        <input type="submit" class="boton boton-marron" value="Iniciar Sesión">
    </form>
</main>