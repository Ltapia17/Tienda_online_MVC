<h1>Crear nueva Categoria</h1>

<form action="<?=RUTE_URL ?>/categoria/save" method="POST">
    <label for="nombre">Categoria</label>
    <input type="text" name="nombre" />
    <input type="submit" value="Guardar">
</form>