<?php
/*
* @package WordPress
* @subpackage alexiamora
* @since alexiamora 1.0
*/

/* Cargar Panle de Opciones
/*-----------------------------------------*/
if ( !function_exists( 'optionsframework_init' ) )
{
	define( 'OPTIONS_FRAMEWORK_DIRECTORY', get_template_directory_uri() . '/includes/' );
	require_once dirname( __FILE__ ) . '/includes/options-framework.php';
}

// Deshabilitar Iconos Emoji
remove_action('wp_head', 'print_emoji_detection_script', 7);
remove_action('wp_print_styles', 'print_emoji_styles');

// Permitir comentarios encadenados
function enable_threaded_comments()
{
	if(is_singular() AND comments_open() AND (get_option('thread_comments')==1))
	{
		wp_enqueue_script('comment-reply');
	}
};
add_action('get_header','enable_threaded_comments');



// Remover clases automáticas del the_post_thumbnail
function the_post_thumbnail_remove_class($output)
{
	$output = preg_replace('/class=".*?"/', '', $output);
    return $output;
}
add_filter('post_thumbnail_html', 'the_post_thumbnail_remove_class');


//Remover atributos de ancho y alto de las imágenes insertadas
add_filter( 'post_thumbnail_html', 'remove_width_attribute', 10 );
add_filter( 'image_send_to__ditor', 'remove_width_attribute', 10 );
function remove_width_attribute( $html )
{
   $html = preg_replace( '/(width|height)="\d*"\s/', "", $html );
   return $html;
};


//Cambiar el logo del login y la url del mismo y el título
function custom_login_logo()
{
	echo '<style type="text/css">
		h1 a
		{
			background: url('.get_bloginfo('stylesheet_directory').'/img/logo.png) center center no-repeat !important;
			width: 300px !important;
			height: 150px !important;
			background-size: 50% !important;
		}
		div#login {padding:0 !important;}
		</style>';
};
add_action('login_head', 'custom_login_logo');
function the_url( $url )
{
    return get_bloginfo( 'url' );
}
add_filter( 'login_headerurl', 'the_url' );
function change_wp_login_title()
{
	return get_option('blogname');
};
add_filter('login_headertitle', 'change_wp_login_title');


//Permitir svg en las imágenes para cargar.
function cc_mime_types($mimes)
{
	$mimes['svg']='image/svg+xml';return $mimes;
};
add_filter('upload_mimes','cc_mime_types');


// Deshabilitar la edición desde otros programas, el link corto y la versión del WP.
remove_action('wp_head', 'rsd_link');
remove_action('wp_head', 'wp_generator');
remove_action('wp_head', 'feed_links', 2);
remove_action('wp_head', 'index_rel_link', 1);
remove_action('wp_head', 'wlwmanifest_link');
remove_action('wp_head', 'feed_links__xtra', 3);
remove_action('wp_head', 'wp_shortlink_wp_head');
remove_action('wp_head', 'parent_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link', 10, 0);
remove_action('wp_head', 'start_post_rel_link', 10, 0);
remove_action('wp_head', 'adjacent_posts_rel_link_wp_head', 10, 0);
remove_action('wp_head', 'rel_canonical');


//Remover clases e ids automáticos de los menúes
add_filter('nav_menu_css_class', 'my_css_attributes_filter', 100, 1);
add_filter('nav_menu_item_id', 'my_css_attributes_filter', 100, 1);
add_filter('page_css_class', 'my_css_attributes_filter', 100, 1);
function my_css_attributes_filter($var)
{
	return is_array($var) ? array_intersect($var, array('current-menu-item', 'current_page_item')) : '';
};


// Personalizar las palabras del excerpt; o sea de los pequeños reúmenes.
function custom__xcerpt_length($length)
{
	return 45;
}; 
add_filter('excerpt_length','custom__xcerpt_length');


//Remover versiones de los scripts y css innecesarios
function remove_script_version($src)
{
	$parts = explode('?', $src); return $parts[0];
};
add_filter('script_loader_src','remove_script_version',15,1);
// add_filter('style_loader_src','remove_script_version',15,1);


// Deshabilitar los enlaces automáticos en los comentarios
remove_filter('comment_text','make_clickable',9);


//Cambio del avatar de WordPress por uno personalizado
function nuevoGravatar($avatar_defaults)
{
    $nuevo = get_bloginfo("stylesheet_directory").'/img/favicon-32x32.png';
    $avatar_defaults[$nuevo] = 'Alexia Mora';
    return $avatar_defaults;
}
add_filter('avatar_defaults', 'nuevoGravatar');


//Modifica el pie de página del panel de administarción
function remove_footer_admin()
{
	echo 'Creado por <a href="http://www.webmoderna.com.ar" target="_blank">...:: WebModerna | el futuro de la web ::...</a></p>';
};
add_filter('admin_footer_text','remove_footer_admin');


//Modificar los campos del perfil de usuario de WordPress
function extra_contact_info($contactmethods)
{
	unset($contactmethods['aim']);
	unset($contactmethods['yim']);
	unset($contactmethods['jabber']);
	$contactmethods['facebook']='Facebook';
	$contactmethods['twitter']='Twitter';
	$contactmethods['google_mas']='Google+';
	$contactmethods['perfil_feed']='RSS';
	return $contactmethods;
};
add_filter('user_contactmethods','extra_contact_info');


