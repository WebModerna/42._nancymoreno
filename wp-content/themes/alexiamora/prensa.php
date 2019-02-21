<?php
/*
* @package WordPress
* @subpackage alexiamora
* @since alexiamora 1.0
* Template Name: Prensa y Noticias
*/
get_header();?>
			<h2><?php _e('Prensa y Noticias', 'alexiamora') ?></h2>
		</div><!-- .encabezado -->
	</header>
<section class="posts">

<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array (
	'post_type'			=>	'post',
	'posts_per_page'	=>	get_option('posts_per_page'),
	'paged'				=>	$paged,
	'order'				=>	'DESC'
	);
$wp_query = new WP_Query($args);
if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post();?>

	<article class="fondo_oscuro">
		<h3><?php the_title();?></h3>
		<figure>
			<a href="<?php the_permalink();?>">
				<?php
					if( has_post_thumbnail() ) {
						the_post_thumbnail('custom-thumb-600-334');
					} else {
						echo '<img src="'.get_stylesheet_directory_uri().'/img/nota.jpg" alt="'.__('Sin imagen', 'alexiamora').'" />';
					};
				?>
			</a>
			<figcaption>
				<?php _e('Publicado el: ','alexiamora'); the_time('j/m/Y');?>
			</figcaption>
		</figure>

		<div class="contenido">
			<?php the_excerpt();?>
			<a href="<?php the_permalink();?>" class="ver_mas"><?php _e('Ver más...', 'alexiamora');?></a>
		</div>
	</article>
<?php
endwhile;
	if (function_exists("pagination")) {
		pagination();
	};
else: ?>
	<article>
		<h3><?php _e('No hay ninguna entrada publicada hasta ahora.', 'alexiamora');?></h3>
	</article>
<?php endif; wp_reset_postdata(); wp_reset_query();?>
</section>
<?php get_footer();?>