<?php
/*
* single-obras.php
* @package WordPress
* @subpackage alexiamora
* @since alexiamora 1.0
*/
get_header();?>
			<h2><?php the_title();?></h2>
		</div><!-- .encabezado -->
	</header>
<section class="posts">
<?php if (have_posts()) : while( have_posts() ) : the_post();?>
	<article class="fondo_oscuro">
		<figure class="img_full">
			<?php if(wpmd_is_notphone()) { ?>
			<?php
				$custom_thumb = wp_get_attachment_image_src( get_post_thumbnail_id($post->ID), 'custom-thumb-1800-x' );
				if(has_post_thumbnail()) {
					$src = $custom_thumb['0'];
				} else {
					$src = get_stylesheet_directory_uri().'/img/logo.png';
				};
			;?>
			<a class="fancybox" rel="gallery" href="<?php echo $src;?>">
				<?php
					if( has_post_thumbnail() ) {
						the_post_thumbnail('custom-thumb-1800-x');
					} else {
						echo '<img src="'.get_stylesheet_directory_uri().'/img/nota.jpg" alt="'.__('Sin imagen', 'alexiamora').'" />';
					};
				?>
			</a>
			<?php } else { ?>
				<?php
					if( has_post_thumbnail() ) {
						the_post_thumbnail('custom-thumb-600-x');
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
	<article class="navegacion_posts fondo_oscuro">
		<?php if(get_previous_post_link()!='') { ?>
		<p>
			<?php echo _e("Anterior: ", "alexiamora");?><span class="ver_mas"><?php previous_post_link();?></span>
		</p>
		<?php };
		if(get_next_post_link()!='') { ?>
		<p>
			<?php echo _e("Siguiente: ", "alexiamora");?><span class="ver_mas"><?php next_post_link();?></span>
		</p>
		<?php };?>
	</article>
	<article class="listado_comentarios fondo_oscuro">
		<?php comments_template();?>
	</article>

<?php endwhile; endif;?>
</section>
<?php get_footer();?>