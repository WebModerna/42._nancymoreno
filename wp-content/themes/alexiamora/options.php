<?php
/**
 * A unique identifier is defined to store the options in the database and reference them from the theme.
 */
/*function optionsframework_option_name() {
	// Change this to use your theme slug
	return 'options-framework-theme';
}*/
function optionsframework_option_name() {
	// Nombre de la plantilla
	$themename = wp_get_theme();
	$themename = preg_replace("/W/", "_", strtolower($themename) );

	$optionsframework_settings = get_option( 'optionsframework' );
	$optionsframework_settings['id'] = $themename;
	update_option( 'optionsframework', $optionsframework_settings );
}

/**
 * Defines an array of options that will be used to generate the settings page and be saved in the database.
 * When creating the 'id' fields, make sure to use all lowercase and no spaces.
 *
 * If you are making your theme translatable, you should replace 'webtranslations'
 * with the actual text domain for your theme.  Read more:
 * http://codex.wordpress.org/Function_Reference/load_theme_textdomain
 */


function optionsframework_options()
{
	// Pestaña Configuración general
	$options[] = array(
	'name' => __('Configuración General', 'options_framework_theme'),
	'type' => 'heading');

	// Cambio del logo 1
	$options[] = array(
	'name' => __('Logotipo del Sitio Web', 'options_check'),
	'desc' => __('Selecciona el logo a mostrar en la web, tamaño 160px x 160px.', 'options_check'),
	'id' => 'logo_uploader',
	'type' => 'upload');

	// Cambio del logo 2
	$options[] = array(
	'name' => __('Logotipo del Sitio Web de diferente color', 'options_check'),
	'desc' => __('Selecciona el logo a mostrar en la web, tamaño 160px x 160px.', 'options_check'),
	'id' => 'logo_uploader2',
	'type' => 'upload');

	// Foto del artista
	$options[] = array(
	'name' => __('Foto del artista', 'options_check'),
	'desc' => __('Selecciona la foto del artista a mostrar en la web, tamaño 200px x 200px.', 'options_check'),
	'id' => 'logo_uploader3',
	'type' => 'upload');

	// Background normal del sitio web
	$options[] = array(
	'name' => __('Color de Fondo e Imagen de Fondo de la web', 'options_framework_theme'),
	'desc' => __('Selecciona una imagen grande de 1300px mínimo de ancho por 900px ó más de alto. También elegí un color de fondo.', 'options_framework_theme'),
	'id' => 'background_de_la_web',
	'type' => 'background',
	'class' => 'of-background-properties');

	// Background Retina Display del sitio web
	$options[] = array(
	'name' => __('Color de Fondo e Imagen Retina Display de Fondo de la web', 'options_framework_theme'),
	'desc' => __('Selecciona una imagen grande de 2600px mínimo de ancho por 1800px ó más de alto. También elegí un color de fondo.', 'options_framework_theme'),
	'id' => 'background_retina_de_la_web',
	'type' => 'background',
	'class' => 'of-background-properties');

	// Meta: keywords
	$options[] = array(
		'name' => __('Palabras claves', 'options_framework_theme'),
		'desc' => __('Introducir palabras claves de la web que son útiles para algunos buscadores. Muy importantes para SEO.', 'options_framework_theme'),
		'id' => 'meta_keywords2',
		'placeholder' => 'palabra1, palabra2, palabra3...',
		'class' => '',
		'type' => 'text'
	);

	// Data Fiscal
	$options[] = array(
		'name' => __('Descripción de la web', 'options_framework_theme'),
		'desc' => __('Introduzca una descripción breve acerca de qué se trata este sitio web. No más de 160 caracteres. Muy importante para SEO.', 'options_framework_theme'),
		'id' => 'meta_description_web',
		'placeholder' => 'Artistas dedicados al arte que late.',
		'class' => '',
		'type' => 'textarea'
	);

	// Google Analitics
	$options[] = array(
		'name' => __('Google Analitycs', 'options_framework_theme'),
		'desc' => __('Introduzca el script de Google Analitycs.', 'options_framework_theme'),
		'id' => 'google_analitycs',
		'placeholder' => 'var _gaq = _gaq || []; _gaq.push(["_setAccount", "UA-40089469-1"]); _gaq.push(["_trackPageview"]); etc...',
		'class' => '',
		'type' => 'textarea'
	);


	/*====================================================================================*/
	/* =================== Pestaña información de contacto ============================== */
	$options[] = array(
	'name' => __('Información de contacto', 'options_framework_theme'),
	'type' => 'heading' );

	// Facebook
	$options[] = array(
		'name' => __('Facebook', 'options_framework_theme'),
		'desc' => __('Introduzca el enlace a Facebook.', 'options_framework_theme'),
		'id' => 'facebook_contact',
		'class' => '',
		'placeholder' => 'www.facebook.com/usuario',
		'type' => 'text'
	);


	// Twitter
	$options[] = array(
		'name' => __('Twitter', 'options_framework_theme'),
		'desc' => __('Introduzca su enlace a Twitter.', 'options_framework_theme'),
		'id' => 'twitter_contact',
		'placeholder' => 'www.twitter.com/usuario',
		'class' => '',
		'type' => 'text'
	);

	// LinkedIn
	$options[] = array(
		'name' => __('LinkedIn', 'options_framework_theme'),
		'desc' => __('Introduzca su enlace al perfil de LinkedIn.', 'options_framework_theme'),
		'id' => 'linkedin_contact',
		'placeholder' => 'www.linkedin.com/usuario',
		'class' => '',
		'type' => 'text'
	);

	// Google+
	$options[] = array(
		'name' => __('Google+', 'options_framework_theme'),
		'desc' => __('Introduzca su enlace a Google+.', 'options_framework_theme'),
		'id' => 'google_plus_contact',
		'placeholder' => 'plus.google.com/usuario',
		'class' => '',
		'type' => 'text'
	);

	// Email de contacto
	$options[] = array(
		'name' => __('E-mail de contacto', 'options_framework_theme'),
		'desc' => __('Introduzca el Email de contacto, se mostrará al pie del sitio web en un ícono.', 'options_framework_theme'),
		'id' => 'email_contact',
		'placeholder' => 'tu-mail@lo-que-sea.com.ar',
		'class' => '',
		'type' => 'text'
	);

	// Una dirección
	$options[] = array(
		'name' => __('Dirección y teléfono de contacto', 'options_framework_theme'),
		'desc' => __('Introduzca una ciudad, provincia, país, calle, número, etc... También un teléfono. Se mostrará al pie del sitio web.', 'options_framework_theme'),
		'id' => 'direccion_contact',
		'placeholder' => 'Calle Sin Nombre 0124, Dogoy Gruz, Menduka, Argentilandia - 0351-1213424',
		'class' => '',
		'type' => 'text'
	);

	$facebook_contact = of_get_option('facebook_contact','');
	$twitter_contact = of_get_option('twitter_contact','');
	$linkedin_contact = of_get_option('linkedin_contact', '');
	$google_plus_contact = of_get_option('google_plus_contact','');
	$email_contact = of_get_option('email_contact','');
	$direccion_contact = of_get_option('direccion_contact','');

	/* para guardar los campos en variable y para mostrarlos con un condicional
	<ul>
		<?php
			if($tel_contact){echo "<li><strong>Teléfono:</strong>" . $tel_contact . "</li>";}
			if($email_contact){ echo "<li><strong>Email:</strong>" . $email_contact . "</li>";}
			if($dir_contact){ echo"<li><strong>Dirección:</strong>" . $dir_contact . "</li>";}
			if($cp_contact){echo"<li><strong>Cp:</strong>" . $cp_contact . "</li>";}
		?>
	</ul>

	*/

	/* ============================================================================== */
	/* Panel de la home page =========================================================*/
	$options[] = array(
	'name' => __('Página de portada principal', 'options_framework_theme'),
	'type' => 'heading');

	// Nombre y apellido completo
	$options[] = array(
		'name' => __('Nombre y Apellido', 'options_framework_theme'),
		'desc' => __('Introduzca su nombre y apellido completo.', 'options_framework_theme'),
		'id' => 'nombre_web',
		'placeholder' => 'Fulgencio Baryz',
		'class' => 'mini',
		'type' => 'text'
	);

	// Alguna descripción del sitio web
	$options[] = array(
		'name' => __('Descripción', 'options_framework_theme'),
		'desc' => __('Introduzca una descripción corta.', 'options_framework_theme'),
		'id' => 'descripcion_web',
		'placeholder' => 'Arte que late',
		'class' => '',
		'type' => 'text'
	);

	// Título profesional
	$options[] = array(
		'name' => __('Currículum Vitae Profesional', 'options_framework_theme'),
		'desc' => __('Introduzca su autobriografía profesional.', 'options_framework_theme'),
		'id' => 'briografia_web',
		'placeholder' => __('Lorem ipsum dolor sit amet, consectetur adipisicing elit. Autem architecto voluptas ipsam sequi ipsum odit perspiciatis dolor in odio illo iusto quo, reprehenderit facilis cum dignissimos nesciunt explicabo est. Nemo.', 'options_framework_theme'),
		// 'class' => 'mini',
		'type' => 'editor'
	);

	/*=============================================================*/
	// Pestaña Configuración general
	$options[] = array(
	'name' => __('Configuración del Slider', 'options_framework_theme'),
	'type' => 'heading');

	// Poner todas las taxonomías en un array
	/*$taxonomies = array();
	$taxonomies_obj = get_categories( 'post_type=post_type_obra');
	foreach ( $taxonomies_obj as $tag ) {
		$taxonomies[$tag->term_id] = $tag->name;
	};*/
	$taxonomies = array();
	$taxonomies_obj = get_terms( 'post_type_obra' );
	foreach ( $taxonomies as $term ) {
		$taxonomies[$tag->term_id] = $tag->name;
	}


	// If using image radio buttons, define a directory path
	$imagepath =  get_template_directory_uri() . '/img/';


	if ( $taxonomies ) {
		$options[] = array(
			'name' => __( 'Categorías de obras artísticas', 'alexiamora' ),
			'desc' => __( 'Seleccionar una tipo de obra artísica.', 'alexiamora' ),
			'id' => 'example_select_taxonomies',
			'type' => 'select',
			'options' => $taxonomies
		);
	}

	$options[] = array(
		'name' => __( 'Activador del Slider', 'options_framework_theme' ),
		'desc' => __( 'Activar Slider.', 'options_framework_theme' ),
		'id' => 'activar_slider_checkbox',
		'std' => '0',
		'type' => 'checkbox'
	);

	return $options;
}