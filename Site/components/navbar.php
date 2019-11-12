<?php
    function makeNavItem(string $link, string $name): string {
        $className = 'navItem';
        if ($_SERVER["PHP_SELF"] === $link) {
            $className .= ' selected';
        }
        return <<<HTML
            <a href="$link" class="$className">$name</a>
HTML;
    }
?>

<ul class = "navBar">
    <li class="navElements"><?= makeNavItem('/index.php', 'Accueil') ?></li>
    
    <li class="navElements"> <span>Semestre 7</span>
        <ul>
            <li><?= makeNavItem('/notes_pages/acid.php', 'Analyse, classification et indexation des données') ?></li>
            <li><?= makeNavItem('/notes_pages/ao.php', 'Approche objet') ?></li>
            <li><?= makeNavItem('/notes_pages/coca.php', 'Calculabilité et complexité') ?></li>
            <li><?= makeNavItem('/notes_pages/se.php', 'Systèmes d\'exploitation') ?></li>
            <li><?= makeNavItem('/notes_pages/ia.php', 'Intelligence artificielle') ?></li>
            <li><?= makeNavItem('/notes_pages/anglais.php', 'Anglais') ?></li>
        </ul>
    </li>

    <li class="navElements"> <span>Semestre 8</span>
        <ul>
</ul>
        </li>

</ul>