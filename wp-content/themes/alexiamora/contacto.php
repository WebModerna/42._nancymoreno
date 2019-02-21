<?php
/*
* @package WordPress
* @subpackage alexiamora
* @since alexiamora 1.0
* Template Name: Contacto
*/
get_header();?>
<?php if (have_posts()):while(have_posts()):the_post();get_page($page_id);$page_data=get_page($page_id);?>
			<h2><?php the_title();?></h2>
		</div><!-- .encabezado -->
	</header>	
<section>
	<article>
		<?php echo do_shortcode('[contact-form-7 id="4" title="Formulario de contacto 1"]');?>
	</article>
<?php endwhile; else: ?>
	<article>
		<h3><?php _e('No hay ningún formulario publicado hasta ahora.', 'alexiamora');?></h3>
	</article>
<?php endif;?>
</section>
<?php get_footer();?>