<?php
/**
 * Displays the site header.
 *
 * @package WordPress
 */
$wrapper_classes = 'header-primary site-header';
$wrapper_classes .= has_custom_logo() ? ' has-logo' : '';
$wrapper_classes .= ( true === get_theme_mod( 'display_title_and_tagline', true ) ) ? ' has-title-and-tagline' : '';
$wrapper_classes .= has_nav_menu( 'primary' ) ? ' has-menu' : '';
?>
<header class="<?php echo esc_attr( $wrapper_classes ); ?>">
    <div class="note-bar">
        <div class="inner flex-mob a-center">
            <p class="wicon w-text truck"><?php the_field('priority_red_banner_message', 'option'); ?></p>
            <p class="wicon w-text cart" style="background-image: url(/wp-content/uploads/2023/10/icon-cart-white.png)">Minimum order: £15</p>
            <div class="right flex">
                <?php wp_nav_menu( array( 'theme_location'=>'top-menu', 'container_class'=>'secondary-nav' ) ); ?>
                <div class="user-nav">
                    <nav>
                        <ul>
                            <?php
                            if ( is_user_logged_in() ) { ?>
                            <li><a href="/favourites">
                                    <svg width="21" height="20" viewBox="0 0 21 20" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path d="M2.04176 8.63254L2.04107 8.63172C1.32733 7.78821 0.9375 6.71689 0.9375 5.6125C0.9375 3.04274 3.02043 0.9375 5.54063 0.9375C7.16463 0.9375 8.61849 1.74626 9.4612 3.13996L9.46113 3.14L9.46595 3.14766L10.0769 4.11797L10.5077 4.80226L10.9274 4.11105L11.5349 3.11042C12.4162 1.74328 13.8754 0.9375 15.4594 0.9375C17.9796 0.9375 20.0625 3.04274 20.0625 5.6125C20.0625 6.71689 19.6727 7.78821 18.9589 8.63172L18.9582 8.63254L10.5 18.6724L2.04176 8.63254Z" fill="white" stroke="white" />
                                    </svg>
                                </a>
                            </li>
                            <?php } ?>
                            <li>
                            	<a href="/my-account">
                                    <svg width="20" height="22" viewBox="0 0 20 22" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M0.0742403 22C-0.10084 21.4476 -0.0638701 20.0214 1.29302 19.0299C1.38346 18.9638 1.48001 18.8954 1.58266 18.8247L1.90889 18.6058L2.27171 18.3731L2.67111 18.1267L3.10711 17.8665L3.57969 17.5926L4.08886 17.3049L4.92122 16.8475L5.52186 16.5254L6.8329 15.8399L6.83047 15.5048L6.82163 15.2756C6.79456 14.821 6.70255 14.4099 6.38971 14.4099C4.6499 14.4099 3.77557 12.102 3.37152 9.87006L3.30118 9.45304L3.24128 9.04129C3.23214 8.9733 3.2234 8.90567 3.21507 8.83848L3.16975 8.44119L3.13342 8.05789L3.10552 7.69209L3.08545 7.34728L3.07264 7.02694L3.06578 6.59997C3.06578 2.95491 6.04213 0 9.71364 0H9.69812H9.71364H9.69812C13.3696 0 16.346 2.95491 16.346 6.59997L16.3391 7.02694L16.3263 7.34728L16.3062 7.69209L16.2783 8.05789L16.242 8.44119L16.1967 8.83848C16.1884 8.90567 16.1796 8.9733 16.1705 9.04129L16.1106 9.45304L16.0402 9.87006C15.6362 12.102 14.7619 14.4099 13.0221 14.4099C12.7092 14.4099 12.6172 14.821 12.5901 15.2756L12.5813 15.5048L12.5789 15.8399L13.8899 16.5254L14.4905 16.8475L15.3229 17.3049L15.8321 17.5926L16.3047 17.8665L16.7407 18.1267L17.1401 18.3731L17.5029 18.6058L17.8291 18.8247C17.9318 18.8954 18.0283 18.9638 18.1187 19.0299C19.4756 20.0214 19.5126 21.4476 19.3375 22H0.0742403Z" fill="white" />
                                    </svg>
                                </a></li>
                            <li class="user-nav-basket">
                            	<a href="/basket"><svg width="28" height="25" viewBox="0 0 28 25" fill="none" xmlns="http://www.w3.org/2000/svg">
                                        <path fill-rule="evenodd" clip-rule="evenodd" d="M17.055 0.251899C17.9532 -0.266657 19.1017 0.0410769 19.6202 0.939243L24.6995 9.7367L25.4293 9.73713C26.7257 9.73713 27.7767 10.7881 27.7767 12.0845C27.7767 13.3808 26.7257 14.4318 25.4293 14.4318L25.1164 14.4313L22.5343 24.76H5.63358L3.05152 14.4313L2.34732 14.4318C1.05093 14.4318 0 13.3808 0 12.0845C0 10.7881 1.05093 9.73713 2.34732 9.73713L3.34165 9.7367L8.42186 0.939243C8.94041 0.0410769 10.0889 -0.266657 10.9871 0.251899C11.8852 0.770455 12.193 1.91894 11.6744 2.8171L7.67856 9.7367H20.3626L16.3677 2.8171C15.8738 1.96171 16.1294 0.879267 16.9308 0.330168L17.055 0.251899Z" fill="white" />
                                    </svg><span><?php echo WC()->cart->get_cart_contents_count(); ?></span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="header-main">
        <div class="inner flex-mob a-center">
            <a href="/" class="logo">
                <img src="/wp-content/themes/custom/base_html/www/images/petrange-logo.svg" alt="Pet Range">
            </a>
            <div class="right flex-mob a-center">
                <button class="dropdown-init cs-button dashed green"><span>View all</span><img src="/wp-content/themes/custom/base_html/www/images/icons/icon-chevron-down-white.svg" alt=""></button>
                <button class="nav-trigger" for="nav-trigger">
                    <span>
                        <span></span>
                    </span>
                </button>
				<?php get_template_part( 'template-parts/header/site-nav' ); ?>
                <?php wp_nav_menu( array( 'theme_location'=>'main-menu', 'container_class'=>'main-nav primary-menu' ) ); ?>
            </div>
        </div>
    </div>
    <div class="search-main">
        <div class="inner flex jc-center a-center">
            <form action="/shop" method="POST">
                <input id="filter-results-search" type="search" name="s" placeholder="Search products">
                <input type="hidden" name="post_type" value="product">
                <input type="hidden" name="title" value="1">
                <input type="hidden" name="excerpt" value="1">
                <input type="hidden" name="content" value="1">
                <input type="hidden" name="categories" value="1">
                <input type="hidden" name="attributes" value="1">
                <input type="hidden" name="tags" value="1">
                <input type="hidden" name="sku" value="1">
                <input type="hidden" name="orderby" value="date-DESC">
                <input type="hidden" name="ixwps" value="1">
                <input type="submit" class="wicon mag">
            </form>
        </div>
    </div>
    <div class="megamenu">
        <div class="inner">
            <div class="flex col-1-2-1 mega-menu-popular">
                <div class="col">
                    <h3>Popular categories</h3>
                    <?php 
                    $terms = get_field('popular_categories_list', 'option');
                    if( $terms ): ?>
                        <ul>
                        <?php foreach( $terms as $term ): ?>
                            <li>
                                <a class="cs-button full yellow icon after arrow slim" href="<?php echo esc_url( get_term_link( $term ) ); ?>"><?php echo esc_html( $term->name ); ?></a>
                            </li>
                        <?php endforeach; ?>
                        </ul>
                    <?php endif; ?>
                </div>
                <div class="col mega-menu-brands">
                    <h3>Our brands</h3>
                    <div class="flex a-stretch col-2">
                    <?php 
                    $args = array(
                        'post_type' => 'brands',
                        'posts_per_page' => '-1',
                        'order' => 'DESC',
                        'post_status' => 'publish'

                    );
                    $the_query = new WP_Query( $args );
                    // The Loop
                    if ( $the_query->have_posts() ) {
                        while ( $the_query->have_posts() ) {
                            $the_query->the_post();
                            ?>
                                <div class="brand">
                                    <?php $term = get_field('product_category_page_link');
                                    if( $term ): ?>
                                    <a href="<?php echo esc_url( get_term_link( $term )); ?>">                                        
                                    <?php endif; ?>
                                        <div class="brand-logo">
                                            <?php 
                                            $image = get_field('brand_logo');
                                            if( !empty( $image ) ): ?>
                                                <img src="<?php echo esc_url($image['url']); ?>" alt="<?php echo esc_attr($image['alt']); ?>" />
                                            <?php endif; ?>
                                        </div>
                                        <div class="brand-content">
                                            <h5><?php the_title(); ?></h5>
                                        </div>
                                    </a>
                                </div>
                            <?php } 
                        wp_reset_postdata();
                    } ?>
                    </div>
                </div>
                <div class="col popular">
                    <h3>Shop by pet type</h3>
                    <?php
                    $terms = get_field('shop_by_pet_type_categories', 'option');
                    if( $terms ): ?>
                        <?php foreach( $terms as $term ): ?>
                            <div class="mega-menu-cta bg-<?php the_field('background_colour', $term);?>">
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
        </div>
    </div>
