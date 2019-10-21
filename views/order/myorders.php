<?php if (isset($gestion)) : ?>

    <h1>Gestionar Pedidos</h1>

<?php else: ?>
    <h1>Mis pedidos</h1>
<?php endif; ?>

<table >
    <tr>
        <th>N° Pedido</th>
        <th>Coste Pedido</th>
        <th>Fecha Pedido</th>
        <th>Estado</th>
    </tr>


    <?php while($ped = $pedidos->fetch_object()): ?>
      
        <tr>
            <td>
               <a href="<?=RUTE_URL?>/pedido/detalle&id=<?=$ped->id?>"><?=$ped->id?></a>
            </td>
            <td>
                $ <?=$ped->coste?>
            </td>
            <td>
                <?=$ped->fecha?>
            </td>
            <td>
            <?=Util::showStatus($ped->estado);?>
            </td>
        </tr>
    <?php endwhile; ?>
</table>