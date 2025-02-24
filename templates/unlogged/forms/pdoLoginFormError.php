<form action="pdoLoginCoffee.php" method="post">
    <div class="formDiv">
        <label for="username" class="formLabel">
            Nombre de usuario:
            <input type="text" name="username" id="username" value="<?=$_POST['username']?>">
        </label>
        <label for="password" class="formLabel">
            Contraseña:
            <input type="password" name="password" id="password">
        </label>
    </div>
    <span>El nombre de usuario o contraseña son incorrectos, por favor, inténtelo de nuevo</span>
    <label for="submit" class="formLabel">
        Enviar:
        <input type="submit" value="Enviar" id="submit">
    </label>
</form>