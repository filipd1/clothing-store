<footer class="site-footer">

    <div class="footer-container">

        <div class="footer-newsletter">
            <h2>Stay up to date about our latest offers</h2>
            <?php echo do_shortcode('[wpforms id="189"]'); ?>
        </div>

        <div class="footer-grid">

            <div class="footer-logo">
                <?php if (has_custom_logo()) : ?>
                    <?php the_custom_logo(); ?>
                <?php endif; ?>

                <p>We have cloths that suits your style and which you're proud to wear. From women to men</p>

                <div class="footer-icons">
                    <?php
                        echo file_get_contents(
                            get_stylesheet_directory() . '/assets/icons/twitter.svg'
                        );
                    ?>
                    <?php
                        echo file_get_contents(
                            get_stylesheet_directory() . '/assets/icons/fb.svg'
                        );
                    ?>
                    <?php
                        echo file_get_contents(
                            get_stylesheet_directory() . '/assets/icons/ig.svg'
                        );
                    ?>
                    <?php
                        echo file_get_contents(
                            get_stylesheet_directory() . '/assets/icons/github.svg'
                        );
                    ?>
                </div>
            </div>

            <div class="footer-col">
                <h4>Company</h4>
                <?php
                    wp_nav_menu([
                        'theme_location' => 'footer_menu_company',
                        'container' => 'false',
                        'menu_class' => 'footer-menu'
                    ])
                ?>
            </div>

            <div class="footer-col">
                <h4>Help</h4>
                <?php
                    wp_nav_menu([
                        'theme_location' => 'footer_menu_help',
                        'container' => 'false',
                        'menu_class' => 'footer-menu'
                    ])
                ?>
            </div>

            <div class="footer-col">
                <h4>Faq</h4>
                <?php
                    wp_nav_menu([
                        'theme_location' => 'footer_menu_faq',
                        'container' => 'false',
                        'menu_class' => 'footer-menu'
                    ])
                ?>
            </div>

            <div class="footer-col">
                <h4>Resources</h4>
                <?php
                    wp_nav_menu([
                        'theme_location' => 'footer_menu_resources',
                        'container' => 'false',
                        'menu_class' => 'footer-menu'
                    ])
                ?>
            </div>

        </div>

        <hr>

        <div class="absolute-footer">
            <p>Shop.co © 2000-<?php echo date('Y'); ?>. All rights reserved.</p>
            <div class="footer-icons">
                <?php
                    echo file_get_contents(
                        get_stylesheet_directory() . '/assets/icons/visa.svg'
                    );
                ?>
                <?php
                    echo file_get_contents(
                        get_stylesheet_directory() . '/assets/icons/mastercard.svg'
                    );
                ?>
                <?php
                    echo file_get_contents(
                        get_stylesheet_directory() . '/assets/icons/paypal.svg'
                    );
                ?>
                <?php
                    echo file_get_contents(
                        get_stylesheet_directory() . '/assets/icons/apple-pay.svg'
                    );
                ?>
                                    <?php
                    echo file_get_contents(
                        get_stylesheet_directory() . '/assets/icons/google-pay.svg'
                    );
                ?>
            </div>
        </div>
       
    </div>

</footer>
<?php wp_footer(); ?>
</body>
</html>