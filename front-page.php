<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package WordPress
 * @subpackage Petrange
 * @since Petrange
 */

get_header();
?>
    <?php if( have_rows( 'hero_slides' ) ) : ?>
    <section class="owl-carousel owl-theme js-home-hero">
        <?php while( have_rows( 'hero_slides' ) ) : the_row(); 
        $image_hero = get_sub_field('home_hero_image');
        $image_hero_mob = get_sub_field('hero_image_mobile');
        ?>
    <div class="hero bb yellow" style="background-image:url('<?php echo $image_hero['url'] ?>');">
        <?php 
            $hero_link = get_sub_field('hero_link');
			 if($hero_link) {
				$hero_link_url = $hero_link['url'];
				$hero_link_title = $hero_link['title'];
				$hero_link_target = $hero_link['target'] ? $hero_link['target'] : '_self';
			 }

            $hero_link_2 = get_sub_field('hero_link_2');
			 if($hero_link_2) {
				 $hero_link_url_2 = $hero_link_2['url'];
				 $hero_link_title_2 = $hero_link_2['title'];
				 $hero_link_target_2 = $hero_link_2['target'] ? $hero_link_2['target'] : '_self';  
			 }
                  
        ?>
        <div class="hero-frame">
            <div class="inner flex-mob col-2 a-center">
                <div class="left">
                    <?php if( get_sub_field('hero_title') ): ?>
                        <h1><?php echo get_sub_field('hero_title'); ?></h1>
                    <?php endif; ?>
                    <?php if( get_sub_field('hero_copy') ): ?>
                        <p><?php echo get_sub_field('hero_copy'); ?></p>
                    <?php endif; ?>
                    <div class="button-holder">
						<?php if( get_sub_field('hero_link') ): ?>
                        <a class="cs-button large" href="<?php echo esc_url( $hero_link_url ); ?>" target="<?php echo esc_attr( $hero_link_target ); ?>"><?php echo esc_html( $hero_link_title ); ?></a>
						<?php endif; ?>
                        <?php if( get_sub_field('hero_link_2') ): ?>
                            <a class="cs-button large" href="<?php echo esc_url( $hero_link_url_2 ); ?>" target="<?php echo esc_attr( $hero_link_target_2 ); ?>"><?php echo esc_html( $hero_link_title_2 ); ?></a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        </div>        
        <div class="hero_bg_mobile">
			 <?php if( get_sub_field('hero_image_mobile') ): ?>
            <img src="<?php echo $image_hero_mob['url'] ?>" alt="<?php echo $image_hero_mob['alt'] ?>" class="">
			<?php endif; ?>
            <div class="button-holder">
				<?php if( get_sub_field('hero_link') ): ?>
                <a class="cs-button" href="<?php echo esc_url( $hero_link_url ); ?>" target="<?php echo esc_attr( $hero_link_target ); ?>"><?php echo esc_html( $hero_link_title ); ?></a>
				<?php endif; ?>
                <?php if( get_sub_field('hero_link_2') ): ?>
                    <a class="cs-button" href="<?php echo esc_url( $hero_link_url_2 ); ?>" target="<?php echo esc_attr( $hero_link_target_2 ); ?>"><?php echo esc_html( $hero_link_title_2 ); ?></a>
                <?php endif; ?>
            </div>
        </div>
    </div>
