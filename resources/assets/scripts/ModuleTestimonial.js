import '@bower_components/owl-carousel/dist/owl.carousel.js';
import '@bower_components/owl-carousel/dist/assets/owl.carousel.css';
// import 'owl.carousel';

jQuery(document).ready(function(){
    jQuery( ".testimonial-carousel" ).each(function( index ) {
        // console.log( index);
        jQuery(this).owlCarousel({
            items:3,
            margin:5,
            // nav:true,
            responsive:{
                0: {
                    items:1
                },
                767: {
                    items: 2
                },
                991: {
                    items: 2
                },
                1200: {
                    items:3
                },
                1500: {
                    items:3
                }
            }
        });
    });
})