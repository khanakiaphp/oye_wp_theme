<!DOCTYPE html>
<html <?php language_attributes(); ?>>
<head>
<title>
	<?php
		echo wp_title('', true, 'right');
	?>
</title>

<meta charset="<?php bloginfo( 'charset' ); ?>" />
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no">

<?php wp_head(); ?>
<?php //get_template_part('favicons'); ?>
</head>
<body <?php body_class(); ?>>
