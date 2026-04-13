<?php
    defined('ABSPATH') || exit;

    get_header();
?>

<div class="container account-container">
    <?php if ( is_user_logged_in() ) : ?>

        <h1>My account</h1>

        <div class="account-layout">

            <div class="account-menu">
                <?php wc_get_template('myaccount/navigation.php'); ?>
            </div>

            <div class="account-content">
                <?php woocommerce_account_content(); ?>
            </div>

        </div>

    <?php else : ?>

        <div class="login-page-wrapper">
            <?php 
                woocommerce_output_all_notices();
                wc_get_template('myaccount/form-login.php'); 
            ?>
        </div>

    <?php endif; ?>

</div>

<?php get_footer(); ?>