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
            <legend>Email y Password</legend>
            <label for="email">Email</label>
            <input data-cy="login-mail" type="email" name="login[email]" id="email" placeholder="Ingresa tu mail" required>
            <label for="password">Password</label>
            <input data-cy="login-password" type="password" name="login[password]" id="password" placeholder="Ingresa tu contraseña" required>
        </fieldset>
        <input type="submit" class="boton boton-morado" value="Iniciar Sesión">
    </form>
</main>