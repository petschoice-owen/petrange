jQuery(function() {
  jQuery('.js-accordion').accordion({
     headersSelector: '> .js-accordion__header', // relative to panel
     panelsSelector: '> .js-accordion__panel', // relative to wrapper
     buttonsSelector: '> button.js-accordion__header' // relative to wrapper
  });
});

jQuery(".dropdown-init").click(function(){
	if(jQuery(this).hasClass("active")){
		jQuery(this).removeClass("active");
		jQuery(".megamenu").removeClass("active");
	}else{
		jQuery(this).addClass("active");
		jQuery(".megamenu").addClass("active");
	}
});

jQuery(".nav-trigger").click(function(){
	if(jQuery(this).hasClass("active")){
		jQuery(this).removeClass("active");
		jQuery(".main-nav").removeClass("active");
	}else{
		jQuery(this).addClass("active");
		jQuery(".main-nav").addClass("active");
	}
});

jQuery(".coupon-init").click(function(){
	if(jQuery(this).hasClass("active")){
		jQuery(this).removeClass("active");
		jQuery(".coupon").removeClass("active");
	}else{
		jQuery(this).addClass("active");
		jQuery(".coupon").addClass("active");
	}
});

jQuery(".our-brands .show-more").click(function(){
	jQuery(".our-brands").toggleClass("show");
});

jQuery(".product-details-main .woocommerce-product-rating, .product-details-main .yith-wcwl-add-to-wishlist").wrapAll('<div class="top flex" />')

jQuery(".product-details-main .price").eq(1).wrapAll('<div class="product-option" />');

// jQuery(".woocommerce-product-details__short-description .paws p").wrap( "<li></li>" );


jQuery('.owl-carousel:not(.js-home-hero)').owlCarousel({
    loop:true,
    margin:20,
    nav:true,
    dots: true,
    responsive:{
        0:{
            items:2
        },
        960:{
            items:4
        }
    }
});
jQuery('.js-home-hero').owlCarousel({
	items: 1,
  autoplay: true,
  autoplayTimeout: 8000
});



var linkToggle = document.querySelectorAll('.cs-toggle');

for(i = 0; i < linkToggle.length; i++){
  linkToggle[i].addEventListener('click', function(event){
    event.preventDefault();
    var container = document.getElementById(this.dataset.container);
    if (!container.classList.contains('active')) {
      container.classList.add('active');
      container.style.height = 'auto';
      var height = container.clientHeight + 'px';
      container.style.height = '0px';
      this.classList.add('active');
      setTimeout(function () {
        container.style.height = height;
      }, 0);
    } else {
      container.classList.remove('active');
      this.classList.remove('active');
      container.style.height = '0px';
      container.addEventListener('transitionend', function () {
        container.classList.remove('active');
      }, {
        once: true
      }); 
    }
  });
}
