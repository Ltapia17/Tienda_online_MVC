<h1>Carrito de compra</h1>
<?php if (isset($_SESSION['carrito']) && count($_SESSION['carrito']) >= 1) : ?>
    <div class="delete-carrito">
        <a href="<?= RUTE_URL ?>/carrito/deleteAll"><button class="button-delete">Vaciar Carrito</button></a>
    </div>

    <table>
        <tr>
            <th>imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
            <th>Eliminar</th>
        </tr>


        <?php foreach ($_SESSION['carrito'] as $index => $elemento) :
                $producto = $elemento['producto'];
                ?>
            <tr>
                <td>
                <?php if ($producto->imagen != null) : ?>
                        <img src="<?= RUTE_URL ?>/uploads/images/<?=$producto->imagen?>" alt="" class="img-carrito">
                    <?php else: ?>
                        <img src="<?= RUTE_URL ?>/uploads/images/no-image.png" alt="" class="img-carrito">
                    <?php endif; ?>
                </td>
                <td>
                    <a href="<?= RUTE_URL ?>/producto/view&id=<?= $producto->id ?>"><?= $producto->nombre ?></a>
                </td>
                <td><?= $producto->precio ?></td>

                <td>
                    <a href="<?= RUTE_URL ?>/carrito/down&index=<?= $index ?>" class="button">-</a>

                    <?= $elemento['unidades'] ?>
                    <a href="<?= RUTE_URL ?>/carrito/up&index=<?= $index ?>" class="button">+</a>
                </td>
                <td><a href="<?= RUTE_URL ?>/carrito/delete&index=<?= $index ?>"><button class="button-red">Eliminar</button></a></td>
            </tr>
        <?php endforeach; ?>
    </table>

    <br>

    <div class="total-carrito">
        <?php $stats = Util::statsCart(); ?>
        <h3>Total a Pagar: $<?= $stats['total'] ?></h3> <br>
        <a href="<?= RUTE_URL ?>/pedido/hacer"><button>Realizar pedido</button></a>
    </div>

<?php else : ?>
    <h3>El carrito esta vacio, debes añadir productos</h3>
<?php endif; ?>