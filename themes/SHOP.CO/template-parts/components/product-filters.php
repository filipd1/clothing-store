<div class="archive-sidebar">
    <form method="get" action="<?php echo esc_url(strtok($_SERVER["REQUEST_URI"], '?')); ?>" class="custom-filter-form">
        <h3>Filters</h3>

        <div class="filter-section">
            <ul class="filter-category-list">
                <?php
                    $parent_categories = get_terms([
                        'taxonomy'   => 'product_cat',
                        'parent'     => 0,
                        'hide_empty' => true,
                    ]);

                    if (!empty($parent_categories) && !is_wp_error($parent_categories)) :

                        foreach ($parent_categories as $parent) :
                            $is_current_parent = (is_product_category($parent->slug)) ? 'is-active' : '';
                            
                            $children = get_terms([
                                'taxonomy'   => 'product_cat',
                                'parent'     => $parent->term_id,
                                'hide_empty' => true,
                            ]);
                        ?>
                        <li class="parent-cat">
                            <a href="<?php echo esc_url(get_term_link($parent)); ?>" class="<?php echo $is_current_parent; ?>">
                                <?php echo esc_html($parent->name); ?>
                                <span class="count">(<?php echo $parent->count; ?>)</span>
                            </a>

                            <?php if (!empty($children)) : ?>
                                <ul class="sub-categories">
                                    <?php foreach ($children as $child) : 
                                        $is_current_child = (is_product_category($child->slug)) ? 'is-active' : '';
                                    ?>
                                        <li>
                                            <a href="<?php echo esc_url(get_term_link($child)); ?>" class="<?php echo $is_current_child; ?>">
                                                <?php echo esc_html($child->name); ?>
                                                <span class="count">(<?php echo $child->count; ?>)</span>
                                            </a>
                                        </li>
                                    <?php endforeach; ?>
                                </ul>
                            <?php endif; ?>
                        </li>
                        <?php
                        endforeach;
                    endif;
                ?>
            </ul>
        </div>

        <div class="filter-section">
            <h4>Price</h4>
            <div class="price-inputs">
                <input type="number" name="min_price" id="min_price" 
                    value="<?php echo isset($_GET['min_price']) ? esc_attr($_GET['min_price']) : ''; ?>" 
                    placeholder="Min">
                <span>-</span>
                <input type="number" name="max_price" id="max_price" 
                    value="<?php echo isset($_GET['max_price']) ? esc_attr($_GET['max_price']) : ''; ?>" 
                    placeholder="Max">
            </div>
        </div>

        <div class="filter-section">
            <h4>Colors</h4>
            <div class="attr-inputs">
                <?php
                $colors = get_terms([
                    'taxonomy' => 'pa_color',
                    'hide_empty' => true,
                ]);

                foreach ($colors as $color) :
                    $checked = (isset($_GET['filter_color']) && in_array($color->slug, (array)($_GET['filter_color']))) ? 'checked' : '';
                    $hex = get_term_meta($color->term_id, 'color', true) ?: $color->slug;
                ?>

                <label>
                    <input type="checkbox" name="filter_color[]" value="<?php echo esc_attr($color->slug); ?>" <?php echo $checked; ?>>
                    <span class="color-box" style="background-color: <?php echo esc_attr($hex); ?>;" title="<?php echo esc_attr($color->name); ?>"></span>
                </label>

                <?php endforeach; ?>
            </div>
        </div>

        <div class="filter-section">
            <h4>Size</h4>
            <div class="attr-inputs">
                <?php
                $sizes = get_terms([
                    'taxonomy' => 'pa_size',
                    'hide_empty' => true,
                ]);

                foreach ($sizes as $size) :
                    $checked = (isset($_GET['filter_size']) && in_array($size->slug, (array)$_GET['filter_size'])) ? 'checked' : '';
                ?>
                    <label>
                        <input type="checkbox" name="filter_size[]" value="<?php echo esc_attr($size->slug); ?>" <?php echo $checked; ?>>
                        <span class="size-box"><?php echo esc_html($size->name); ?></span>
                    </label>
                <?php endforeach; ?>
            </div>
        </div>

        <button type="submit" class="btn btn-main">Apply Filters</button>
        <?php
        $has_filters = !empty($_GET['min_price']) || 
               !empty($_GET['max_price']) || 
               !empty($_GET['filter_color']) || 
               !empty($_GET['filter_size']);
        if ($has_filters) :
        ?>
            <a href="<?php echo esc_url(get_permalink(wc_get_page_id('shop'))); ?>" class="filter-clear">
                Clear
            </a>
        <?php endif; ?>
    </form>
</div>