<?php
/**
 * The header for our theme.
 *
 * Displays all of the <head> section and everything up till <div id="content">
 *
 * @package custom
 */

?><!doctype html>
<html <?php language_attributes(); ?>>
<head>
<meta charset="<?php bloginfo( 'charset' ); ?>">
<meta name="viewport" content="width=device-width, initial-scale=1">
<meta name="google-site-verification" content="LMPFo3EfMEMfW5qnJuO0I_qxYfkaDKe_hPyPBFeKSaE" />
<link rel="profile" href="http://gmpg.org/xfn/11">
<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">

<?php wp_head(); 
/*
    <!-- Google Analytics 4 -->
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-5LR22TC');</script>
    <!-- End Google Tag Manager -->

    <!-- Google Analytics 4 -->
    <!-- Google tag (gtag.js) -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=G-2SEW1HERYY"></script>
    <script>
        window.dataLayer = window.dataLayer || [];
        function gtag(){dataLayer.push(arguments);}
        gtag('js', new Date());

        gtag('config', 'G-2SEW1HERYY');
    </script>


    <!-- Google Tag Manager >
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-TPS4JPG');</script>
    End Google Tag Manager -->
    
    <!-- Google tag (gtag.js) - Google Ads -->
    <script async src="https://www.googletagmanager.com/gtag/js?id=AW-925192800"></script>
    <script>
    window.dataLayer = window.dataLayer || [];
    function gtag(){dataLayer.push(arguments);}
    gtag('js', new Date());

    gtag('config', 'AW-925192800');
    </script>
    */
 ?>

<!-- Google tag (gtag.js) -->
<script async src="https://www.googletagmanager.com/gtag/js?id=G-WNK6EMFY0Z"></script>
<script>
   window.dataLayer = window.dataLayer || [];
   function gtag(){dataLayer.push(arguments);}
   gtag('js', new Date());

   gtag('config', 'G-WNK6EMFY0Z');
</script>
</head>

<body <?php body_class(); ?>>

<?php wp_body_open(); ?>

<?php do_action( 'custom_before_site' ); ?>

<div id="page" class="hfeed site">
	<?php get_template_part( 'template-parts/header/site-header' ); ?>
	<!-- <div class="black-friday-cta">
		<div class="black-friday-cta__text">Black Friday Deal - up to 50% off on selected items</div>
		<div class="black-friday-cta__button"><a href="/shop/black-friday">Shop Now</a></div>
	</div> -->
<!-- 	<div class="black-friday-cta">
		<div class="black-friday-cta__text">No deliveries between 22nd December and 2nd January</div>
		<div class="black-friday-cta__button"><a href="/delivery-information">Find out more</a></div>
	</div> -->
	<?php
	/**
	 * Functions hooked in to custom_before_content
	 *
	 * @hooked custom_header_widget_region - 10
	 * @hooked woocommerce_breadcrumb - 10
	 */
	do_action( 'custom_before_content' );
	?>

	<div id="content" class="site-content" tabindex="-1">

		<?php
		do_action( 'custom_content_top' );
