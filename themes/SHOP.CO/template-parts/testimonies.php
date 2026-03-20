<?
    $testimonies = new WP_Query([
            'post_type'      => 'testimonies',
            'posts_per_page' => 6,
            'orderby'        => 'menu_order',
            'order'          => 'ASC',
        ]);
?>

<div class="testimonies">

    <div class="testimonies-header">
        <h2>Our happy customers</h2>
        <div class="testimonies-controls">

            <button class="btn-testimonies btn-left">
                <?php
                    echo file_get_contents(
                        get_stylesheet_directory() . '/assets/icons/arrow-left.svg'
                    );
        	    ?>
            </button>

            <button class="btn-testimonies btn-right">
                <?php
                    echo file_get_contents(
                        get_stylesheet_directory() . '/assets/icons/arrow-right.svg'
                    );
        	    ?>
            </button>

        </div>
    </div>

    <?php if ($testimonies->have_posts()) : ?>
        <div class="testimonies-grid swiper mySwiper">
            <div class="swiper-wrapper">
                <?php while($testimonies->have_posts()) : $testimonies->the_post(); ?>
                    <div class="testimony-card swiper-slide">
                        <div class="testimony-card-rating"></div>
                        <p class="testimony-card-name"><?php the_title(); ?></p>
                        <p class="testimony-card-content"><?php the_content(); ?></p>
                    </div>
                <?php endwhile; ?>
            </div>
        </div>
    <?php endif; ?>
</div>