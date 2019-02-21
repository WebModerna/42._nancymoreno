<?php
/*
* archives.php
* @package WordPress
* @subpackage alexiamora
* @since alexiamora 1.0
*/
get_header();?>
<h2><?php $category = get_the_category(); echo $category[0]->cat_name; ?></h2>
		</div><!-- .encabezado -->
	</header>	
<section class="posts">
<?php if (have_posts()):while(have_posts()):the_post();?>