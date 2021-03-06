<?php
/**
 * Single Product Rating
 *
 * @author      YITH
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit; // Exit if accessed directly
}

global $product;
$YWAR_AdvancedReview = YITH_YWAR();

if ( get_option( 'woocommerce_enable_review_rating' ) === 'no' ) {
    return;
}

$product_id = yit_get_prop($product, 'id');

$review_count = $YWAR_AdvancedReview->get_reviews_count( $product_id );

$rating_count = $review_count;
$average      = $YWAR_AdvancedReview->get_average_rating( $product_id );

if ( apply_filters( 'yith_ywar_display_rating_stars_condition', $rating_count > 0, $rating_count ) ) : ?>
    <div class="woocommerce-product-rating" itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating">
        <div class="star-rating" title="<?php printf( __( 'Rated %s out of 5', 'yith-woocommerce-advanced-reviews' ), $average ); ?>">
			<span style="width:<?php echo( ( $average / 5 ) * 100 ); ?>%">
				<strong itemprop="ratingValue" class="rating"><?php echo esc_html( $average ); ?></strong> <?php printf( __( 'out of %s5%s', 'yith-woocommerce-advanced-reviews' ), '<span itemprop="bestRating">', '</span>' ); ?>
                <?php printf( _n( 'based on %s customer rating', 'based on %s customer ratings', $rating_count, 'yith-woocommerce-advanced-reviews' ), '<span itemprop="ratingCount" class="rating">' . $rating_count . '</span>' ); ?>
			</span>
        </div>

        <?php if ( comments_open() ) : ?><a href="#reviews" class="woocommerce-review-link" rel="nofollow">
            (<?php printf( _n( '%s customer review', '%s customer reviews', $review_count, 'yith-woocommerce-advanced-reviews' ), '<span itemprop="reviewCount" class="count">' . $review_count . '</span>' ); ?>
            )</a><?php endif ?>
        <div itemprop="itemReviewed" itemscope itemtype="http://schema.org/Product">
            <!-- Product properties -->
        </div>
    </div>
<?php endif; ?>