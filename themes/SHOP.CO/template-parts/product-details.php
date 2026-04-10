<?php
    global $product;
    $product_id = $product->get_id();

    $fabric = get_field('fabric', $product_id);
    $model_size = get_field('model_size', $product_id);
    $care_instructions = get_field('care_instructions', $product_id);
?>

<div class="details-container">

    <h3 class="tab-title">Details</h3>

    <?php if ($fabric || $model_size || $care_instructions) : ?>
        <div class="details-list">
            
            <div class="details-item">
                <span>Fabric & Composition:</span><p><?=$fabric;?></p>
            </div>
            <div class="details-item">
                <span>Fit & Model Size:</span><p><?=$model_size;?></p>
            </div>

            <div class="details-item">
                <span>Care Instructions:</span><p><?=$care_instructions;?></p>
            </div>

        </div>
    <?php else : ?>
        <p class="tab-empty">No details found for this product</p>
    <?php endif; ?>

</div>