<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title><?php is_front_page() ? bloginfo('description') : wp_title('Mon site •'); ?></title>
</head>
<body>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <header class="header">
            <h1 class="header__title"><?php the_title(); ?></h1>
        </header>
        <main class="content">
            <div class="content__wysiwyg"><?php the_content(); ?></div>
        </main>
    <?php endwhile; else : ?>
        <div class="empty">
            <p class="empty__message">Oups, nous n'avons rien à afficher.</p>
        </div>
    <?php endif; ?>
</body>
</html>