<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="<?php echo RUTE_URL; ?>/assets/css/styles.css">
    <title>Tienda Online</title>
</head>

<body>
    <!--Header-->

    <div id="container">

        <header id="header">

            <div id="logo">
                <img src="<?php echo RUTE_URL; ?>/assets/img/tienda.png" alt="tienda" />
                <a href="index.php">
                    Shopping
                </a>
            </div>
        </header>

        <!--Menu-->
    <?php $categorias = util::showCategory(); ?>
        <nav id="menu">
            <ul>
                <li><a href="<?=RUTE_URL;?>">Inicio</a></li>
                <?php while($cat = $categorias->fetch_object()): ?>
                <li>
                    <a href="<?=RUTE_URL?>/categoria/view&id=<?=$cat->id?>"><?=$cat->nombre; ?></a>
                </li>
                <?php endwhile; ?>
            </ul>

        </nav>
        <div id="content"> 