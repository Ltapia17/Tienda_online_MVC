<h1>Gestion de productos</h1>

<a href="<?= RUTE_URL ?>/producto/crear"><button class="small">Crear Producto</button></a>
</br>
<?php if (isset($_SESSION['producto']) && $_SESSION['producto'] == 'complete') : ?>
    <strong class="alert-green">Producto Ingresado</strong>

<?php elseif(isset($_SESSION['producto']) && $_SESSION['producto'] != 'complete'): ?>
<strong class="alert-red">Hubo un problema al ingresar el producto</strong>
    <?php endif; ?>
    <?php Util::deleteSession('producto'); ?>


<?php if (isset($_SESSION['delete']) && $_SESSION['delete'] == 'complete') : ?>
    <strong class="alert-green">Producto eliminado</strong>

<?php elseif(isset($_SESSION['delete']) && $_SESSION['delete'] != 'complete'): ?>
<strong class="alert-red">Hubo un problema al eliminar el producto</strong>
    <?php endif; ?>
    <?php Util::deleteSession('delete'); ?>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Descripcion</th>
        <th>Fecha</th>
        <th>Stock</th>
        <th>Precio</th>
        <th>Acciones</th>
    </tr>

    <?php while ($pro = $productos->fetch_object()) : ?>
        <tr>

            <td><?= $pro->id ?></td>
            <td><?= $pro->nombre ?></td>
            <td><?= $pro->descripcion ?></td>
            <td><?= $pro->fecha ?></td>
            <td><?= $pro->stock ?></td>
            <td><?= $pro->precio ?></td>
            <td>
                <a href="<?=RUTE_URL ?>/producto/edit&id=<?=$pro->id?>"><button class="button-green">Editar</button></a>
                <a href="<?=RUTE_URL ?>/producto/delete&id=<?=$pro->id?>"><button class="button-red">Borrar</button ></a>
            </td>

        </tr>

    <?php endwhile; ?>
</table>