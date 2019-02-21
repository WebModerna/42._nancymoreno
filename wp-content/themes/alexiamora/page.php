<?php
/*
* page.php
* @package WordPress
* @subpackage alexiamora
* @since alexiamora 1.0
*/
get_header();?>
<?php if ( have_posts() ) : ?>
			<h2><?php the_title();?></h2>
		</div><!-- .encabezado -->
	</header>
<?php while( have_posts() ) : the_post();?>
<section class="posts">
	<article class="fondo_oscuro">
		<figure>
			<?php if(wpmd_is_notphone()) { ?>
				<?php
					if( has_post_thumbnail() ) {
						the_post_thumbnail('custom-thumb-600-334');
					} else {
						echo '<img src="'.get_stylesheet_directory_uri().'/img/nota.jpg" alt="'.__('Sin imagen', 'alexiamora').'" />';
					};
				?>
			<?php } else { ?>
				<?php
					if( has_post_thumbnail() ) {
						the_post_thumbnail('custom-thumb-600-334');
					} else {
						echo '<img src="'.get_stylesheet_directory_uri().'/img/nota.jpg" alt="'.__('Sin imagen', 'alexiamora').'" />';
					};
				?>
			<?php };?>
		</figure>
		<div class="contenido">
			<?php the_content();?>
		</div>
	</article>
<?php endwhile; else: ?>
	<article class="fondo_oscuro">
		<h3><?php _e('No hay nada publicado hasta ahora.', 'alexiamora');?></h3>
	</article>
<?php endif;?>
</section>
<?php get_footer();?>