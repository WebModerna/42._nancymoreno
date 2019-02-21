<!-- <div class="slider-_-content">
	<ul id="cbp-bislideshow" class="cbp-bislideshow"> -->
<div class="slider--content cycle-slideshow"
	data-cycle-timeout="4000"
	data-cycle-speed="2000"
	data-cycle-loader="true"
	data-cycle-pause-on-hover="true"
	data-cycle-auto-height="container"
	>
	<div class="cycle-prev"></div>
	<div class="cycle-next"></div>
<?php
// WP_Query arguments
$args = array(
	'post_type' => 'post_type_obra',
	'orderby'	=> 'rand',
	'tax_query' => array(
		array(
			'taxonomy' => 'obras',
			'field'    => 'slug',
			'terms'    => 'pinturas'
		)
	)
);

// The Query
$el_slideshow = new WP_Query( $args );

// The Loop
if ( $el_slideshow->have_posts() ) {
	while ( $el_slideshow->have_posts() ) {
		$el_slideshow->the_post();
		// do something


		if(wpmd_is_notphone())
		{

			if( has_post_thumbnail() )
			{
				the_post_thumbnail('custom-thumb-800-600');
			}
		} else {
			if( has_post_thumbnail() )
			{
				the_post_thumbnail('custom-thumb-600-334');
			}
		}
	}
} else {
	// no posts found ?>
	<img src="<?php bloginfo('stylesheet_directory');?>/img/1.jpg" alt="image01"/>
	<img src="<?php bloginfo('stylesheet_directory');?>/img/2.jpg" alt="image02"/>
	<img src="<?php bloginfo('stylesheet_directory');?>/img/3.jpg" alt="image03"/>
	<img src="<?php bloginfo('stylesheet_directory');?>/img/4.jpg" alt="image04"/>
	<img src="<?php bloginfo('stylesheet_directory');?>/img/5.jpg" alt="image05"/>
	<img src="<?php bloginfo('stylesheet_directory');?>/img/6.jpg" alt="image06"/>
<?php }

// Restore original Post Data
wp_reset_postdata();?>
</div>