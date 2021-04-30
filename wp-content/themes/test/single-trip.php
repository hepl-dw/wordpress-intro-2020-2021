<?php get_header(); ?>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <main class="content">
            <dl class="content__info">
                <dt class="content__term">Destination&nbsp;:</dt>
                <dt class="content__value"><?php the_field('destination'); ?></dt>
                <dt class="content__term">Coût du voyage&nbsp;:</dt>
                <dt class="content__value"><?php the_field('costs'); ?></dt>
            </dl>
            <div class="content__wysiwyg"><?php the_content(); ?></div>
        </main>
    <?php endwhile; endif; ?>
<?php get_footer(); ?>