<?php
	get_header();
	// echo "<pre>";
	// var_dump(get_fields());

	
	$fields = get_fields();
	$content = $fields['content'] ? $fields['content'] : [];
	foreach ($content as $key => $value) {
		if($value['acf_fc_layout']=='header') {
			$navHtml = wp_nav_menu(array(
				// 'menu' => 'header_menu',
				'container' => false,
				'menu_class' => 'nav-menu hidden-xs hidden-sm hidden-md header-menu',
				'echo' => false
			));
			$template = $twig->instance->load('header.twig');
			echo $template->render(array(
				'logo' => get_field('logo', 'option'),
				'navHtml' => $navHtml
			));
		}

		if($value['acf_fc_layout']=='testimonial') {
			echo $moduleTestimonial->render(array(
				'heading' => $value['heading'],
				'subHeading' => $value['subHeading']
			));	
		}
	}
	// var_dump($timber::get_post());

	// var_dump($moduleTestimonial->list());

	// $moduleTestimonial->render();
	
	// $twig = new App\Oye\Twig();
	// $template = $twig->instance->load('ModuleTestimonial.twig');
    // echo $template->render(array(
	// 	'heading' => 'Testimonials',
	// 	'subHeading' => 'Find below all testimonials',
	// 	'testimonials' => $moduleTestimonial->list()
	// ));

	// echo $template->render(array(
	// 	'heading' => 'Testimonials',
	// 	'subHeading' => 'Find below all testimonials',
	// 	'testimonials' => $moduleTestimonial->list()
	// ));

	// $context = $timber::get_context();
	// $context['post'] = $timber::get_post();
	// echo $timber::compile('index.twig', $context);

	get_footer();
?>


