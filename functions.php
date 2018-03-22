<?php
// DISABLE WPML CSS AND JS
define('ICL_DONT_LOAD_NAVIGATION_CSS', true);
define('ICL_DONT_LOAD_LANGUAGE_SELECTOR_CSS', true);
define('ICL_DONT_LOAD_LANGUAGES_JS', true);

require_once( __DIR__ . '/vendor/autoload.php' );
$template_directory = get_template_directory();
$timber = new Timber\Timber();
$timber::$locations = $template_directory.'/resources/views';
$twig = new App\Oye\Twig();

$variables = new App\Oye\Variables();
// $variables->add_var('PAGE_OLDBROWSER', 1, false);
require_once (dirname(__FILE__) . '/includes/post-types.php');
require_once (dirname(__FILE__) . '/includes/sidebars.php');
require_once (dirname(__FILE__) . '/includes/theme-functions.php');
require_once (dirname(__FILE__) . '/includes/custom-functions.php');

add_action('wp_head', function() use ($variables){
    $variables->process();
}, 0);


// add_filter('timber_context', 'add_to_context');
// function add_to_context($data){
//     global $theme_opt;
//     $data['theme_opt'] = $theme_opt;
//     return $data;
// }

add_action( 'wp_enqueue_scripts', 'oye_scripts' );
function oye_scripts() {
    global $variables;
    $template_directory_url = get_template_directory_uri();
    wp_enqueue_style( 'css-vendor', $template_directory_url.'/dist/vendor.css', array(), '' );
    wp_enqueue_style( 'css-main', $template_directory_url.'/dist/main.css', array(), '' );
    wp_enqueue_style( 'style', $template_directory_url.'/style.css', array(), '' );
    
    wp_enqueue_script( "js-vendor", $template_directory_url."/dist/vendor.js", array('jquery'), '', false );
    wp_enqueue_script( "js-main", $template_directory_url."/dist/main.js", array('jquery'), '', false );
    wp_enqueue_script( "js-custom", $template_directory_url."/resources/assets/js/custom.js", array('jquery'), '', false );
}

if( function_exists('acf_add_options_page') ) {
	acf_add_options_page();
}


$moduleTestimonial = new App\OyeTheme\ModuleTestimonial();