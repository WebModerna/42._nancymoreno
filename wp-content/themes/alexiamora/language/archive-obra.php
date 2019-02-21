<?php
/* post_type_obra.php
* @package WordPress
* @subpackage alexiamora
* @since alexiamora 1.0
*/
get_header();?>
      <h2><?php _e('Listado de obras clasificadas por...', 'alexiamora'); ?></h2>
    </div><!-- .encabezado -->
  </header>
<section class="posts">

<?php  if (is_tax()) { ?>
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
$post_type = array ('post_type_obra');
$paged = (get_query_var('paged')) ? get_query_var('paged') : 1;
$args = array (
  'post_type'     =>  $post_type,
  'posts_per_page'  =>  get_option('posts_per_page'),
  'paged'       =>  $paged,
  'order'       =>  'DESC',
  );
$wp_query = new WP_Query($args);
if ($wp_query->have_posts()) : while ($wp_query->have_posts()) : $wp_query->the_post();?>

<article class="fondo_oscuro">
    <h2>
      <a href="<?php the_permalink();?>">
        <?php the_title();?>
      </a>
    </h2>
    <figure>
      <a href="<?php the_permalink();?>">
      <?php if(wpmd_is_notphone()) { ?>
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
            the_post_thumbnail('custom-thumb-600-334');
          } else {
            echo '<img src="'.get_stylesheet_directory_uri().'/img/nota.jpg" alt="'.__('Sin imagen', 'alexiamora').'" />';
          };
        ?>
      <?php };?>
      </a>
      <figcaption>
        <?php _e('Publicado el: ','alexiamora'); the_time('j/m/Y');?>
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
      <?php the_excerpt();?>
      <a href="<?php the_permalink();?>" class="ver_mas"><?php _e('Ver más...', 'alexiamora');?></a>
    </div>
  </article>

<?php
  endwhile;
  if (function_exists("pagination")){pagination();};
  else: ?>
  <article>
    <h3><?php _e('No hay ningún artículo con esta etiqueta que se haya publicado hasta ahora.', 'alexiamora');?>
    </h3>
  </article>
<?php endif; wp_reset_postdata(); wp_reset_query();?>
</section>
<?php get_footer();?>