//Añadir imágenes a los feeds rss
function rss_post_thumbnail($content)
{
	global $post; 
	if(has_post_thumbnail($post->ID))
		{
			$content='<p>'.get_the_post_thumbnail($post->ID).'</p>'.get_the_content();
		};
	return $content;
};
add_filter('the__xcerpt_rss','rss_post_thumbnail');
add_filter('the_content_feed','rss_post_thumbnail');


//Remover versión del WordPress
function remove_wp_version()
{
	return'';
};
add_filter('the_generator','remove_wp_version');


//Eliminar el atributo rel="category tag".
function remove_category_list_rel($output)
{
	return str_replace(' rel="category tag"','',$output);
};
add_filter('wp_list_categories','remove_category_list_rel');
add_filter('the_category','remove_category_list_rel');


//Eliminar css y scripts de comentarios cuando no hagan falta
function clean_header()
{
	wp_deregister_script('comment-reply');
};
add_action('init','clean_header');


//Definir tamaños personalizados de miniaturas - hay que configurarlas
add_theme_support('post-thumbnails', array(
	'post',
	'page',
	'post_type_obra',
	'eventos'
	));
add_image_size('custom-thumb-1800-800', 1560, 900, true);//Slideshow Inicio - Desktop
add_image_size('custom-thumb-1800-x', 1800, false);
add_image_size('custom-thumb-800-600', 1200, 900, true);//Slideshow Inicio - Tablets
add_image_size('custom-thumb-1240-x', 1240, false);
add_image_size('custom-thumb-1000-x', 1000, false);
add_image_size('custom-thumb-600-334', 600, 334, true);//Slideshow Inicio - Móviles
add_image_size('custom-thumb-600-x', 600, false);
add_image_size('custom-thumb-300-x', 300, false);
add_image_size('custom-thumb-100-100', 100, 100, true);


// Habilitar la compresión de imágenes
add_filter('jpeg_quality', create_function('','return 50;'));


//Registrar las menúes de navegación
register_nav_menus (array(
	'header_nav'  => __('Menú Principal',  'alexiamora'),
	'footer_nav'  => __('Menú Secundario', 'alexiamora')
	)
);


// Agregar nofollow a los enlaces externos
function auto_nofollow($content)
{
    return preg_replace_callback('/<a>]+/', 'auto_nofollow_callback', $content);
}
function auto_nofollow_callback($matches)
{
    $link = $matches[0];
    $site_link = get_bloginfo('url');
    if (strpos($link, 'rel') === false)
    {
        $link = preg_replace("%(href=S(?!$site_link))%i", 'rel="nofollow" $1', $link);
    }
    elseif (preg_match("%href=S(?!$site_link)%i", $link))
    {
        $link = preg_replace('/rel=S(?!nofollow)S*/i', 'rel="nofollow"', $link);
    }
    return $link;
}
add_filter('comment_text', 'auto_nofollow');


//Habilitar botones de edición avanzados
function habilitar_mas_botones($buttons)
{
	$buttons[]='hr';
	$buttons[]='sub';
	$buttons[]='sup';
	$buttons[]='fontselect';
	$buttons[]='fontsizeselect';
	$buttons[]='cleanup';
	$buttons[]='styleselect';
	return $buttons;
};
add_filter("mce_buttons_3","habilitar_mas_botones");


// Agregar varias imágenes a las entradas y páginas
function add_custom_meta_box() {
	add_meta_box(
	'custom_meta_box', // id
	'<strong>'.__('Subir las fotos del producto desde aquí', 'alexiamora').'</strong>', // título
	'show_custom_meta_box', // función a la que llamamos
	'page', // sólo para páginas
	'normal', // contexto
	'high'); // prioridad

	add_meta_box(
	'custom_meta_box', // id
	'<strong>'.__('Subir las fotos del producto desde aquí', 'alexiamora').'</strong>', // título
	'show_custom_meta_box', // función a la que llamamos
	'post', // sólo para entradas
	'normal', // contexto
	'high'); // prioridad

	add_meta_box(
	'custom_meta_box', // id
	'<strong>'.__('Subir las fotos del producto desde aquí', 'alexiamora').'</strong>', // título
	'show_custom_meta_box', // función a la que llamamos
	'eventos', // sólo para eventos
	'normal', // contexto
	'high'); // prioridad
};
add_action('add_meta_boxes', 'add_custom_meta_box');

// Para imágenes cargamos el script sólo si estamos en páginas.
function add_admin_scripts ($hook) {
	global $post;
	if ( $hook == 'post-new.php' || $hook == 'post.php' ) {wp_enqueue_script('custom-js', get_stylesheet_directory_uri().'/js/custom-js.js');}
};
add_action( 'admin_enqueue_scripts', 'add_admin_scripts', 10, 1 );

