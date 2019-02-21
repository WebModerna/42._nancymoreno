<?php
/* category.php
* @package WordPress
* @subpackage alexiamora
* @since alexiamora 1.0
*/
get_header();?>
      <h2><?php _e('Obras Artísticas', 'alexiamora'); ?></h2>
    </div><!-- .encabezado -->
  </header> 
<section class="posts_inline">

<!--<?php //$post = $posts[0]; ?>-->
<?php  if (is_category()) { ?>
  <?php } elseif( is_tag() ) { ?>
    <h2><?php _e('Etiqueta ', 'alexiamora');?> &#8216;<?php single_tag_title(); ?>&#8217;</h2>
  <?php } elseif (is_day()) { ?>
    <h2><?php _e('Archivo para ', 'alexiamora');?> <?php the_time('F jS Y'); ?>:</h2>
  <?php  } elseif (is_month()) { ?><h2>Archivo para <?php the_time('F, Y'); ?>:</h2>
  <?php } elseif (is_year()) { ?>
    <h2><?php _e('Archivo para ', 'alexiamora');?> <?php the_time('Y'); ?>:</h2>
  <?php } elseif (is_author()) { ?>
    <h2><?php _e('Archivo del autor', 'alexiamora');?></h2>
  <?php } elseif (isset($_GET['paged']) && !empty($_GET['paged'])) { ?>
    <h2><?php _e('Archivos del blog', 'alexiamora');?></h2>
<?php } ?>

<?php
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array (
  'post_type'     =>  'post_type_obra',
  'posts_per_page'  =>  get_option('posts_per_page'),
  'paged'       =>  $paged,
  'order'       =>  'ASC'
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
      <a class="fancybox" rel="gallery" href="<?php echo $src;?>">
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
<?php endif; wp_reset_postdata(); wp_reset_query();?>
</section>
<?php get_footer();?>