</header>

<style>
    .klaviyo-sidebar-floating {
        position: fixed;
        top: 35%;
        right: 0;
        z-index: 10;
    }
    .klaviyo-sidebar-floating .sidebar-text {
        position: absolute;
        right: -72px;
        z-index: 2;
        display: -webkit-box;
        display: -ms-flexbox;
        display: flex;
        width: 190px;
        padding: 14px 55px 15px 30px;
        font-size: 16px;
        font-weight: 600;
        color: #fff;
        text-decoration: none;
        background-color: #383838;
        -webkit-transform: rotate(-90deg);
        -ms-transform: rotate(-90deg);
        transform: rotate(-90deg);
        outline: none !important;
    }
    .klaviyo-sidebar-floating .sidebar-text:focus {
        outline: none !important;
    }
    .klaviyo-sidebar-floating .sidebar-text::before,
    .klaviyo-sidebar-floating .sidebar-text::after {
        content: '';
        position: absolute;
        top: 24px;
        width: 12px;
        height: 2px;
        background-color: #fff;
    }
    .klaviyo-sidebar-floating .sidebar-text::before {
        right: 30px;
        -webkit-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        transform: rotate(-45deg);
    }
    .klaviyo-sidebar-floating .sidebar-text::after {
        right: 23px;
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    .klaviyo-sidebar-floating.sidebar-show .sidebar-text::before {
        -webkit-transform: rotate(45deg);
        -ms-transform: rotate(45deg);
        transform: rotate(45deg);
    }
    .klaviyo-sidebar-floating.sidebar-show .sidebar-text::after {
        -webkit-transform: rotate(-45deg);
        -ms-transform: rotate(-45deg);
        transform: rotate(-45deg);
    }
    .klaviyo-sidebar-floating.sidebar-show .sidebar-content {
        right: 47px;
    }
    .klaviyo-sidebar-floating .sidebar-content {
        position: absolute;
        top: -71px;
        right: -275px;
        z-index: 1;
        width: 320px;
        height: 190px;
        padding: 20px 30px;
        background: #101010;
        -webkit-transition: ease-in-out .2s all;
        -o-transition: ease-in-out .2s all;
        transition: ease-in-out .2s all;
    }
    .klaviyo-sidebar-floating .sidebar-content h3,
    .klaviyo-sidebar-floating .sidebar-content p {
        color: #fff;
    }
    .klaviyo-sidebar-floating .sidebar-content h3 {
        margin-bottom: 10px;
        font-size: 24px;
    }
    .klaviyo-sidebar-floating .sidebar-content p {
        margin-bottom: 15px;    
        font-size: 14px;
    }
    .klaviyo-sidebar-floating form.klaviyo-form [data-testid="form-row"] > [data-testid="form-component"] > .needsclick > input[type="email"] {
        padding: 0 15px !important;
        text-align: center !important;
    }
    .klaviyo-sidebar-floating form.klaviyo-form [data-testid="form-component"] > button.needsclick[type="button"] {
        margin-top: 5px !important;
    }
    @media (max-width: 767px) {
        .klaviyo-sidebar-floating {
            display: none;
        }
    }
</style>
<div class="klaviyo-sidebar-floating">
    <a href="#" class="sidebar-text">NEWSLETTER</a>
    <div class="sidebar-content">
        <h3><span class="yellow">Sign up</span> to our newsletter</h3>
        <p style="display: none;">And receive <span class="red">10% off</span> your next order</p>
        <div class="klaviyo-sidebar">
            <div class="klaviyo-form-SjP8kB"></div>
        </div>
    </div>
</div>
<script>
    var $ = jQuery;
    $('.klaviyo-sidebar-floating .sidebar-text').click(function(e) {
        e.preventDefault();
        $(this).parent().toggleClass('sidebar-show');
    });
</script>
