<?php if (isset($_SESSION['identity'])) : ?>
    <h1>Finalizacion de pedido</h1> <br>
    <a href="<?= RUTE_URL ?>/carrito/index">Ver productos de pedido</a>
    <h3>Direccion de Envio:</h3>
<br>
<form action="<?=RUTE_URL?>/pedido/confirm" method="POST">
    <label for="">Comuna</label>
    <input type="text" name="comuna" required />

    <label for="">Ciudad</label>
    <input type="text" name="ciudad" required />

    <label for="">Direccion</label>
    <input type="text" name="direccion" required />

    <input type="submit" value="realizar pedido">
</form>
    <?php else : ?>
    <h1>No se puede realizar pedido</h1>
    <p>Necesitas estar logeado para finalizar pedido</p>
<?php endif; ?>