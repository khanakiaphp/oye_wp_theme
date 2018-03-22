<?php
namespace App\OyeTheme;

class ModuleTestimonial {
    public function __construct ($args=[]) {
        add_action('init', array( $this, '_init'), 0);
    }

    function _init() {
        $this->registerPostType();
        $this->registerCustomFields();
    }

    function registerPostType() {
        $labels = array(
            "name" => __( "Testimonials", "oyetheme" ),
            "singular_name" => __( "Testimonial", "oyetheme" ),
        );

        $args = array(
            "label" => __( "Testimonials", "oyetheme" ),
            "labels" => $labels,
            "description" => "",
            "public" => false,
            "publicly_queryable" => true,
            "show_ui" => true,
            "show_in_rest" => false,
            "rest_base" => "",
            "has_archive" => false,
            "show_in_menu" => true,
            "exclude_from_search" => false,
            "capability_type" => "post",
            "map_meta_cap" => true,
            "hierarchical" => false,
            "rewrite" => false,
            "query_var" => true,
            "supports" => array( "title", "editor", "thumbnail" ),
        );

        register_post_type( "testimonial", $args );
    }


    function registerCustomFields() {
        if( function_exists('acf_add_local_field_group') ):

            acf_add_local_field_group(array (
                'key' => 'group_5ab22d0371f22',
                'title' => 'Testimonial',
                'fields' => array (
                    array (
                        'key' => 'field_5ab22d128d67b',
                        'label' => 'Rating',
                        'name' => 'rating',
                        'type' => 'select',
                        'instructions' => '',
                        'required' => 0,
                        'conditional_logic' => 0,
                        'wrapper' => array (
                            'width' => '25',
                            'class' => '',
                            'id' => '',
                        ),
                        'choices' => array (
                            1 => '1',
                            2 => '2',
                            3 => '3',
                            4 => '4',
                            5 => '5',
                        ),
                        'default_value' => array (
                            0 => 5,
                        ),
                        'allow_null' => 0,
                        'multiple' => 0,
                        'ui' => 0,
                        'ajax' => 0,
                        'return_format' => 'value',
                        'placeholder' => '',
                    ),
                ),
                'location' => array (
                    array (
                        array (
                            'param' => 'post_type',
                            'operator' => '==',
                            'value' => 'testimonial',
                        ),
                    ),
                ),
                'menu_order' => 0,
                'position' => 'normal',
                'style' => 'default',
                'label_placement' => 'top',
                'instruction_placement' => 'label',
                'hide_on_screen' => '',
                'active' => 1,
                'description' => '',
            ));
            
            endif;
    }

    function list(){
        $args = array(
            'posts_per_page'   => 20,
            'orderby'          => 'date',
            'order'            => 'DESC',
            'post_type'        => 'testimonial',
            'post_status'      => 'publish',
        );
        $posts = get_posts($args);
        $result = [];
        foreach ($posts as $key => $value) {
        	$result[] = $this->transform($value);
        }

        return $result;

    }

    function transform($post, $array=false) {
        $response = array(
            'post_title' => $post->post_title,
            'post_content' => $post->post_content,
            'rating' => get_field( "rating", $post->ID ),
            'published_date' => get_the_date( 'm/d/Y', $post->ID ),
        );

        $response = json_decode(json_encode($response), $array);
        return $response;
    }
   

    function render($atts) {
        $attr = shortcode_atts( array(
            "heading" => __("Testimonials"),
            "subHeading" => "",
        ), $atts );
        $twig = new \App\Oye\Twig();
        $template = $twig->instance->load('ModuleTestimonial.twig');
        return $template->render(array(
            'heading' => $attr['heading'],
            'subHeading' => $attr['subHeading'],
            'testimonials' => $this->list()
        ));
    }
}


?>