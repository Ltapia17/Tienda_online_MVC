<h1>Gestionar Categoria</h1>
<a href="<?=RUTE_URL ?>/categoria/crear"><button class="small">Crear Categoria</button></a>
<table border="1">
        <tr>
            <th>ID</th>
            <th>Nombre</th>
        </tr>
        
        <?php while ($cat = $categorias->fetch_object()) : ?>
        <tr>
            <td><?=$cat->id ?></td>
            <td><?=$cat->nombre ?></td>
        </tr>

    <?php endwhile; ?>
</table>