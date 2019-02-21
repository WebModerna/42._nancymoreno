<?php
/*
* @package WordPress
* @subpackage alexiamora
* @since alexiamora 1.0
*/
get_header();?>
			<h2><?php _e('Error 404.', 'alexiamora'); ?></h2>
		</div><!-- .encabezado -->
	</header>	
<section class="posts">
	<article class="fondo_oscuro">
		<h2><?php _e('No entiendo qué estás buscando. Cualquiera! Intentá de nuevo, pero bien...ok?', 'alexiamora');?></h2>
		<figure>
				<?php
					echo '<img src="'.get_stylesheet_directory_uri().'/img/nota.jpg" alt="'.__('Sin imagen', 'alexiamora').'" />';
				?>
			<figcaption>
				<?php _e('Publicado el: ¿...? Tu dirás?','alexiamora');?>
			</figcaption>
		</figure>
		<div class="tags">
			<?php 
				if(get_the_tags()!='') {
					the_tags();
				} else {
					_e('Etiquetas: Ninguna', 'alexiamora');
				};
			?>
		</div>
		<div class="contenido">	
		</div>
	</article>
</section>
<?php get_footer();?>