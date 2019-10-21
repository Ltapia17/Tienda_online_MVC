<h1>Registrarse</h1>

<?php 
    if(isset($_SESSION['register']) && $_SESSION['register'] && $_SESSION['register'] == 'complete'): ?>
    <strong class="alert-green">Registro completado</strong>

<?php elseif(isset($_SESSION['register']) && $_SESSION['register'] && $_SESSION['register'] == 'failed'): ?>
    <strong class="alert-red">Debes ingresar bien los datos</strong>
<?php endif;?>

<?php Util::deleteSession('register'); ?>

<form action="<?php echo RUTE_URL?>/usuario/save" method="POST">

    <label for="">Nombre</label>
    <input type="text" name="nombre" required />
    <label for="">Apellido</label>
    <input type="text" name="apellido" required />
    <label for="">Email</label>
    <input type="email" name="email" />
    <label for="">Contraseña</label>
    <input type="password" name="password" required />
    <input type="submit" value="registrarse" />
</form>