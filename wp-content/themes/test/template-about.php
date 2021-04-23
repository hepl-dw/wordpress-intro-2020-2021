<?php /* Template Name: Le template pour la page à propos */ ?>
<?php get_header(); ?>
    <?php if (have_posts()) : while (have_posts()) : the_post(); ?>
        <main class="about">
            <!-- Ce que vous voulez de différent -->
            <div class="about__wysiwyg"><?php the_content(); ?></div>
        </main>
    <?php endwhile; endif; ?>
<?php get_footer(); ?>