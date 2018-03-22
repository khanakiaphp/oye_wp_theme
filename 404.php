<?php
	get_header();
	$context = $timber::get_context();
	echo $timber::compile('404.twig', $context);
	get_footer();
?>


