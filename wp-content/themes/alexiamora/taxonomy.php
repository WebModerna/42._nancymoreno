<?php
/* taxonomy.php
* @package WordPress
* @subpackage alexiamora
* @since alexiamora 1.0
*/
get_header();?>
			<h2><?php single_term_title(); ?></h2>
		</div><!-- .encabezado -->
	</header>
<section class="posts_inline">

<?php if ( have_posts() ) : while ( have_posts() ) : the_post();?>
	<article>
		<figure>
		<?php if(wpmd_is_notphone()) { ?>
			<a class="fancybox" rel="gallery" href="<?php the_permalink();?>">
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
					the_post_thumbnail('custom-thumb-600-x');
				} else {
					echo '<img src="'.get_stylesheet_directory_uri().'/img/nota.jpg" alt="'.__('Sin imagen', 'alexiamora').'" />';
				};
			?>
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
<?php endif;?>
</section>
<?php get_footer();?>