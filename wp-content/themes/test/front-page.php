<?php get_header(); ?>
    <!-- Commencer la boucle principale permettant d'afficher la page -->
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <main class="content">
            <header class="content__hero">
                <h2 class="content__title"><?= __('Ceci est le hero', 'dw'); ?></h2>
                <p class="content__tagline"><?php bloginfo('description'); ?></p>
            </header>
            <div class="content__wysiwyg"><?php the_content(); ?></div>

            <section class="trips">
                <h2 class="trips__title"><?= __('Mes derniers voyages', 'dw'); ?></h2>
                <div class="trips__container">
                    <!-- Commencer la boucle des voyages -->
                    <?php
                    $trips = new WP_Query([
                        'post_type' => 'trip',
                        'posts_per_page' => 2,
                        'orderby' => 'date',
                        'order' => 'desc',
                    ]);

                    if($trips->have_posts()) : while($trips->have_posts()) : $trips->the_post();?>
                        <article class="trip">
                            <a href="<?php the_permalink(); ?>" class="trip__link">
                                <span class="sro"><?= __('En savoir plus sur', 'dw'); ?> "<?php the_title(); ?>"</span>
                            </a>
                            <div class="trip__card">
                                <div class="trip__content">
                                    <h3 class="trip__title"><?php the_title(); ?></h3>
                                    <dl class="trip__info">
                                        <dt class="trip__term">Pays de destination&nbsp;:</dt>
                                        <dd class="trip__value"><?php the_field('destination'); ?></dd>
                                        <dt class="trip__term">Coût du voyage&nbsp;:</dt>
                                        <dd class="trip__value"><?php the_field('costs'); ?></dd>
                                    </dl>
                                    <strong class="trip__more" aria-hidden="true"><?= __('En savoir plus', 'dw'); ?></strong>
                                </div>
                                <figure class="trip__fig">
                                    <img <?= dw_the_thumbnail_attributes(['medium','medium_large']); ?> class="trip__img">
                                </figure>
                            </div>
                        </article>
                    <?php endwhile; else: ?>
                        <p class="trips__empty">Je n'ai pas encore voyage pour le moment.</p>
                    <?php endif; ?>
                    <!-- Terminer la boucle des voyages -->
                </div>
            </section>
        </main>
    <?php endwhile; else : ?>
        <div class="empty">
            <p class="empty__message">Oups, nous n'avons rien à afficher.</p>
        </div>
    <?php endif; ?>
    <!-- Fin de la boucle principale permettant d'afficher la page -->
<?php get_footer(); ?>