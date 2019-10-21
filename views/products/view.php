<?php if (isset($pro)) : ?>
    <h1><?= $pro->nombre; ?></h1>
    <div class="product-detail"> 
        <div class="image">
        <?php if ($pro->imagen != null) : ?>
            <img src="<?= RUTE_URL ?>/uploads/images/<?= $pro->imagen ?>" alt="">
        <?php else : ?>
            <img src="<?= RUTE_URL ?>/uploads/images/no-image.png" alt="">
        <?php endif; ?>
</div>
    <div class="data">
    </a>
    <p class="description"><?= $pro->descripcion ?></p>
    <p class="price">$<?= $pro->precio ?></p>
    <a href="<?=RUTE_URL ?>/carrito/addcart&id=<?=$pro->id?>" class="button">Comprar</a>
    </div>
    </div>
<?php else : ?>

    <h1>Producto no disponible</h1>

<?php endif; ?>