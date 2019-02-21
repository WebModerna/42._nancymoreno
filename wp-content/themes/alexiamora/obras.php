<?php
/*
* @package WordPress
* @subpackage alexiamora
* @since alexiamora 1.0
* Template Name: Portfolio de Obras
*/
get_header();?>
			<h2><?php _e('Obras', 'alexiamora'); ?></h2>
		</div><!-- .encabezado -->
	</header>
<section class="posts_inline">
<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array (
	'post_type'			=>	'post_type_obra',
	'posts_per_page'	=>	get_option('posts_per_page'),
	'paged'				=>	$paged,
	'taxonomy'			=>	'pinturas',
	'order'				=>	'DESC'
	);
$wp_query = new WP_Query($args);
if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post();?>

	<article>
		<figure>
		<?php if(wpmd_is_notphone()) { ?>
			<?php
				$custom_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'custom-thumb-1800-x' );
				if(has_post_thumbnail()) {
					$src = $custom_thumb['0'];
				} else {
					$src = get_stylesheet_directory_uri().'/img/logo.png';
				};
			;?>
			<a href="<?php the_permalink();?>">
			<?php
				if( has_post_thumbnail() ) {
					the_post_thumbnail('custom-thumb-600-334');
				} else {
					echo '<img src="'.get_stylesheet_directory_uri().'/img/nota.jpg" alt="'.__('Sin imagen', 'alexiamora').'" />';
				};
			?>
		<?php } else { ?>
			<a href="<?php the_permalink();?>">
			<?php
				if( has_post_thumbnail() ) {
					the_post_thumbnail('custom-thumb-600-x');
				} else {
					echo '<img src="'.get_stylesheet_directory_uri().'/img/nota.jpg" alt="'.__('Sin imagen', 'alexiamora').'" />';
				};
			?>
			</a>
		<?php };?>
			</a>
			<figcaption>
				<?php the_title();?>
			</figcaption>
		</figure>
	</article>
<?php
	endwhile;
	if (function_exists("pagination")){pagination();};
	else: ?>
	<article>
		<h3><?php _e('No hay ninguna obra publicada hasta ahora.', 'alexiamora');?>
		</h3>
	</article>
<?php endif; wp_reset_postdata(); wp_reset_query();?>
</section>
<?php get_footer();?>