<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Login</title>
</head>

<body>
	<?=validation_errors()?>
	<?=form_open('iniciar-sesion');?>
		<fieldset>
			<label for="usuario">Correo electrónico:</label>
			<input type="text" name="usuario" id="usuario"/>
			<label for="usuario">Contraseña:</label>
			<input type="password" name="contrasenia" id="contrasenia"/>
			<input type="submit" value="Iniciar sesión"/>
		</fieldset>
	</form>
	
</body>
</html>