//Nombre del campo personalizado.
$prefix = 'custom_';
$custom_meta_fields = array( // Dentro de este array podemos incluir más tipos
	array(
		'label'  => 'Fotos',
		'desc'   => '<strong>IMPORTANTE!!: </strong>Las imágenes deben ser mínimo de <strong><i style="color:red;">2048px (ancho) por 1536px (alto);</i></strong> ya que hay que optimizar para Tablets y Móviles, es muy importante cargar imágenes al doble del tamaño en el cual van a aparecer en la página web (A las imágenes más chicas o de diferentes tamaños, el sistema las cortará autmáticamente). Tiene que ser de esta forma para que se pueda optimizar y ver correctamente en los dispositivos con tecnología Retina Display. Estos aparatos lo que hacen es cuadriplicar la densidad en píxeles; por lo tanto una foto común ser vería en esos dispositivos en la mitad de su tamaño real (en el mejor de los casos); o si no, horriblemente pixelada (lo más común).
		',
		'id'     => $prefix.'imagenrepetible',
		'type'   => 'imagenrepetible' ));

// Función show custom metabox. Es larguísimaaaa!!!
function show_custom_meta_box() {
	global $custom_meta_fields, $post;
	// Usamos nonce para verificación
    /*echo '<input type="hidden" name="custom_meta_box_nonce" value="'.wp_create_nonce(basename(__FILE__)).'" />';
    Reemplazé por lo de más abajo para desaparecer los errores del depurador
    */
    wp_nonce_field( basename( __FILE__ ), 'custom_meta_box_nonce' );
 // Creamos la tabla de campos personalizados y empezamos un loop con todos ellos
	echo '<table class="form-table">';
	foreach ($custom_meta_fields as $field) { // Hacemos un loop con todos los campos personalizados
					// obtenemos el valor del campo personalizado si existe para este $post->ID
		$meta = get_post_meta($post->ID, $field['id'], true);
					// comenzamos una fila de la tabla
	echo '<tr><th><label for="'.$field['id'].'">'.$field['label'].'</label></th><td>';
	switch($field['type']) { // Si tenemos varios tipos de campos aquí se seleccionan
// En nuestro caso tenemos solo uno: Imagen repetible
	case 'imagenrepetible': // Lo que pone en "type" más arriba
		$image = get_stylesheet_directory_uri().'/img/favicon.png'; // Ponemos una imagen por defecto
		echo '<i class="custom_default_image" style="display:none">'.$image.'</i>'; // Al principio no la mostramos
		echo '<ul id="'.$field['id'].'-repeatable" class="custom_repeatable">';
		$i = 0;
	if ($meta) { // Si get_post_meta nos ha dado valores, hacemos un foreach
		foreach($meta as $row) {

// Obtenemos la imagen en su tamaño máximo. Podéis poner en su lugar thumbnail, medium o large
		$image = wp_get_attachment_image_src($row, 'custom-thumb-300-x');
// la primera parte de wp_get_attachment_image_src nos da su url.
		$image = $image[0]; ?>
	<li><!-- Añadimos la imagen que se arrastra para cambiar posición, dentro de tu tema -->
		<i class="sort hndle" style="float:left;"><img src="<?php echo get_stylesheet_directory_uri().'/img/drag_drop.gif';?>" />&nbsp;&nbsp;&nbsp;</i>
	<!-- El input con el valor del meta. Su attributo "name" tiene un número que se irá incrementando a medida que creamos nuevos campos -->
	<input name="<?php echo $field['id'] . '['.$i.']'; ?>" id="<?php echo $field['id']; ?>" type="hidden" class="custom_upload_image" value="<?php echo $row; ?>" />
	<!-- mostramos la imagen con 200px de ancho para ver lo que hemos subido -->
	<img src="<?php echo $image; ?>" class="custom_preview_image" alt="" width="200"/><br />
	<!-- El botón de Seleccionar Imagen -->
	<input class="custom_upload_image_button button" type="button" value="Seleccionar imagen" />
	<!-- Los botones de eliminar imagen y de quitar fila-->
	<small><a href="#" class="custom_clear_image_button">Eliminar imagen</a></small>
	&nbsp;&nbsp;&nbsp;<a class="repeatable-remove button" href="#"><?php _e('Quitar fila', 'alexiamora');?></a>
</li>
	<?php $i++; // Incrementamos el contador para que no se repita el atributo "name"
} // Fin del foreach
	} else { // Si no hay datos ?>

<li><i class="sort hndle" style="float:left;"><img src="<?php echo get_stylesheet_directory_uri().'/img/drag_drop.gif';?>" />&nbsp;&nbsp;&nbsp;</i>
	<input name="<?php echo $field['id'] . '['.$i.']'; ?>" id="<?php echo $field['id']; ?>" type="hidden" class="custom_upload_image" value="<?php echo $row; ?>" />
	<img src="<?php echo $image; ?>" class="custom_preview_image" alt="" width="200" /><br />
	<input class="custom_upload_image_button button" type="button" value="<?php _e('Seleccionar imagen', 'alexiamora');?>" />
	<small><a href="#" class="custom_clear_image_button"><?php _e('Eliminar imagen', 'alexiamora');?></a></small>
	&nbsp;&nbsp;&nbsp;<a class="repeatable-remove button" href="#"><?php _e('Quitar fila', 'alexiamora');?></a>
</li>
<?php } ?>
</ul><br />
<!-- Botón para añadir una nueva fila -->
<a class="repeatable-add button-primary" href="#">+<?php _e(' Agregar Imagen', 'alexiamora');?></a>
<!-- Aquí va la descripción -->
<br clear="all" /><br /><p class="description"><?php echo $field['desc']; ?></p>
<?php break;} // fin del switch
	echo '</td></tr>';} // fin del foreach
	echo '</table>'; // fin de la tabla
}; // Fin de la función

