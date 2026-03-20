<?php
    global $product;
    if (!comments_open()) return;
?>

<div class="reviews-container">
    <h3 class="tab-title">All Reviews <span>(<?php echo $product->get_review_count(); ?>)</span></h3>

    <ul class="reviews-list">
        <?php
            $comments = get_comments([
                'post_id' => $product->get_id(),
                'status' => 'approve',
                'type' => 'review',
            ]);

            if ($comments) :
                wp_list_comments([
                    'callback' => 'custom_woocommerce_review_callback'
                ], $comments);
            else :
                echo '<p>No reviews yet. Be the first to review!</p>';
            endif;
        ?>
    </ul>

    <hr>

    <div class="review-form-wrapper">
        <?php
            $commenter = wp_get_current_commenter();
            $comment_form = [
                'title_reply' => 'Add a review',
                'title-reply-to' => 'Reply to %s',
                'comment_notes_before' => '',
                'fields' => [
                    'author' => '<p class="comment-form-author"><input id="author" name="author" type="text" value="' . esc_attr($commenter['comment_author']) . '" size="30" placeholder="Name" required /></p>',
                ],
                'label_submit'  => 'Submit Review',
                'class_submit' => 'btn btn-review',
                'logged_in_as'  => '',
                'comment_field' => '',
            ];

            if (get_option('woocommerce_enable_review_rating') === 'yes') {
                $comment_form['comment_field'] = '<div class="comment-form-rating">
                <select name="rating" id="rating" required>
                    <option value="">Rate&hellip;</option>
                    <option value="5">Perfect</option>
                    <option value="4">Good</option>
                    <option value="3">Average</option>
                    <option value="2">Not that bad</option>
                    <option value="1">Very poor</option>
                </select></div>';
            }

            $comment_form['comment_field'] .= '<p class="comment-form-comment"><textarea id="comment" name="comment" cols="45" rows="8" placeholder="Your review" required></textarea></p>';

            comment_form($comment_form);
        ?>
    </div>

</div>