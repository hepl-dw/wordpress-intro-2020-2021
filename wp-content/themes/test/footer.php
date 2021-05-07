    <footer class="end">
        <p class="end__copyright">© Toon Van den Bos</p>
        <nav class="end__menu menu">
            <h2 class="sro">Liens utiles</h2>

            <?php foreach(dw_menu('footer') as $link): ?>
            <a href="<?= $link->url; ?>" class="menu__link"><?= $link->label; ?></a>
            <?php endforeach; ?>
        </nav>
    </footer>
    <?php wp_footer(); ?>
</body>
</html>