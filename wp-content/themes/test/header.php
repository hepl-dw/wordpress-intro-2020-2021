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
            <h2 class="sro"><?= __('Navigation principale', 'dw'); ?></h2>

            <?php foreach(dw_menu('main') as $link): ?>
            <a href="<?= $link->url; ?>" class="menu__link <?= dw_bem('menu__link', $link->modifiers); ?>"><?= $link->label; ?></a>
            <?php endforeach; ?>
        </nav>

        <nav class="top__language languages">
            <h2 class="sro"><?= __('Sélectionnez votre langue', 'dw'); ?></h2>

            <p class="languages__current"><?= __('Vous êtes actuellement en', 'dw'); ?> : <strong class="languages__lang"><?= dw_current_language()['slug']; ?></strong></p>


            <ul class="languages__list">
                <?php foreach(dw_languages() as $lang): ?>
                <li class="languages__item">
                    <a href="<?= $lang['url'] ?>" hreflang="<?= $lang['locale'] ?>" title="<?= $lang['name'] ?>" class="languages__link"><?= $lang['slug'] ?></a>
                </li>
                <?php endforeach; ?>
            </ul>
        </nav>
    </header>