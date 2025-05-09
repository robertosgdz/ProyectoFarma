<?php
require_once("menu.php");
?>

<div class="login-wrapper">
    <div class="login-container">
        <!-- Logo de PFARMA -->
        <div class="logo-container">
            <h1 class="logo-text">PFARMA</h1>
        </div>

        <!-- Título del formulario -->
        <h2>Inicio de sesión</h2>

        <!-- Formulario de login -->
        <form action="" method="post" class="login-form">
            <div class="form-group">
                <label for="nombre"><b>Usuario</b></label>
                <input type="text" placeholder="Usuario..." name="nombre" id="nombre" required>
            </div>

            <div class="form-group">
                <label for="passwd"><b>Contraseña</b></label>
                <input type="password" placeholder="Contraseña..." name="passwd" id="passwd" required>
            </div>

            <input type="submit" name="submit" value="Login" class="login-button">
        </form>

        <!-- Mensaje de error o información -->
        <?php if (!empty($message)): ?>
            <div class="mt-3 alert alert-danger text-center" role="alert">
                <?= htmlspecialchars($message) ?>
            </div>
        <?php endif; ?>

        <!-- Enlace opcional para registrarse -->
        <!--
        <div style="margin-top: 15px; text-align: center;">
            <p>¿No tienes cuenta? 
                <a href="index.php?controlador=usuarios&action=registro">Regístrate aquí</a>
            </p>
        </div>
        -->
    </div>
</div>