// Grabar los datos de las imágenes subidas.
function save_custom_meta($post_id) {
	global $custom_meta_fields;
// verificamos usando nonce
/*if (!wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
Reemplazé por lo de más abajo para desaparecer los errores del depurador.*/
    if (!isset($_POST['custom_meta_box_nonce']) || !wp_verify_nonce($_POST['custom_meta_box_nonce'], basename(__FILE__)))
    return $post_id;
// comprobamos si se ha realizado una grabación automática, para no tenerla en cuenta
	if (defined('DOING_AUTOSAVE') && DOING_AUTOSAVE)
	return $post_id;
// comprobamos que el usuario puede editar
	if ('page' == $_POST['post_type']) {
		if (!current_user_can('edit_page', $post_id))
		return $post_id;
		} elseif (!current_user_can('edit_post', $post_id)) {
		return $post_id;
}
// hacemos un loop por todos los campos y guardamos los datos
	foreach ($custom_meta_fields as $field) {
		$old = get_post_meta($post_id, $field['id'], true);
		$new = $_POST[$field['id']];
	if ($new && $new != $old) {
		update_post_meta($post_id, $field['id'], $new);
	} elseif ('' == $new && $old) {
		delete_post_meta($post_id, $field['id'], $old);}
	} // final del foreach
};
add_action('save_post', 'save_custom_meta');

// Paginación avanzada
function pagination($pages = '', $range = 4)
{
	$pagina_palabra = __('Página', 'alexiamora');
	$de_palabra = __('de', 'alexiamora');
	$showitems = ($range * 2)+1;
	global $paged;
	if(empty($paged)) $paged = 1;
	if($pages == '')
	{
		global $wp_query;
		$pages = $wp_query->max_num_pages;
		if(!$pages)
		{
			$pages = 1;
		}
	}
	if(1 != $pages)
	{
		echo "<ul class='pagination'><li>".$pagina_palabra." ".$paged." ".$de_palabra." ".$pages."</li>";
		if($paged > 2 && $paged > $range+1 && $showitems < $pages) echo "<a href='".get_pagenum_link(1)."'>&laquo;</a>";
		if($paged > 1 && $showitems < $pages) echo "<a href='".get_pagenum_link($paged - 1)."'>&lsaquo;</a>";
		for ($i=1; $i <= $pages; $i++)
		{
			if (1 != $pages &&( !($i >= $paged+$range+1 || $i <= $paged-$range-1) || $pages <= $showitems ))
			{
				echo ($paged == $i)? "<li class='current'>".$i."</li>":"<a href='".get_pagenum_link($i)."' class='inactive'>".$i."</a>";
			}
		}
		if ($paged < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($paged + 1)."'>&rsaquo;</a>"; 
		if ($paged < $pages-1 &&  $paged+$range-1 < $pages && $showitems < $pages) echo "<a href='".get_pagenum_link($pages)."'>&raquo;</a>";
		echo "</ul>\n";
	}
};


//Para hacer posible que esta plantilla pueda cambiar de idioma
load_theme_textdomain('alexiamora',TEMPLATEPATH.'/languages');
$locale = get_locale();
$locale_file = TEMPLATEPATH."/languages/$locale.php";
if(is_readable($locale_file)) require_once($locale_file);


//Detén las adivinanzas de URLs de WordPress
add_filter('redirect_canonical','stop_guessing');
function stop_guessing($url)
{
	if(is_404())
	{
		return false;
	}
	return $url;
}

//Ocultar los errores en la pantalla de Inicio de sesión de WordPress
function no__rrors_please()
{
	return __('¡Sal de mi jardín! ¡AHORA MISMO!', 'alexiamora');
};
add_filter('login__rrors','no__rrors_please');


//Eliminar palabras cortas de URL
function remove_short_words($slug)
{
    if (!is_admin()) return $slug;
    $slug = explode('-', $slug);
    foreach ($slug as $k => $word)
    {
        if (strlen($word) < 3)
        {
            unset($slug[$k]);
        }
    }
    return implode('-', $slug);
};
add_filter('sanitize_title', 'remove_short_words');

//Relativas las urls
function relative_url()
{
    // Don't do anything if:
    // - In feed
    // - In sitemap by WordPress SEO plugin
    if ( is_feed() || get_query_var( 'sitemap' ) )
      return;
    $filters = array(
      'post_link',       // Normal post link
      'post_type_link',  // Custom post type link
      'page_link',       // Page link
      'attachment_link', // Attachment link
      'get_shortlink',   // Shortlink
      'post_type_archive_link',    // Post type archive link
      'get_pagenum_link',          // Paginated link
      'get_comments_pagenum_link', // Paginated comment link
      'term_link',   // Term link, including category, tag
      'search_link', // Search link
      'day_link',   // Date archive link
      'month_link',
      'year_link',

    // site location
	// Los comento porque generan error en el modo Depuración en WordPress

	// 'option_siteurl',
	// 'option_home',
	// 'admin_url',
	// 'home_url',
	// 'site_url',//Hasta acá estaba comentado
	'blog_option_siteurl',
	'includes_url',
	'site_option_siteurl',
	'network_home_url',
	'network_site_url',

      // debug only filters
      'get_the_author_url',
      'get_comment_link',
      'wp_get_attachment_image_src',
      'wp_get_attachment_thumb_url',
      'wp_get_attachment_url',
      'wp_login_url',
      'wp_logout_url',
      'wp_lostpassword_url',
      'get_stylesheet_uri',
      'get_stylesheet_directory_uri',//
      'plugins_url',//
      'plugin_dir_url',//
      'stylesheet_directory_uri',//
      'get_template_directory_uri',//
      'template_directory_uri',//
      'get_locale_stylesheet_uri',
      'script_loader_src', // plugin scripts url
      // 'style_loader_src', // plugin styles url
      'get_theme_root_uri',
      // 'home_url'
    );
    foreach ( $filters as $filter )
    {
      add_filter( $filter, 'wp_make_link_relative' );
    };
    home_url($path = '', $scheme = null);
};
add_action( 'template_redirect', 'relative_url', 0 );

// Register Custom Post Type Obras
function custom_post_type_obras() {
	$labels = array(
		'name'                => _x( 'Obras', 'Post Type General Name', 'alexiamora' ),
		'singular_name'       => _x( 'Obra', 'Post Type Singular Name', 'alexiamora' ),
		'menu_name'           => __( 'Obras Artísticas', 'alexiamora' ),
		'parent_item_colon'   => __( 'Item superior:', 'alexiamora' ),
		'all_items'           => __( 'Todas las obras', 'alexiamora' ),
		'view_item'           => __( 'Ver obra', 'alexiamora' ),
		'add_new_item'        => __( 'Agregar nueva obra', 'alexiamora' ),
		'add_new'             => __( 'Agregar nueva', 'alexiamora' ),
		'edit_item'           => __( 'Editar obra', 'alexiamora' ),
		'update_item'         => __( 'Actualizar obra', 'alexiamora' ),
		'search_items'        => __( 'Buscar alexiamora', 'alexiamora' ),
		'not_found'           => __( 'No hay nada', 'alexiamora' ),
		'not_found_in_trash'  => __( 'No hay nada en la papelera', 'alexiamora' ),
	);
	$rewrite = array(
		'slug'                => 'obra',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'Obras Artísticas', 'alexiamora' ),
		'description'         => __( 'Listado de obras artísticas', 'alexiamora' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'post-formats', 'pagination', 'comments' ),
		'taxonomies'          => array('taxonomia_obras'),
		'hierarchical'        => false,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-portfolio',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'query_var'           => '',
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'post_type_obra', $args );
};
add_action( 'init', 'custom_post_type_obras', 0 );

