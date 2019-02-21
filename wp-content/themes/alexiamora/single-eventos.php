<?php
/*
* single-eventos.php
* @package WordPress
* @subpackage alexiamora
* @since alexiamora 1.0
*/
get_header();?>
			<h2><?php _e('Eventos Artísticos', 'alexiamora'); ?></h2>
		</div><!-- .encabezado -->
	</header>
<section class="posts">
<?php if (have_posts()):while(have_posts()):the_post();?>
	<article class="single fondo_oscuro">
		<h2><?php the_title();?></h2>
		<figure class="nota_completa">
			<?php if(wpmd_is_notphone()) { ?>
				<?php
					if( has_post_thumbnail() ) {
						the_post_thumbnail('custom-thumb-1000-x');
					} else {
						echo '<img src="'.get_stylesheet_directory_uri().'/img/nota.jpg" alt="'.__('Sin imagen', 'alexiamora').'" />';
					};
				?>
			<?php } else { ?>
				<?php
					if( has_post_thumbnail() ) {
						the_post_thumbnail('custom-thumb-600-x');
					} else {
						echo '<img src="'.get_stylesheet_directory_uri().'/img/nota.jpg" alt="'.__('Sin imagen', 'alexiamora').'" />';
					};
				?>
			<?php };?>
			<figcaption>
				<?php _e('Publicado el: ','alexiamora'); the_time('j/m/Y');?>
			</figcaption>
		</figure>

		<div class="contenido">
			<?php the_content();?>
		</div>
		<div class="clearfix"></div>

		<?php $attachID = ( get_post_meta( $post->ID, 'custom_imagenrepetible', true) );
		if ( $attachID[0] != null ) { ?>
		<hr />
		<div class="galeria_fotos">
			<?php if(wpmd_is_notphone()) { ?>
				<?php
				//Listado de imágenes
					$attachID = (get_post_meta( $post->ID, 'custom_imagenrepetible', true));
					foreach ($attachID as $item) {
						$imagen = wp_get_attachment_image_src($item,'custom-thumb-600-334');
						$imagen_big = wp_get_attachment_image_src($item,'custom-thumb-1800-x');
						$alt = get_post_meta($item, '_wp_attachment_image_alt', true);
						$descripcion = get_post_field('post_content', $item);
						if ( $imagen[0] != null ) {
							echo '<figure><a class="fancybox" title="'.$alt.'" rel="gallery'.$post->ID.'" href="'.$imagen_big[0].'"><img src="'.$imagen[0].'" alt="'.$alt.'" /></a><figcaption>'.$alt.'</figcaption></figure>';
							if (count($alt)) {};
					};};?>
			<?php } else { ?>
				<?php
					//Listado de imágenes
					$attachID = (get_post_meta( $post->ID, 'custom_imagenrepetible', true));
					foreach ($attachID as $item) {
						$imagen = wp_get_attachment_image_src($item,'custom-thumb-600-x');
						$alt = get_post_meta($item, '_wp_attachment_image_alt', true);
						$descripcion = get_post_field('post_content', $item);
						if ( $imagen[0] != null ) {
							echo '<figure><img src="'.$imagen[0].'" alt="'.$alt.'" /><figcaption>'.$alt.'</figcaption></figure>';
							if (count($alt)) {};
						};
					};?>
			<?php };?>
		</div>
		<?php };
		$google_maps = do_shortcode('[codepeople-post-map]');?>
		<figure class="google_maps">
			<figcaption>
				<?php _e('Ubicación del evento', 'alexiamora');?>
			</figcaption>
			<?php echo $google_maps;?>
		</figure>
	</article>
	<article class="navegacion_posts fondo_oscuro">
		<?php if( get_previous_post_link() !='' ) { ?>
		<p>
			<?php echo _e("Anterior: ", "alexiamora");?><span class="ver_mas"><?php previous_post_link();?></span>
		</p>
		<?php };
		if( get_next_post_link() != '' ) { ?>
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