<form role="search" method="get" class="search-form" action="<?php echo esc_url(home_url('/')); ?>">

    <input 
        type="search"
        placeholder="Search for products..."
        value="<?php echo get_search_query(); ?>"
        name="s"
    >

    <input type="hidden" name="post_type" value="product">
    <div class="form-icon">
        <?php
            echo file_get_contents(
                get_stylesheet_directory() . '/assets/icons/search-icon.svg'
            );
        ?>
    </div>

    

</form>