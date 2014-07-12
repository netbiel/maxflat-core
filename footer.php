<footer id="main-footer" class="main-footer">
    <?php

    if (!is_404())
        get_sidebar('footer'); //Add footer sidebar
    ?>
    <div id="footer-bottom">
        <div class="row">
            <div class="large-4 columns">
               <?php echo __MAXFLAT::option( 'title_tagline_footer' ) ?>
            </div>
            <div class="large-12 columns footer-navigation">
                <?php wp_nav_menu(array('theme_location' => 'footer_pages', 'container' => false, 'depth'=>1)); ?>
            </div>
        </div>
    </div>
</footer>
    <?php wp_footer(); ?>
</body>
</html>
