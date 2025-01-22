<form method="GET" action="<?php echo htmlspecialchars($_SERVER['PHP_SELF']); ?>">

    <div>
        <p>Email:
        <input class="email" type="text" name="user"  style="margin-bottom: 10px;"> <br /></p>
        <p>Clave:
        <input class="pwd" type="password" name="pwd"  style="margin-bottom: 10px;"> <br /></p>
        <br />
        <div class="diventrar">
            <input type="submit" name="enviar" value="Entrar">
            <input type="hidden" name="action" value="userValidate">
        </div>
    </div>

</form>
