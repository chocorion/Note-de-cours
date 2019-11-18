<?php
    function makeNavItem($link, $name, $className = '') {
        if ($_SERVER["PHP_SELF"] === $link) {
            $className .= ' selected';
        }
        return <<<HTML
            <a href="$link" class="$className">$name</a>
HTML;
    }
?>

<div class = "navBar">
    <?= makeNavItem('/index.php', 'Accueil', 'dropDown navElements') ?>
    
    <div class = "dropDown navElements">
        <span class = "dropdown_button">
            Semestre 7
        </span>
        

        <div class="dropdown_content">
            <li><?= makeNavItem('/acid.php', 'Analyse, classification et indexation des données', 'navItem') ?></li>
            <li><?= makeNavItem('/ao.php', 'Approche objet', 'navItem') ?></li>
            <li><?= makeNavItem('/coca.php', 'Calculabilité et complexité', 'navItem') ?></li>
            <li><?= makeNavItem('/se.php', 'Systèmes d\'exploitation', 'navItem') ?></li>
            <li><?= makeNavItem('/ia.php', 'Intelligence artificielle', 'navItem') ?></li>
            <li><?= makeNavItem('/anglais.php', 'Anglais', 'navItem') ?></li>
        </div>
    </div>

    <div class="dropDown navElements">
       
        <span class = "dropdown_button">
            Semestre 8
        </span>

    </div>

</div>
