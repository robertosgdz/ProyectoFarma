<?php
    require_once("menu.php");
?>
<div class="login-wrapper">
    <div class="login-container">
        <form action="" method="post" class="login-form">
            <div class="form-group">
                <label for="nombre"><b>Username</b></label>
                <input type="text" placeholder="Usuario..." name="nombre" id="nombre" required>
            </div>
            <div class="form-group">
                <label for="passwd"><b>Password</b></label>
                <input type="password" placeholder="Contraseña..." name="passwd" id="passwd" required>
            </div>
            <input type="submit" name="submit" value="Login" class="login-button">
        </form>
    </div>
</div>
<?php
    echo $message;
?>
