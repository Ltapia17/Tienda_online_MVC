<?php if(isset($_SESSION['pedido']) && $_SESSION['pedido'] == 'complete'): ?>
<h1>Tu pedido ha sido confirmado</h1>
<p>Tu pedido ha sido guardado con !Exito
    una vez realizada la tranferencia bancaria a la cuenta 123456 con el coste del pedido
    sera procesado y enviado.
</p>
<?php if(isset($pedido)): ?>
<h3>Datos pedido</h3>

Numero de pedido:<?=$pedido->id?> <br>
Total a pagar: <?=$pedido->coste?> <br>
Productos: 


<table >
    <tr>
        <th>imagen</th>
        <th>Nombre</th>
        <th>Precio</th>
        <th>Unidades</th>
    </tr>


    <?php while($producto = $productos->fetch_object()): ?>
      
        <tr>
            <td>
            <?php if ($producto->imagen != null): ?>
                        <img src="<?=RUTE_URL?>/uploads/images/<?=$producto->imagen?>" alt="" class="img-carrito">
                    <?php else: ?>
                        <img src="<?=RUTE_URL?>/uploads/images/no-image.png" alt="" class="img-carrito">
                    <?php endif;?>
                    
            </td>
            <td>
                <a href="<?= RUTE_URL ?>/producto/view&id=<?= $producto->id ?>"><?= $producto->nombre ?></a>
            </td>
            <td><?= $producto->precio ?></td>
            <td><?= 'x'.$producto->unidades ?></td>
        </tr>
    <?php endwhile; ?>
</table>


<?php endif; ?>
<?php elseif(isset($_SESSION['pedido']) && $_SESSION['pedido'] != 'complete'): ?>

<h1>Tu pedido no ha pido procesarse</h1>
<?php endif; ?>