jQuery(function() {
  jQuery('.js-accordion').accordion({
     headersSelector: '> .js-accordion__header', // relative to panel
     panelsSelector: '> .js-accordion__panel', // relative to wrapper
     buttonsSelector: '> button.js-accordion__header' // relative to wrapper
  });
});

jQuery(".dropdown-init").click(function(){
	if(jQuery(this).hasClass("active")){
		$(this).removeClass("active");
		$(".megamenu").removeClass("active");
	}else{
		$(this).addClass("active");
		$(".megamenu").addClass("active");
	}
});

jQuery(".nav-trigger").click(function(){
	if(jQuery(this).hasClass("active")){
		$(this).removeClass("active");
		$(".main-nav").removeClass("active");
	}else{
		$(this).addClass("active");
		$(".main-nav").addClass("active");
	}
});

jQuery(".coupon-init").click(function(){
	if(jQuery(this).hasClass("active")){
		$(this).removeClass("active");
		$(".coupon").removeClass("active");
	}else{
		$(this).addClass("active");
		$(".coupon").addClass("active");
	}
});

jQuery(".our-brands .show-more").click(function(){
	$(".our-brands").toggleClass("show");
});

jQuery(".product-details-main .woocommerce-product-rating, .product-details-main .yith-wcwl-add-to-wishlist").wrapAll('<div class="top flex" />')

jQuery(".product-details-main .price").eq(1).wrapAll('<div class="product-option" />');

jQuery( ".woocommerce-product-details__short-description .paws p" ).wrap( "<li></li>" );


jQuery('.owl-carousel').owlCarousel({
    loop:true,
    margin:20,
    nav:false,
    dots: true,
    responsive:{
        0:{
            items:2
        },
        600:{
            items:3
        },
        1000:{
            items:5
        }
    }
});
