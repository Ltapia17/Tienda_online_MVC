<h1>Detalle Pedido</h1>

<?php if (isset($pedido)): ?>
<?php if(isset($_SESSION['admin'])): ?>
    <h3>Cambiar estado de pedido</h3>

    <form action="<?= RUTE_URL?>/pedido/estado" method="POST">
    <input type="hidden" value="<?=$pedido->id?>" name="pedido_id">
    <select name="estado" id="">
        <option value="confirm" <?=$pedido->estado == "confirm" ? 'selected' : '';?>> Pendiente</option>
        <option value="preparation" <?=$pedido->estado == "preparation" ? 'selected' : '';?>">En preparacion</option>
        <option value="ready" <?=$pedido->estado == "ready" ? 'selected' : '';?>>Prepado Para envio</option>
        <option value="sended" <?=$pedido->estado == "sended" ? 'selected' : '';?>>Enviado</option>
        
    </select>
    <input type="submit" value="Cambiar estado">
    
    </form>
    <br>
<?php endif; ?>

    <h3>Direccion pedido</h3>
    
    Comuna:<?= $pedido->comuna ?> <br>
    Ciudad:<?= $pedido->ciudad ?> <br>
    Direccion:<?= $pedido->direccion ?> <br>
    <br>
    <h3>Datos pedido</h3>
    Estado: <?=Util::showStatus($pedido->estado);?> <br>
    Numero de pedido:<?= $pedido->id ?> <br>
    Total a pagar: <?= $pedido->coste ?> <br>
    Productos:


    <table>
        <tr>
            <th>imagen</th>
            <th>Nombre</th>
            <th>Precio</th>
            <th>Unidades</th>
        </tr>


        <?php while ($producto = $productos->fetch_object()) : ?>

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
                <td>x<?=$producto->unidades ?></td>
            </tr>
        <?php endwhile; ?>
    </table>


<?php endif; ?>