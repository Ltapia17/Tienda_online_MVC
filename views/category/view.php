<?php if(isset($categoria)): ?>
<h1><?= $categoria->nombre ?></h1>
<?php if($productos->num_rows == 0): ?>
<p>No ahi productos para mostrar</p>
<?php else: ?>
<?php while($product = $productos->fetch_object()): ?>
    <div class="product">
        <a href="<?=RUTE_URL?>/producto/view&id=<?=$product->id?>">
        <?php if($product->imagen != null): ?>
        <img src="<?=RUTE_URL?>/uploads/images/<?=$product->imagen?>" alt="">
<?php else:?>
        <img src="<?=RUTE_URL?>/uploads/images/no-image.png" alt="">
<?php endif; ?>
        <h2><?=$product->nombre; ?></h2>
        </a>
        <p><?=$product->precio ?></p>
        <a href="<?=RUTE_URL ?>/carrito/addcart&id=<?=$product->id?>" class="button">Comprar</a>

    </div>

<?php endwhile?>

<?php endif; ?> 
<?php else: ?>
<h1>Categoria no existe</h1>
<?php endif;?>