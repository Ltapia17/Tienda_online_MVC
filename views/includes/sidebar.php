    <!--Lateral-->

    <aside id="lateral">
        <div id="carrito" class="block-aside">
            <h3>Carrito</h3>
            <ul>
                <?php $stats = Util::statsCart(); ?>
            <li><a href="<?=RUTE_URL?>/carrito/index">Productos(<?=$stats['count']?>)</a></li>
            <li><a href="<?=RUTE_URL?>/carrito/index">Total(<?=$stats['total']?>)</a></li>
                <li><a href="<?=RUTE_URL?>/carrito/index">Ver carrito</a></li>
            </ul>
        </div>
        <div id="login" class="block-aside">
            <?php if (!isset($_SESSION['identity'])) : ?>
                <h3>Identificacion</h3>
                <form action="<?php echo RUTE_URL ?>/usuario/login" method="POST">
                    <label for="email">Email</label>
                    <input type="email" name="email" />
                    <label for="password">Contraseña</label>
                    <input type="password" name="password" />
                    <input type="submit" value="Ingresar" />
                </form>
            <?php else : ?>
                <h3><?= $_SESSION['identity']->nombre ?> <?= $_SESSION['identity']->apellido ?></h3>
            <?php endif; ?>
            <ul>

                <?php if (isset($_SESSION['admin'])) : ?>
                    <li><a href="<?= RUTE_URL ?>/categoria/index">Gestionar Categorias</a></li>
                    <li><a href="<?= RUTE_URL ?>/producto/gestion">Gestionar Productos</a></li>
                    <li><a href="<?= RUTE_URL ?>/pedido/gestion">Gestionar Pedidos</a></li>
                <?php endif; ?>

                <?php if (isset($_SESSION['identity'])) : ?>
                    <li><a href="<?= RUTE_URL?>/pedido/mis_pedidos">Mis pedidos</a></li>
                    <li><a href="<?php echo RUTE_URL ?>/usuario/logout">Cerrar Session</a></li>

                <?php else : ?>
                    <li><a href="<?php echo RUTE_URL ?>/usuario/registro">Registrarte</a></li>

                <?php endif; ?>
            </ul>
        </div>

    </aside>
    </div>

    <!--Content-->
    <div id="central">