<!DOCTYPE html>

<html>
    <head>
        <meta charset="utf-8">
        <title>
            <?php echo (isset($title))? $title : "Cours" ?>
        </title>

        <?php if (isset($descrition)): ?>
            <meta name="description" content="<?= $description ?>">
        <?php else: ?>
            <meta name="description" content="Notes de cours pour le master informatique de Bordeaux.">
        <?php endif ?>

        <link rel="stylesheet" href="/stylesheet/basic.css">
        <link href="https://fonts.googleapis.com/css?family=Vollkorn&display=swap" rel="stylesheet"> 

        <script async src="https://www.googletagmanager.com/gtag/js?id=UA-151907906-1"></script>
        <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'UA-151907906-1');
        </script>

    </head>

    <body>
    
    <?php 
    if (isset($display_nav)) {
        if ($display_nav) {
            require 'navbar.php';
        }
    } else {
        require 'navbar.php';
    }
    ?>