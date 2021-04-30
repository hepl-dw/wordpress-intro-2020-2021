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
    </header>