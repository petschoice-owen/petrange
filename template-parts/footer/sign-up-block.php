<?php
/**
 * Displays the sign up form widget area.
 *
 * @package WordPress
 * @subpackage Twenty_Twenty_One
 * @since Twenty Twenty-One 1.0
 */

?>

<style>
    .klaviyo-footer form.klaviyo-form [data-testid="form-component"] > button.needsclick[type="button"] {
        padding: 0 30px !important;
    }
    @media (max-width: 959px) {
        .klaviyo-footer form.klaviyo-form .needsclick > [data-testid="form-component"]:first-child > .needsclick > input[type="email"] {
            margin-bottom: 0 !important;
        } 
        .klaviyo-footer form.klaviyo-form .needsclick > [data-testid="form-component"]:last-child > button.needsclick[type="button"] {
            margin-top: 0 !important;
        } 
    }
    @media (max-width: 575px) {
        .klaviyo-footer form.klaviyo-form [data-testid="form-component"] > button.needsclick[type="button"] {
            padding: 0 20px !important;
        }
    }
</style>

<section class="sign-up bg-black">
    <div class="inner flex jc-center a-center">
        <?php 
        $image = get_field('newsletter_image', 'option');
        if( !empty( $image ) ): ?>
            <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
        <?php endif; ?>
        <div class="right">
            <h3><span class="yellow">Sign up</span> to our newsletter</h3>
			<br>
            <!-- <p>And receive <span class="red">10% off</span> your next order</p> -->
            <div class="klaviyo-footer">
                <div class="klaviyo-form-WMFtbU"></div>
            </div>
        </div>
    </div>
</section>
