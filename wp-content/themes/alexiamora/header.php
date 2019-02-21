<!DOCTYPE html>
<html <?php language_attributes();?>>
<head>
	<meta charset="<?php bloginfo('charset');?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1.0, minimum-scale=1.0, maximum-scale=1.5, user-scalable=yes" />
	<meta name="author" content="...:: WebModerna | el futuro de la web ::..." />
	<meta name="author URL" content="www.webmoderna.com.ar" />
<?php
$meta_keywords2 = of_get_option('meta_keywords2','');
$meta_description_web = of_get_option('meta_description_web', '');

if ( is_home() || is_search() || is_category() || is_tag() ) { ?>
	<title><?php bloginfo('name');?></title>

<?php
	if ( $meta_keywords2 )
	{
		echo '<meta name="keywords" content="' . $meta_keywords2 . '" />';
	}
	if ( $meta_description_web )
	{
		echo '<meta name="description" content="' . $meta_description_web . '" />';
	}
} elseif ( is_404() ) { ?>

	<title><?php _e('Error 404', 'alexiamora');?> | <?php bloginfo('name');?></title>

<?php
	if ( $meta_keywords2 )
	{
		echo '<meta name="keywords" content="' . $meta_keywords2 . '" />';
	}
	if ( $meta_description_web )
	{
		echo '<meta name="description" content="' . $meta_description_web . '" />';
	}

} else {
	$meta_description	= get_post_meta( $post->ID, '_my_meta_value_key2', true );
	$meta_keywords		= get_post_meta( $post->ID, '_my_meta_value_key3', true );
?>

	<title><?php the_title();?> | <?php bloginfo('name');?></title>

<?php if ( $meta_keywords )
	{
		echo '<meta name="keywords" content="' . $meta_keywords . '" />';
	}
	if ( $meta_description )
	{
		echo '<meta name="description" content="' . $meta_description . '" />';
	};
};

if(wpmd_is_ios()) { ?>
	<link rel="apple-touch-icon-precomposed" sizes="57x57" href="<?php bloginfo('stylesheet_directory');?>/img/apple-touch-icon-57x57.png" />
	<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php bloginfo('stylesheet_directory');?>/img/apple-touch-icon-114x114.png" />
	<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php bloginfo('stylesheet_directory');?>/img/apple-touch-icon-72x72.png" />
	<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php bloginfo('stylesheet_directory');?>/img/apple-touch-icon-144x144.png" />
	<link rel="apple-touch-icon-precomposed" sizes="60x60" href="<?php bloginfo('stylesheet_directory');?>/img/apple-touch-icon-60x60.png" />
	<link rel="apple-touch-icon-precomposed" sizes="120x120" href="<?php bloginfo('stylesheet_directory');?>/img/apple-touch-icon-120x120.png" />
	<link rel="apple-touch-icon-precomposed" sizes="76x76" href="<?php bloginfo('stylesheet_directory');?>/img/apple-touch-icon-76x76.png" />
	<link rel="apple-touch-icon-precomposed" sizes="152x152" href="<?php bloginfo('stylesheet_directory');?>/img/apple-touch-icon-152x152.png" />
<?php };?>
	<link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory');?>/img/favicon-196x196.png" sizes="196x196" />
	<link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory');?>/img/favicon-96x96.png" sizes="96x96" />
	<link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory');?>/img/favicon-32x32.png" sizes="32x32" />
	<link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory');?>/img/favicon-16x16.png" sizes="16x16" />
	<link rel="icon" type="image/png" href="<?php bloginfo('stylesheet_directory');?>/img/favicon-128.png" sizes="128x128" />
	<link rel="shortcut icon" type="image/x-icon" href="<?php bloginfo('stylesheet_directory');?>/favicon.ico" />
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/modernizr-2.8.3.min.js"></script>
	<link rel="stylesheet" href="<?php bloginfo('stylesheet_directory');?>/css/style.min.css" />
<?php if (wp_is_mobile()==false) { //Condicionales para IE ?>
	<!--[if IE 8]>
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/html5.js"></script>
	<script type="text/javascript" src="<?php bloginfo('stylesheet_directory');?>/js/respond.js"></script>
	<link type="text/css" rel="stylesheet" href="<?php bloginfo('stylesheet_directory');?>/css/styleIE8.css" />
	<![endif]-->
<?php };
// Background de la web
$background_de_la_web = of_get_option('background_de_la_web', '');
$background_retina_de_la_web = of_get_option('background_retina_de_la_web', '');
?>

