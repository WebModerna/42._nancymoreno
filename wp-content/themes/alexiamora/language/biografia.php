<?php
/*
* @package WordPress
* @subpackage alexiamora
* @since alexiamora 1.0
* Template Name: Biografía
*/
get_header();
if (have_posts()):while(have_posts()):the_post();?>
			<h2><?php bloginfo('description');?></h2>
		</div><!-- .encabezado -->
	</header>
	<section class="index">
		<article>
			<h2><?php _e('Biografía', 'alexiamora'); ?></h2>
			<?php the_content();?>
		</article>
	</section>
<?php
endwhile;
endif;
get_footer();?>