<?php endwhile; ?>
    </section>
    <?php endif; ?>

    <section class="popular bg-grey p-60 all-icons icons-group-1">
        <div class="inner">
            <h2 class="underline header-icon after paw-2">Shop by pet</h2>
            <div class="flex-mob">
                <?php
                $terms = get_field('home_popular_categories');
                if( $terms ): ?>
                    <?php foreach( $terms as $term ): ?>
                        <div class="main-cta bg-<?php the_field('background_colour', $term);?>">
                            <h2><?php echo esc_html( $term->name ); ?></h2>
                            <a class="cs-button white" href="<?php echo esc_url( get_term_link( $term ) ); ?>">Shop now</a>
                            <?php 
                            $catgimage = get_field('background_image', $term);
                            if( !empty( $catgimage ) ): ?>
                                <img src="<?php echo esc_url($catgimage['url']); ?>" alt="<?php echo esc_attr($catgimage['alt']); ?>" />
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>       
        </div>
    </section>
    <section class="shop-by-ctas p-60">
        <div class="inner">
            <h2 class="underline header-icon after star">
                Popular categories
            </h2>
            <div class="flex-mob col-4">
                <?php
                $categories = get_field('home_shop_by_category');
                if( $categories ): ?>
                    <?php foreach( $categories as $category ): ?>
                        <div class="shop-by bg-<?php the_field('background_colour', $category);?>-fade">
                            <a href="<?php echo esc_url( get_term_link( $category ) ); ?>">
                                <h4><?php echo esc_html( $category->name ); ?></h4>
                                <?php 
                            $categoryimage = get_field('shop_by_category_image', $category);
                            if( !empty( $categoryimage ) ): ?>
                                <img src="<?php echo esc_url($categoryimage['url']); ?>" alt="<?php echo esc_attr($categoryimage['alt']); ?>" />
                            <?php endif; ?>
                                <div class="overlay">
                                    <?php
                                    $buttontext = get_field('shop_by_category_button_text', $category);

                                    if ($buttontext){
                                        $buttontextnew = $buttontext;
                                    }else{
                                        $buttontextnew = "Shop now!";
                                    }
                                    ?>
                                    <span class="cs-button white"><?php echo $buttontextnew; ?></span>
                                </div>
                            </a>
                        </div>
                    <?php endforeach; ?>
                <?php endif; ?>
            </div>
        </div>
    </section>
    <section class="our-brands-main bg-grey p-60 all-icons icons-group-3">
        <div class="inner">
            <h2 class="underline red header-icon after star">Our brands</h2>
            <div class="flex col-3 pt-60 a-stretch">
            <?php 
            $frontBrandsArgs = array(
                'post_type' => 'brands',
                'posts_per_page' => 3,
                'order' => 'DESC',
                'post_status' => 'publish'

            );
            $frontBrands = new WP_Query( $frontBrandsArgs );
            // The Loop
            if ( $frontBrands->have_posts() ) {
                while ( $frontBrands->have_posts() ) {
                    $frontBrands->the_post();
                    ?>
                        <div class="brand p-40 radius">
                            <div class="brand-logo">       
                                <?php 
                                $image = get_field('brand_logo');
                                if( !empty( $image ) ): ?>
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                <?php endif; ?>
                            </div>
                            <div class="brand-content">
                                <!-- <h5><?php the_title(); ?></h5> -->
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                    <?php } 
                wp_reset_postdata();
            } ?>
            </div>
            <div class="flex col-3 brands-additional a-stretch" id="toggle-1">
            <?php
            $frontBrandsMoreArgs = array(
                'post_type' => 'brands',
                'posts_per_page' => 999,
                'order' => 'DESC',
                'offset' => 3,
                'post_status' => 'publish'
            );
            $frontBrandsMore = new WP_Query( $frontBrandsMoreArgs );
            // The Loop
            if ( $frontBrandsMore->have_posts() ) {
                while ( $frontBrandsMore->have_posts() ) {
                    $frontBrandsMore->the_post();
                    ?>
                        <div class="brand p-40 radius">
                            <div class="brand-logo">       
                                <?php 
                                $image = get_field('brand_logo');
                                if( !empty( $image ) ): ?>
                                    <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                <?php endif; ?>
                            </div>
                            <div class="brand-content">
                                <!-- <h5><?php the_title(); ?></h5> -->
                                <?php the_excerpt(); ?>
                            </div>
                        </div>
                    <?php } 
                wp_reset_postdata();
            } ?>
            </div>
            <div class="flex jc-center">
                <a href="#" class="show-more cs-toggle" data-container="toggle-1">
                    <img src="/wp-content/themes/custom/base_html/www/images/icons/icon-chevron-down-black.svg" alt="">
                </a>
            </div>
        </div>
    </section>
    <section class="lines p-60">
        <div class="inner inner-1100">
            <div class="video">
                <iframe width="560" height="315" src="<?php the_field('video'); ?>" title="video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share" allowfullscreen></iframe>      
            </div>
            <style>
                .video button.cmplz-blocked-content-notice {
                    opacity: 0;
                    pointer-events: none;
                }
            </style>
            <script>
                var $ = jQuery;
                $(window).on('load', function() {
                    if ( $('button.cmplz-blocked-content-notice').length ) {
                        $('button.cmplz-blocked-content-notice').click();
                    }
                });
            </script>
        </div>
    </section>
        <?php if ( have_posts() ) :
        $args = array(
            'post_type' => 'product',
            'post_status' => 'publish',
            'posts_per_page' => -1,
            'orderby' => 'date', 
            'order' => 'DESC',
            'tax_query' => array(
                array(
                    'taxonomy' => 'product_cat',
                    'field' => 'term_id',
                    'terms' => 89,
                    'operator' => 'IN'
                )
            )

        );
        $loop = new WP_Query( $args ); ?>
        <section class="bg-yellow p-60">
            <div class="radial-white"></div>
            <div class="inner">
                <h2 class="underline red">Special offers</h2>
                <br /><br /><br />
                <div class="owl-carousel owl-theme">
                    <?php while ( $loop->have_posts() ) : $loop->the_post(); ?> 
                        <?php $featured_img = wp_get_attachment_image_src(get_post_thumbnail_id($post->ID), 'full' ); ?>
                        <div class="special-offer border p-20 item">
                            <img src="<?php echo $featured_img[0]; ?>" alt="" />
                            <p><?php the_title(); ?></p>
                            <span class="price">
                                <?php echo $product->get_price_html(); ?>
                            </span>
                            <a href="<?php the_permalink(); ?>" class="cs-button full slim black">Shop Now</a>
                        </div>
                    <?php endwhile;
                    wp_reset_postdata(); ?>
                </div>
            </div>
        </section>
        <?php endif; 
    wp_reset_query(); ?>
    <section class="news-blog p-60">
        <div class="inner">
            <h2 class="underline yellow header-icon after paw-2">News & Blog</h2>
            <div class="flex-mob col-4 pt-40">
                <?php 
                    $args = array(
                        'post_type' => 'post',
                        'posts_per_page' => '4',
                        'order' => 'DESC',
                        'post_status' => 'publish'

                    );
                    $the_query = new WP_Query( $args );
                    // The Loop
                    if ( $the_query->have_posts() ) {
                        while ( $the_query->have_posts() ) {
                            $the_query->the_post();
                            ?>
                                <div class="news-teaser">
                                    <div class="teaser-image">
                                        <?php
                                            if(has_post_thumbnail()){
                                                the_post_thumbnail();
                                            }
                                        ?>
                                    </div>
                                    <div class="teaser-content">
                                        <p class="category">News category</p>
                                        <h4><?php the_title(); ?></h4>
                                        <p><?php echo get_the_date( 'd F Y' ); ?></p>
                                        <?php // the_excerpt(); ?>
                                        <a href="<?php the_permalink(); ?>" class="cs-button white">Read article</a>
                                    </div>
                                </div>  
                            <?php } 
                        wp_reset_postdata();
                    }
                ?>
            </div>
        </div>
    </section>
    <section class="home-additional bg-grey">
        <div class="inner">
            <div class="flex col-2-full a-stretch">
                <?php if( get_field('two_column_additional_image') ):
                    $ca_image = get_field('two_column_additional_image');
                    // echo '<img src="'. ($ca_image['url']) .'" alt="'. ($ca_image['alt']) .'">';
                    echo '<div class="image-holder"><img src="'. ($ca_image['url']) .'" alt="'. ($ca_image['alt']) .'"></div>';
                endif; ?>
                <div class="right">
                <?php if( get_field('2_column_additional_title') ): ?>
                    <h2><?php the_field('2_column_additional_title'); ?></h2>
                    <?php the_field('2_column_additional_copy'); ?>
                <?php endif; ?>
                </div>
            </div>
        </div>
    </section>

<?php get_footer(); ?>