// Register Custom Taxonomy Para Obras
function taxonomia_obras() {
	$labels = array(
		'name'                       => _x( 'Categorías de Obras', 'Taxonomy General Name', 'alexiamora' ),
		'singular_name'              => _x( 'Categoría de Obra', 'Taxonomy Singular Name', 'alexiamora' ),
		'menu_name'                  => __( 'Categorías de Obras', 'alexiamora' ),
		'all_items'                  => __( 'Todos las categorías', 'alexiamora' ),
		'parent_item'                => __( 'Item superior', 'alexiamora' ),
		'parent_item_colon'          => __( 'Item superior:', 'alexiamora' ),
		'new_item_name'              => __( 'Nuevo nombre de item', 'alexiamora' ),
		'add_new_item'               => __( 'Agregar nuevo item', 'alexiamora' ),
		'edit_item'                  => __( 'Editar item', 'alexiamora' ),
		'update_item'                => __( 'Actualizar item', 'alexiamora' ),
		'separate_items_with_commas' => __( 'Separar items con comas', 'alexiamora' ),
		'search_items'               => __( 'Buscar items', 'alexiamora' ),
		'add_or_remove_items'        => __( 'Agregar o remover items', 'alexiamora' ),
		'choose_from_most_used'      => __( 'Elegir el item más usado', 'alexiamora' ),
		'not_found'                  => __( 'No hay items.', 'alexiamora' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => false,
		'query_var'                  => '',
	);
	register_taxonomy( 'obras', 'post_type_obra', $args );

}
add_action( 'init', 'taxonomia_obras', 1 );

// Definiendo unos metaboxes para las medidas y las técnicas
function product_add_box()
{
	add_meta_box('product_price_box', 'Información de la obra', 'product_box' , 'post_type_obra');
};
function product_box()
{
    if( isset($_REQUEST['post']) )
    {
        $tecnica = "";
        $tecnica = get_post_meta( $_REQUEST['post'] , 'll_product_tecnica' , true );
        $width = "";
        $width = get_post_meta( (int)$_REQUEST['post'] , 'll_product_width' , true );
        $high = "";
        $high = get_post_meta( (int)$_REQUEST['post'] , 'll_product_high' , true );
	}; // Tomando la información de los metaboxes desde el panel. ?>
<label for="ll_product_tecnica"><?php _e('Técnica utilzada', 'alexiamora');?></label>
<input id="ll_product_tecnica" class="" name="ll_product_tecnica" size="20" type="text" value="<?php echo $tecnica;?>" />
<label for="ll_product_width"><?php _e('Ancho en centímetros', 'alexiamora');?></label>
<input id="ll_product_width" class="" name="ll_product_width" size="5" type="text" value="<?php echo $width;?>" />
<label for="ll_product_high"><?php _e('Alto en centímetros', 'alexiamora');?></label>
<input id="ll_product_high" class="" name="ll_product_high" size="5" type="text" value="<?php echo $high;?>" />
<?php
};
add_action('add_meta_boxes', 'product_add_box', 2);

//Guardando la información de los metaboxes
function product_save_meta($postID)
{
	if( is_admin() )
	{
		if(isset($_POST['ll_product_tecnica']))
		{
			update_post_meta($postID, 'll_product_tecnica', $_POST['ll_product_tecnica']);
		};
		if(isset($_POST['ll_product_width']))
		{
			update_post_meta($postID, 'll_product_width', $_POST['ll_product_width']);
		};
		if(isset($_POST['ll_product_high']))
		{
			update_post_meta($postID, 'll_product_high', $_POST['ll_product_high']);
		};
	};
};
add_action( 'save_post' , 'product_save_meta', 3 );


// Register Custom Post Type Eventos
function custom_post_type_eventos()
{
	$labels = array(
		'name'                => _x( 'Eventos Artísticos', 'Post Type General Name', 'alexiamora' ),
		'singular_name'       => _x( 'Evento Artístico', 'Post Type Singular Name', 'alexiamora' ),
		'menu_name'           => __( 'Eventos Artísticos', 'alexiamora' ),
		'parent_item_colon'   => __( 'Item superior:', 'alexiamora' ),
		'all_items'           => __( 'Todos los eventos', 'alexiamora' ),
		'view_item'           => __( 'Ver evento', 'alexiamora' ),
		'add_new_item'        => __( 'Agregar un nuevo evento', 'alexiamora' ),
		'add_new'             => __( 'Agregar nuevo', 'alexiamora' ),
		'edit_item'           => __( 'Editar evento', 'alexiamora' ),
		'update_item'         => __( 'Actualizar evento', 'alexiamora' ),
		'search_items'        => __( 'Buscar eventos', 'alexiamora' ),
		'not_found'           => __( 'No hay eventos', 'alexiamora' ),
		'not_found_in_trash'  => __( 'No hay eventos en la papelera', 'alexiamora' ),
	);
	$rewrite = array(
		'slug'                => 'eventos',
		'with_front'          => true,
		'pages'               => true,
		'feeds'               => true,
	);
	$args = array(
		'label'               => __( 'eventos', 'alexiamora' ),
		'description'         => __( 'Eventos artísticos a realizarse', 'alexiamora' ),
		'labels'              => $labels,
		'supports'            => array( 'title', 'editor', 'thumbnail', 'comments', 'post-formats', 'pagination' ),
		'taxonomies'          => array( 'post_tag' ),
		'hierarchical'        => true,
		'public'              => true,
		'show_ui'             => true,
		'show_in_menu'        => true,
		'show_in_nav_menus'   => true,
		'show_in_admin_bar'   => true,
		'menu_position'       => 5,
		'menu_icon'           => 'dashicons-groups',
		'can_export'          => true,
		'has_archive'         => true,
		'exclude_from_search' => false,
		'publicly_queryable'  => true,
		'rewrite'             => $rewrite,
		'capability_type'     => 'post',
	);
	register_post_type( 'eventos', $args );
};
// Hook into the 'init' action
add_action( 'init', 'custom_post_type_eventos', 0 );

/*// Register Custom Taxonomy para Eventos
function eventos() {

	$labels = array(
		'name'                       => _x( 'Eventos', 'Taxonomy General Name', 'alexiamora' ),
		'singular_name'              => _x( 'Evento', 'Taxonomy Singular Name', 'alexiamora' ),
		'menu_name'                  => __( 'Categorías de Eventos', 'alexiamora' ),
		'all_items'                  => __( 'Todos los items', 'alexiamora' ),
		'parent_item'                => __( 'Item superior', 'alexiamora' ),
		'parent_item_colon'          => __( 'Item superior:', 'alexiamora' ),
		'new_item_name'              => __( 'Nuevo nombre de item', 'alexiamora' ),
		'add_new_item'               => __( 'Agregar nuevo item', 'alexiamora' ),
		'edit_item'                  => __( 'Editar item', 'alexiamora' ),
		'update_item'                => __( 'Actualizar item', 'alexiamora' ),
		'separate_items_with_commas' => __( 'Separar items con comas', 'alexiamora' ),
		'search_items'               => __( 'Buscar items', 'alexiamora' ),
		'add_or_remove_items'        => __( 'Agregar o remover items', 'alexiamora' ),
		'choose_from_most_used'      => __( 'Elegir el item más usado', 'alexiamora' ),
		'not_found'                  => __( 'No hay items.', 'alexiamora' ),
	);
	$args = array(
		'labels'                     => $labels,
		'hierarchical'               => true,
		'public'                     => true,
		'show_ui'                    => true,
		'show_admin_column'          => true,
		'show_in_nav_menus'          => true,
		'show_tagcloud'              => true,
		'query_var'                  => 'categoria_eventos',
	);
	register_taxonomy( 'eventos', 'eventos', $args );
}
// Hook into the 'init' action
add_action( 'init', 'eventos', 0 );*/


//Función para Minificar el HTML
/*
class WP_HTML_Compression
{
	protected $compress_css = true;
	protected $compress_js = true;
	protected $info_comment = true;
	protected $remove_comments = true;
	protected $html;
	public function __construct($html)
	{
		if (!empty($html))
		{
			$this->parseHTML($html);
		}
	}
	public function __toString()
	{
		return $this->html;
	}
	protected function bottomComment($raw, $compressed)
	{
		$raw = strlen($raw);
		$compressed = strlen($compressed);
		$savings = ($raw-$compressed) / $raw * 100;
		$savings = round($savings, 2);
		return '<!-- HTML Minify | Se ha reducido el tamaño de la web un '.$savings.'% | De '.$raw.' Bytes a '.$compressed.' Bytes -->';
	}
	protected function minifyHTML($html)
	{
		$pattern = '/<(?<script>script).*?<\/script\s*>|<(?<style>style).*?<\/style\s*>|<!(?<comment>--).*?-->|<(?<tag>[\/\w.:-]*)(?:".*?"|\'.*?\'|[^\'">]+)*>|(?<text>((<[^!\/\w.:-])?[^<]*)+)|/si';
		preg_match_all($pattern, $html, $matches, PREG_SET_ORDER);
		$overriding = false;
		$raw_tag = false;
		$html = '';
		foreach ($matches as $token)
		{
			$tag = (isset($token['tag'])) ? strtolower($token['tag']) : null;
			$content = $token[0];
			if (is_null($tag))
			{
				if ( !empty($token['script']) )
				{
					$strip = $this->compress_js;
				}
				else if ( !empty($token['style']) )
				{
					$strip = $this->compress_css;
				}
				else if ($content == '<!--wp-html-compression no compression-->')
				{
					$overriding = !$overriding;
					continue;
				}
				else if ($this->remove_comments)
				{
					if (!$overriding && $raw_tag != 'textarea')
					{
						$content = preg_replace('/<!--(?!\s*(?:\[if [^\]]+]|<!|>))(?:(?!-->).)*-->/s', '', $content);
					}
				}
			}
			else
			{
				if ($tag == 'pre' || $tag == 'textarea')
				{
					$raw_tag = $tag;
				}
				else if ($tag == '/pre' || $tag == '/textarea')
				{
					$raw_tag = false;
				}
				else
				{
					if ($raw_tag || $overriding)
					{
						$strip = false;
					}
					else
					{
						$strip = true;
						$content = preg_replace('/(\s+)(\w++(?<!\baction|\balt|\bcontent|\bsrc)="")/', '$1', $content);
						$content = str_replace(' />', '/>', $content);
					}
				}
			}
			if ($strip)
			{
				$content = $this->removeWhiteSpace($content);
			}
			$html .= $content;
		}
		return $html;
	}
	public function parseHTML($html)
	{
		$this->html = $this->minifyHTML($html);
		if ($this->info_comment)
		{
			$this->html .= "\n" . $this->bottomComment($html, $this->html);
		}
	}
	protected function removeWhiteSpace($str)
	{
		$str = str_replace("\t", ' ', $str);
		$str = str_replace("\n",  '', $str);
		$str = str_replace("\r",  '', $str);
		while (stristr($str, '  '))
		{
			$str = str_replace('  ', ' ', $str);
		}
		return $str;
	}
}
function wp_html_compression_finish($html)
{
	return new WP_HTML_Compression($html);
}
function wp_html_compression_start()
{
	ob_start('wp_html_compression_finish');
}
add_action('get_header', 'wp_html_compression_start');
*/


// Agrega un meta description
function myplugin_add_meta_box2()
{
	$screens = array( 'page', 'post', 'eventos' );
	foreach ( $screens as $screen )
	{
		add_meta_box(
			'myplugin_sectionid2',
			__( 'Meta: Descripción. Máximo 160 caracteres.', 'alexiamora' ),
			'myplugin_meta_box_callback2',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'myplugin_add_meta_box2' );

function myplugin_meta_box_callback2( $post )
{
	wp_nonce_field( 'myplugin_meta_box2', 'myplugin_meta_box_nonce2' );
	$value = get_post_meta( $post->ID, '_my_meta_value_key2', true );
	echo '<textarea maxlength="160" rows="2" style="width:100%;" id="myplugin_new_field2" placeholder="'.__('Es una descripción que aparece en el meta description. Es muy recomendable para SEO.', 'alexiamora').'" name="myplugin_new_field2">' . esc_attr( $value ) . '</textarea>';
}

function myplugin_save_meta_box_data2( $post_id )
{
	if ( ! isset( $_POST['myplugin_meta_box_nonce2'] ) )
	{
		return;
	}
	if ( ! wp_verify_nonce( $_POST['myplugin_meta_box_nonce2'], 'myplugin_meta_box2' ) )
	{
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
	{
		return;
	}
	if ( isset( $_POST['post_type'] ) && 'myplugin_new_field2' == $_POST['post_type'] )
	{
		if ( ! current_user_can( 'edit_page', $post_id ) )
		{
			return;
		}
	}
	else
	{
		if ( ! current_user_can( 'edit_post', $post_id ) )
		{
			return;
		}
	}
	if ( ! isset( $_POST['myplugin_new_field2'] ) )
	{
		return;
	}
	$my_data = sanitize_text_field( $_POST['myplugin_new_field2'] );
	update_post_meta( $post_id, '_my_meta_value_key2', $my_data );
}
add_action( 'save_post', 'myplugin_save_meta_box_data2' );


// Agrega un meta keywords
function myplugin_add_meta_box3()
{
	$screens = array( 'page', 'post', 'eventos' );
	foreach ( $screens as $screen )
	{
		add_meta_box(
			'myplugin_sectionid3',
			__( 'Meta: Palabras claves. Máximo 160 caracteres.', 'alexiamora' ),
			'myplugin_meta_box_callback3',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'myplugin_add_meta_box3' );

function myplugin_meta_box_callback3( $post )
{
	wp_nonce_field( 'myplugin_meta_box3', 'myplugin_meta_box_nonce3' );
	$value = get_post_meta( $post->ID, '_my_meta_value_key3', true );
	echo '<textarea maxlength="160" rows="1" style="width:100%;" id="myplugin_new_field3" placeholder="'.__('Palabras claves (keywords) separadas por comas. Son útiles para SEO en algunos buscadores.', 'alexiamora').'" name="myplugin_new_field3">' . esc_attr( $value ) . '</textarea>';
}

function myplugin_save_meta_box_data3( $post_id )
{
	if ( ! isset( $_POST['myplugin_meta_box_nonce3'] ) )
	{
		return;
	}
	if ( ! wp_verify_nonce( $_POST['myplugin_meta_box_nonce3'], 'myplugin_meta_box3' ) )
	{
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
	{
		return;
	}
	if ( isset( $_POST['post_type'] ) && 'myplugin_new_field3' == $_POST['post_type'] )
	{
		if ( ! current_user_can( 'edit_page', $post_id ) )
		{
			return;
		}
	}
	else
	{
		if ( ! current_user_can( 'edit_post', $post_id ) )
		{
			return;
		}
	}
	if ( ! isset( $_POST['myplugin_new_field3'] ) )
	{
		return;
	}
	$my_data = sanitize_text_field( $_POST['myplugin_new_field3'] );
	update_post_meta( $post_id, '_my_meta_value_key3', $my_data );
}
add_action( 'save_post', 'myplugin_save_meta_box_data3' );



// Agrega un enlace al botón
function myplugin_add_meta_box4()
{
	$screens = array( 'home_page' );
	foreach ( $screens as $screen )
	{
		add_meta_box(
			'myplugin_sectionid4',
			__( 'Botón principal', 'alexiamora' ),
			'myplugin_meta_box_callback4',
			$screen
		);
	}
}
add_action( 'add_meta_boxes', 'myplugin_add_meta_box4' );

function myplugin_meta_box_callback4( $post )
{
	wp_nonce_field( 'myplugin_meta_box4', 'myplugin_meta_box_nonce4' );
	$value = get_post_meta( $post->ID, '_my_meta_value_key4', true );
	echo '<label for="myplugin_new_field4">'._e('Texto a mostrar en el botón', 'alexiamora').'</label>';
	echo '<textarea maxlength="160" placeholder="'.__('Texto de Botón', 'alexiamora').'" rows="1" style="width:100%;" id="myplugin_new_field4" name="myplugin_new_field4">' . esc_attr( $value ) . '</textarea>';
}

function myplugin_save_meta_box_data4( $post_id )
{
	if ( ! isset( $_POST['myplugin_meta_box_nonce4'] ) )
	{
		return;
	}
	if ( ! wp_verify_nonce( $_POST['myplugin_meta_box_nonce4'], 'myplugin_meta_box4' ) )
	{
		return;
	}
	if ( defined( 'DOING_AUTOSAVE' ) && DOING_AUTOSAVE )
	{
		return;
	}
	if ( isset( $_POST['post_type'] ) && 'myplugin_new_field4' == $_POST['post_type'] )
	{
		if ( ! current_user_can( 'edit_page', $post_id ) )
		{
			return;
		}
	}
	else
	{
		if ( ! current_user_can( 'edit_post', $post_id ) )
		{
			return;
		}
	}
	if ( ! isset( $_POST['myplugin_new_field4'] ) )
	{
		return;
	}
	$my_data = sanitize_text_field( $_POST['myplugin_new_field4'] );
	update_post_meta( $post_id, '_my_meta_value_key4', $my_data );
}
add_action( 'save_post', 'myplugin_save_meta_box_data4' );

// Algo con respecto a las ssl seguro..
define( 'PILAU_REQUEST_PROTOCOL', isset( $_SERVER[ 'HTTPS' ] ) ? 'https' : 'http' );


;?>