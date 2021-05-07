<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php is_front_page() ? bloginfo('description') : wp_title('Mon site •'); ?></title>
    
    <!-- ASSETS -->
    <link rel="stylesheet" href="<?= dw_asset('css/theme.css') ?>">
    <script src="<?= dw_asset('js/app.js') ?>"></script>

    <!-- WORDPRESS -->
    <?php wp_head(); ?>
</head>
<body>
    <header class="top">
        <h1 class="top__title"><?= is_front_page() ? 'Bienvenue ici !' : trim(wp_title('', false)); ?></h1>

        <nav class="top__menu menu">
            <h2 class="sro">Navigation principale</h2>

            <?php foreach(dw_menu('main') as $link): ?>
            <a href="<?= $link->url; ?>" class="menu__link <?= dw_bem('menu__link', $link->modifiers); ?>"><?= $link->label; ?></a>
            <?php endforeach; ?>
        </nav>

        <nav class="top__language languages">
            <h2 class="sro">Sélectionnez votre langue</h2>

            <p class="languages__current">Vous êtes actuellement en : <strong class="languages__lang">FR</strong></p>

            <ul class="languages__list">
                <li class="languages__item">
                    <a href="#TODO" class="languages__link">FR</a>
                </li>
                <li class="languages__item">
                    <a href="#TODO" class="languages__link">NL</a>
                </li>
                <li class="languages__item">
                    <a href="#TODO" class="languages__link">EN</a>
                </li>
            </ul>
        </nav>
    </header>