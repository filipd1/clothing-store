<?php
    global $product;
    $product_id = $product->get_id();
?>

<div class="questions-container">
    <h3 class="tab-title">Frequently Asked Qustions</h3>

    <?php if (have_rows('faq', $product_id)) : ?>
        <div class="faq-list">
            <?php while (have_rows('faq', $product_id)) : the_row(); ?>
                <div class="faq-item">
                    <h4><?php the_sub_field('question'); ?></h4>
                    <p><?php the_sub_field('answer'); ?></p>
                </div>
            <?php endwhile; ?>
        </div>
    <?php else : ?>
        <p class="tab-empty">No questions for this product.</p>
    <?php endif; ?>

</div>