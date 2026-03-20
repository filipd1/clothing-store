<?php
    defined('ABSPATH') || exit;

    get_header();
?>

<div class="container account-container">
    <h1>My account</h1>

    <div class="account-layout">

        <div class="account-menu">
            <?php wc_get_template('myaccount/navigation.php'); ?>
        </div>

        <div class="account-content">
            <?php woocommerce_account_content(); ?>
        </div>

    </div>
</div>

<?php get_footer(); ?>