<style type="text/css" media="screen">
#wrapper {
<?php if ( $background_de_la_web['color'] != null )	{ ?>
	background-color: <?php echo $background_de_la_web["color"];?>;
<?php }
	if ( $background_de_la_web['image'] != null ) { ?>
	background-image: url("<?php echo $background_de_la_web['image'];?>");
	background-repeat: <?php echo $background_de_la_web['repeat'];?>;
	background-position: <?php echo $background_de_la_web['position'];?>;
	background-attachment: <?php echo $background_de_la_web['attachment'];?>;
<?php };?>
}


@media only screen and (-webkit-min-device-pixel-ratio: 1.5), only screen and (-moz-min-device-pixel-ratio: 1.5), only screen and (-ms-min-device-pixel-ratio: 1.5), only screen and (-o-min-device-pixel-ratio: 1.5), only screen and (min-device-pixel-ratio: 1.5), only screen and (min-resolution: 240dpi) {
	#wrapper
	{
		<?php if ( $background_retina_de_la_web['color'] != null ) { ?>
		background-color: <?php echo $background_retina_de_la_web['color'];
		?>;

	<?php }
	if ( $background_retina_de_la_web['image'] != null ) { ?>
		background-image: url("<?php echo $background_retina_de_la_web['image'];?>");
		background-repeat: <?php echo $background_retina_de_la_web['repeat'];?>;
		background-position: <?php echo $background_retina_de_la_web['position'];?>;
		background-attachment: <?php echo $background_retina_de_la_web['attachment'];?>;
	<?php };?>
	}
}
</style>
<?php
	wp_head();

	$google_analitycs = of_get_option('google_analitycs','');
	if( $google_analitycs ) {
?>
	<script type="text/javascript"><?php echo $google_analitycs; ?></script>
<?php };?>
</head>
<body>
<?php if ( wpmd_is_notphone() ) { ?>
<div id="wrapper" data-0="background-position:0px 0px;" data-800000="background-position:0px -50000px;">
<!--[if lt IE 8]>
	<p class="browsehappy">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
	<p class="browsehappy">Estás usando un navegador <strong>muuuy viejo y desactualizado</strong>. Por favor <a href="http://browsehappy.com/">actualizá tu navegador</a> para mejorar tu experiencia :-)</p>
<![endif]-->
<?php } else { ?>
<div id="wrapper">
<?php };
if ( $background_de_la_web['image'] ) {
} else {
	// include (TEMPLATEPATH ."/includes/slider.php");
}?>
	<header>
		<?php if ( wpmd_is_notphone() ) { ?>
		<!-- <div id="top_bar" style="padding:1em;background:transparent;" data-0="display:none;" data-top-top="display:block;" data-anchor-target="#header_nav" data-edge-strategy="set">&nbsp;</div> -->
		<?php };?>
		<nav class="navegacion">
			<div class="boton_menu">
				<button id="menu" class="autor_menu">
					<img src="<?php bloginfo('stylesheet_directory');?>/img/boton_menu_web.png" alt="Menú" />
				</button>
			</div>
		<?php
			$default=array(
				'container'			=>	false,
				'depth'				=>	2,
				'menu'				=>	'header_nav',
				'theme_location'	=>	'header_nav',
				'items_wrap'		=>	'<ul id="header_nav" class="navegacion_principal">%3$s</ul>'
			);
			wp_nav_menu($default);
		?>
		</nav>
		<?php if( is_home() ) { ?>
		<div class="encabezado relative">
		<?php } else { ?>
		<div class="encabezado">
		<?php } ?>
			<?php if (is_front_page()) { ?>
			<h2><?php bloginfo('name');?></h2>
			<?php };?>
			<?php if (is_front_page()) { ?>
			<h1>
			<?php } else { ?>
			<h1 class="left">
			<?php };?>

			<!-- loop solo para el la imágen y el logo -->
				<a href="<?php bloginfo('url');?>" class="logo">
					<?php if ( is_front_page() ) { ?>
					<figure class="foto_alexia">
						<?php $logo_uploader3 =  of_get_option('logo_uploader3','');
						if ( $logo_uploader3 != null ) { ?>
						<img src="<?php echo $logo_uploader3 ?>" alt="<?php bloginfo('name');?>" />
						<?php };?>
					</figure>
				<?php };?>
				<?php if (is_front_page()) { ?>
					<figure>
				<?php } else { ?>
					<figure class="posicionada">
				<?php };?>
					<?php $logo_uploader2 =  of_get_option('logo_uploader2','');
						if ( $logo_uploader2 ) { ?>
						<img src="<?php echo $logo_uploader2;?>" alt="<?php bloginfo('name');?>" />
					<?php };?>
					</figure>
				</a>
			</h1>
