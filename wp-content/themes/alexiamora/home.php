<?php
/*
* @package WordPress
* @subpackage alexiamora
* @since alexiamora 1.0
*/
?>
<?php get_header();?>

			<?php $descripcion_web = of_get_option('descripcion_web','');
			if( $descripcion_web ) { ?>
			<h2><?php echo $descripcion_web;?></h2>
			<?php } else { ?>
			<h2><?php bloginfo('description');?></h2>
			<?php };?>
		</div><!-- .encabezado -->
	</header>
	<section class="index">
		<!-- <article>
			<h2><?php// _e('Biografía', 'alexiamora'); ?></h2>
			<?php /*$briografia_web = of_get_option('briografia_web', '');
			if( $briografia_web ) {
				echo $briografia_web;
			};*/?>
		</article> -->
		<?php // include_once "includes/slider.php"; ?>
	</section>

<?php get_footer();?>